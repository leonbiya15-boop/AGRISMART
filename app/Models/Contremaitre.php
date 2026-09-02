<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contremaitre extends Model
{
    protected $table = 'contremaitres';
    protected $fillable = ['id','telephone'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class);
    }

    public function recoltes()
    {
        return $this->hasMany(Recolte::class);
    }
}
