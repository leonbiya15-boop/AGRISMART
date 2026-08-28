<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    protected $table = 'parcelles';
    protected $fillable = ['nom', 'superficie', 'latitude', 'longitude', 'contremaitre_id'];

    public function contremaitre()
    {
        return $this->belongsTo(Contremaitre::class);
    }

    public function cultures()
    {
        return $this->hasMany(Culture::class);
    }

    public function rotations()
    {
        return $this->belongsToMany(Rotation::class, 'parcelle_rotation');
    }

    public function diagnostics()
    {
        return $this->belongsToMany(Diagnostic::class, 'diagnostic_parcelle');
    }
}
