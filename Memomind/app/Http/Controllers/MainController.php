<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process; 
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    /**
     * Executa o shell script de deploy da Arduino.
     *
     * @return \Illuminate\Http\Response
     */
    public function deployArduino(Request $request)
    {
        $arduinoCliHome = storage_path('app/arduino-cli-home');
        if (!is_dir($arduinoCliHome)) {
            mkdir($arduinoCliHome, 0755, true);
        }
        
        $scriptPath = base_path('scripts/deploy_arduino.sh'); 
        
        $process = new Process([$scriptPath]);
        $process->setTimeout(300);

        $process->setEnv([
            'HOME' => $arduinoCliHome,
        ]);
        
        try {
            $process->mustRun(); 

            $output = $process->getOutput();

            return redirect()->back()->with('status', nl2br(e($output)));

        } catch (ProcessFailedException $exception) {
            $detailedError = $process->getErrorOutput();
            $standardOutput = $process->getOutput(); 

            Log::error("Arduino Deploy Failed (ProcessFailedException):", [
                'exit_code' => $exception->getProcess()->getExitCode(),
                'error_output' => $detailedError,
                'standard_output' => $standardOutput,
            ]);

            $errorMessage = "Ocorreu uma falha durante a compilação ou upload. Status do Processo: " . $exception->getProcess()->getExitCode() . 
                            "<br>Output de Erro (relevante):<br>" . nl2br(e($detailedError ?: $standardOutput));
            
            return redirect()->back()->with('error', $errorMessage);

        } catch (\Exception $e) {
             Log::error("Arduino Deploy General Error:", ['exception' => $e->getMessage()]);
             return redirect()->back()->with('error', 'Erro interno ao tentar executar o deploy: ' . $e->getMessage());
        }
    }
     /**
     * Executa o shell script de parar o Arduino.
     *
     * @return \Illuminate\Http\Response
     */
    public function pararArduino(Request $request)
    {
        $arduinoCliHome = storage_path('app/arduino-cli-home');
        if (!is_dir($arduinoCliHome)) {
            mkdir($arduinoCliHome, 0755, true);
        }
        
        $scriptPath = base_path('scripts/parar_arduino.sh'); 
        
        $process = new Process([$scriptPath]);
        $process->setTimeout(300);

        $process->setEnv([
            'HOME' => $arduinoCliHome,
        ]);
        
        try {
            $process->mustRun(); 

            $output = $process->getOutput();

            return redirect()->back()->with('status', 'Arduino parou com sucesso.');

        } catch (ProcessFailedException $exception) {
            $detailedError = $process->getErrorOutput();
            $standardOutput = $process->getOutput(); 

            Log::error("Arduino Deploy Failed (ProcessFailedException):", [
                'exit_code' => $exception->getProcess()->getExitCode(),
                'error_output' => $detailedError,
                'standard_output' => $standardOutput,
            ]);

            $errorMessage = "Ocorreu uma falha durante a compilação ou upload. Status do Processo: " . $exception->getProcess()->getExitCode() . 
                            "<br>Output de Erro (relevante):<br>" . nl2br(e($detailedError ?: $standardOutput));
            
            return redirect()->back()->with('error', $errorMessage);

        } catch (\Exception $e) {
             Log::error("Arduino Parar General Error:", ['exception' => $e->getMessage()]);
             return redirect()->back()->with('error', 'Erro interno ao tentar executar a parada: ' . $e->getMessage());
        }
    }
}