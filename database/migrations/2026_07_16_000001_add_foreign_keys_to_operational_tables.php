<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->removeOrphanRows();
        $this->nullOrphanReferences();

        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete();
            $table->foreign('seller_id')->references('id')->on('sellers')->nullOnDelete();
            $table->foreign('trade_stock_vehicle_id')->references('id')->on('vehicles')->nullOnDelete();
        });

        Schema::table('financial_expenses', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->nullOnDelete();
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->nullOnDelete();
        });

        Schema::table('financing_applications', function (Blueprint $table) {
            $table->foreign('lead_id')->references('id')->on('leads')->nullOnDelete();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->nullOnDelete();
        });

        Schema::table('financing_documents', function (Blueprint $table) {
            $table->foreign('financing_application_id')->references('id')->on('financing_applications')->cascadeOnDelete();
        });

        Schema::table('audit_logs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::table('customer_communications', function (Blueprint $table) {
            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('customer_communications', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('financing_documents', function (Blueprint $table) {
            $table->dropForeign(['financing_application_id']);
        });

        Schema::table('financing_applications', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropForeign(['vehicle_id']);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });

        Schema::table('financial_expenses', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['trade_stock_vehicle_id']);
        });
    }

    private function removeOrphanRows(): void
    {
        DB::table('sales')
            ->whereNotNull('vehicle_id')
            ->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('vehicles')
                    ->whereColumn('vehicles.id', 'sales.vehicle_id');
            })
            ->delete();

        DB::table('financing_documents')
            ->whereNotNull('financing_application_id')
            ->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('financing_applications')
                    ->whereColumn('financing_applications.id', 'financing_documents.financing_application_id');
            })
            ->delete();

        DB::table('customer_communications')
            ->whereNotNull('lead_id')
            ->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('leads')
                    ->whereColumn('leads.id', 'customer_communications.lead_id');
            })
            ->delete();
    }

    private function nullOrphanReferences(): void
    {
        $this->nullMissingReference('sales', 'seller_id', 'sellers');
        $this->nullMissingReference('sales', 'trade_stock_vehicle_id', 'vehicles');
        $this->nullMissingReference('financial_expenses', 'vehicle_id', 'vehicles');
        $this->nullMissingReference('leads', 'vehicle_id', 'vehicles');
        $this->nullMissingReference('financing_applications', 'lead_id', 'leads');
        $this->nullMissingReference('financing_applications', 'vehicle_id', 'vehicles');
        $this->nullMissingReference('audit_logs', 'user_id', 'users');
        $this->nullMissingReference('customer_communications', 'user_id', 'users');
    }

    private function nullMissingReference(string $table, string $column, string $relatedTable): void
    {
        DB::table($table)
            ->whereNotNull($column)
            ->whereNotExists(function ($query) use ($table, $column, $relatedTable) {
                $query->selectRaw('1')
                    ->from($relatedTable)
                    ->whereColumn($relatedTable.'.id', $table.'.'.$column);
            })
            ->update([$column => null]);
    }
};
