<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;

class RankingController extends Controller
{
    public function index()
    {
        $rankings = Partida::with('user')
                           ->orderBy('rodadas', 'desc')
                           ->orderBy('created_at', 'desc')
                           ->take(10)
                           ->get();

        return view('ranking', compact('rankings'));
    }
}