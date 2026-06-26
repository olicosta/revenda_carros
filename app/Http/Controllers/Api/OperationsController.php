<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsVisit;
use App\Models\VehicleHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    public function histories(): JsonResponse
    {
        return response()->json([
            'data' => VehicleHistory::query()
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->get()
                ->map(fn (VehicleHistory $history) => $this->historyToLegacy($history))
                ->values(),
        ]);
    }

    public function syncHistories(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'histories' => ['present', 'array'],
            'histories.*' => ['required', 'array'],
            'histories.*.id' => ['nullable', 'integer'],
            'histories.*.carroId' => ['required', 'integer'],
            'histories.*.carroNome' => ['nullable', 'string', 'max:255'],
            'histories.*.tipo' => ['required', 'string', 'max:255'],
            'histories.*.descricao' => ['required', 'string'],
            'histories.*.data' => ['nullable', 'date'],
            'histories.*.extras' => ['nullable', 'array'],
        ]);

        $histories = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['histories'] as $legacy) {
                $id = $this->nullableInteger($legacy['id'] ?? null);
                $metadata = is_array($legacy['extras'] ?? null) ? $legacy['extras'] : [];
                $metadata['carroNome'] = $legacy['carroNome'] ?? '';
                $attributes = [
                    'vehicle_id' => $legacy['carroId'],
                    'type' => $legacy['tipo'],
                    'description' => $legacy['descricao'],
                    'metadata' => $metadata,
                ];

                if (! empty($legacy['data'])) {
                    $attributes['created_at'] = Carbon::parse($legacy['data']);
                }

                $history = $id
                    ? VehicleHistory::query()->updateOrCreate(['id' => $id], $attributes)
                    : VehicleHistory::query()->create($attributes);

                $ids[] = $history->id;
            }

            $this->deleteMissing(VehicleHistory::query(), $ids);

            return VehicleHistory::query()
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->get()
                ->map(fn (VehicleHistory $history) => $this->historyToLegacy($history))
                ->values();
        });

        return response()->json(['data' => $histories]);
    }

    public function analytics(): JsonResponse
    {
        return response()->json([
            'data' => [
                'visitas' => AnalyticsVisit::query()
                    ->orderByDesc('started_at')
                    ->limit(1500)
                    ->get()
                    ->reverse()
                    ->values()
                    ->map(fn (AnalyticsVisit $visit) => $this->visitToLegacy($visit))
                    ->values(),
            ],
        ]);
    }

    public function recordVisit(Request $request): JsonResponse
    {
        $visit = $this->upsertVisit($request);

        return response()->json(['data' => $this->visitToLegacy($visit)], 201);
    }

    public function updateVisit(Request $request, string $externalId): JsonResponse
    {
        $validated = $request->validate([
            'duracao' => ['required', 'integer', 'min:0', 'max:86400'],
        ]);

        $visit = AnalyticsVisit::query()->where('external_id', $externalId)->firstOrFail();
        $visit->update([
            'duration' => max($visit->duration, $validated['duracao']),
        ]);

        return response()->json(['data' => $this->visitToLegacy($visit->refresh())]);
    }

    public function syncAnalytics(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visitas' => ['present', 'array', 'max:1500'],
            'visitas.*' => ['required', 'array'],
        ]);

        foreach ($validated['visitas'] as $legacy) {
            $this->upsertVisit(new Request($legacy));
        }

        return $this->analytics();
    }

    public function clearAnalytics(): JsonResponse
    {
        AnalyticsVisit::query()->delete();

        return response()->json(status: 204);
    }

    private function upsertVisit(Request $request): AnalyticsVisit
    {
        $validated = $request->validate([
            'id' => ['required', 'string', 'max:255'],
            'sessao' => ['required', 'string', 'max:255'],
            'pagina' => ['required', 'string', 'max:255'],
            'titulo' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:2048'],
            'veiculoId' => ['nullable', 'integer'],
            'inicio' => ['required', 'integer'],
            'duracao' => ['nullable', 'integer', 'min:0', 'max:86400'],
        ]);

        return AnalyticsVisit::query()->updateOrCreate(
            ['external_id' => $validated['id']],
            [
                'session_id' => $validated['sessao'],
                'page' => $validated['pagina'],
                'title' => $validated['titulo'] ?? null,
                'url' => $validated['url'] ?? null,
                'vehicle_id' => $validated['veiculoId'] ?? null,
                'started_at' => Carbon::createFromTimestampMs($validated['inicio']),
                'duration' => $validated['duracao'] ?? 0,
            ]
        );
    }

    private function historyToLegacy(VehicleHistory $history): array
    {
        $metadata = is_array($history->metadata) ? $history->metadata : [];
        $vehicleName = $metadata['carroNome'] ?? '';
        unset($metadata['carroNome']);

        return [
            'id' => $history->id,
            'carroId' => $history->vehicle_id,
            'carroNome' => $vehicleName,
            'tipo' => $history->type,
            'descricao' => $history->description,
            'data' => $history->created_at?->toISOString(),
            'extras' => $metadata,
        ];
    }

    private function visitToLegacy(AnalyticsVisit $visit): array
    {
        return [
            'id' => $visit->external_id,
            'sessao' => $visit->session_id,
            'pagina' => $visit->page,
            'titulo' => $visit->title ?? '',
            'url' => $visit->url ?? '',
            'veiculoId' => $visit->vehicle_id,
            'inicio' => $visit->started_at?->getTimestampMs(),
            'duracao' => $visit->duration,
        ];
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
}
