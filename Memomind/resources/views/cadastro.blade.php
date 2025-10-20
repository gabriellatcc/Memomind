<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Cadastro</title>

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

        <form class="login-form" action="cadastro.php" method="POST">

            <div class="form-esquerda">
                <div class="input-group">
                    <i class="icon mail-icon"></i>
                    <input type="text" placeholder="nome@email.com" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <i class="icon user-icon"></i>
                    <input type="text" placeholder="um nome de usuário de 3 à 20 caracteres" id="username" name="username" required>
                </div>

                <div class="input-group">
                    <i class="icon lock-icon"></i>
                    <input type="password" placeholder="senha com dígitos e números" id="password" name="password" required>
                </div>

                <div class="input-group">
                    <input type="password" placeholder="confirme sua senha" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <div class="form-direita"> <button type="submit" class="botao-jogar">Jogar</button>
                <a href="index.php" class="botao-cadastrar">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>