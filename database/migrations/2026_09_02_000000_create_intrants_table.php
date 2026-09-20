<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('intrants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('categorie');
            $table->decimal('quantite_stock', 12, 2)->default(0);
            $table->string('unite', 20);
            $table->decimal('seuil_alerte', 12, 2)->default(0);
            $table->decimal('prix_unitaire', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('intrants'); }
};
