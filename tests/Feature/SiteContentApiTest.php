<?php

namespace Tests\Feature;

use App\Models\Partner;
use App\Models\StoreSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SiteContentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_list_site_content(): void
    {
        Testimonial::query()->create([
            'customer_name' => 'Maria',
            'message' => 'Excelente atendimento.',
            'visible' => true,
        ]);
        Partner::query()->create([
            'name' => 'Banco Parceiro',
            'visible' => true,
        ]);
        StoreSetting::query()->create([
            'key' => 'store',
            'value' => ['nome' => '3M Veículos'],
        ]);

        $this->getJson('/api/site/testimonials')
            ->assertOk()
            ->assertJsonPath('data.0.cliente', 'Maria');

        $this->getJson('/api/site/partners')
            ->assertOk()
            ->assertJsonPath('data.0.nome', 'Banco Parceiro');

        $this->getJson('/api/site/settings')
            ->assertOk()
            ->assertJsonPath('data.store.nome', '3M Veículos');

        $this->getJson('/api/site/bootstrap')
            ->assertOk()
            ->assertJsonPath('data.settings.store.nome', '3M Veículos')
            ->assertJsonPath('data.testimonials.0.cliente', 'Maria')
            ->assertJsonPath('data.partners.0.nome', 'Banco Parceiro');
    }

    public function test_authenticated_admin_can_sync_testimonials_and_partners(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $image = $this->tinyPng();

        $response = $this->putJson('/api/site/testimonials/sync', [
            'testimonials' => [[
                'id' => 21,
                'cliente' => 'João',
                'veiculo' => 'Honda Civic',
                'texto' => 'Compra tranquila.',
                'imagem' => $image,
            ]],
        ])->assertOk()
            ->assertJsonPath('data.0.id', 21)
            ->assertJsonPath('data.0.cliente', 'João');

        $storedImage = $response->json('data.0.imagem');
        $this->assertStringStartsWith('/storage/testimonials/', $storedImage);
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $storedImage));

        $this->putJson('/api/site/partners/sync', [
            'partners' => [[
                'id' => 31,
                'nome' => 'Financeira XPTO',
                'ativo' => false,
            ]],
        ])->assertOk()
            ->assertJsonPath('data.0.id', 31)
            ->assertJsonPath('data.0.ativo', false);

        $this->assertDatabaseHas('testimonials', [
            'id' => 21,
            'customer_name' => 'João',
            'image_path' => $storedImage,
        ]);
        $this->assertDatabaseHas('partners', [
            'id' => 31,
            'name' => 'Financeira XPTO',
            'visible' => false,
        ]);
    }

    public function test_authenticated_admin_can_update_settings(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $logo = $this->tinyPng();

        $response = $this->putJson('/api/site/settings', [
            'store' => [
                'nome' => 'Nova Loja',
                'whatsapp' => '5547999999999',
                'logo' => $logo,
            ],
            'home' => [
                'heroTitulo' => 'Seu próximo carro está aqui',
            ],
        ])->assertOk()
            ->assertJsonPath('data.store.nome', 'Nova Loja')
            ->assertJsonPath('data.home.heroTitulo', 'Seu próximo carro está aqui');

        $storedLogo = $response->json('data.store.logo');
        $this->assertStringStartsWith('/storage/store/', $storedLogo);
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $storedLogo));
        $this->assertDatabaseHas('store_settings', ['key' => 'store']);
        $this->assertDatabaseHas('store_settings', ['key' => 'home']);
    }

    public function test_site_content_writes_require_authentication(): void
    {
        $this->putJson('/api/site/testimonials/sync', ['testimonials' => []])
            ->assertUnauthorized();
        $this->putJson('/api/site/partners/sync', ['partners' => []])
            ->assertUnauthorized();
        $this->putJson('/api/site/settings', ['store' => []])
            ->assertUnauthorized();
    }

    private function tinyPng(): string
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=';
    }
}
