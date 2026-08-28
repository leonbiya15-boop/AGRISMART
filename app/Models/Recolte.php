<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recolte extends Model
{
    protected $table = 'recoltes';
    protected $fillable = ['date_recolte', 'quantite', 'unite', 'contremaitre_id'];

    public function contremaitre()
    {
        return $this->belongsTo(Contremaitre::class);
    }
}
