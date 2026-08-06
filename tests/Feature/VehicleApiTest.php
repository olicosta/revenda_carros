<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VehicleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_synchronizes_and_lists_legacy_vehicles(): void
    {
        $this->actingAs(User::factory()->create());

        $payload = [
            'vehicles' => [
                [
                    'id' => 101,
                    'nome' => 'Honda Civic Touring',
                    'marca' => 'Honda',
                    'modelo' => 'Civic Touring',
                    'ano' => 2020,
                    'km' => '48.000 km',
                    'cambio' => 'Automático',
                    'status' => 'Disponível',
                    'preco' => 'R$ 129.900',
                    'precoCompra' => 110000,
                    'destaque' => true,
                    'oferta' => false,
                    'imagem' => 'https://example.com/civic.jpg',
                    'galeria' => ['https://example.com/civic.jpg'],
                    'opcionais' => ['Bancos em couro'],
                ],
            ],
        ];

        $this->putJson('/api/vehicles/sync', $payload)
            ->assertOk()
            ->assertJsonPath('data.0.id', 101)
            ->assertJsonPath('data.0.nome', 'Honda Civic Touring')
            ->assertJsonPath('data.0.preco', 'R$ 129.900');

        $this->assertDatabaseHas('vehicles', [
            'id' => 101,
            'brand' => 'Honda',
            'status' => 'Disponível',
            'sale_price' => 129900,
        ]);

        $this->getJson('/api/vehicles')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.opcionais.0', 'Bancos em couro');
    }

    public function test_sync_removes_vehicles_missing_from_the_client_list(): void
    {
        $this->actingAs(User::factory()->create());

        Vehicle::query()->create([
            'name' => 'Veículo antigo',
            'status' => 'Disponível',
        ]);

        $this->putJson('/api/vehicles/sync', ['vehicles' => []])
            ->assertOk()
            ->assertJsonCount(0, 'data');

        $this->assertDatabaseCount('vehicles', 0);
    }

    public function test_sync_creates_sale_for_sold_vehicle(): void
    {
        $this->actingAs(User::factory()->create());

        $this->putJson('/api/vehicles/sync', [
            'vehicles' => [
                [
                    'id' => 800,
                    'nome' => 'Toyota Corolla',
                    'status' => 'Vendido',
                    'preco' => 'R$ 135.900',
                    'dataVenda' => '2026-06-17',
                    'valorVenda' => 135900,
                    'valorRecebido' => 100000,
                    'saldoReceber' => 35900,
                    'comissao' => 1200,
                ],
            ],
        ])->assertOk();

        $this->assertDatabaseHas('sales', [
            'vehicle_id' => 800,
            'sale_value' => 135900,
            'cash_received' => 100000,
            'balance_receivable' => 35900,
        ]);

        $this->assertSame(1, Sale::query()->count());
    }

    public function test_sync_stores_base64_vehicle_images_on_public_disk(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $image = $this->tinyPng();

        $response = $this->putJson('/api/vehicles/sync', [
            'vehicles' => [[
                'id' => 901,
                'nome' => 'Carro com foto',
                'imagem' => $image,
                'galeria' => [$image],
            ]],
        ])->assertOk();

        $cover = $response->json('data.0.imagem');

        $this->assertStringStartsWith('/storage/vehicles/', $cover);
        $this->assertSame($cover, $response->json('data.0.galeria.0'));
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $cover));
        $this->assertStringStartsWith('/storage/', Vehicle::query()->findOrFail(901)->cover_image_path);
    }

    public function test_individual_crud_preserves_other_vehicles_and_synchronizes_sale(): void
    {
        $this->actingAs(User::factory()->create());
        Vehicle::query()->create([
            'id' => 10,
            'name' => 'Veículo existente',
            'status' => 'Disponível',
        ]);

        $this->postJson('/api/vehicles', [
            'id' => 20,
            'nome' => 'Toyota Corolla',
            'status' => 'Disponível',
            'preco' => 'R$ 130.000',
        ])->assertCreated()
            ->assertJsonPath('data.id', 20);

        $this->putJson('/api/vehicles/20', [
            'id' => 20,
            'nome' => 'Toyota Corolla',
            'status' => 'Vendido',
            'preco' => 'R$ 130.000',
            'valorVenda' => 128000,
            'valorRecebido' => 128000,
            'dataVenda' => '2026-06-18',
        ])->assertOk()
            ->assertJsonPath('data.status', 'Vendido');

        $this->assertDatabaseCount('vehicles', 2);
        $this->assertDatabaseHas('vehicles', ['id' => 10]);
        $this->assertDatabaseHas('sales', [
            'vehicle_id' => 20,
            'sale_value' => 128000,
        ]);

        $this->deleteJson('/api/vehicles/20')->assertNoContent();

        $this->assertDatabaseHas('vehicles', ['id' => 10]);
        $this->assertDatabaseMissing('vehicles', ['id' => 20]);
        $this->assertDatabaseMissing('sales', ['vehicle_id' => 20]);
    }

    public function test_quick_registration_can_save_incomplete_vehicle(): void
    {
        $this->actingAs(User::factory()->create());

        $this->postJson('/api/vehicles', [
            'nome' => 'Fiat Pulse Drive',
            'placa' => 'ABC1D23',
            'marca' => 'Fiat',
            'modelo' => 'Pulse',
            'versao' => 'Drive',
            'anoFabricacao' => 2023,
            'anoModelo' => 2024,
            'km' => '12.000 km',
            'combustivel' => 'Flex',
            'cambio' => 'Automático',
            'cor' => 'Branca',
            'origem' => 'Compra direta',
            'preco' => 'R$ 91.000',
            'status' => 'Cadastro incompleto',
        ])->assertCreated()
            ->assertJsonPath('data.status', 'Cadastro incompleto')
            ->assertJsonPath('data.placa', 'ABC1D23');

        $this->assertDatabaseHas('vehicles', [
            'plate' => 'ABC1D23',
            'brand' => 'Fiat',
            'version' => 'Drive',
            'status' => 'Cadastro incompleto',
            'sale_price' => 91000,
        ]);
    }

    public function test_active_plate_cannot_be_duplicated(): void
    {
        $this->actingAs(User::factory()->create());

        Vehicle::query()->create([
            'name' => 'Veículo ativo',
            'plate' => 'ABC1D23',
            'status' => 'Disponível',
        ]);

        $this->postJson('/api/vehicles', [
            'nome' => 'Outro veículo',
            'placa' => 'abc-1d23',
            'status' => 'Cadastro incompleto',
        ])->assertStatus(422);
    }

    private function tinyPng(): string
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=';
    }
}
