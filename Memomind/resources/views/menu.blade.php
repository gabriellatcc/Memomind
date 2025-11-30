<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - MENU</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">


</head>
<body>

    <header>
        <button id="btnAbrirMenu" class="toggle-btn">☰</button>
        <h1 class="logo">
          <span class="m">M</span><span class="e">E</span><span class="o">M</span><span class="o2">O</span> 
          <span class="m2">M</span><span class="i">I</span><span class="n">N</span><span class="d">D</span>
        </h1>
    </header>

    <main>
        <aside class="menu" id="menu">
            
            <a href="{{ route('dashboard') }}" class="btn vermelho">Tela Inicial</a>
            <button class="btn verde">Como Jogar</button>
            
            <a href="{{ route('memomind.gamedata') }}" class="btn amarelo" id="btnRanking">Ranking (Dados)</a>

            <div class="espaco"></div>

            <button class="btn amarelo">Sobre nós</button>
            <button class="btn verde">Configurações</button>
            
            <form method="POST" action="{{ route('logout') }}" style="display: block;">
                @csrf
                <button type="submit" class="btn vermelho" style="width: calc(100% - 30px);">Sair</button>
            </form>
        </aside>

        <section id="conteudo">
            <div class="resultado-card">
                <h1>Último Resultado (Arduino)</h1>
                <p>Dados obtidos em tempo real do Node-RED:</p>
                
                @if ($apiError)
                    <div class="error-message">
                        <strong>API Offline!</strong> Não foi possível conectar ao Node-RED. <br>{{ $apiError }}
                    </div>
                    <p>Pontuação exibida abaixo é 0.</p>
                @else
                    @php
                        $rodadasCompletas = $ultimoResultado['rodadas_completadas'] ?? 0;
                    @endphp

                    <div class="rounds-display">{{ $rodadasCompletas }}</div>
                    
                    <p>
                        @if ($ultimoResultado['vitoria_maxima'] ?? false)
                            <span class="status-win">VITÓRIA MÁXIMA!</span>
                        @elseif ($rodadasCompletas > 0)
                            <span class="status-fail">Partida encerrada.</span>
                        @else
                            Aguardando a conclusão do primeiro jogo.
                        @endif
                    </p>
                @endif
                
                <a href="{{ route('dashboard') }}" style="color: #FFC107; text-decoration: none; font-weight: bold;">[Voltar ao Menu Principal]</a>
                <a href="{{ route('memomind.gamedata') }}" style="color: #FFC107; text-decoration: none; font-weight: bold; margin-left: 20px;">[Atualizar Dados]</a>
            </div>


            <div class="ranking-container">
                <h2>Ranking (Simulado)</h2>
                <hr>

                @foreach ($ranking as $index => $item)
                    @php
                        $posClass = 'pos' . ($index + 1);
                        $posDisplay = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    @endphp

                    <div class="ranking-item {{ $posClass }}">
                        <span>{{ $posDisplay }}</span>
                        <div class="user-box">
                            <span>{{ $item['nome'] }}</span>
                            <span class="pontuacao">{{ str_pad($item['pontuacao'], 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menu = document.getElementById('menu');
            const btnAbrirMenu = document.getElementById('btnAbrirMenu');

            function toggleMenu() {
                menu.classList.toggle('open');
            }

            btnAbrirMenu.addEventListener('click', toggleMenu);

            const menuLinks = menu.querySelectorAll('a, button');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        if (link.getAttribute('type') !== 'submit') {
                            menu.classList.remove('open');
                        }
                    }
                });
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    menu.classList.remove('open');
                }
            });
        });
    </script>
</body>
</html>