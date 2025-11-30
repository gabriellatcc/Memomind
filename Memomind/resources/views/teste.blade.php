<!DOCTYPE html>

<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MEMOMIND - Teste</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Madimi One', sans-serif;
        background-color: #191919;
        color: #191919;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        text-align: center;
    }

    .alert-message {
        position: absolute; 
        top: 20px; 
        left: 50%; 
        transform: translateX(-50%); 
        padding: 10px 20px; 
        border-radius: 5px; 
        border: 1px solid;
        font-family: 'Madimi One', sans-serif;
        z-index: 100;
        max-width: 90%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
        background-color: #d4edda; 
        color: #155724; 
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da; 
        color: #721c24; 
        border-color: #f5c6cb;
    }

    .container {
        background-color: #f2f2f2;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 20px #191919;
        width: 90%;
        max-width: 500px;
    }

    .construction-icon {
        font-size: 5rem;
        color: #FFC107;
        margin-bottom: 20px;
        display: inline-block;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-15px);
        }

        60% {
            transform: translateY(-7px);
        }
    }

    h1 {
        color: #191919;
        margin-bottom: 15px;
        font-size: 2.5rem;
    }

    p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        color: #191919;
    }

    .action-button {
        background-color: #007BFF; 
        color: #f2f2f2;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        font-size: 1.1rem;
        font-family: 'Madimi One', sans-serif;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
        margin-bottom: 10px;
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
    }
    
    .action-button:hover {
        background-color: #0056b3;
        transform: scale(1.02);
    }

    .logout-button-area {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .botao-logout {
        background-color: #DC3545;
        color: #f2f2f2;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        font-size: 1.1rem;
        font-family: 'Madimi One', sans-serif;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
    }

    .botao-logout:hover {
        background-color: #C82333;
        transform: scale(1.05);
    }
</style>


</head>

<body>
@if (session('status'))
<div class="alert-message alert-success">
{!! session('status') !!}
</div>
@endif

@if (session('error'))
    <div class="alert-message alert-danger">
        {!! session('error') !!}
    </div>
@endif

<div class="container">
    <span class="construction-icon">🚧</span>

    <h1>MEMOMIND</h1>

    @if (Auth::check())
        <p>
            Olá, <strong>{{ Auth::user()->name }}</strong>! <br>
            Acesse o dashboard de dados ou realize o deploy do seu Arduino.
        </p>

        <div class="button-area">
            <a href="{{ route('memomind.gamedata') }}" 
               class="action-button" 
               style="background-color: #27AE60;">
                <span style="font-size: 1.2em;">📊</span> Ver Dados do Jogo
            </a>
        </div>
        
        <div class="button-area">
            <form method="POST" action="{{ route('deploy.arduino') }}">
                @csrf
                <button type="submit" class="action-button">
                    <span style="font-size: 1.2em;">🔌</span> Realizar Deploy Arduino
                </button>
            </form>
    @else
        <p>O menu principal do MEMOMIND está sendo preparado.</p>
    @endif

    <div class="logout-button-area">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="botao-logout">Sair (Logout)</button>
        </form>
    </div>
</div>


</body>

</html>