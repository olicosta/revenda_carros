<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_id')->nullable()->index()->after('vehicle_id');
            $table->string('temperature')->default('Morno')->after('status');
            $table->string('loss_reason')->nullable()->after('temperature');
            $table->string('task_title')->nullable()->after('loss_reason');
            $table->dateTime('task_due_at')->nullable()->after('task_title');
            $table->timestamp('consent_at')->nullable()->after('task_due_at');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'seller_id',
                'temperature',
                'loss_reason',
                'task_title',
                'task_due_at',
                'consent_at',
            ]);
        });
    }
};
