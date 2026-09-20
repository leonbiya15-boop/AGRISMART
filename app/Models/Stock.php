<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $fillable = [
        'quantite_totale',
        'date_mise_a_jour',
        'administrateur_id',
        'commentaire',
    ];

    protected $casts = [
        'date_mise_a_jour' => 'datetime',
        'quantite_totale' => 'float',
    ];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'administrateur_id');
    }
}