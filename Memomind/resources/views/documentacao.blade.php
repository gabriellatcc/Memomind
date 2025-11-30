<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Documentação Técnica</title>
      
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/documentacao.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body class="antialiased">
    
    <div class="bg-tech-grid"></div>
    <div class="ambient-light"></div>

     @include('_sidebar_menu')

    <header class="main-header">
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
        <div class="system-status">HARDWARE DOCS v1.0</div>
    </header>

    <div class="documentation-container tech-card">
        <div class="doc-header">
            <div class="icon-box"><i class="fa-solid fa-microchip"></i></div>
            <h2>Arquitetura de Hardware</h2>
        </div>

        <p class="intro-text">
            Bem-vindo à engenharia do <strong>Memomind</strong>. Abaixo detalhamos o mapeamento de pinos (Pinout) e conexões lógicas que conectam o cérebro (Arduino) aos atuadores e sensores do sistema.
        </p>

        <div class="component-list">
            <h3>Lista de Componentes </h3>
            <ul>
                <li><span>Arduino Uno R3</span> (Controlador)</li>
                <li><span>4x Botões Push-Button</span> (Input Tátil)</li>
                <li><span>4x LEDs</span> (Vermelho, Verde, Azul, Amarelo)</li>
                <li><span>Display LCD 16x2</span> (Interface Visual)</li>
                <li><span>Potenciômetro 10kΩ</span> (Ajuste de Contraste)</li>
                <li><span>Resistores</span> (330Ω para LEDs, 1kΩ para Pull-down)</li>
            </ul>
        </div>

        <hr class="tech-divider">

        <h3>Mapeamento de Portas</h3>
        
        <h4 class="table-title">01. Interface Display LCD 16x2</h4>
        <div class="table-wrapper">
            <table class="pinagem-table">
                <thead>
                    <tr>
                        <th>Pino LCD</th>
                        <th>Função</th>
                        <th>Arduino GPIO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>GND</td><td>Terra</td><td>GND</td></tr>
                    <tr><td>VCC</td><td>Energia (5V)</td><td>5V</td></tr>
                    <tr><td>VO</td><td>Contraste</td><td>Potenciômetro (Centro)</td></tr>
                    <tr><td>RS</td><td>Register Select</td><td><span class="highlight-blue">Pino 12</span></td></tr>
                    <tr><td>RW</td><td>Read/Write</td><td>GND</td></tr>
                    <tr><td>E</td><td>Enable</td><td><span class="highlight-blue">Pino 11</span></td></tr>
                    <tr><td>D4</td><td>Data 4</td><td><span class="highlight-blue">Pino 10</span></td></tr>
                    <tr><td>D5</td><td>Data 5</td><td><span class="highlight-blue">Pino 13</span></td></tr>
                    <tr><td>D6</td><td>Data 6</td><td><span class="highlight-blue">A4</span></td></tr>
                    <tr><td>D7</td><td>Data 7</td><td><span class="highlight-blue">A5</span></td></tr>
                </tbody>
            </table>
        </div>

        <div class="tables-grid">
            <div class="table-column">
                <h4 class="table-title">02. Atuadores (LEDs)</h4>
                <div class="table-wrapper">
                    <table class="pinagem-table">
                        <thead>
                            <tr>
                                <th>Cor</th>
                                <th>Arduino GPIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td style="color: var(--neon-red)">Vermelho</td><td>Pino 2</td></tr>
                            <tr><td style="color: var(--neon-green)">Verde</td><td>Pino 4</td></tr>
                            <tr><td style="color: var(--neon-blue)">Azul</td><td>Pino 6</td></tr>
                            <tr><td style="color: var(--neon-yellow)">Amarelo</td><td>Pino 8</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="note-text"><i class="fa-solid fa-circle-info"></i> Catodo (C) de cada LED se conecta a um resistor de 330 Ω, que por sua vez se conecta à barramento negativo da placa de ensaio (ligada ao GND do Arduino).</p>
            </div>

            <div class="table-column">
                <h4 class="table-title">03. Sensores (Botões)</h4>
                <div class="table-wrapper">
                    <table class="pinagem-table">
                        <thead>
                            <tr>
                                <th>Botão</th>
                                <th>Arduino GPIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td style="color: var(--neon-red)">Vermelho</td><td>Pino 3</td></tr>
                            <tr><td style="color: var(--neon-green)">Verde</td><td>Pino 5</td></tr>
                            <tr><td style="color: var(--neon-blue)">Azul</td><td>Pino 7</td></tr>
                            <tr><td style="color: var(--neon-yellow)">Amarelo</td><td>Pino 9</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="note-text"><i class="fa-solid fa-circle-info"></i> Todos os terminais 2B dos botões se conectam à barramento positivo da placa de ensaio (ligada ao GND do Arduino). O terminal 1B se conecta ao resistor de 1kΩ, que está ligado à barramento negativo da placa de ensaio (ligada ao GND do Arduino).</p>
            </div>
        </div>

        <div class="action-area">
            <p>Visualize a simulação completa e interativa do circuito:</p>
            <a href="https://www.tinkercad.com/things/hgeWVzPvez8-memomind" target="_blank" class="tinkercad-button">
                <i class="fa-solid fa-cube"></i> Abrir no Tinkercad
                <div class="btn-glow"></div>
            </a>
        </div>
    </div>
    
</body>
</html>