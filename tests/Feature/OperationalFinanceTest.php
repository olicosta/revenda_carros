<?php

namespace Tests\Feature;

use App\Models\FinancialAccount;
use App\Models\FinancialCategory;
use App\Models\FinancialEntry;
use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperationalFinanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_finance_summary_calculates_vehicle_result_without_transfer_revenue(): void
    {
        $user = User::factory()->create(['role' => 'financeiro']);
        $account = FinancialAccount::query()->create([
            'name' => 'Caixa',
            'type' => 'caixa',
            'opening_balance' => 0,
            'is_default' => true,
        ]);
        $revenue = FinancialCategory::query()->firstOrCreate([
            'name' => 'Receita de venda',
            'type' => 'receber',
        ], [
            'dre_group' => 'receita_bruta',
        ]);
        $mechanic = FinancialCategory::query()->firstOrCreate([
            'name' => 'Mecânica',
            'type' => 'pagar',
        ], [
            'vehicle_cost' => true,
            'dre_group' => 'custo_veiculos_vendidos',
        ]);
        $revenue->update([
            'dre_group' => 'receita_bruta',
        ]);
        $mechanic->update([
            'vehicle_cost' => true,
            'dre_group' => 'custo_veiculos_vendidos',
        ]);
        $vehicle = Vehicle::query()->create([
            'name' => 'Honda Civic',
            'purchase_price' => 50000,
            'sale_price' => 80000,
            'preparation_cost' => 2500,
            'fees_cost' => 500,
            'status' => 'Vendido',
        ]);
        Sale::query()->create([
            'vehicle_id' => $vehicle->id,
            'sold_at' => now()->toDateString(),
            'sale_value' => 80000,
            'cash_received' => 60000,
            'trade_value' => 20000,
            'commission_value' => 1000,
        ]);
        FinancialEntry::query()->create([
            'direction' => 'receber',
            'description' => 'Venda',
            'financial_account_id' => $account->id,
            'financial_category_id' => $revenue->id,
            'vehicle_id' => $vehicle->id,
            'competence_date' => now()->toDateString(),
            'due_at' => now()->toDateString(),
            'original_amount' => 80000,
            'final_amount' => 80000,
            'paid_amount' => 80000,
            'status' => 'recebido',
        ]);
        FinancialEntry::query()->create([
            'direction' => 'pagar',
            'description' => 'Revisão',
            'financial_account_id' => $account->id,
            'financial_category_id' => $mechanic->id,
            'vehicle_id' => $vehicle->id,
            'competence_date' => now()->toDateString(),
            'due_at' => now()->toDateString(),
            'original_amount' => 2000,
            'final_amount' => 2000,
            'paid_amount' => 2000,
            'status' => 'pago',
        ]);
        FinancialEntry::query()->create([
            'direction' => 'receber',
            'description' => 'Transferência interna',
            'financial_account_id' => $account->id,
            'competence_date' => now()->toDateString(),
            'due_at' => now()->toDateString(),
            'original_amount' => 999,
            'final_amount' => 999,
            'paid_amount' => 999,
            'status' => 'recebido',
            'is_transfer' => true,
        ]);

        $response = $this->actingAs($user)->getJson('/api/finance/summary?month='.now()->format('Y-m'));

        $response->assertOk()
            ->assertJsonPath('data.cards.entradas_periodo', 80000)
            ->assertJsonPath('data.cards.receita_vendas', 80000)
            ->assertJsonPath('data.cards.lucro_bruto', 24000);
    }

    public function test_finance_summary_uses_announced_stock_value_for_available_vehicles(): void
    {
        $user = User::factory()->create(['role' => 'financeiro']);

        Vehicle::query()->create([
            'name' => 'Fiat Pulse',
            'purchase_price' => 0,
            'sale_price' => 91000,
            'status' => 'Disponível',
        ]);
        Vehicle::query()->create([
            'name' => 'Honda Civic',
            'purchase_price' => 0,
            'sale_price' => 129900,
            'status' => 'Disponível',
        ]);
        Vehicle::query()->create([
            'name' => 'Toyota Corolla vendido',
            'purchase_price' => 70000,
            'sale_price' => 135000,
            'status' => 'Vendido',
        ]);

        $this->actingAs($user)
            ->getJson('/api/finance/summary?month='.now()->format('Y-m'))
            ->assertOk()
            ->assertJsonPath('data.cards.capital_estoque', 220900)
            ->assertJsonPath('data.cards.capital_investido_estoque', 0)
            ->assertJsonPath('data.cards.veiculos_estoque', 2);
    }

    public function test_non_financial_user_cannot_store_financial_entry(): void
    {
        $user = User::factory()->create(['role' => 'marketing']);

        $this->actingAs($user)->postJson('/api/finance/entries', [
            'direction' => 'pagar',
            'description' => 'Despesa',
            'due_at' => now()->toDateString(),
            'original_amount' => 100,
        ])->assertForbidden();
    }

    public function test_entry_can_be_partially_settled(): void
    {
        $user = User::factory()->create(['role' => 'financeiro']);
        $account = FinancialAccount::query()->create(['name' => 'Banco', 'type' => 'banco']);
        $entry = FinancialEntry::query()->create([
            'direction' => 'pagar',
            'description' => 'Boleto',
            'financial_account_id' => $account->id,
            'competence_date' => now()->toDateString(),
            'due_at' => now()->toDateString(),
            'original_amount' => 1000,
            'final_amount' => 1000,
            'paid_amount' => 0,
            'status' => 'pendente',
        ]);

        $this->actingAs($user)->postJson('/api/finance/entries/'.$entry->id.'/settle', [
            'amount' => 300,
            'paid_at' => now()->toDateString(),
            'financial_account_id' => $account->id,
            'payment_method' => 'Pix',
        ])->assertOk()
            ->assertJsonPath('data.status', 'parcial')
            ->assertJsonPath('data.paid_amount', 300)
            ->assertJsonPath('data.open_amount', 700);
    }

    public function test_entry_status_follows_paid_amount_instead_of_manual_paid_status(): void
    {
        $user = User::factory()->create(['role' => 'financeiro']);

        $this->actingAs($user)->postJson('/api/finance/entries', [
            'direction' => 'receber',
            'description' => 'Venda a receber',
            'due_at' => now()->addDay()->toDateString(),
            'original_amount' => 5000,
            'paid_amount' => 0,
            'status' => 'recebido',
        ])->assertCreated()
            ->assertJsonPath('data.status', 'pendente')
            ->assertJsonPath('data.open_amount', 5000);
    }

    public function test_financial_account_and_report_endpoints_are_operational(): void
    {
        $user = User::factory()->create(['role' => 'financeiro']);

        $accountResponse = $this->actingAs($user)->postJson('/api/finance/accounts', [
            'name' => 'Banco teste',
            'type' => 'banco',
            'opening_balance' => 500,
            'opening_balance_date' => now()->toDateString(),
            'status' => 'ativa',
            'is_default' => true,
        ]);

        $accountResponse->assertCreated()
            ->assertJsonPath('data.name', 'Banco teste')
            ->assertJsonPath('data.is_default', true);

        $category = FinancialCategory::query()->firstOrCreate([
            'name' => 'Despesa operacional',
            'type' => 'pagar',
        ], [
            'dre_group' => 'despesas_administrativas',
        ]);

        FinancialEntry::query()->create([
            'direction' => 'pagar',
            'description' => 'Aluguel',
            'financial_account_id' => $accountResponse->json('data.id'),
            'financial_category_id' => $category->id,
            'competence_date' => now()->toDateString(),
            'due_at' => now()->toDateString(),
            'original_amount' => 1200,
            'final_amount' => 1200,
            'paid_amount' => 1200,
            'status' => 'pago',
        ]);

        $this->actingAs($user)->getJson('/api/finance/report?month='.now()->format('Y-m'))
            ->assertOk()
            ->assertJsonPath('data.dre.despesas_administrativas', 1200);
    }
}
