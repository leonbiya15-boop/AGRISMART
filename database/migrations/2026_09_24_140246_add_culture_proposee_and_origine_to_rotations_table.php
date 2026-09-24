<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rotations', function (Blueprint $table) {
            $table->string('culture_proposee')->after('status');
            $table->enum('origine', ['ia', 'manuelle'])->after('culture_proposee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rotations', function (Blueprint $table) {
            $table->dropColumn(['culture_proposee', 'origine']);
        });
    }
};