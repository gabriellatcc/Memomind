<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CadastroController extends Controller
{
    /**
     * Exibe o formulário de cadastro.
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('cadastro');
    }

    /**
     * Processa e armazena o novo usuário.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        // 1 -> valida os dados de entrada
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|min:3|max:20|unique:users', //
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.unique' => 'O nome de usuário já está em uso.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
        ]);

        // 2 -> criação o usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dataCadastro' => now(),
        ]);

        // 3 -> loga automático após o registro
        Auth::login($user);

        // 4 -> redireciona para o dashboard com mensagem de sucesso
        return redirect()->route('dashboard')->with('success', 'Cadastro realizado com sucesso! Bem-vindo(a)!');
    }
}
