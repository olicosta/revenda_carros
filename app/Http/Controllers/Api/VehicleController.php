<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Sale;
use App\Models\StoreSetting;
use App\Models\Testimonial;
use App\Models\Vehicle;
use App\Services\ImageStorage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function __construct(private readonly ImageStorage $imageStorage) {}

    public function index(): JsonResponse
    {
        $vehicles = Vehicle::query()
            ->orderByDesc('featured')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Vehicle $vehicle) => $this->toLegacy($vehicle))
            ->values();

        return response()->json(['data' => $vehicles]);
    }

    public function bootstrap(): JsonResponse
    {
        return response()->json([
            'data' => [
                'settings' => StoreSetting::query()
                    ->whereIn('key', ['store', 'home'])
                    ->pluck('value', 'key'),
                'vehicles' => Vehicle::query()
                    ->orderByDesc('featured')
                    ->orderByDesc('created_at')
                    ->get()
                    ->map(fn (Vehicle $vehicle) => $this->toLegacy($vehicle))
                    ->values(),
                'testimonials' => Testimonial::query()
                    ->where('visible', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get()
                    ->map(fn (Testimonial $testimonial) => [
                        'id' => $testimonial->id,
                        'cliente' => $testimonial->customer_name,
                        'veiculo' => $testimonial->vehicle ?? '',
                        'texto' => $testimonial->message,
                        'imagem' => $testimonial->image_path ?? '',
                    ])
                    ->values(),
                'partners' => Partner::query()
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get()
                    ->map(fn (Partner $partner) => [
                        'id' => $partner->id,
                        'nome' => $partner->name,
                        'ativo' => $partner->visible,
                    ])
                    ->values(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $payload = $this->prepareVehicleImages($this->validateVehicle($request));
        $attributes = $this->toAttributes($payload);
        $id = $this->nullableInteger($payload['id'] ?? null);
        $vehicle = DB::transaction(function () use ($attributes, $id, $payload) {
            $vehicle = Vehicle::query()->create(
                $id ? ['id' => $id, ...$attributes] : $attributes
            );
            $this->syncSaleForVehicle($vehicle, $payload);

            return $vehicle;
        });

        return response()->json(['data' => $this->toLegacy($vehicle->refresh())], 201);
    }

    public function update(Request $request, Vehicle $vehicle): JsonResponse
    {
        $payload = $this->prepareVehicleImages($this->validateVehicle($request, $vehicle));
        DB::transaction(function () use ($vehicle, $payload) {
            $vehicle->update($this->toAttributes($payload));
            $this->syncSaleForVehicle($vehicle, $payload);
        });

        return response()->json(['data' => $this->toLegacy($vehicle->refresh())]);
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        DB::transaction(function () use ($vehicle) {
            Sale::query()->where('vehicle_id', $vehicle->id)->delete();
            $vehicle->delete();
        });

        return response()->json(status: 204);
    }

    public function sync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'vehicles' => ['present', 'array'],
            'vehicles.*' => ['required', 'array'],
        ]);

        $vehicles = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['vehicles'] as $payload) {
                $payload = $this->prepareVehicleImages($payload);
                $attributes = $this->toAttributes($payload);
                $legacyId = $this->nullableInteger($payload['id'] ?? null);

                if ($legacyId) {
                    $vehicle = Vehicle::query()->updateOrCreate(
                        ['id' => $legacyId],
                        $attributes
                    );
                } else {
                    $vehicle = Vehicle::query()->create($attributes);
                }

                $ids[] = $vehicle->id;
            }

            Vehicle::query()
                ->when(
                    count($ids) > 0,
                    fn ($query) => $query->whereNotIn('id', $ids),
                    fn ($query) => $query
                )
                ->delete();

            $this->syncSales($validated['vehicles']);

            return Vehicle::query()
                ->orderByDesc('featured')
                ->orderByDesc('created_at')
                ->get()
                ->map(fn (Vehicle $vehicle) => $this->toLegacy($vehicle))
                ->values();
        });

        return response()->json(['data' => $vehicles]);
    }

    private function validateVehicle(Request $request, ?Vehicle $vehicle = null): array
    {
        $validated = $request->validate([
            'id' => [
                'nullable',
                'integer',
                Rule::unique('vehicles', 'id')->ignore($vehicle?->id),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'marca' => ['nullable', 'string', 'max:100'],
            'modelo' => ['nullable', 'string', 'max:150'],
            'ano' => ['nullable'],
            'status' => ['nullable', 'string', 'max:50'],
            'preco' => ['nullable'],
            'imagem' => ['nullable', 'string'],
            'galeria' => ['nullable', 'array'],
            'opcionais' => ['nullable', 'array'],
        ]);

        return array_replace($request->all(), $validated);
    }

    private function prepareVehicleImages(array $vehicle): array
    {
        $originalCover = $this->nullableString($vehicle['imagem'] ?? null);
        $vehicle['imagem'] = $this->imageStorage->storeDataUrl(
            $originalCover,
            'vehicles'
        );
        $vehicle['galeria'] = array_values(array_map(
            function (mixed $image) use ($originalCover, $vehicle) {
                if (is_string($image) && $image === $originalCover) {
                    return $vehicle['imagem'];
                }

                return $this->imageStorage->storeDataUrl(
                    is_string($image) ? $image : null,
                    'vehicles/gallery'
                );
            },
            is_array($vehicle['galeria'] ?? null) ? $vehicle['galeria'] : []
        ));

        return $vehicle;
    }

    private function toAttributes(array $vehicle): array
    {
        $name = trim((string) ($vehicle['nome'] ?? ''));
        $brand = trim((string) ($vehicle['marca'] ?? ''));
        $model = trim((string) ($vehicle['modelo'] ?? ''));

        if ($name === '') {
            $name = trim($brand.' '.$model);
        }

        return [
            'name' => $name ?: 'Veículo sem nome',
            'brand' => $brand ?: null,
            'model' => $model ?: null,
            'year' => $this->nullableInteger($vehicle['ano'] ?? null),
            'mileage' => $this->moneyNumber($vehicle['km'] ?? 0),
            'transmission' => $this->nullableString($vehicle['cambio'] ?? null),
            'fuel' => $this->nullableString($vehicle['combustivel'] ?? null),
            'color' => $this->nullableString($vehicle['cor'] ?? null),
            'purchase_price' => $this->decimalNumber($vehicle['precoCompra'] ?? 0),
            'sale_price' => $this->moneyNumber($vehicle['preco'] ?? 0),
            'preparation_cost' => $this->decimalNumber($vehicle['custoPreparacao'] ?? 0),
            'fees_cost' => $this->decimalNumber($vehicle['taxas'] ?? 0),
            'commission_rate' => $this->decimalNumber($vehicle['comissaoPercentual'] ?? 0),
            'status' => $this->nullableString($vehicle['status'] ?? null) ?: 'Disponível',
            'featured' => (bool) ($vehicle['destaque'] ?? false),
            'offer' => (bool) ($vehicle['oferta'] ?? false),
            'description' => $this->nullableString($vehicle['descricao'] ?? null),
            'cover_image_path' => $this->nullableString($vehicle['imagem'] ?? null),
            'gallery' => array_values($vehicle['galeria'] ?? []),
            'options' => array_values($vehicle['opcionais'] ?? []),
            'metadata' => $vehicle,
        ];
    }

    private function toLegacy(Vehicle $vehicle): array
    {
        $legacy = is_array($vehicle->metadata) ? $vehicle->metadata : [];

        return array_merge($legacy, [
            'id' => $vehicle->id,
            'nome' => $vehicle->name,
            'marca' => $vehicle->brand ?? '',
            'modelo' => $vehicle->model ?? '',
            'ano' => $vehicle->year ?? '',
            'km' => $legacy['km'] ?? number_format($vehicle->mileage, 0, ',', '.').' km',
            'cambio' => $vehicle->transmission ?? '-',
            'combustivel' => $vehicle->fuel ?? '-',
            'cor' => $vehicle->color ?? '-',
            'precoCompra' => (float) $vehicle->purchase_price,
            'custoPreparacao' => (float) $vehicle->preparation_cost,
            'taxas' => (float) $vehicle->fees_cost,
            'comissaoPercentual' => (float) $vehicle->commission_rate,
            'status' => $vehicle->status,
            'destaque' => $vehicle->featured,
            'oferta' => $vehicle->offer,
            'descricao' => $vehicle->description ?? '',
            'preco' => $legacy['preco'] ?? $this->formatCurrency((float) $vehicle->sale_price),
            'imagem' => $vehicle->cover_image_path ?? '',
            'galeria' => $vehicle->gallery ?? [],
            'opcionais' => $vehicle->options ?? [],
        ]);
    }

    private function moneyNumber(mixed $value): int
    {
        if (is_numeric($value)) {
            return (int) round((float) $value);
        }

        return (int) preg_replace('/\D+/', '', (string) $value);
    }

    private function decimalNumber(mixed $value): float
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        return (float) $this->moneyNumber($value);
    }

    private function nullableInteger(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (int) $value;
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        return $value === '' ? null : $value;
    }

    private function formatCurrency(float $value): string
    {
        return 'R$ '.number_format($value, 0, ',', '.');
    }

    private function syncSales(array $vehicles): void
    {
        $vehicleIds = [];

        foreach ($vehicles as $legacy) {
            if (($legacy['status'] ?? '') !== 'Vendido') {
                continue;
            }

            $vehicleId = $this->nullableInteger($legacy['id'] ?? null);

            if (! $vehicleId) {
                continue;
            }

            Sale::query()->updateOrCreate(
                ['vehicle_id' => $vehicleId],
                [
                    'seller_id' => $this->nullableInteger($legacy['vendedorId'] ?? null),
                    'sold_at' => ($legacy['dataVenda'] ?? null) ?: null,
                    'sale_value' => $this->decimalNumber($legacy['valorVenda'] ?? 0),
                    'cash_received' => $this->decimalNumber($legacy['valorRecebido'] ?? 0),
                    'has_trade' => (bool) ($legacy['temTroca'] ?? false),
                    'trade_vehicle' => $this->nullableString($legacy['trocaVeiculo'] ?? null),
                    'trade_value' => $this->decimalNumber($legacy['trocaValor'] ?? 0),
                    'trade_stock_vehicle_id' => $this->nullableInteger($legacy['trocaEstoqueId'] ?? null),
                    'balance_receivable' => $this->decimalNumber($legacy['saldoReceber'] ?? 0),
                    'commission_value' => $this->decimalNumber($legacy['comissao'] ?? 0),
                    'metadata' => $legacy,
                ]
            );

            $vehicleIds[] = $vehicleId;
        }

        if ($vehicleIds === []) {
            Sale::query()->delete();

            return;
        }

        Sale::query()->whereNotIn('vehicle_id', $vehicleIds)->delete();
    }

    private function syncSaleForVehicle(Vehicle $vehicle, array $legacy): void
    {
        if (($legacy['status'] ?? '') !== 'Vendido') {
            Sale::query()->where('vehicle_id', $vehicle->id)->delete();

            return;
        }

        Sale::query()->updateOrCreate(
            ['vehicle_id' => $vehicle->id],
            [
                'seller_id' => $this->nullableInteger($legacy['vendedorId'] ?? null),
                'sold_at' => ($legacy['dataVenda'] ?? null) ?: null,
                'sale_value' => $this->decimalNumber($legacy['valorVenda'] ?? 0),
                'cash_received' => $this->decimalNumber($legacy['valorRecebido'] ?? 0),
                'has_trade' => (bool) ($legacy['temTroca'] ?? false),
                'trade_vehicle' => $this->nullableString($legacy['trocaVeiculo'] ?? null),
                'trade_value' => $this->decimalNumber($legacy['trocaValor'] ?? 0),
                'trade_stock_vehicle_id' => $this->nullableInteger($legacy['trocaEstoqueId'] ?? null),
                'balance_receivable' => $this->decimalNumber($legacy['saldoReceber'] ?? 0),
                'commission_value' => $this->decimalNumber($legacy['comissao'] ?? 0),
                'metadata' => $legacy,
            ]
        );
    }
}
