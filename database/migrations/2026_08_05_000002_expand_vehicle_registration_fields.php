<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('stock_code')->nullable()->after('id');
            $table->string('plate', 20)->nullable()->after('stock_code');
            $table->string('version')->nullable()->after('model');
            $table->unsignedSmallInteger('manufacture_year')->nullable()->after('version');
            $table->unsignedSmallInteger('model_year')->nullable()->after('manufacture_year');
            $table->string('condition')->nullable()->after('model_year');
            $table->string('origin')->nullable()->after('condition');
            $table->string('store_unit')->nullable()->after('origin');
            $table->foreignId('responsible_user_id')->nullable()->after('store_unit')->constrained('users')->nullOnDelete();
            $table->date('entry_date')->nullable()->after('responsible_user_id');
            $table->date('available_at')->nullable()->after('entry_date');
            $table->date('reserved_at')->nullable()->after('available_at');
            $table->date('delivered_at')->nullable()->after('reserved_at');
            $table->unsignedTinyInteger('completion_percentage')->default(0)->after('delivered_at');
            $table->json('documentation')->nullable()->after('metadata');
            $table->json('condition_report')->nullable()->after('documentation');
            $table->json('financial_details')->nullable()->after('condition_report');
            $table->json('preparation')->nullable()->after('financial_details');
            $table->json('publication')->nullable()->after('preparation');
            $table->json('validation_status')->nullable()->after('publication');
            $table->unsignedInteger('record_version')->default(1)->after('validation_status');

            $table->index('stock_code');
            $table->index('plate');
            $table->index('status');
            $table->index('brand');
            $table->index('model');
            $table->index('entry_date');
            $table->index('responsible_user_id');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('responsible_user_id');
            $table->dropIndex(['stock_code']);
            $table->dropIndex(['plate']);
            $table->dropIndex(['status']);
            $table->dropIndex(['brand']);
            $table->dropIndex(['model']);
            $table->dropIndex(['entry_date']);

            $table->dropColumn([
                'stock_code',
                'plate',
                'version',
                'manufacture_year',
                'model_year',
                'condition',
                'origin',
                'store_unit',
                'entry_date',
                'available_at',
                'reserved_at',
                'delivered_at',
                'completion_percentage',
                'documentation',
                'condition_report',
                'financial_details',
                'preparation',
                'publication',
                'validation_status',
                'record_version',
            ]);
        });
    }
};
