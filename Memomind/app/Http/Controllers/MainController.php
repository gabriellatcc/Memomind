<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function deployArduino()
    {
        $scriptPath = base_path('scripts/deploy_arduino.sh');
        $userId = Auth::id();

        $env = [
            'HOME' => '/home/gabriellacorrea', 
            'PATH' => getenv('PATH'),
            'GAME_USER_ID' => $userId
        ];

        $process = new Process(['bash', $scriptPath], null, $env);
        $process->setTimeout(120);
        $process->run();

        if (!$process->isSuccessful()) {
            return redirect()->back()->with('error', 'Erro ao iniciar: ' . $process->getErrorOutput());
        }

        return redirect()->back()->with('status', 'Jogo Iniciado! Monitoramento ativado.');
    }

    public function pararArduino()
    {
        $scriptPath = base_path('scripts/parar_arduino.sh');

        $env = [
            'HOME' => '/home/gabriellacorrea',
            'PATH' => getenv('PATH')
        ];

        $process = new Process(['bash', $scriptPath], null, $env);
        $process->run();

        if (!$process->isSuccessful()) {
            return redirect()->back()->with('error', 'Erro ao parar: ' . $process->getErrorOutput());
        }

        return redirect()->back()->with('status', 'Jogo Interrompido.');
    }
}