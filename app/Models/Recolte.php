<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recolte extends Model
{
    protected $table = 'recoltes';
    protected $fillable = ['nom', 'date_recolte', 'quantite', 'unite', 'contremaitre_id'];

    protected function casts(): array
    {
        return ['date_recolte' => 'date'];
    }

    public function contremaitre()
    {
        return $this->belongsTo(Contremaitre::class);
    }
}
