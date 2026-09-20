<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rotations', function (Blueprint $table) {
            $table->string('culture_proposee')->nullable();
            $table->string('origine')->default('manuelle'); // 'ia' ou 'manuelle'
        });
    }

    public function down(): void
    {
        Schema::table('rotations', function (Blueprint $table) {
            $table->dropColumn(['culture_proposee', 'origine']);
        });
    }
};