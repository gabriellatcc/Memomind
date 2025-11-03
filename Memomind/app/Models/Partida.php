<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    public function partidas()
    {
        return $this->belongsToMany(Partida::class, 'Joga', 'fk_User_id', 'fk_Partida_codPartida')
            ->withPivot('pontuacaoObtida');
    }
}
