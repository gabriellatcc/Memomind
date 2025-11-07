// app/Http/Controllers/GameController.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;

class GameController extends Controller
{
public function startGame(Request $request)
{
$user = Auth::user();

// Caminho para o seu script do jogo (ex: um script Node.js)
$gameScriptPath = base_path('scripts/meu-jogo.js');

// Cria um novo processo para executar o script
// passar argumentos o ID do usuário
$process = new Process(['node', $gameScriptPath, $user->id]);
$process->run();

// Verifica se o processo foi executado com sucesso
if (!$process->isSuccessful()) {
// Lida com o erro...
return response()->json(['error' => 'Falha ao executar o jogo'], 500);
}

// Pega a saída do script (que deve ser a pontuação)
$output = $process->getOutput();
$result = json_decode($output, true); // Decodifica se o jogo retornar JSON

// Salva a pontuação no banco de dados (exemplo)
// $score = new Score();
// $score->user_id = $user->id;
// $score->points = $result['pontuacao'];
// $score->save();

return response()->json([
'message' => 'Jogo finalizado!',
'score' => $result['pontuacao'] ?? 0
]);
}
}