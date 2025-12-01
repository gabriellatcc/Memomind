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
use App\Http\Controllers\PasswordController;

Route::redirect('/', '/login');

Route::get('/../../index', function () {
    return view('login');
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
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});

// ROTAS API
Route::post('/api/arduino/salvar', [ArduinoController::class, 'salvarPartida'])
    ->withoutMiddleware([
        VerifyCsrfToken::class
    ]);

Route::middleware(['guest'])->group(function () {
    
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

    // Cadastro
    Route::get('/cadastro', [CadastroController::class, 'showRegistrationForm'])->name('cadastro.form');
    Route::post('/cadastro', [CadastroController::class, 'register'])->name('cadastro.submit');

    // Redefinição de Senha (Fluxo Customizado)
    Route::get('/forgot-password', function () {
        return view('auth.reset_password_modal'); 
    })->name('forgot-password');

    Route::post('/forgot-password-custom', [PasswordController::class, 'sendTemporaryPassword'])
        ->name('password.temporary');

});