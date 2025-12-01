<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GameControlController extends Controller
{
    public function iniciarArduino()
    {
        // Caminho para o shell script
        $scriptPath = base_path('start_game.sh');

        // Executa o script
        $process = new Process(['bash', $scriptPath]);
        $process->run();

        // Verifica se deu erro ao tentar rodar o script
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Retorna para a view com mensagem de sucesso
        return redirect()->back()->with('status', 'Conexão com Arduino iniciada!');
    }
}