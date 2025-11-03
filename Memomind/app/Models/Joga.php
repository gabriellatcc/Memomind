<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joga extends Model
{
    use HasFactory;

    protected $primaryKey = 'codPartida';
    public $timestamps = false;

    public function jogadores()
    {
        return $this->belongsToMany(User::class, 'Joga', 'fk_Partida_codPartida', 'fk_User_id')
            ->withPivot('pontuacaoObtida');
    }
}
