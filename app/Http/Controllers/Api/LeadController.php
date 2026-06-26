<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Lead::query()
                ->orderByRaw("CASE status WHEN 'Novo' THEN 1 WHEN 'Em atendimento' THEN 2 WHEN 'Proposta' THEN 3 WHEN 'Fechado' THEN 4 ELSE 5 END")
                ->orderBy('next_contact_at')
                ->orderByDesc('updated_at')
                ->get()
                ->map(fn (Lead $lead) => $this->toLegacy($lead))
                ->values(),
        ]);
    }

    public function sync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'leads' => ['present', 'array'],
            'leads.*' => ['required', 'array'],
        ]);

        $leads = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['leads'] as $legacy) {
                $id = $this->nullableInteger($legacy['id'] ?? null);
                $historico = is_array($legacy['historico'] ?? null)
                    ? $legacy['historico']
                    : [];
                $ultimaInteracao = $historico[0]['texto'] ?? null;
                $attributes = [
                    'name' => $legacy['nome'] ?? 'Cliente',
                    'phone' => $this->nullableString($legacy['whatsapp'] ?? null),
                    'email' => $this->nullableString($legacy['email'] ?? null),
                    'vehicle_id' => $this->nullableInteger($legacy['veiculoId'] ?? null),
                    'source' => $this->nullableString($legacy['origem'] ?? null),
                    'status' => $legacy['status'] ?? 'Novo',
                    'next_contact_at' => ($legacy['proximoContato'] ?? null) ?: null,
                    'last_interaction' => $this->nullableString($ultimaInteracao),
                    'notes' => $this->nullableString($legacy['observacao'] ?? null),
                    'metadata' => $legacy,
                ];

                $lead = $id
                    ? Lead::query()->updateOrCreate(['id' => $id], $attributes)
                    : Lead::query()->create($attributes);

                $ids[] = $lead->id;
            }

            if ($ids === []) {
                Lead::query()->delete();
            } else {
                Lead::query()->whereNotIn('id', $ids)->delete();
            }

            return Lead::query()
                ->orderByRaw("CASE status WHEN 'Novo' THEN 1 WHEN 'Em atendimento' THEN 2 WHEN 'Proposta' THEN 3 WHEN 'Fechado' THEN 4 ELSE 5 END")
                ->orderBy('next_contact_at')
                ->orderByDesc('updated_at')
                ->get()
                ->map(fn (Lead $lead) => $this->toLegacy($lead))
                ->values();
        });

        return response()->json(['data' => $leads]);
    }

    public function store(Request $request): JsonResponse
    {
        $legacy = $this->validateLead($request);
        $id = $this->nullableInteger($legacy['id'] ?? null);
        $lead = Lead::query()->create(
            $id ? ['id' => $id, ...$this->toAttributes($legacy)] : $this->toAttributes($legacy)
        );

        return response()->json(['data' => $this->toLegacy($lead)], 201);
    }

    public function update(Request $request, Lead $lead): JsonResponse
    {
        $legacy = $this->validateLead($request, $lead);
        $lead->update($this->toAttributes($legacy));

        return response()->json(['data' => $this->toLegacy($lead->refresh())]);
    }

    public function destroy(Lead $lead): JsonResponse
    {
        $lead->delete();

        return response()->json(status: 204);
    }

    private function validateLead(Request $request, ?Lead $lead = null): array
    {
        $validated = $request->validate([
            'id' => ['nullable', 'integer', Rule::unique('leads', 'id')->ignore($lead?->id)],
            'nome' => ['required', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:14'],
            'dataNascimento' => ['nullable', 'date', 'before_or_equal:today'],
            'cep' => ['nullable', 'string', 'max:9'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'size:2'],
            'profissao' => ['nullable', 'string', 'max:255'],
            'rendaMensal' => ['nullable'],
            'veiculoId' => ['nullable', 'integer'],
            'vendedorId' => ['nullable', 'integer'],
            'origem' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'temperatura' => ['nullable', Rule::in(['Frio', 'Morno', 'Quente'])],
            'motivoPerda' => ['nullable', 'string', 'max:255'],
            'tarefa' => ['nullable', 'string', 'max:255'],
            'prazoTarefa' => ['nullable', 'date'],
            'consentimento' => ['nullable', 'boolean'],
            'proximoContato' => ['nullable', 'date'],
            'observacao' => ['nullable', 'string'],
            'historico' => ['nullable', 'array'],
        ]);

        return array_replace($request->all(), $validated);
    }

    private function toAttributes(array $legacy): array
    {
        $history = is_array($legacy['historico'] ?? null) ? $legacy['historico'] : [];

        return [
            'name' => $legacy['nome'] ?? 'Cliente',
            'phone' => $this->nullableString($legacy['whatsapp'] ?? null),
            'email' => $this->nullableString($legacy['email'] ?? null),
            'cpf' => $this->nullableString($legacy['cpf'] ?? null),
            'birth_date' => ($legacy['dataNascimento'] ?? null) ?: null,
            'postal_code' => $this->nullableString($legacy['cep'] ?? null),
            'city' => $this->nullableString($legacy['cidade'] ?? null),
            'state' => $this->nullableString($legacy['estado'] ?? null),
            'occupation' => $this->nullableString($legacy['profissao'] ?? null),
            'monthly_income' => $this->nullableMoney($legacy['rendaMensal'] ?? null),
            'vehicle_id' => $this->nullableInteger($legacy['veiculoId'] ?? null),
            'seller_id' => $this->nullableInteger($legacy['vendedorId'] ?? null),
            'source' => $this->nullableString($legacy['origem'] ?? null),
            'status' => $legacy['status'] ?? 'Novo',
            'temperature' => $legacy['temperatura'] ?? 'Morno',
            'loss_reason' => $this->nullableString($legacy['motivoPerda'] ?? null),
            'task_title' => $this->nullableString($legacy['tarefa'] ?? null),
            'task_due_at' => ($legacy['prazoTarefa'] ?? null) ?: null,
            'consent_at' => ($legacy['consentimento'] ?? false)
                ? ($legacy['consentimentoEm'] ?? now())
                : null,
            'next_contact_at' => ($legacy['proximoContato'] ?? null) ?: null,
            'last_interaction' => $this->nullableString($history[0]['texto'] ?? null),
            'notes' => $this->nullableString($legacy['observacao'] ?? null),
            'metadata' => $legacy,
        ];
    }

    private function toLegacy(Lead $lead): array
    {
        return array_merge($lead->metadata ?? [], [
            'id' => $lead->id,
            'nome' => $lead->name,
            'whatsapp' => $lead->phone ?? '',
            'email' => $lead->email ?? '',
            'cpf' => $lead->cpf ?? '',
            'dataNascimento' => $lead->birth_date?->format('Y-m-d') ?? '',
            'cep' => $lead->postal_code ?? '',
            'cidade' => $lead->city ?? '',
            'estado' => $lead->state ?? '',
            'profissao' => $lead->occupation ?? '',
            'rendaMensal' => $lead->monthly_income !== null
                ? (float) $lead->monthly_income
                : '',
            'veiculoId' => $lead->vehicle_id ?? '',
            'vendedorId' => $lead->seller_id ?? '',
            'origem' => $lead->source ?? '',
            'status' => $lead->status,
            'temperatura' => $lead->temperature,
            'motivoPerda' => $lead->loss_reason ?? '',
            'tarefa' => $lead->task_title ?? '',
            'prazoTarefa' => $lead->task_due_at?->format('Y-m-d\TH:i') ?? '',
            'consentimento' => $lead->consent_at !== null,
            'consentimentoEm' => $lead->consent_at?->toISOString(),
            'proximoContato' => $lead->next_contact_at?->format('Y-m-d') ?? '',
            'observacao' => $lead->notes ?? '',
        ]);
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

    private function nullableMoney(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        return (float) preg_replace('/\D+/', '', (string) $value);
    }
}
