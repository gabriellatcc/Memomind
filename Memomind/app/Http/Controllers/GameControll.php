<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GameControlController extends Controller
{
    public function iniciarArduino()
    {
        $scriptPath = base_path('start_game.sh');

        $process = new Process(['bash', $scriptPath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return redirect()->back()->with('status', 'Conexão com Arduino iniciada!');
    }
}