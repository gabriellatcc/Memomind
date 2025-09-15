<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">

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

        <form class="login-form" method="POST" action=""> @csrf <div class="input-group">
                <i class="icon user-icon"></i>
                <input type="text" placeholder="Nome de usuário" id="username" name="username" required>
            </div>

            <div class="password-wrapper">
                <div class="input-group">
                    <i class="icon lock-icon"></i>
                    <input type="password" placeholder="Senha" id="password" name="password" required>
                </div>
                <a href="#" class="forgot-password">
                    Esqueceu a senha? <span>Clique aqui</span>
                </a>
            </div>

            <button type="submit" class="botao-jogar">Jogar</button>
            <a href="#" class="botao-cadastrar">Cadastre-se</a>
        </form>
    </div>
</body>

</html>