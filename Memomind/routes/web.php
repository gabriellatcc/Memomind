<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;

Route::redirect('/', '/login'); //o programa é iniciado pelo login partido daqui

Route::get('/../../index', function () {
    return view('login');
});

//chama rota para tela de login (View)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');


Route::get('/cadastro', [CadastroController::class, 'showRegistrationForm'])->name('cadastro.form');
Route::post('/cadastro', [CadastroController::class, 'register'])->name('cadastro.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//rota teste menu
// exige que o usuário esteja autenticado
Route::get('/dashboard', function () {
    return view('teste');
})->middleware('auth')->name('dashboard');


// rota de teste
Route::get('/teste', function () {
    return 'A rota de teste funcionou!';
});
