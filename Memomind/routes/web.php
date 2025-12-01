<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfTokens;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Api\ArduinoController;

Route::redirect('/', '/login'); //o programa é iniciado pelo login partido daqui

Route::get('/../../index', function () {
    return view('login');
});

//chama rota para tela de login (View)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
//rota processamento login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

Route::get('/cadastro', [CadastroController::class, 'showRegistrationForm'])->name('cadastro.form');
Route::post('/cadastro', [CadastroController::class, 'register'])->name('cadastro.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// rota de teste
Route::get('/teste', function () {
    return 'A rota de teste funcionou!';
});


// ROTAS PROTEGIDAS (Exigem Login)
Route::middleware(['auth'])->group(function () {
        Route::get('/main', function () {
        return view('main');
    })->name('main');

    Route::get('/documentacao', function () {
        return view('documentacao');
    })->name('doc');

    Route::get('/configuracoes', [SettingsController::class, 'index'])->name('settings');
    
    Route::post('/configuracoes', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

    Route::post('/deploy-arduino', [MainController::class, 'deployArduino'])->name('deploy.arduino');
    Route::post('/parar-arduino', [MainController::class, 'pararArduino'])->name('parar.arduino');

});

// ROTAS API
Route::post('/api/arduino/salvar', [ArduinoController::class, 'salvarPartida'])
    ->withoutMiddleware([
        VerifyCsrfToken::class
    ]);