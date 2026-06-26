<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financing_applications', function (Blueprint $table) {
            $table->string('protocol', 16)->nullable()->unique()->after('access_token');
        });
    }

    public function down(): void
    {
        Schema::table('financing_applications', function (Blueprint $table) {
            $table->dropColumn('protocol');
        });
    }
};
