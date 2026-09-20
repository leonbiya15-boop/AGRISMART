<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    protected $table = 'administrateurs';

    protected $fillable = [
        'id',
        'niveau_acces'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'administrateur_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'administrateur_id');
    }
}