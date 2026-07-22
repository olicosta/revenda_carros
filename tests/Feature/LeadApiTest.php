<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_sync_leads_with_history(): void
    {
        $this->actingAs(User::factory()->create());

        Vehicle::query()->create([
            'id' => 10,
            'name' => 'Honda Civic',
            'status' => 'Disponível',
        ]);

        $this->putJson('/api/leads/sync', [
            'leads' => [
                [
                    'id' => 900,
                    'nome' => 'Maria Silva',
                    'whatsapp' => '47999999999',
                    'origem' => 'Instagram',
                    'veiculoId' => 10,
                    'veiculoNome' => 'Honda Civic',
                    'status' => 'Proposta',
                    'proximoContato' => '2026-06-20',
                    'observacao' => 'Cliente quer financiamento.',
                    'historico' => [
                        [
                            'data' => '2026-06-17T12:00:00.000Z',
                            'texto' => 'Proposta enviada.',
                        ],
                    ],
                ],
            ],
        ])->assertOk()
            ->assertJsonPath('data.0.id', 900)
            ->assertJsonPath('data.0.nome', 'Maria Silva')
            ->assertJsonPath('data.0.historico.0.texto', 'Proposta enviada.');

        $this->assertDatabaseHas('leads', [
            'id' => 900,
            'name' => 'Maria Silva',
            'vehicle_id' => 10,
            'status' => 'Proposta',
            'last_interaction' => 'Proposta enviada.',
        ]);

        $this->getJson('/api/leads')
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_sync_can_remove_all_leads(): void
    {
        $this->actingAs(User::factory()->create());

        Lead::query()->create([
            'name' => 'Cliente antigo',
            'status' => 'Novo',
        ]);

        $this->putJson('/api/leads/sync', ['leads' => []])
            ->assertOk()
            ->assertJsonCount(0, 'data');

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_lead_endpoints_require_authentication(): void
    {
        $this->getJson('/api/leads')->assertUnauthorized();
        $this->putJson('/api/leads/sync', ['leads' => []])->assertUnauthorized();
        $this->postJson('/api/leads', ['nome' => 'Cliente'])->assertUnauthorized();
    }

    public function test_individual_lead_crud_preserves_other_leads(): void
    {
        $this->actingAs(User::factory()->create());
        Lead::query()->create([
            'id' => 1,
            'name' => 'Cliente existente',
            'status' => 'Novo',
        ]);

        $this->postJson('/api/leads', [
            'id' => 2,
            'nome' => 'Ana Souza',
            'whatsapp' => '47999999999',
            'email' => 'ana@example.com',
            'cpf' => '123.456.789-00',
            'dataNascimento' => '1990-05-20',
            'cep' => '89000-000',
            'cidade' => 'Blumenau',
            'estado' => 'SC',
            'profissao' => 'Comerciante',
            'rendaMensal' => 6500,
            'vendedorId' => 7,
            'temperatura' => 'Quente',
            'tarefa' => 'Enviar simulação',
            'prazoTarefa' => '2026-06-19T10:00',
            'consentimento' => true,
            'status' => 'Em atendimento',
            'historico' => [[
                'texto' => 'Primeiro contato.',
            ]],
        ])->assertCreated()
            ->assertJsonPath('data.id', 2)
            ->assertJsonPath('data.historico.0.texto', 'Primeiro contato.');

        $this->putJson('/api/leads/2', [
            'id' => 2,
            'nome' => 'Ana Souza',
            'whatsapp' => '47999999999',
            'email' => 'ana@example.com',
            'cpf' => '123.456.789-00',
            'dataNascimento' => '1990-05-20',
            'cep' => '89000-000',
            'cidade' => 'Blumenau',
            'estado' => 'SC',
            'profissao' => 'Comerciante',
            'rendaMensal' => 6500,
            'vendedorId' => 7,
            'temperatura' => 'Quente',
            'tarefa' => 'Enviar simulação',
            'prazoTarefa' => '2026-06-19T10:00',
            'consentimento' => true,
            'status' => 'Proposta',
            'observacao' => 'Aguardando retorno.',
            'historico' => [[
                'texto' => 'Proposta enviada.',
            ]],
        ])->assertOk()
            ->assertJsonPath('data.status', 'Proposta');

        $this->assertDatabaseCount('leads', 2);
        $this->assertDatabaseHas('leads', ['id' => 1]);
        $this->assertDatabaseHas('leads', [
            'id' => 2,
            'email' => 'ana@example.com',
            'cpf' => '123.456.789-00',
            'city' => 'Blumenau',
            'state' => 'SC',
            'occupation' => 'Comerciante',
            'monthly_income' => 6500,
            'seller_id' => 7,
            'temperature' => 'Quente',
            'task_title' => 'Enviar simulação',
            'last_interaction' => 'Proposta enviada.',
        ]);

        $this->deleteJson('/api/leads/2')->assertNoContent();
        $this->assertDatabaseHas('leads', ['id' => 1]);
        $this->assertDatabaseMissing('leads', ['id' => 2]);
    }
}
