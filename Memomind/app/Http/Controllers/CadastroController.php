<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    /**
     * Mostra o formulário de cadastro (GET request).
     */
    public function showRegistrationForm()
    {
        return view('cadastro');
    }
}
