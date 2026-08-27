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
        Schema::create('parcelle_rotation', function (Blueprint $table) {
            $table->foreignId('parcelle_id')->constrained('parcelles')->onDelete('cascade');
            $table->foreignId('rotation_id')->constrained('rotations')->onDelete('cascade');
            $table->primary(['parcelle_id', 'rotation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelle_rotation');
    }
};
