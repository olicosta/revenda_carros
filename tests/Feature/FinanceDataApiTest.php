<?php

namespace Tests\Feature;

use App\Models\FinancialExpense;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinanceDataApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_sync_expenses(): void
    {
        $this->actingAs(User::factory()->create());

        $this->putJson('/api/finance/expenses/sync', [
            'expenses' => [
                [
                    'id' => 501,
                    'data' => '2026-06-17',
                    'categoria' => 'Marketing',
                    'valor' => 950,
                    'descricao' => 'Anúncios',
                    'pagamento' => 'Pix',
                    'responsavel' => 'Admin',
                ],
            ],
        ])->assertOk()
            ->assertJsonPath('data.0.id', 501)
            ->assertJsonPath('data.0.valor', 950);

        $this->assertDatabaseHas('financial_expenses', [
            'id' => 501,
            'category' => 'Marketing',
            'amount' => 950,
        ]);

        $this->putJson('/api/finance/expenses/sync', ['expenses' => []])
            ->assertOk()
            ->assertJsonCount(0, 'data');

        $this->assertDatabaseCount('financial_expenses', 0);
    }

    public function test_authenticated_admin_can_sync_sellers(): void
    {
        $this->actingAs(User::factory()->create());

        $this->putJson('/api/finance/sellers/sync', [
            'sellers' => [
                [
                    'id' => 701,
                    'nome' => 'Carlos',
                    'whatsapp' => '47999999999',
                    'comissaoPadrao' => 500,
                    'comissaoTipo' => 'fixa',
                    'comissaoPercentualPadrao' => 2.5,
                    'ativo' => true,
                ],
            ],
        ])->assertOk()
            ->assertJsonPath('data.0.id', 701)
            ->assertJsonPath('data.0.nome', 'Carlos')
            ->assertJsonPath('data.0.ativo', true);

        $this->assertDatabaseHas('sellers', [
            'id' => 701,
            'name' => 'Carlos',
            'status' => 'Ativo',
        ]);
    }

    public function test_finance_endpoints_require_authentication(): void
    {
        $this->getJson('/api/finance/expenses')->assertUnauthorized();
        $this->getJson('/api/finance/sellers')->assertUnauthorized();
        $this->postJson('/api/finance/expenses', [])->assertUnauthorized();
        $this->postJson('/api/finance/sellers', [])->assertUnauthorized();
    }

    public function test_individual_expense_crud_preserves_other_expenses(): void
    {
        $this->actingAs(User::factory()->create());
        FinancialExpense::query()->create([
            'id' => 1,
            'expense_date' => '2026-06-01',
            'category' => 'Fixa',
            'amount' => 100,
            'description' => 'Despesa existente',
        ]);

        $this->postJson('/api/finance/expenses', [
            'id' => 2,
            'data' => '2026-06-18',
            'categoria' => 'Marketing',
            'valor' => 500,
            'descricao' => 'Anúncios',
        ])->assertCreated()
            ->assertJsonPath('data.id', 2);

        $this->putJson('/api/finance/expenses/2', [
            'id' => 2,
            'data' => '2026-06-18',
            'categoria' => 'Marketing',
            'valor' => 650,
            'descricao' => 'Anúncios atualizados',
        ])->assertOk()
            ->assertJsonPath('data.valor', 650);

        $this->assertDatabaseCount('financial_expenses', 2);
        $this->assertDatabaseHas('financial_expenses', ['id' => 1]);

        $this->deleteJson('/api/finance/expenses/2')->assertNoContent();
        $this->assertDatabaseHas('financial_expenses', ['id' => 1]);
    }

    public function test_individual_seller_crud_preserves_other_sellers(): void
    {
        $this->actingAs(User::factory()->create());
        Seller::query()->create([
            'id' => 1,
            'name' => 'Vendedor existente',
            'status' => 'Ativo',
        ]);

        $this->postJson('/api/finance/sellers', [
            'id' => 2,
            'nome' => 'Carla',
            'whatsapp' => '47999999999',
            'comissaoPadrao' => 500,
            'comissaoTipo' => 'fixa',
            'comissaoPercentualPadrao' => 2,
            'ativo' => true,
        ])->assertCreated()
            ->assertJsonPath('data.id', 2);

        $this->putJson('/api/finance/sellers/2', [
            'id' => 2,
            'nome' => 'Carla',
            'whatsapp' => '47999999999',
            'comissaoPadrao' => 750,
            'comissaoTipo' => 'fixa',
            'comissaoPercentualPadrao' => 2,
            'ativo' => false,
        ])->assertOk()
            ->assertJsonPath('data.ativo', false);

        $this->assertDatabaseCount('sellers', 2);
        $this->assertDatabaseHas('sellers', ['id' => 1]);

        $this->deleteJson('/api/finance/sellers/2')->assertNoContent();
        $this->assertDatabaseHas('sellers', ['id' => 1]);
    }
}
