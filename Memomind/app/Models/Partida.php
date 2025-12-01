<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'rodadas',
        'max_rounds',
        'vitoria_maxima',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}