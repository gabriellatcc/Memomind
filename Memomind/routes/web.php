<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;


Route::redirect('/', '/login'); //o programa é iniciado pelo login partido daqui

Route::get('/../../index', function () {
    return view('login');
});

//chama rota para tela de login (View)
Route::get('/login', function () {
    return view('login');
});

Route::get('/teste', function () {
    return 'A rota de teste funcionou!';
});

// rota para processar o formulário de login (quando o botão "Jogar" for clicado)
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

Route::get('/cadastro', [CadastroController::class, 'showRegistrationForm'])->name('cadastro.form');
