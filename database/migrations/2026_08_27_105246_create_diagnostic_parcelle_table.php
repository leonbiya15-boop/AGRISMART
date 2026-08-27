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
        Schema::create('diagnostic_parcelle', function (Blueprint $table) {
            $table->foreignId('diagnostic_id')->constrained('diagnostics')->onDelete('cascade');
            $table->foreignId('parcelle_id')->constrained('parcelles')->onDelete('cascade');
            $table->primary(['diagnostic_id', 'parcelle_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_parcelle');
    }
};
