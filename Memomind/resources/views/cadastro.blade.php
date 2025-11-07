<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Cadastro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">

    <!-- Supondo que você tem um arquivo CSS em public/css/login.css -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-container">
        <header class="logo">
            <div class="row">
                <span class="letra">M</span>
                <span class="letra">E</span>
                <span class="letra">M</span>
                <span class="letra">O</span>
            </div>
            <div class="row">
                <span class="letra">M</span>
                <span class="letra">I</span>
                <span class="letra">N</span>
                <span class="letra">D</span>
            </div>
        </header>

        <!-- Exibir erros de validação -->
        @if ($errors->any())
        <div class="alert alert-danger" style="color: red; margin-bottom: 1rem; text-align: left; padding: 10px; border: 1px solid red; border-radius: 5px;">
            <p>Ocorreram erros de validação:</p>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Ação corrigida: aponta para a rota Laravel e inclui @csrf -->
        <form class="login-form" action="{{ route('cadastro.submit') }}" method="POST">
            @csrf
            <div class="form-esquerda">
                <div class="input-group">
                    <i class="icon mail-icon"></i>
                    <input type="text" placeholder="nome@email.com" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <i class="icon user-icon"></i>
                    <!-- name="name" para corresponder ao modelo 'User' -->
                    <input type="text" placeholder="um nome de usuário de 3 à 20 caracteres" id="username" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="input-group">
                    <i class="icon lock-icon"></i>
                    <input type="password" placeholder="senha com dígitos e números" id="password" name="password" required>
                </div>

                <div class="input-group">
                    <!-- name="password_confirmation" é obrigatório para o Laravel fazer a validação 'confirmed' -->
                    <input type="password" placeholder="confirme sua senha" id="confirm_password" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-direita">
                <button type="submit" class="botao-jogar">Jogar</button>
                <!-- Retorna para a tela de Login -->
                <a href="{{ route('login.form') }}" class="botao-cadastrar">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>