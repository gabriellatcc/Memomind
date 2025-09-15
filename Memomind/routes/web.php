<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login'); //o programa é iniciado pelo login partido daqui

Route::get('/login', function () {
    return view('login');
});

Route::get('/teste', function () {
    return 'A rota de teste funcionou!';
});
