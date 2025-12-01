<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Memomind</title>
    
    <!-- Inclua o CSS do Menu aqui -->
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}">
</head>
<body>

    <!-- Menu Lateral Padronizado (Com botão X e lógica de abrir) -->
    @include('_sidebar_menu')

    <div class="bg-tech-grid"></div>
    <div class="ambient-light"></div>

    <main class="main-content">
          
       <header class="main-header header-colored-letters">
            <div class="header-row">
                <span class="letra letra-m1">M</span>
                <span class="letra letra-e">E</span>
                <span class="letra letra-m2">M</span>
                <span class="letra letra-o">O</span>
                <span class="letra letra-m3">M</span>
                <span class="letra letra-i">I</span>
                <span class="letra letra-n">N</span>
                <span class="letra letra-d">D</span>
            </div>
        </header>

        <div class="ranking-container">
            <h2 class="ranking-title">Ranking</h2>

            <div class="ranking-labels">
                <div class="label-pos">Posição</div>
                <div class="label-user">Usuário</div>
                <div class="label-score">Recorde</div>
            </div>

            <div class="ranking-list">
                @if($rankings->isEmpty())
                    <div style="text-align: center; padding: 40px; color: #ccc; font-size: 1.2rem;">
                        <i class="fa-regular fa-folder-open" style="font-size: 3rem; margin-bottom: 20px; display: block;"></i>
                        Ainda não há registros.<br>Jogue para aparecer aqui!
                    </div>
                @else
                    @foreach($rankings as $index => $partida)
                        @php
                            $posicao = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                            
                            $colors = ['red', 'blue', 'yellow', 'green'];
                            $variant = 'variant-' . $colors[$index % 4];

                            $icon = '';
                            if($index == 0) $icon = '<i class="fa-solid fa-crown" style="font-size:0.8em; margin-left:8px; color:#FFD700;"></i>';
                        @endphp

                        <div class="ranking-item {{ $variant }}">
                            <div class="position">{{ $posicao }}</div>
                            
                            <div class="player-pill">
                                {{ $partida->user ? $partida->user->name : ($partida->app_id ?? 'Visitante') }}
                                {!! $icon !!}
                                @if($partida->vitoria_maxima) 
                                    <span style="font-size: 0.8em; opacity: 0.8;">(MAX)</span> 
                                @endif
                            </div>
                            
                            <div class="score-pill">
                                {{ str_pad($partida->rodadas, 3, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </main>

</body>
</html>