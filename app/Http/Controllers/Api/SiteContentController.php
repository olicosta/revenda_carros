<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\StoreSetting;
use App\Models\Testimonial;
use App\Services\ImageStorage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteContentController extends Controller
{
    public function __construct(private readonly ImageStorage $imageStorage) {}

    public function testimonials(): JsonResponse
    {
        return response()->json([
            'data' => Testimonial::query()
                ->where('visible', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Testimonial $testimonial) => $this->testimonialToLegacy($testimonial))
                ->values(),
        ]);
    }

    public function syncTestimonials(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'testimonials' => ['present', 'array'],
            'testimonials.*' => ['required', 'array'],
            'testimonials.*.id' => ['nullable', 'integer'],
            'testimonials.*.cliente' => ['required', 'string', 'max:255'],
            'testimonials.*.veiculo' => ['nullable', 'string', 'max:255'],
            'testimonials.*.texto' => ['required', 'string'],
            'testimonials.*.imagem' => ['nullable', 'string'],
        ]);

        $testimonials = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['testimonials'] as $position => $legacy) {
                $id = $this->nullableInteger($legacy['id'] ?? null);
                $image = $this->imageStorage->storeDataUrl(
                    $this->nullableString($legacy['imagem'] ?? null),
                    'testimonials'
                );
                $attributes = [
                    'customer_name' => $legacy['cliente'],
                    'vehicle' => $this->nullableString($legacy['veiculo'] ?? null),
                    'rating' => 5,
                    'message' => $legacy['texto'],
                    'image_path' => $image,
                    'visible' => true,
                    'sort_order' => $position,
                ];

                $testimonial = $id
                    ? Testimonial::query()->updateOrCreate(['id' => $id], $attributes)
                    : Testimonial::query()->create($attributes);

                $ids[] = $testimonial->id;
            }

            $this->deleteMissing(Testimonial::query(), $ids);

            return Testimonial::query()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Testimonial $testimonial) => $this->testimonialToLegacy($testimonial))
                ->values();
        });

        return response()->json(['data' => $testimonials]);
    }

    public function partners(): JsonResponse
    {
        return response()->json([
            'data' => Partner::query()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Partner $partner) => $this->partnerToLegacy($partner))
                ->values(),
        ]);
    }

    public function syncPartners(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'partners' => ['present', 'array'],
            'partners.*' => ['required', 'array'],
            'partners.*.id' => ['nullable', 'integer'],
            'partners.*.nome' => ['required', 'string', 'max:255'],
            'partners.*.ativo' => ['required', 'boolean'],
        ]);

        $partners = DB::transaction(function () use ($validated) {
            $ids = [];

            foreach ($validated['partners'] as $position => $legacy) {
                $id = $this->nullableInteger($legacy['id'] ?? null);
                $attributes = [
                    'name' => $legacy['nome'],
                    'visible' => $legacy['ativo'],
                    'sort_order' => $position,
                ];

                $partner = $id
                    ? Partner::query()->updateOrCreate(['id' => $id], $attributes)
                    : Partner::query()->create($attributes);

                $ids[] = $partner->id;
            }

            $this->deleteMissing(Partner::query(), $ids);

            return Partner::query()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Partner $partner) => $this->partnerToLegacy($partner))
                ->values();
        });

        return response()->json(['data' => $partners]);
    }

    public function settings(): JsonResponse
    {
        return response()->json([
            'data' => StoreSetting::query()
                ->whereIn('key', ['store', 'home'])
                ->pluck('value', 'key'),
        ]);
    }

    public function syncSettings(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'store' => ['sometimes', 'array'],
            'home' => ['sometimes', 'array'],
        ]);

        if (isset($validated['store']['logo'])) {
            $validated['store']['logo'] = $this->imageStorage->storeDataUrl(
                $this->nullableString($validated['store']['logo']),
                'store'
            );
        }

        foreach ($validated as $key => $value) {
            StoreSetting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return $this->settings();
    }

    private function testimonialToLegacy(Testimonial $testimonial): array
    {
        return [
            'id' => $testimonial->id,
            'cliente' => $testimonial->customer_name,
            'veiculo' => $testimonial->vehicle ?? '',
            'texto' => $testimonial->message,
            'imagem' => $testimonial->image_path ?? '',
        ];
    }

    private function partnerToLegacy(Partner $partner): array
    {
        return [
            'id' => $partner->id,
            'nome' => $partner->name,
            'ativo' => $partner->visible,
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

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        return $value === '' ? null : $value;
    }
}
