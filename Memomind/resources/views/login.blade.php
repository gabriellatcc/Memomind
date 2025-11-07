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

        <form class="login-form" method="POST" action="">
            @csrf

            <div class="form-esquerda"> <!--css desse é form-esquerda -->
                <div class="input-group"> <!--css desse é input-group -->
                    <i class="icon user-icon"></i> <!--css desse é o caminho user-icon -->
                    <input type="username" placeholder="Nome de usuário" id="username" name="username" required><!--css desse é o input[type="username"] -->
                </div>

                <div class="password-wrapper"> <!--css desse é password-wrapper -->
                    <div class="input-group"> <!--css desse é input-group -->
                        <i class="icon lock-icon"></i> <!--css desse é o caminho lock-icon -->
                        <input type="password" placeholder="Senha" id="password" name="password" required> <!--css desse é o input[type="password"] -->
                    </div>
                    <a href="#" class="forgot-password"> <!--css desse é forgot-password -->
                        Esqueceu a senha? <span>Clique aqui</span> <!--css desse é o input[type="password"] -->
                    </a>
                </div>
            </div>
            <div class="form-direita">
                <button type="submit" class="botao-jogar">Jogar</button> <!--css desse é botao - jogar -->
                <a href="{{ route('cadastro.form') }}" class="botao-cadastrar">Cadastrar</a> <!--css desse é botao - cadastrar -->
            </div>
        </form>
    </div>
</body>

</html>