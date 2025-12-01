<?php

namespace App\Http\Controllers;

use App\Mail\NewPasswordNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    /**
     * Processa a requisição de 'Esqueci Minha Senha' de forma customizada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendTemporaryPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('status', 'Se o e-mail estiver correto, você receberá a nova senha temporária.');
        }

        $newPassword = (string) random_int(10000000, 99999999);
        
        $user->password = Hash::make($newPassword);
        
        $user->setRememberToken(Str::random(60)); 
        
        $user->save();

        try {
            Mail::to($user->email)->send(new NewPasswordNotification($newPassword));

            Log::info("Nova senha temporária enviada para: " . $user->email);

            return back()->with('status', "Sua nova senha temporária foi enviada para **{$user->email}**. Por favor, verifique sua caixa de entrada e, se não encontrar, procure na caixa de Spam.");
            
        } catch (\Exception $e) {
            Log::error("Falha ao enviar e-mail de redefinição para {$user->email}: " . $e->getMessage());
            
            return back()->withErrors(['email' => 'Ocorreu um erro ao tentar enviar o e-mail. Verifique a configuração do seu serviço de e-mail (SMTP) e tente novamente mais tarde.']);
        }
    }
}