<?php

namespace Tests\Feature;

use App\Models\StoreSetting;
use App\Models\Testimonial;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaMigrationCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_moves_existing_base64_images_to_public_storage(): void
    {
        Storage::fake('public');
        $image = $this->tinyPng();

        Vehicle::query()->create([
            'name' => 'Veículo legado',
            'cover_image_path' => $image,
            'gallery' => [$image],
            'metadata' => ['imagem' => $image, 'galeria' => [$image]],
        ]);
        Testimonial::query()->create([
            'customer_name' => 'Cliente',
            'message' => 'Ótimo atendimento',
            'image_path' => $image,
        ]);
        StoreSetting::query()->create([
            'key' => 'store',
            'value' => ['logo' => $image],
        ]);

        $this->artisan('media:migrate-base64')
            ->expectsOutput('Registros com imagens migradas: 3')
            ->assertSuccessful();

        $vehicle = Vehicle::query()->firstOrFail();
        $testimonial = Testimonial::query()->firstOrFail();
        $setting = StoreSetting::query()->where('key', 'store')->firstOrFail();

        $this->assertStringStartsWith('/storage/vehicles/', $vehicle->cover_image_path);
        $this->assertSame($vehicle->cover_image_path, $vehicle->gallery[0]);
        $this->assertStringStartsWith('/storage/testimonials/', $testimonial->image_path);
        $this->assertStringStartsWith('/storage/store/', $setting->value['logo']);

        Storage::disk('public')->assertExists(str_replace('/storage/', '', $vehicle->cover_image_path));
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $testimonial->image_path));
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $setting->value['logo']));
    }

    private function tinyPng(): string
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=';
    }
}
