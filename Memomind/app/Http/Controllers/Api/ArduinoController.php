<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partida;
use Illuminate\Support\Facades\Log;

class ArduinoController extends Controller
{
    public function salvarPartida(Request $request)
    {
        $request->validate([
            'rodadas' => 'required|integer',
            'vitoria_maxima' => 'required|boolean'
        ]);

        try {
            $partida = Partida::create([
                'app_id' => $request->input('app_id', 'Memomind'),
                'rodadas' => $request->input('rodadas'),
                'max_rounds' => $request->input('max_rounds', 100),
                'vitoria_maxima' => $request->input('vitoria_maxima'),
                'status' => $request->input('vitoria_maxima') ? 'Vitoria' : 'Derrota'
            ]);

            Log::info("Partida salva: ID " . $partida->id);

            return response()->json(['success' => true, 'id' => $partida->id], 201);

        } catch (\Exception $e) {
            Log::error("Erro ao salvar partida: " . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}