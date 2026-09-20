<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rapport extends Model
{
    protected $fillable = [
        'date_generation',
        'type',
        'administrateur_id',
        'commentaire',
    ];

    protected $casts = [
        'date_generation' => 'datetime',
    ];

    public function administrateur(): BelongsTo
    {
        return $this->belongsTo(Administrateur::class);
    }
}
