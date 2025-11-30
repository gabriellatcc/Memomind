<?php

// AGUARDA use App\Http\Controllers\Memomind;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\SettingsController;

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

    //  TESTE Route::get('/memomind-data', [Memomind::class, 'showGameDataDashboard'])->middleware('auth') ->name('memomind.gamedata');

    // TESTE Route::get('/dashboard', [Memomind::class, 'index'])->name('dashboard');

    // TESTE Route::get('/memomind-data', [Memomind::class, 'showGameDataDashboard'])->middleware('auth') ->name('memomind.gamedata');


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

    Route::post('/deploy-arduino', [TesteController::class, 'deployArduino'])->name('deploy.arduino');
});