<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $table = 'diagnostics';
    protected $fillable = ['maladie_detectee', 'nom_maladie', 'date_analyse', 'niveau_confiance'];

    public function parcelles()
    {
        return $this->belongsToMany(Parcelle::class, 'diagnostic_parcelle');
    }
}
