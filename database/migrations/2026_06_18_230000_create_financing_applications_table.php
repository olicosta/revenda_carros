<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financing_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable()->index();
            $table->unsignedBigInteger('vehicle_id')->nullable()->index();
            $table->string('customer_name');
            $table->string('cpf', 14)->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->default('Recebida')->index();
            $table->string('institution')->nullable();
            $table->decimal('requested_amount', 12, 2)->nullable();
            $table->decimal('down_payment', 12, 2)->nullable();
            $table->unsignedInteger('installments')->nullable();
            $table->decimal('desired_installment', 12, 2)->nullable();
            $table->decimal('approved_amount', 12, 2)->nullable();
            $table->json('terms')->nullable();
            $table->json('form_data');
            $table->text('analysis_notes')->nullable();
            $table->timestamp('consent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financing_applications');
    }
};
