<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rotation extends Model
{
    protected $table = 'rotations';

    protected $fillable = [
        'date_proposition',
        'status',
        'culture_proposee',
        'origine',
    ];

    protected function casts(): array
    {
        return [
            'date_proposition' => 'date',
        ];
    }

    public function parcelles()
    {
        return $this->belongsToMany(
            Parcelle::class,
            'parcelle_rotation'
        );
    }
}