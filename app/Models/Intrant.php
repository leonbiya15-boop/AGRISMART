<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intrant extends Model
{
    protected $fillable = ['nom', 'categorie', 'quantite_stock', 'unite', 'seuil_alerte', 'prix_unitaire'];

    protected function casts(): array
    {
        return ['quantite_stock' => 'decimal:2', 'seuil_alerte' => 'decimal:2', 'prix_unitaire' => 'decimal:2'];
    }

    public function getStockFaibleAttribute(): bool
    {
        return $this->quantite_stock <= $this->seuil_alerte;
    }
}
