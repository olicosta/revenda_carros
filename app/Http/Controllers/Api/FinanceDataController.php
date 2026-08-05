<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinancialAccount;
use App\Models\FinancialCategory;
use App\Models\FinancialEntry;
use App\Models\FinancialEntryPayment;
use App\Models\FinancialExpense;
use App\Models\Seller;
use App\Models\Vehicle;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FinanceDataController extends Controller
{
    private const ENTRY_STATUSES = ['pendente', 'parcial', 'pago', 'recebido', 'vencido', 'cancelado'];

    public function summary(Request $request): JsonResponse
    {
        $period = $this->periodFromRequest($request);
        $entries = FinancialEntry::query()
            ->with(['account:id,name,type', 'category:id,name,type,dre_group,vehicle_cost'])
            ->where(function ($query) use ($period) {
                $query
                    ->whereBetween('competence_date', [$period['start'], $period['end']])
                    ->orWhereBetween('due_at', [$period['start'], $period['end']])
                    ->orWhereBetween('settled_at', [$period['start'], $period['end']]);
            })
            ->get();

        $previousEntries = FinancialEntry::query()
            ->whereBetween('competence_date', [$period['previous_start'], $period['previous_end']])
            ->get();

        $sales = \App\Models\Sale::query()
            ->whereBetween('sold_at', [$period['start'], $period['end']])
            ->get();
        $availableVehicles = Vehicle::query()->where('status', '!=', 'Vendido')->get();
        $soldVehicles = Vehicle::query()->where('status', 'Vendido')->get();

        $income = $this->sumEntries($entries, 'receber', includeTransfers: false);
        $expenses = $this->sumEntries($entries, 'pagar', includeTransfers: false);
        $paidOut = $this->sumPaid($entries, 'pagar');
        $received = $this->sumPaid($entries, 'receber');
        $receivable = $this->sumOpen($entries, 'receber');
        $payable = $this->sumOpen($entries, 'pagar');
        $overdue = $entries
            ->filter(fn (FinancialEntry $entry) => $entry->status !== 'cancelado'
                && $entry->due_at
                && $entry->due_at->lt(today())
                && ((float) $entry->open_amount) > 0)
            ->sum(fn (FinancialEntry $entry) => (float) $entry->open_amount);

        $stockCapital = $availableVehicles->sum(
            fn (Vehicle $vehicle) => (float) $vehicle->purchase_price
                + (float) $vehicle->preparation_cost
                + (float) $vehicle->fees_cost
        );
        $averageTicket = $sales->count() ? $sales->avg(fn ($sale) => (float) $sale->sale_value) : 0;
        $vehicleResults = $sales->map(fn ($sale) => $this->vehicleResultForSale($sale));
        $grossProfit = $vehicleResults->sum('gross_result');
        $netResult = $income - $expenses;

        return response()->json([
            'data' => [
                'period' => $period,
                'cards' => [
                    'saldo_consolidado' => $this->accountBalances(),
                    'entradas_periodo' => round($income, 2),
                    'saidas_periodo' => round($expenses, 2),
                    'contas_a_pagar' => round($payable, 2),
                    'contas_a_receber' => round($receivable, 2),
                    'contas_vencidas' => round($overdue, 2),
                    'receita_vendas' => round((float) $sales->sum('sale_value'), 2),
                    'despesas_operacionais' => round($paidOut, 2),
                    'lucro_bruto' => round($grossProfit, 2),
                    'resultado_liquido' => round($netResult, 2),
                    'fluxo_caixa_projetado' => round($received - $paidOut + $receivable - $payable, 2),
                    'capital_estoque' => round($stockCapital, 2),
                    'veiculos_estoque' => $availableVehicles->count(),
                    'ticket_medio' => round((float) $averageTicket, 2),
                    'margem_media' => round($this->averageMargin($vehicleResults), 2),
                    'dias_medios_estoque' => round($this->averageStockDays($availableVehicles), 1),
                    'periodo_anterior_resultado' => round(
                        $this->sumEntries($previousEntries, 'receber', false)
                        - $this->sumEntries($previousEntries, 'pagar', false),
                        2
                    ),
                ],
                'account_balances' => FinancialAccount::query()->get()->map(fn ($account) => [
                    'id' => $account->id,
                    'name' => $account->name,
                    'type' => $account->type,
                    'balance' => round($this->balanceForAccount($account), 2),
                ]),
                'alerts' => $this->managementAlerts($entries, $availableVehicles, $vehicleResults),
                'low_margin_vehicles' => $vehicleResults
                    ->filter(fn ($result) => $result['gross_result'] < 0 || $result['margin_percent'] < 8)
                    ->values(),
            ],
        ]);
    }

    public function accounts(): JsonResponse
    {
        return response()->json([
            'data' => FinancialAccount::query()->orderByDesc('is_default')->orderBy('name')->get(),
        ]);
    }

    public function storeAccount(Request $request): JsonResponse
    {
        $account = FinancialAccount::query()->create($this->accountAttributes($request));

        return response()->json(['data' => $account], 201);
    }

    public function updateAccount(Request $request, FinancialAccount $account): JsonResponse
    {
        $account->update($this->accountAttributes($request, $account));

        return response()->json(['data' => $account->refresh()]);
    }

    public function categories(): JsonResponse
    {
        return response()->json([
            'data' => FinancialCategory::query()->orderBy('type')->orderBy('name')->get(),
        ]);
    }

    public function entries(Request $request): JsonResponse
    {
        $query = FinancialEntry::query()
            ->with(['account:id,name,type', 'category:id,name,type,vehicle_cost,dre_group'])
            ->orderByRaw('coalesce(due_at, competence_date, issued_at) desc')
            ->orderByDesc('id');

        if ($request->filled('type')) {
            $query->where('direction', $request->query('type'));
        }

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', (int) $request->query('vehicle_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->filled('month') || ($request->filled('from') && $request->filled('to'))) {
            $period = $this->periodFromRequest($request);
            $query->where(function ($subQuery) use ($period) {
                $subQuery
                    ->whereBetween('competence_date', [$period['start'], $period['end']])
                    ->orWhereBetween('due_at', [$period['start'], $period['end']])
                    ->orWhereBetween('settled_at', [$period['start'], $period['end']]);
            });
        }

        return response()->json(['data' => $query->limit(500)->get()->map(fn ($entry) => $this->entryPayload($entry))]);
    }

    public function report(Request $request): JsonResponse
    {
        $period = $this->periodFromRequest($request);
        $entries = FinancialEntry::query()
            ->with(['account:id,name,type', 'category:id,name,type,dre_group,vehicle_cost'])
            ->where('status', '!=', 'cancelado')
            ->where(function ($query) use ($period) {
                $query
                    ->whereBetween('competence_date', [$period['start'], $period['end']])
                    ->orWhereBetween('due_at', [$period['start'], $period['end']])
                    ->orWhereBetween('settled_at', [$period['start'], $period['end']]);
            })
            ->get();

        $dreGroups = [
            'receita_bruta' => 0,
            'deducoes' => 0,
            'receita_liquida' => 0,
            'custo_veiculos_vendidos' => 0,
            'resultado_bruto' => 0,
            'despesas_comerciais' => 0,
            'despesas_administrativas' => 0,
            'despesas_financeiras' => 0,
            'outras_receitas' => 0,
            'outras_despesas' => 0,
            'resultado_operacional' => 0,
            'resultado_liquido' => 0,
        ];

        foreach ($entries as $entry) {
            if ($entry->is_transfer) {
                continue;
            }

            $group = $entry->category?->dre_group;
            $amount = (float) $entry->final_amount;

            if ($entry->direction === 'receber') {
                $dreGroups[$group ?: 'outras_receitas'] += $amount;
            } elseif ($group) {
                $dreGroups[$group] += $amount;
            } else {
                $dreGroups['outras_despesas'] += $amount;
            }
        }

        $dreGroups['receita_liquida'] = $dreGroups['receita_bruta'] - $dreGroups['deducoes'];
        $dreGroups['resultado_bruto'] = $dreGroups['receita_liquida'] - $dreGroups['custo_veiculos_vendidos'];
        $dreGroups['resultado_operacional'] = $dreGroups['resultado_bruto']
            - $dreGroups['despesas_comerciais']
            - $dreGroups['despesas_administrativas']
            - $dreGroups['despesas_financeiras']
            + $dreGroups['outras_receitas']
            - $dreGroups['outras_despesas'];
        $dreGroups['resultado_liquido'] = $dreGroups['resultado_operacional'];

        $cashflow = $entries
            ->groupBy(fn (FinancialEntry $entry) => ($entry->settled_at ?? $entry->due_at ?? $entry->competence_date)?->format('Y-m-d') ?? 'sem-data')
            ->map(function ($items, $date) {
                $received = $this->sumPaid($items, 'receber');
                $paid = $this->sumPaid($items, 'pagar');

                return [
                    'date' => $date,
                    'received' => round($received, 2),
                    'paid' => round($paid, 2),
                    'projected_open' => round($this->sumOpen($items, 'receber') - $this->sumOpen($items, 'pagar'), 2),
                    'balance' => round($received - $paid, 2),
                ];
            })
            ->sortBy('date')
            ->values();

        return response()->json([
            'data' => [
                'period' => $period,
                'dre' => array_map(fn ($value) => round($value, 2), $dreGroups),
                'cashflow' => $cashflow,
                'unreconciled' => $entries
                    ->filter(fn (FinancialEntry $entry) => ! $entry->settled_at && ((float) $entry->open_amount) > 0)
                    ->map(fn (FinancialEntry $entry) => $this->entryPayload($entry))
                    ->values(),
            ],
        ]);
    }

    public function storeEntry(Request $request): JsonResponse
    {
        $entry = DB::transaction(function () use ($request) {
            $entry = FinancialEntry::query()->create($this->entryAttributes($request));
            $this->syncLegacyExpense($entry);

            return $entry->refresh()->load(['account', 'category']);
        });

        return response()->json(['data' => $this->entryPayload($entry)], 201);
    }

    public function updateEntry(Request $request, FinancialEntry $entry): JsonResponse
    {
        if ($entry->status === 'cancelado') {
            abort(422, 'Lançamentos cancelados não podem ser alterados.');
        }

        $entry = DB::transaction(function () use ($request, $entry) {
            $entry->update($this->entryAttributes($request, $entry));
            $this->syncLegacyExpense($entry);

            return $entry->refresh()->load(['account', 'category']);
        });

        return response()->json(['data' => $this->entryPayload($entry)]);
    }

    public function settleEntry(Request $request, FinancialEntry $entry): JsonResponse
    {
        if ($entry->status === 'cancelado') {
            abort(422, 'Não é possível baixar um lançamento cancelado.');
        }

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'paid_at' => ['required', 'date'],
            'financial_account_id' => ['nullable', 'integer', 'exists:financial_accounts,id'],
            'payment_method' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $entry = DB::transaction(function () use ($validated, $entry, $request) {
            FinancialEntryPayment::query()->create([
                'financial_entry_id' => $entry->id,
                'financial_account_id' => $validated['financial_account_id'] ?? $entry->financial_account_id,
                'paid_at' => $validated['paid_at'],
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'] ?? $entry->payment_method,
                'notes' => $validated['notes'] ?? null,
                'created_by' => $request->user()?->id,
            ]);

            $paid = (float) $entry->payments()->sum('amount');
            $final = (float) $entry->final_amount;
            $entry->update([
                'paid_amount' => min($paid, $final),
                'settled_at' => $paid >= $final ? $validated['paid_at'] : $entry->settled_at,
                'status' => $paid >= $final
                    ? ($entry->direction === 'receber' ? 'recebido' : 'pago')
                    : 'parcial',
                'updated_by' => $request->user()?->id,
            ]);

            $this->syncLegacyExpense($entry);

            return $entry->refresh()->load(['account', 'category', 'payments']);
        });

        return response()->json(['data' => $this->entryPayload($entry)]);
    }

    public function cancelEntry(Request $request, FinancialEntry $entry): JsonResponse
    {
        $validated = $request->validate([
            'reason' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $entry = DB::transaction(function () use ($entry, $validated, $request) {
            $entry->update([
                'status' => 'cancelado',
                'cancel_reason' => $validated['reason'],
                'updated_by' => $request->user()?->id,
            ]);

            FinancialEntry::query()->create([
                'direction' => $entry->direction === 'receber' ? 'pagar' : 'receber',
                'description' => 'Estorno: '.$entry->description,
                'financial_account_id' => $entry->financial_account_id,
                'financial_category_id' => $entry->financial_category_id,
                'vehicle_id' => $entry->vehicle_id,
                'sale_id' => $entry->sale_id,
                'seller_id' => $entry->seller_id,
                'competence_date' => today(),
                'issued_at' => today(),
                'due_at' => today(),
                'settled_at' => today(),
                'original_amount' => $entry->paid_amount,
                'final_amount' => $entry->paid_amount,
                'paid_amount' => $entry->paid_amount,
                'payment_method' => $entry->payment_method,
                'status' => $entry->direction === 'receber' ? 'pago' : 'recebido',
                'is_reversal' => true,
                'reversal_of_entry_id' => $entry->id,
                'notes' => $validated['reason'],
                'created_by' => $request->user()?->id,
            ]);

            $this->syncLegacyExpense($entry);

            return $entry->refresh()->load(['account', 'category']);
        });

        return response()->json(['data' => $this->entryPayload($entry)]);
    }

    public function vehicleFinance(Vehicle $vehicle): JsonResponse
    {
        $entries = FinancialEntry::query()
            ->with(['category:id,name,type,vehicle_cost,dre_group', 'account:id,name,type'])
            ->where('vehicle_id', $vehicle->id)
            ->where('status', '!=', 'cancelado')
            ->orderByDesc('competence_date')
            ->get();
        $sale = \App\Models\Sale::query()->where('vehicle_id', $vehicle->id)->latest('sold_at')->first();
        $directCosts = $entries
            ->filter(fn (FinancialEntry $entry) => $entry->direction === 'pagar' && $entry->category?->vehicle_cost)
            ->sum(fn (FinancialEntry $entry) => (float) $entry->final_amount);
        $investment = (float) $vehicle->purchase_price + (float) $vehicle->preparation_cost + (float) $vehicle->fees_cost + $directCosts;
        $saleValue = $sale ? (float) $sale->sale_value : 0;
        $variableSaleExpenses = $entries
            ->filter(fn (FinancialEntry $entry) => $entry->direction === 'pagar' && ! $entry->category?->vehicle_cost)
            ->sum(fn (FinancialEntry $entry) => (float) $entry->final_amount);
        $grossResult = $saleValue ? $saleValue - $investment - $variableSaleExpenses : 0;

        return response()->json([
            'data' => [
                'vehicle_id' => $vehicle->id,
                'vehicle_name' => $vehicle->name,
                'purchase_value' => (float) $vehicle->purchase_price,
                'direct_costs' => round($directCosts, 2),
                'financial_costs' => 0,
                'investment_total' => round($investment, 2),
                'announced_price' => (float) $vehicle->sale_price,
                'sale_value' => round($saleValue, 2),
                'gross_result' => round($grossResult, 2),
                'margin_percent' => $saleValue ? round(($grossResult / $saleValue) * 100, 2) : 0,
                'stock_days' => $vehicle->created_at ? $vehicle->created_at->diffInDays(now()) : 0,
                'entries' => $entries->map(fn ($entry) => $this->entryPayload($entry))->values(),
            ],
        ]);
    }

    private function entryAttributes(Request $request, ?FinancialEntry $entry = null): array
    {
        $validated = $request->validate([
            'direction' => ['required', Rule::in(['pagar', 'receber'])],
            'description' => ['required', 'string', 'max:255'],
            'financial_account_id' => ['nullable', 'integer', 'exists:financial_accounts,id'],
            'financial_category_id' => ['nullable', 'integer', 'exists:financial_categories,id'],
            'vehicle_id' => ['nullable', 'integer', 'exists:vehicles,id'],
            'sale_id' => ['nullable', 'integer', 'exists:sales,id'],
            'lead_id' => ['nullable', 'integer', 'exists:leads,id'],
            'seller_id' => ['nullable', 'integer', 'exists:sellers,id'],
            'person_name' => ['nullable', 'string', 'max:255'],
            'cost_center' => ['nullable', 'string', 'max:255'],
            'competence_date' => ['nullable', 'date'],
            'issued_at' => ['nullable', 'date'],
            'due_at' => ['required', 'date'],
            'settled_at' => ['nullable', 'date'],
            'original_amount' => ['required', 'numeric', 'min:0'],
            'interest_amount' => ['nullable', 'numeric', 'min:0'],
            'fine_amount' => ['nullable', 'numeric', 'min:0'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'paid_amount' => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:255'],
            'installment_number' => ['nullable', 'integer', 'min:1'],
            'installments_total' => ['nullable', 'integer', 'min:1'],
            'recurrence' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(self::ENTRY_STATUSES)],
            'notes' => ['nullable', 'string'],
        ]);

        $original = (float) $validated['original_amount'];
        $interest = (float) ($validated['interest_amount'] ?? 0);
        $fine = (float) ($validated['fine_amount'] ?? 0);
        $discount = (float) ($validated['discount_amount'] ?? 0);
        $final = max(0, $original + $interest + $fine - $discount);
        $paid = min((float) ($validated['paid_amount'] ?? $entry?->paid_amount ?? 0), $final);
        $status = $validated['status'] ?? $this->statusForAmounts(
            $validated['direction'],
            $paid,
            $final,
            $validated['due_at']
        );

        return [
            ...$validated,
            'competence_date' => $validated['competence_date'] ?? $validated['due_at'],
            'issued_at' => $validated['issued_at'] ?? now()->toDateString(),
            'interest_amount' => $interest,
            'fine_amount' => $fine,
            'discount_amount' => $discount,
            'final_amount' => $final,
            'paid_amount' => $paid,
            'status' => $status,
            'updated_by' => $request->user()?->id,
            'created_by' => $entry ? $entry->created_by : $request->user()?->id,
        ];
    }

    private function accountAttributes(Request $request, ?FinancialAccount $account = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['caixa', 'banco', 'conta_digital'])],
            'opening_balance' => ['nullable', 'numeric'],
            'opening_balance_date' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(['ativa', 'inativa'])],
            'is_default' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string'],
        ]);

        if (($validated['is_default'] ?? false) === true) {
            FinancialAccount::query()
                ->when($account, fn ($query) => $query->whereKeyNot($account->id))
                ->update(['is_default' => false]);
        }

        return [
            'name' => $validated['name'],
            'type' => $validated['type'],
            'opening_balance' => $validated['opening_balance'] ?? 0,
            'opening_balance_date' => $validated['opening_balance_date'] ?? null,
            'status' => $validated['status'] ?? 'ativa',
            'is_default' => (bool) ($validated['is_default'] ?? $account?->is_default ?? false),
            'notes' => $validated['notes'] ?? null,
        ];
    }

    private function entryPayload(FinancialEntry $entry): array
    {
        return [
            'id' => $entry->id,
            'direction' => $entry->direction,
            'description' => $entry->description,
            'account' => $entry->account,
            'category' => $entry->category,
            'vehicle_id' => $entry->vehicle_id,
            'sale_id' => $entry->sale_id,
            'seller_id' => $entry->seller_id,
            'person_name' => $entry->person_name,
            'cost_center' => $entry->cost_center,
            'competence_date' => $entry->competence_date?->format('Y-m-d'),
            'issued_at' => $entry->issued_at?->format('Y-m-d'),
            'due_at' => $entry->due_at?->format('Y-m-d'),
            'settled_at' => $entry->settled_at?->format('Y-m-d'),
            'original_amount' => (float) $entry->original_amount,
            'final_amount' => (float) $entry->final_amount,
            'paid_amount' => (float) $entry->paid_amount,
            'open_amount' => (float) $entry->open_amount,
            'payment_method' => $entry->payment_method,
            'installment_number' => $entry->installment_number,
            'installments_total' => $entry->installments_total,
            'status' => $entry->status,
            'is_transfer' => $entry->is_transfer,
            'is_reversal' => $entry->is_reversal,
            'notes' => $entry->notes,
        ];
    }

    private function statusForAmounts(string $direction, float $paid, float $final, string $dueAt): string
    {
        if ($final > 0 && $paid >= $final) {
            return $direction === 'receber' ? 'recebido' : 'pago';
        }

        if ($paid > 0) {
            return 'parcial';
        }

        return CarbonImmutable::parse($dueAt)->isPast() ? 'vencido' : 'pendente';
    }

    private function periodFromRequest(Request $request): array
    {
        if ($request->filled('month')) {
            $start = CarbonImmutable::createFromFormat('Y-m', $request->query('month'))->startOfMonth();
            $end = $start->endOfMonth();
        } else {
            $start = $request->filled('from')
                ? CarbonImmutable::parse($request->query('from'))->startOfDay()
                : CarbonImmutable::now()->startOfMonth();
            $end = $request->filled('to')
                ? CarbonImmutable::parse($request->query('to'))->endOfDay()
                : CarbonImmutable::now()->endOfMonth();
        }

        $days = max(1, $start->diffInDays($end) + 1);
        $previousEnd = $start->subDay();
        $previousStart = $previousEnd->subDays($days - 1);

        return [
            'start' => $start->toDateString(),
            'end' => $end->toDateString(),
            'previous_start' => $previousStart->toDateString(),
            'previous_end' => $previousEnd->toDateString(),
        ];
    }

    private function sumEntries($entries, string $direction, bool $includeTransfers): float
    {
        return (float) $entries
            ->filter(fn (FinancialEntry $entry) => $entry->direction === $direction
                && $entry->status !== 'cancelado'
                && ($includeTransfers || ! $entry->is_transfer))
            ->sum(fn (FinancialEntry $entry) => (float) $entry->final_amount);
    }

    private function sumPaid($entries, string $direction): float
    {
        return (float) $entries
            ->filter(fn (FinancialEntry $entry) => $entry->direction === $direction
                && $entry->status !== 'cancelado'
                && ! $entry->is_transfer)
            ->sum(fn (FinancialEntry $entry) => (float) $entry->paid_amount);
    }

    private function sumOpen($entries, string $direction): float
    {
        return (float) $entries
            ->filter(fn (FinancialEntry $entry) => $entry->direction === $direction
                && $entry->status !== 'cancelado'
                && ! $entry->is_transfer)
            ->sum(fn (FinancialEntry $entry) => max(0, (float) $entry->open_amount));
    }

    private function accountBalances(): float
    {
        return (float) FinancialAccount::query()->get()->sum(fn ($account) => $this->balanceForAccount($account));
    }

    private function balanceForAccount(FinancialAccount $account): float
    {
        $entries = FinancialEntry::query()
            ->where('financial_account_id', $account->id)
            ->where('status', '!=', 'cancelado')
            ->get();
        $received = $entries->where('direction', 'receber')->sum(fn ($entry) => (float) $entry->paid_amount);
        $paid = $entries->where('direction', 'pagar')->sum(fn ($entry) => (float) $entry->paid_amount);

        return (float) $account->opening_balance + $received - $paid;
    }

    private function vehicleResultForSale($sale): array
    {
        $vehicle = Vehicle::query()->find($sale->vehicle_id);
        $vehicleCosts = FinancialEntry::query()
            ->where('vehicle_id', $sale->vehicle_id)
            ->where('direction', 'pagar')
            ->where('status', '!=', 'cancelado')
            ->sum('final_amount');
        $investment = $vehicle
            ? (float) $vehicle->purchase_price + (float) $vehicle->preparation_cost + (float) $vehicle->fees_cost + (float) $vehicleCosts
            : (float) $vehicleCosts;
        $saleValue = (float) $sale->sale_value;
        $gross = $saleValue - $investment - (float) $sale->commission_value;

        return [
            'vehicle_id' => $sale->vehicle_id,
            'vehicle_name' => $vehicle?->name ?? 'Veículo removido',
            'sale_value' => round($saleValue, 2),
            'investment_total' => round($investment, 2),
            'gross_result' => round($gross, 2),
            'margin_percent' => $saleValue ? round(($gross / $saleValue) * 100, 2) : 0,
        ];
    }

    private function averageMargin($vehicleResults): float
    {
        return $vehicleResults->count() ? (float) $vehicleResults->avg('margin_percent') : 0;
    }

    private function averageStockDays($vehicles): float
    {
        return $vehicles->count()
            ? (float) $vehicles->avg(fn (Vehicle $vehicle) => $vehicle->created_at?->diffInDays(now()) ?? 0)
            : 0;
    }

    private function managementAlerts($entries, $availableVehicles, $vehicleResults): array
    {
        $alerts = [];
        $overdueCount = $entries->filter(fn (FinancialEntry $entry) => $entry->due_at
            && $entry->due_at->lt(today())
            && $entry->status !== 'cancelado'
            && ((float) $entry->open_amount) > 0)->count();

        if ($overdueCount > 0) {
            $alerts[] = $overdueCount.' conta(s) vencida(s) precisam de atenção.';
        }

        $oldStock = $availableVehicles->filter(fn (Vehicle $vehicle) => ($vehicle->created_at?->diffInDays(now()) ?? 0) > 90)->count();
        if ($oldStock > 0) {
            $alerts[] = $oldStock.' veículo(s) há mais de 90 dias no estoque.';
        }

        $negative = $vehicleResults->filter(fn ($result) => $result['gross_result'] < 0)->count();
        if ($negative > 0) {
            $alerts[] = $negative.' venda(s) com resultado bruto negativo.';
        }

        return $alerts;
    }

    private function syncLegacyExpense(FinancialEntry $entry): void
    {
        if ($entry->direction !== 'pagar' || $entry->is_transfer || $entry->is_reversal) {
            return;
        }

        $attributes = [
            'expense_date' => $entry->competence_date ?? $entry->due_at ?? today(),
            'category' => $entry->category?->name ?? 'Outros',
            'amount' => $entry->final_amount,
            'description' => $entry->description,
            'payment_method' => $entry->payment_method,
            'vehicle_id' => $entry->vehicle_id,
            'responsible' => $entry->person_name,
            'notes' => $entry->notes,
            'metadata' => [
                'financial_entry_id' => $entry->id,
                'status' => $entry->status,
            ],
        ];

        if ($entry->source_expense_id) {
            FinancialExpense::query()->whereKey($entry->source_expense_id)->update($attributes);
            return;
        }

        if ($entry->status !== 'cancelado') {
            $expense = FinancialExpense::query()->create($attributes);
            $entry->forceFill(['source_expense_id' => $expense->id])->saveQuietly();
        }
    }

    public function expenses(): JsonResponse
    {
        return response()->json([
            'data' => FinancialExpense::query()
                ->orderByDesc('expense_date')
                ->orderByDesc('id')
                ->get()
                ->map(fn (FinancialExpense $expense) => $this->expenseToLegacy($expense))
                ->values(),
        ]);
    }

    public function syncExpenses(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'expenses' => ['present', 'array'],
            'expenses.*' => ['required', 'array'],
        ]);

        $expenses = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['expenses'] as $legacy) {
                $id = $this->nullableInteger($legacy['id'] ?? null);
                $attributes = [
                    'expense_date' => $legacy['data'] ?? now()->toDateString(),
                    'category' => $legacy['categoria'] ?? 'Outros',
                    'amount' => $this->number($legacy['valor'] ?? 0),
                    'description' => $legacy['descricao'] ?? 'Saída financeira',
                    'payment_method' => $this->nullableString($legacy['pagamento'] ?? null),
                    'vehicle_id' => $this->nullableInteger($legacy['veiculoId'] ?? null),
                    'responsible' => $this->nullableString($legacy['responsavel'] ?? null),
                    'notes' => $this->nullableString($legacy['observacao'] ?? null),
                    'metadata' => $legacy,
                ];

                $expense = $id
                    ? FinancialExpense::query()->updateOrCreate(['id' => $id], $attributes)
                    : FinancialExpense::query()->create($attributes);

                $ids[] = $expense->id;
            }

            $this->deleteMissing(FinancialExpense::query(), $ids);

            return FinancialExpense::query()
                ->orderByDesc('expense_date')
                ->orderByDesc('id')
                ->get()
                ->map(fn (FinancialExpense $expense) => $this->expenseToLegacy($expense))
                ->values();
        });

        return response()->json(['data' => $expenses]);
    }

    public function sellers(): JsonResponse
    {
        return response()->json([
            'data' => Seller::query()
                ->orderByDesc('status')
                ->orderBy('name')
                ->get()
                ->map(fn (Seller $seller) => $this->sellerToLegacy($seller))
                ->values(),
        ]);
    }

    public function syncSellers(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sellers' => ['present', 'array'],
            'sellers.*' => ['required', 'array'],
        ]);

        $sellers = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['sellers'] as $legacy) {
                $id = $this->nullableInteger($legacy['id'] ?? null);
                $attributes = [
                    'name' => $legacy['nome'] ?? 'Vendedor',
                    'phone' => $this->nullableString($legacy['whatsapp'] ?? null),
                    'status' => ($legacy['ativo'] ?? true) ? 'Ativo' : 'Inativo',
                    'commission_type' => $legacy['comissaoTipo'] ?? 'fixa',
                    'commission_default' => $this->number($legacy['comissaoPadrao'] ?? 0),
                    'commission_percentage' => $this->number($legacy['comissaoPercentualPadrao'] ?? 0),
                    'metadata' => $legacy,
                ];

                $seller = $id
                    ? Seller::query()->updateOrCreate(['id' => $id], $attributes)
                    : Seller::query()->create($attributes);

                $ids[] = $seller->id;
            }

            $this->deleteMissing(Seller::query(), $ids);

            return Seller::query()
                ->orderByDesc('status')
                ->orderBy('name')
                ->get()
                ->map(fn (Seller $seller) => $this->sellerToLegacy($seller))
                ->values();
        });

        return response()->json(['data' => $sellers]);
    }

    public function storeExpense(Request $request): JsonResponse
    {
        $legacy = $this->validateExpense($request);
        $id = $this->nullableInteger($legacy['id'] ?? null);
        $expense = FinancialExpense::query()->create(
            $id ? ['id' => $id, ...$this->expenseAttributes($legacy)] : $this->expenseAttributes($legacy)
        );

        return response()->json(['data' => $this->expenseToLegacy($expense)], 201);
    }

    public function updateExpense(Request $request, FinancialExpense $expense): JsonResponse
    {
        $legacy = $this->validateExpense($request, $expense);
        $expense->update($this->expenseAttributes($legacy));

        return response()->json(['data' => $this->expenseToLegacy($expense->refresh())]);
    }

    public function destroyExpense(FinancialExpense $expense): JsonResponse
    {
        $expense->delete();

        return response()->json(status: 204);
    }

    public function storeSeller(Request $request): JsonResponse
    {
        $legacy = $this->validateSeller($request);
        $id = $this->nullableInteger($legacy['id'] ?? null);
        $seller = Seller::query()->create(
            $id ? ['id' => $id, ...$this->sellerAttributes($legacy)] : $this->sellerAttributes($legacy)
        );

        return response()->json(['data' => $this->sellerToLegacy($seller)], 201);
    }

    public function updateSeller(Request $request, Seller $seller): JsonResponse
    {
        $legacy = $this->validateSeller($request, $seller);
        $seller->update($this->sellerAttributes($legacy));

        return response()->json(['data' => $this->sellerToLegacy($seller->refresh())]);
    }

    public function destroySeller(Seller $seller): JsonResponse
    {
        $seller->delete();

        return response()->json(status: 204);
    }

    private function validateExpense(Request $request, ?FinancialExpense $expense = null): array
    {
        $validated = $request->validate([
            'id' => ['nullable', 'integer', Rule::unique('financial_expenses', 'id')->ignore($expense?->id)],
            'data' => ['required', 'date'],
            'categoria' => ['required', 'string', 'max:255'],
            'valor' => ['required'],
            'descricao' => ['required', 'string', 'max:255'],
            'pagamento' => ['nullable', 'string', 'max:255'],
            'veiculoId' => ['nullable', 'integer'],
            'responsavel' => ['nullable', 'string', 'max:255'],
            'observacao' => ['nullable', 'string'],
        ]);

        return array_replace($request->all(), $validated);
    }

    private function validateSeller(Request $request, ?Seller $seller = null): array
    {
        $validated = $request->validate([
            'id' => ['nullable', 'integer', Rule::unique('sellers', 'id')->ignore($seller?->id)],
            'nome' => ['required', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'comissaoPadrao' => ['nullable'],
            'comissaoTipo' => ['nullable', 'string', 'max:255'],
            'comissaoPercentualPadrao' => ['nullable'],
            'ativo' => ['required', 'boolean'],
        ]);

        return array_replace($request->all(), $validated);
    }

    private function expenseAttributes(array $legacy): array
    {
        return [
            'expense_date' => $legacy['data'] ?? now()->toDateString(),
            'category' => $legacy['categoria'] ?? 'Outros',
            'amount' => $this->number($legacy['valor'] ?? 0),
            'description' => $legacy['descricao'] ?? 'Saída financeira',
            'payment_method' => $this->nullableString($legacy['pagamento'] ?? null),
            'vehicle_id' => $this->nullableInteger($legacy['veiculoId'] ?? null),
            'responsible' => $this->nullableString($legacy['responsavel'] ?? null),
            'notes' => $this->nullableString($legacy['observacao'] ?? null),
            'metadata' => $legacy,
        ];
    }

    private function sellerAttributes(array $legacy): array
    {
        return [
            'name' => $legacy['nome'] ?? 'Vendedor',
            'phone' => $this->nullableString($legacy['whatsapp'] ?? null),
            'status' => ($legacy['ativo'] ?? true) ? 'Ativo' : 'Inativo',
            'commission_type' => $legacy['comissaoTipo'] ?? 'fixa',
            'commission_default' => $this->number($legacy['comissaoPadrao'] ?? 0),
            'commission_percentage' => $this->number($legacy['comissaoPercentualPadrao'] ?? 0),
            'metadata' => $legacy,
        ];
    }

    private function expenseToLegacy(FinancialExpense $expense): array
    {
        return array_merge($expense->metadata ?? [], [
            'id' => $expense->id,
            'data' => $expense->expense_date?->format('Y-m-d'),
            'categoria' => $expense->category,
            'valor' => (float) $expense->amount,
            'descricao' => $expense->description,
            'pagamento' => $expense->payment_method ?? '',
            'veiculoId' => $expense->vehicle_id ?? '',
            'responsavel' => $expense->responsible ?? '',
            'observacao' => $expense->notes ?? '',
        ]);
    }

    private function sellerToLegacy(Seller $seller): array
    {
        return array_merge($seller->metadata ?? [], [
            'id' => $seller->id,
            'nome' => $seller->name,
            'whatsapp' => $seller->phone ?? '',
            'comissaoPadrao' => (float) $seller->commission_default,
            'comissaoTipo' => $seller->commission_type,
            'comissaoPercentualPadrao' => (float) $seller->commission_percentage,
            'ativo' => $seller->status === 'Ativo',
        ]);
    }

    private function deleteMissing($query, array $ids): void
    {
        if ($ids === []) {
            $query->delete();

            return;
        }

        $query->whereNotIn('id', $ids)->delete();
    }

    private function nullableInteger(mixed $value): ?int
    {
        return $value === null || $value === '' ? null : (int) $value;
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        return $value === '' ? null : $value;
    }

    private function number(mixed $value): float
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        return (float) preg_replace('/\D+/', '', (string) $value);
    }
}
