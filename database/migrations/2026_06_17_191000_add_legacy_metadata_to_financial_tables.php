<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financial_expenses', function (Blueprint $table) {
            $table->json('metadata')->nullable()->after('notes');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->decimal('commission_percentage', 5, 2)->default(0)->after('commission_default');
            $table->json('metadata')->nullable()->after('notes');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->json('metadata')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('financial_expenses', function (Blueprint $table) {
            $table->dropColumn('metadata');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn(['commission_percentage', 'metadata']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('metadata');
        });
    }
};
