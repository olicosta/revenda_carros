<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinancingApplication;
use App\Models\FinancingDocument;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FinancingApplicationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => FinancingApplication::query()
                ->with('documents:id,financing_application_id,category,original_name')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'veiculo' => ['nullable', 'string', 'max:255'],
            'valorVeiculo' => ['nullable'],
            'entrada' => ['nullable'],
            'prazo' => ['nullable', 'integer', 'min:1', 'max:120'],
            'parcela' => ['nullable'],
            'consentimento' => ['accepted'],
            'dados' => ['required', 'array'],
        ]);

        $lead = Lead::query()->where('cpf', $validated['cpf'])->first();

        if (! $lead) {
            $lead = Lead::query()->create([
                'name' => $validated['nome'],
                'cpf' => $validated['cpf'],
                'phone' => $validated['whatsapp'],
                'email' => $validated['email'] ?? null,
                'source' => 'Financiamento',
                'status' => 'Em atendimento',
                'temperature' => 'Quente',
                'consent_at' => now(),
                'metadata' => [
                    'nome' => $validated['nome'],
                    'cpf' => $validated['cpf'],
                    'whatsapp' => $validated['whatsapp'],
                    'email' => $validated['email'] ?? '',
                    'origem' => 'Financiamento',
                    'status' => 'Em atendimento',
                    'temperatura' => 'Quente',
                    'consentimento' => true,
                ],
            ]);
        }

        $application = FinancingApplication::query()->create([
            'access_token' => hash('sha256', Str::random(64)),
            'protocol' => $this->uniqueProtocol(),
            'lead_id' => $lead->id,
            'customer_name' => $validated['nome'],
            'cpf' => $validated['cpf'],
            'phone' => $validated['whatsapp'],
            'email' => $validated['email'] ?? null,
            'requested_amount' => $this->money($validated['valorVeiculo'] ?? null),
            'down_payment' => $this->money($validated['entrada'] ?? null),
            'installments' => $validated['prazo'] ?? null,
            'desired_installment' => $this->money($validated['parcela'] ?? null),
            'form_data' => $validated['dados'],
            'consent_at' => now(),
        ]);

        return response()->json([
            'data' => [
                ...$application->toArray(),
                'upload_token' => $application->access_token,
                'portal_protocol' => $application->protocol,
            ],
            'message' => 'Solicitação recebida com sucesso.',
        ], 201);
    }

    public function update(Request $request, FinancingApplication $application): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:255'],
            'institution' => ['nullable', 'string', 'max:255'],
            'approved_amount' => ['nullable'],
            'installments' => ['nullable', 'integer', 'min:1', 'max:120'],
            'desired_installment' => ['nullable'],
            'analysis_notes' => ['nullable', 'string'],
        ]);

        $validated['approved_amount'] = $this->money($validated['approved_amount'] ?? null);
        $validated['desired_installment'] = $this->money($validated['desired_installment'] ?? null);
        $application->update($validated);

        return response()->json(['data' => $application->refresh()]);
    }

    public function uploadDocuments(
        Request $request,
        FinancingApplication $application
    ): JsonResponse {
        $validated = $request->validate([
            'token' => ['required', 'string', 'size:64'],
            'category' => ['nullable', 'string', 'max:255'],
            'documents' => ['required', 'array', 'max:8'],
            'documents.*' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        abort_unless(
            is_string($application->access_token)
                && hash_equals($application->access_token, $validated['token']),
            403
        );

        $documents = collect($request->file('documents'))
            ->map(function ($file) use ($application, $validated) {
                $path = $file->store(
                    'financing/'.$application->id,
                    'local'
                );

                return FinancingDocument::query()->create([
                    'financing_application_id' => $application->id,
                    'category' => $validated['category'] ?? 'Outro',
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);
            });

        return response()->json(['data' => $documents], 201);
    }

    public function downloadDocument(FinancingDocument $document)
    {
        abort_unless(Storage::disk('local')->exists($document->path), 404);

        return Storage::disk('local')->download(
            $document->path,
            $document->original_name
        );
    }

    private function money(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        return is_numeric($value)
            ? (float) $value
            : (float) preg_replace('/\D+/', '', (string) $value);
    }

    private function uniqueProtocol(): string
    {
        do {
            $protocol = strtoupper(Str::random(10));
        } while (FinancingApplication::query()->where('protocol', $protocol)->exists());

        return $protocol;
    }
}
