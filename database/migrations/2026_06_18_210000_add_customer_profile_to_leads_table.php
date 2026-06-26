<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('cpf', 14)->nullable()->after('email');
            $table->date('birth_date')->nullable()->after('cpf');
            $table->string('postal_code', 9)->nullable()->after('birth_date');
            $table->string('city')->nullable()->after('postal_code');
            $table->string('state', 2)->nullable()->after('city');
            $table->string('occupation')->nullable()->after('state');
            $table->decimal('monthly_income', 12, 2)->nullable()->after('occupation');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'cpf',
                'birth_date',
                'postal_code',
                'city',
                'state',
                'occupation',
                'monthly_income',
            ]);
        });
    }
};
