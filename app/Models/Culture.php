<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $table = 'cultures';
    protected $fillable = ['nom', 'famille', 'parcelle_id'];

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}
