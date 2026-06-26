<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinancialExpense;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FinanceDataController extends Controller
{
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
