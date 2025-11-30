<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    /**
     * Exibe a página de configurações.
     */
    public function index()
    {
        $user = Auth::user();
        return view('settings', compact('user'));
    }

    /**
     * Processa a atualização dos dados.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'username.required' => 'O campo nome de usuário é obrigatório.',
            'username.max'      => 'O nome de usuário não pode ter mais que :max caracteres.',
            
            'password.min'       => 'A senha deve ter no mínimo: 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha não confere.',
        ]);

        /** @var \App\Models\User $user */
        $user->name = $request->input('username');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('settings')->with('success', 'Perfil atualizado com sucesso!');
    }
}