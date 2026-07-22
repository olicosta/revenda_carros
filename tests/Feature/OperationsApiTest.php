<?php

namespace Tests\Feature;

use App\Models\AnalyticsVisit;
use App\Models\User;
use App\Models\VehicleHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperationsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_sync_vehicle_histories(): void
    {
        $this->actingAs(User::factory()->create());

        $this->putJson('/api/vehicle-histories/sync', [
            'histories' => [[
                'id' => 501,
                'carroId' => 91,
                'carroNome' => 'Honda Civic',
                'tipo' => 'Edição',
                'descricao' => 'Cadastro atualizado.',
                'data' => '2026-06-18T12:00:00.000Z',
                'extras' => ['status' => 'Disponível'],
            ]],
        ])->assertOk()
            ->assertJsonPath('data.0.id', 501)
            ->assertJsonPath('data.0.carroNome', 'Honda Civic')
            ->assertJsonPath('data.0.extras.status', 'Disponível');

        $this->assertDatabaseHas('vehicle_histories', [
            'id' => 501,
            'vehicle_id' => 91,
            'type' => 'Edição',
        ]);

        $this->getJson('/api/vehicle-histories')
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_public_can_record_and_update_visit_duration(): void
    {
        $startedAt = 1781784000000;

        $this->postJson('/api/analytics/visits', [
            'id' => 'visit-123',
            'sessao' => 'session-456',
            'pagina' => 'detalhes.html',
            'titulo' => 'Detalhes do veículo',
            'url' => '/detalhes.html?id=10',
            'veiculoId' => 10,
            'inicio' => $startedAt,
            'duracao' => 0,
        ])->assertCreated()
            ->assertJsonPath('data.id', 'visit-123')
            ->assertJsonPath('data.veiculoId', 10);

        $this->putJson('/api/analytics/visits/visit-123', [
            'duracao' => 42,
        ])->assertOk()
            ->assertJsonPath('data.duracao', 42);

        $this->assertDatabaseHas('analytics_visits', [
            'external_id' => 'visit-123',
            'session_id' => 'session-456',
            'duration' => 42,
        ]);
    }

    public function test_admin_can_list_import_and_clear_analytics(): void
    {
        $this->actingAs(User::factory()->create());

        $this->putJson('/api/analytics/sync', [
            'visitas' => [[
                'id' => 'imported-1',
                'sessao' => 'session-1',
                'pagina' => 'index.html',
                'titulo' => 'Início',
                'url' => '/',
                'inicio' => 1781784000000,
                'duracao' => 12,
            ]],
        ])->assertOk()
            ->assertJsonPath('data.visitas.0.id', 'imported-1');

        $this->getJson('/api/analytics')
            ->assertOk()
            ->assertJsonCount(1, 'data.visitas');

        $this->deleteJson('/api/analytics')->assertNoContent();
        $this->assertDatabaseCount('analytics_visits', 0);
    }

    public function test_operational_data_reads_and_destructive_writes_require_authentication(): void
    {
        VehicleHistory::query()->create([
            'vehicle_id' => 1,
            'type' => 'Cadastro',
            'description' => 'Teste',
        ]);
        AnalyticsVisit::query()->create([
            'external_id' => 'private-visit',
            'session_id' => 'private-session',
            'page' => 'index.html',
            'started_at' => now(),
        ]);

        $this->getJson('/api/vehicle-histories')->assertUnauthorized();
        $this->putJson('/api/vehicle-histories/sync', ['histories' => []])
            ->assertUnauthorized();
        $this->getJson('/api/analytics')->assertUnauthorized();
        $this->deleteJson('/api/analytics')->assertUnauthorized();
    }
}
