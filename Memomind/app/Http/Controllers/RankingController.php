<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use Illuminate\Support\Facades\DB; 

class RankingController extends Controller
{
    public function index()
    {
        $bestScoresSubquery = Partida::select('user_id', DB::raw('MAX(rodadas) as max_rodadas'))
                                     ->groupBy('user_id');

        $rankings = Partida::select('partidas.*')
            ->joinSub($bestScoresSubquery, 'best_scores', function ($join) {
                $join->on('partidas.user_id', '=', 'best_scores.user_id')
                     ->where('partidas.rodadas', '=', DB::raw('best_scores.max_rodadas'));
            })
            ->with('user')
            ->get() 
            ->unique('user_id') 
            ->sortByDesc('rodadas')
            ->values() 
            ->take(10);
            
        return view('ranking', compact('rankings'));
    }
}