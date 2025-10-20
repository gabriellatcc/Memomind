<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Método que será chamado ao clicar em "Jogar"
    public function authenticate(Request $request)
    {
        // lógica de autenticação: validar os dados de $request->username e $request->password, Tentar logar o usuário, Redirecionar para a área logada ou mostrar um erro

        //como nao tem logica redireciona para menu que também nao tem
        return view('menu.blade.php');
    }
}
