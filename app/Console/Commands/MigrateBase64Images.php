<?php

namespace App\Console\Commands;

use App\Models\StoreSetting;
use App\Models\Testimonial;
use App\Models\Vehicle;
use App\Services\ImageStorage;
use Illuminate\Console\Command;

class MigrateBase64Images extends Command
{
    protected $signature = 'media:migrate-base64';

    protected $description = 'Move imagens Base64 existentes no banco para o disco público';

    public function handle(ImageStorage $imageStorage): int
    {
        $migrated = 0;

        Vehicle::query()->each(function (Vehicle $vehicle) use ($imageStorage, &$migrated) {
            $originalCover = $vehicle->cover_image_path;
            $cover = $imageStorage->storeDataUrl($originalCover, 'vehicles');
            $gallery = array_map(
                function (mixed $image) use ($imageStorage, $originalCover, $cover) {
                    if (is_string($image) && $image === $originalCover) {
                        return $cover;
                    }

                    return $imageStorage->storeDataUrl(
                        is_string($image) ? $image : null,
                        'vehicles/gallery'
                    );
                },
                $vehicle->gallery ?? []
            );

            if ($cover === $originalCover && $gallery === ($vehicle->gallery ?? [])) {
                return;
            }

            $metadata = is_array($vehicle->metadata) ? $vehicle->metadata : [];
            $metadata['imagem'] = $cover;
            $metadata['galeria'] = array_values($gallery);

            $vehicle->update([
                'cover_image_path' => $cover,
                'gallery' => array_values($gallery),
                'metadata' => $metadata,
            ]);
            $migrated++;
        });

        Testimonial::query()->each(function (Testimonial $testimonial) use ($imageStorage, &$migrated) {
            $image = $imageStorage->storeDataUrl($testimonial->image_path, 'testimonials');

            if ($image === $testimonial->image_path) {
                return;
            }

            $testimonial->update(['image_path' => $image]);
            $migrated++;
        });

        $setting = StoreSetting::query()->where('key', 'store')->first();

        if ($setting && is_array($setting->value) && isset($setting->value['logo'])) {
            $value = $setting->value;
            $logo = $imageStorage->storeDataUrl($value['logo'], 'store');

            if ($logo !== $value['logo']) {
                $value['logo'] = $logo;
                $setting->update(['value' => $value]);
                $migrated++;
            }
        }

        $this->info("Registros com imagens migradas: {$migrated}");

        return self::SUCCESS;
    }
}
