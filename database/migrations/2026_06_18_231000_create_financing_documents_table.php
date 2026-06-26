<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financing_applications', function (Blueprint $table) {
            $table->string('access_token', 64)->nullable()->unique()->after('id');
        });

        Schema::create('financing_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_application_id')->index();
            $table->string('category')->default('Outro');
            $table->string('original_name');
            $table->string('path');
            $table->string('mime_type');
            $table->unsignedBigInteger('size');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financing_documents');
        Schema::table('financing_applications', function (Blueprint $table) {
            $table->dropColumn('access_token');
        });
    }
};
