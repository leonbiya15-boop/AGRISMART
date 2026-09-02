<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    protected $table = 'administrateurs';
    protected $fillable = ['id', 'niveau_acces'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
