<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $table = 'alertes';
    protected $fillable = ['diagnostic_id', 'parcelle_id', 'message', 'statut'];

    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}