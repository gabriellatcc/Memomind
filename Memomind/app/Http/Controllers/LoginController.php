<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login.
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Se o usuário já estiver logado, redireciona para o dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Processa a autenticação do usuário.
     *
     * O nome deste método DEVE CORRESPONDER à rota.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(Request $request)
    {
        // 1 -> valida os dados
        $request->validate([
            'username' => 'required|string', //nome/email
            'password' => 'required|string',
        ]);

        // 2 -> determina o campo de login (email/name)
        // Se o input parecer um e-mail, tentamos autenticar por email. Caso contrário, tentamos por name.
        $loginType = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $loginType => $request->username,
            'password' => $request->password,
        ];

        // 3 -> tenta autenticar
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // sucesso na autenticação
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // 4 -> falha na autenticação
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')], // mensagem de erro de login
        ]);
    }

    /**
     * Processa o logout do usuário.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
