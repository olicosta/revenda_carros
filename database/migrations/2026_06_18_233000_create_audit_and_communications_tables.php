<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('method', 10);
            $table->string('path');
            $table->unsignedSmallInteger('status');
            $table->string('ip_address', 45)->nullable();
            $table->json('changes')->nullable();
            $table->timestamps();
        });

        Schema::create('customer_communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->index();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('channel')->default('Anotação');
            $table->string('direction')->default('Saída');
            $table->text('message');
            $table->timestamp('sent_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_communications');
        Schema::dropIfExists('audit_logs');
    }
};
