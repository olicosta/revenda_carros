<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_visits', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->string('session_id')->index();
            $table->string('page');
            $table->string('title')->nullable();
            $table->text('url')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable()->index();
            $table->timestamp('started_at')->index();
            $table->unsignedInteger('duration')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_visits');
    }
};
