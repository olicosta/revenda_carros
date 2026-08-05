<?php

use App\Models\FinancialExpense;
use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('caixa');
            $table->decimal('opening_balance', 14, 2)->default(0);
            $table->date('opening_balance_date')->nullable();
            $table->string('status')->default('ativa');
            $table->boolean('is_default')->default(false);
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('financial_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('parent_name')->nullable();
            $table->boolean('vehicle_cost')->default(false);
            $table->boolean('affects_dre')->default(true);
            $table->string('dre_group')->nullable();
            $table->timestamps();
            $table->unique(['name', 'type']);
        });

        Schema::create('financial_entries', function (Blueprint $table) {
            $table->id();
            $table->string('direction');
            $table->string('description');
            $table->foreignId('financial_account_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('financial_category_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('vehicle_id')->nullable()->index();
            $table->unsignedBigInteger('sale_id')->nullable()->index();
            $table->unsignedBigInteger('lead_id')->nullable()->index();
            $table->unsignedBigInteger('seller_id')->nullable()->index();
            $table->unsignedBigInteger('source_expense_id')->nullable()->index();
            $table->string('person_name')->nullable();
            $table->string('cost_center')->nullable();
            $table->date('competence_date')->nullable();
            $table->date('issued_at')->nullable();
            $table->date('due_at')->nullable();
            $table->date('settled_at')->nullable();
            $table->decimal('original_amount', 14, 2)->default(0);
            $table->decimal('interest_amount', 14, 2)->default(0);
            $table->decimal('fine_amount', 14, 2)->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);
            $table->decimal('final_amount', 14, 2)->default(0);
            $table->decimal('paid_amount', 14, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->unsignedInteger('installment_number')->default(1);
            $table->unsignedInteger('installments_total')->default(1);
            $table->string('recurrence')->nullable();
            $table->string('status')->default('pendente');
            $table->boolean('is_transfer')->default(false);
            $table->boolean('is_reversal')->default(false);
            $table->unsignedBigInteger('reversal_of_entry_id')->nullable()->index();
            $table->text('cancel_reason')->nullable();
            $table->text('notes')->nullable();
            $table->json('attachments')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('financial_entry_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_entry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('financial_account_id')->nullable()->constrained()->nullOnDelete();
            $table->date('paid_at');
            $table->decimal('amount', 14, 2);
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('financial_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_account_id')->constrained('financial_accounts')->cascadeOnDelete();
            $table->foreignId('to_account_id')->constrained('financial_accounts')->cascadeOnDelete();
            $table->date('transferred_at');
            $table->decimal('amount', 14, 2);
            $table->string('status')->default('conciliada');
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('commission_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('calculation_type')->default('percentual');
            $table->decimal('value', 10, 2)->default(0);
            $table->string('base')->default('valor_venda');
            $table->string('status')->default('ativa');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        $this->seedDefaults();
        $this->migrateLegacyExpenses();
        $this->migrateLegacySales();
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_rules');
        Schema::dropIfExists('financial_transfers');
        Schema::dropIfExists('financial_entry_payments');
        Schema::dropIfExists('financial_entries');
        Schema::dropIfExists('financial_categories');
        Schema::dropIfExists('financial_accounts');
    }

    private function seedDefaults(): void
    {
        $now = now();

        DB::table('financial_accounts')->insert([
            'name' => 'Caixa principal',
            'type' => 'caixa',
            'opening_balance' => 0,
            'status' => 'ativa',
            'is_default' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $categories = [
            ['Receita de venda', 'receber', null, false, true, 'receita_bruta'],
            ['Compra de veículo', 'pagar', 'Estoque', true, true, 'custo_veiculos_vendidos'],
            ['Frete ou guincho', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Transferência', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Documentação', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Vistoria e laudo cautelar', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Mecânica', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Peças', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Funilaria e pintura', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Pneus', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Higienização e preparação', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Fotografias e anúncios', 'pagar', 'Comercial', true, true, 'despesas_comerciais'],
            ['IPVA', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Licenciamento', 'pagar', 'Veículo', true, true, 'custo_veiculos_vendidos'],
            ['Comissão', 'pagar', 'Comercial', false, true, 'despesas_comerciais'],
            ['Tributos e taxas', 'pagar', 'Fiscal', false, true, 'deducoes'],
            ['Garantia e pós-venda', 'pagar', 'Pós-venda', true, true, 'despesas_comerciais'],
            ['Despesa operacional', 'pagar', 'Loja', false, true, 'despesas_administrativas'],
            ['Outros custos', 'pagar', 'Loja', false, true, 'outras_despesas'],
        ];

        foreach ($categories as [$name, $type, $parent, $vehicleCost, $affectsDre, $dreGroup]) {
            DB::table('financial_categories')->insertOrIgnore([
                'name' => $name,
                'type' => $type,
                'parent_name' => $parent,
                'vehicle_cost' => $vehicleCost,
                'affects_dre' => $affectsDre,
                'dre_group' => $dreGroup,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table('commission_rules')->insert([
            'name' => 'Comissão padrão configurável',
            'calculation_type' => 'percentual',
            'value' => 0,
            'base' => 'valor_venda',
            'status' => 'ativa',
            'notes' => 'Regra inicial sem percentual fixo. Configure por vendedor ou operação.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function migrateLegacyExpenses(): void
    {
        if (! Schema::hasTable('financial_expenses')) {
            return;
        }

        $defaultAccountId = DB::table('financial_accounts')->where('is_default', true)->value('id');

        FinancialExpense::query()->orderBy('id')->chunkById(100, function ($expenses) use ($defaultAccountId) {
            foreach ($expenses as $expense) {
                $categoryId = DB::table('financial_categories')
                    ->where('type', 'pagar')
                    ->where('name', $expense->category)
                    ->value('id');

                if (! $categoryId) {
                    $categoryId = DB::table('financial_categories')->insertGetId([
                        'name' => $expense->category ?: 'Outros custos',
                        'type' => 'pagar',
                        'parent_name' => $expense->vehicle_id ? 'Veículo' : 'Loja',
                        'vehicle_cost' => (bool) $expense->vehicle_id,
                        'affects_dre' => true,
                        'dre_group' => $expense->vehicle_id ? 'custo_veiculos_vendidos' : 'despesas_administrativas',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('financial_entries')->updateOrInsert(
                    ['source_expense_id' => $expense->id],
                    [
                        'direction' => 'pagar',
                        'description' => $expense->description,
                        'financial_account_id' => $defaultAccountId,
                        'financial_category_id' => $categoryId,
                        'vehicle_id' => $expense->vehicle_id,
                        'competence_date' => $expense->expense_date,
                        'issued_at' => $expense->expense_date,
                        'due_at' => $expense->expense_date,
                        'settled_at' => $expense->expense_date,
                        'original_amount' => $expense->amount,
                        'final_amount' => $expense->amount,
                        'paid_amount' => $expense->amount,
                        'payment_method' => $expense->payment_method,
                        'status' => 'pago',
                        'cost_center' => $expense->vehicle_id ? 'Veículo' : 'Loja',
                        'person_name' => $expense->responsible,
                        'notes' => $expense->notes,
                        'metadata' => json_encode([
                            'legacy_table' => 'financial_expenses',
                            'legacy_id' => $expense->id,
                            'legacy_payload' => $expense->metadata,
                        ]),
                        'created_at' => $expense->created_at ?? now(),
                        'updated_at' => now(),
                    ]
                );
            }
        });
    }

    private function migrateLegacySales(): void
    {
        if (! Schema::hasTable('sales')) {
            return;
        }

        $defaultAccountId = DB::table('financial_accounts')->where('is_default', true)->value('id');
        $revenueCategoryId = DB::table('financial_categories')
            ->where('type', 'receber')
            ->where('name', 'Receita de venda')
            ->value('id');
        $commissionCategoryId = DB::table('financial_categories')
            ->where('type', 'pagar')
            ->where('name', 'Comissão')
            ->value('id');

        Sale::query()->orderBy('id')->chunkById(100, function ($sales) use (
            $defaultAccountId,
            $revenueCategoryId,
            $commissionCategoryId
        ) {
            foreach ($sales as $sale) {
                $paid = max(0, (float) $sale->cash_received + (float) $sale->trade_value);
                $final = max(0, (float) $sale->sale_value);

                DB::table('financial_entries')->updateOrInsert(
                    ['sale_id' => $sale->id, 'direction' => 'receber', 'is_reversal' => false],
                    [
                        'description' => 'Receita da venda #'.$sale->id,
                        'financial_account_id' => $defaultAccountId,
                        'financial_category_id' => $revenueCategoryId,
                        'vehicle_id' => $sale->vehicle_id,
                        'seller_id' => $sale->seller_id,
                        'competence_date' => $sale->sold_at,
                        'issued_at' => $sale->sold_at,
                        'due_at' => $sale->sold_at,
                        'settled_at' => $paid >= $final ? $sale->sold_at : null,
                        'original_amount' => $final,
                        'final_amount' => $final,
                        'paid_amount' => min($paid, $final),
                        'payment_method' => 'Venda',
                        'status' => $paid >= $final ? 'recebido' : ($paid > 0 ? 'parcial' : 'pendente'),
                        'cost_center' => 'Venda',
                        'metadata' => json_encode([
                            'legacy_table' => 'sales',
                            'legacy_id' => $sale->id,
                            'trade_value' => (float) $sale->trade_value,
                            'cash_received' => (float) $sale->cash_received,
                            'balance_receivable' => (float) $sale->balance_receivable,
                        ]),
                        'created_at' => $sale->created_at ?? now(),
                        'updated_at' => now(),
                    ]
                );

                if ((float) $sale->commission_value > 0) {
                    DB::table('financial_entries')->updateOrInsert(
                        ['sale_id' => $sale->id, 'direction' => 'pagar', 'seller_id' => $sale->seller_id],
                        [
                            'description' => 'Comissão da venda #'.$sale->id,
                            'financial_account_id' => $defaultAccountId,
                            'financial_category_id' => $commissionCategoryId,
                            'vehicle_id' => $sale->vehicle_id,
                            'competence_date' => $sale->sold_at,
                            'issued_at' => $sale->sold_at,
                            'due_at' => $sale->sold_at,
                            'original_amount' => $sale->commission_value,
                            'final_amount' => $sale->commission_value,
                            'paid_amount' => 0,
                            'payment_method' => 'Comissão',
                            'status' => 'pendente',
                            'cost_center' => 'Comercial',
                            'metadata' => json_encode([
                                'legacy_table' => 'sales',
                                'legacy_id' => $sale->id,
                                'commission' => true,
                            ]),
                            'created_at' => $sale->created_at ?? now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        });
    }
};
