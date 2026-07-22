<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->index();
            $table->unsignedBigInteger('seller_id')->nullable()->index();
            $table->date('sold_at')->nullable();
            $table->decimal('sale_value', 12, 2)->default(0);
            $table->decimal('cash_received', 12, 2)->default(0);
            $table->boolean('has_trade')->default(false);
            $table->string('trade_vehicle')->nullable();
            $table->decimal('trade_value', 12, 2)->default(0);
            $table->unsignedBigInteger('trade_stock_vehicle_id')->nullable()->index();
            $table->decimal('balance_receivable', 12, 2)->default(0);
            $table->decimal('commission_value', 12, 2)->default(0);
            $table->json('payment_methods')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
