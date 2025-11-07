<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Em Construção</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">

    <!-- CSS TESTE -->
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
            /* Amarelo de atenção */
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

        .logout-button-area {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .botao-logout {
            background-color: #DC3545;
            /* Vermelho */
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
    <div class="container">
        <span class="construction-icon">🚧</span>

        <h1>EM CONSTRUÇÃO</h1>

        @if (Auth::check())
        <p>
            Olá, <strong>{{ Auth::user()->name }}</strong>! <br>
            O menu principal do MEMOMIND está sendo preparado para você.
            Volte em breve para iniciar novas partidas!
        </p>
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