<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Cadastro</title>

    <link rel="icon" href="{{ asset('images/logoMemomind.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
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

        <form class="login-form" action="{{ route('cadastro.submit') }}" method="POST">
            @csrf
            <div class="form-esquerda">
                <div class="input-group">
                    <i class="icon mail-icon"></i>
                    <input type="text" placeholder="nome@email.com" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <i class="icon user-icon"></i>
                    <input type="text" placeholder="um nome de usuário de 3 à 20 caracteres" id="username" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="input-group">
                    <i class="icon lock-icon"></i>
                    <input type="password" placeholder="senha de mín. 8 caracteres (dígitos e números)" id="password" name="password" required>
                </div>

                <div class="input-group">
                    <input type="password" placeholder="confirme sua senha" id="confirm_password" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-direita">
                <button type="submit" class="botao-jogar">Jogar</button>
                <a href="{{ route('login.form') }}" class="botao-cadastrar">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>