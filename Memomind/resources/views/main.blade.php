<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memomind - Início</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <style>
        /* Estilos dos Alertas */
    .alert-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            width: auto;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .alert-message {
            pointer-events: auto;
            background: rgba(9, 9, 11, 0.95);
            backdrop-filter: blur(12px);
            padding: 12px 20px;
            border-radius: 4px;
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            color: var(--text-primary);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.8);
            
            animation: slideLeftFade 0.5s ease-out forwards;
            display: flex;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.05);
        }

        /* --- Sucesso (Verde Neon) --- */
        .alert-success {
            border-left: 4px solid var(--neon-green);
            background: linear-gradient(90deg, rgba(46, 211, 13, 0.1) 0%, rgba(9,9,11,0.95) 100%);
        }
        .alert-success::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: var(--neon-green);
            font-size: 1.2rem;
            margin-right: 15px;
        }

        /* --- Erro (Vermelho Neon) --- */
        .alert-danger {
            border-left: 4px solid var(--neon-red);
            background: linear-gradient(90deg, rgba(214, 15, 15, 0.1) 0%, rgba(9,9,11,0.95) 100%);
        }
        .alert-danger::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: var(--neon-red);
            font-size: 1.2rem;
            margin-right: 15px;
        }

        @keyframes slideLeftFade {
            0% { opacity: 0; transform: translateX(50px); }
            100% { opacity: 1; transform: translateX(0); }
        }


    </style>

</head>
<body class="antialiased">
    @include('_sidebar_menu')

    <div class="bg-tech-grid"></div>
    <div class="ambient-light"></div>

    <nav class="navbar fixed w-full z-50 top-0 left-0">

        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-end items-center gap-4">

            <div class="hidden md:flex items-center">
                <form method="POST" action="{{ route('parar.arduino') }}">
                    @csrf
                    <button type="submit" class="game-btn btn-stop">
                        Parar
                    </button>
                </form>
            </div>

            <div class="hidden md:flex items-center">
                <form method="POST" action="{{ route('deploy.arduino') }}">
                    @csrf
                    <button type="submit" class="game-btn btn-play">
                        <span style="font-size: 1.2em; margin-right: 5px;"></span> Jogar
                    </button>
                </form>
            </div>

        </div>
    </nav>
    <div class="alert-container">
        @if (session('status'))
            <div class="alert-message alert-success">
                <span>{!! session('status') !!}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-message alert-danger">
                <span>{!! session('error') !!}</span>
            </div>
        @endif
    </div>

    <header id="inicio" class="relative pt-40 pb-24 flex flex-col items-center justify-center min-h-[90vh] text-center px-4">
        
        <div class="mb-12 relative group">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-xl blur-xl opacity-0 group-hover:opacity-100 transition duration-1000"></div>
           
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
        </div>

        <div class="max-w-4xl mx-auto space-y-6 z-10">
            <div class="inline-block px-3 py-1 border border-blue-500/30 rounded bg-blue-500/10 text-blue-400 text-xs font-tech tracking-widest mb-4">
                PROJETO DE EXTENSÃO
            </div>
            <p class="text-lg text-gray-400 leading-relaxed max-w-2xl mx-auto font-light">
                Sistema híbrido de intervenção terapêutica para TEA. Transformamos estímulos físicos em métricas clínicas precisas através de hardware acessível.
            </p>
            
            <div class="pt-10 flex flex-col sm:flex-row gap-5 justify-center">
                <a href="#missao" class="group px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-tech font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-3 rounded-sm shadow-[0_0_20px_rgba(37,99,235,0.3)]">
                    Explorar
                </a>
                <a href="https://github.com/gabriellatcc/Memomind" target="_blank" class="px-8 py-3 border border-gray-700 hover:border-gray-500 text-gray-300 hover:text-white text-sm font-tech font-bold uppercase tracking-widest transition-all bg-white/5 rounded-sm flex items-center justify-center gap-3">
                    <i class="fa-brands fa-github"></i> Repositório  <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </header>

    <section id="missao" class="py-24 px-6 border-t border-white/5 bg-[#0c0c0e]">
        <div class="container mx-auto max-w-6xl">
            <div class="section-header">
                <h3 class="text-2xl md:text-3xl text-white font-bold"><span class="text-blue-500 mr-2">01.</span> Missão & Contexto</h3>
                <div class="section-line"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div class="tech-card p-10 border-tech-blue">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-xl text-white font-bold">Parceria Clínica</h4>
                        <i class="fa-solid fa-handshake text-blue-500/50 text-2xl"></i>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed font-light">
                        Desenvolvido em colaboração direta com a <span class="text-white font-medium">Clínica Lira</span>, o MEMOMIND não é apenas um jogo, é um instrumento de medição.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="p-3 bg-white/5 border border-white/5 rounded">
                            <span class="block text-2xl text-blue-400 font-tech font-bold">TEA</span>
                            <span class="text-xs text-gray-500 uppercase">Foco da Intervenção</span>
                        </div>
                        <div class="p-3 bg-white/5 border border-white/5 rounded">
                            <span class="block text-2xl text-green-400 font-tech font-bold">IoT</span>
                            <span class="text-xs text-gray-500 uppercase">Tecnologia Base</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h4 class="text-2xl text-white mb-6">Estrutura do Sistema</h4>
                    <p class="text-gray-400 mb-8 font-light">O ecossistema utiliza uma arquitetura de Gateway Serial, conectando o hardware físico diretamente à nuvem via Node.js para transmissão instantânea de resultados.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 border border-gray-800 bg-[#09090b] rounded hover:border-gray-700 transition">
                            <div class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded text-green-500">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <div>
                                <strong class="text-white block font-tech tracking-wide">Hardware (Arduino)</strong>
                                <span class="text-sm text-gray-500">Interface física tátil para estímulo motor e cognitivo.</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 border border-gray-800 bg-[#09090b] rounded hover:border-gray-700 transition">
                            <div class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded text-purple-500">
                                <i class="fa-solid fa-database"></i>
                            </div>
                            <div>
                                <strong class="text-white block font-tech tracking-wide">Interface Web</strong>
                                <span class="text-sm text-gray-500">Dashboard analítico para terapeutas.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="design" class="py-24 px-6 relative">
        <div class="absolute left-0 top-1/2 w-full h-px bg-gradient-to-r from-transparent via-blue-900/30 to-transparent"></div>

        <div class="container mx-auto max-w-6xl relative z-10">
            <div class="section-header">
                <h3 class="text-2xl md:text-3xl text-white font-bold"><span class="text-blue-500 mr-2">02.</span> Diretrizes de UX</h3>
                <div class="section-line"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="tech-card p-8 border-tech-red group">
                    <div class="text-red-500/80 mb-6 text-2xl group-hover:text-red-400 transition">
                        <i class="fa-solid fa-ear-listen"></i> <span class="text-xs align-middle ml-2 border border-red-500/30 px-2 py-0.5 rounded text-red-500/50">MUTE</span>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-3">Redução Sensorial</h4>
                    <p class="text-gray-400 text-sm font-light leading-relaxed">
                        Eliminação proposital de feedback sonoro para prevenir sobrecarga sensorial em pacientes hipersensíveis, focando na atenção visual.
                    </p>
                </div>

                <div class="tech-card p-8 border-tech-yellow group">
                    <div class="text-yellow-500/80 mb-6 text-2xl group-hover:text-yellow-400 transition">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-3">Dificuldade Adaptativa</h4>
                    <p class="text-gray-400 text-sm font-light leading-relaxed">
                        Algoritmo de progressão automática. Remove a carga cognitiva de escolha de nível, mantendo o paciente na zona de desenvolvimento proximal.
                    </p>
                </div>

                <div class="tech-card p-8 border-tech-green group">
                    <div class="text-green-500/80 mb-6 text-2xl group-hover:text-green-400 transition">
                        <i class="fa-solid fa-code-branch"></i>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-3">Arquitetura Aberta</h4>
                    <p class="text-gray-400 text-sm font-light leading-relaxed">
                        Projeto baseado em componentes off-the-shelf (Arduino) visando máxima replicabilidade e baixo custo de implementação (BOM).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="tecnologia" class="py-24 px-6 border-t border-white/5 bg-[#0c0c0e]">
        <div class="container mx-auto max-w-6xl">
            <div class="text-center mb-16">
                <span class="text-blue-500 text-sm font-tech font-bold uppercase tracking-widest">Especificações Técnicas</span>
                <h3 class="text-3xl text-white font-bold mt-2">Full Stack Overview</h3>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <div class="space-y-1">
                        <!-- CARD 1: LARAVEL -->
                        <div class="group relative p-6 bg-[#09090b] border border-gray-800 hover:border-gray-600 transition duration-300">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-600"></div>
                            <h4 class="text-white font-tech text-xl mb-2 flex justify-between">
                                Laravel Framework <span class="text-xs text-gray-500 font-inter font-normal mt-1">v12.26.4</span>
                            </h4>
                            <p class="text-gray-400 text-sm font-light">Backend robusto para gestão de usuários, autenticação segura e API REST.</p>
                        </div>
                        
                        <!-- CARD 2: NODE.JS BRIDGE (Substituindo MQTT) -->
                        <div class="group relative p-6 bg-[#09090b] border border-gray-800 hover:border-gray-600 transition duration-300">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500"></div>
                            <h4 class="text-white font-tech text-xl mb-2 flex justify-between">
                                Node.js Bridge <span class="text-xs text-gray-500 font-inter font-normal mt-1">Serial Port</span>
                            </h4>
                            <p class="text-gray-400 text-sm font-light">Middleware de baixa latência que traduz sinais Serial do Arduino para requisições HTTP.</p>
                        </div>

                        <!-- CARD 3: SHELL AUTOMATION (Substituindo Node-Red) -->
                        <div class="group relative p-6 bg-[#09090b] border border-gray-800 hover:border-gray-600 transition duration-300">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-yellow-500"></div>
                            <h4 class="text-white font-tech text-xl mb-2 flex justify-between">
                                Shell Automation <span class="text-xs text-gray-500 font-inter font-normal mt-1">Bash Scripts</span>
                            </h4>
                            <p class="text-gray-400 text-sm font-light">Orquestração de upload de código (.ino) e gestão de processos em tempo real.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 rounded-lg border border-white/5 p-8 relative overflow-hidden transition-all duration-300 hover:border-blue-500 hover:shadow-[0_0_30px_rgba(59,130,246,0.3)]">
                    <div class="absolute top-0 right-0 p-3 opacity-20">
                        <i class="fa-solid fa-palette text-6xl text-white"></i>
                    </div>
                    
                    <h4 class="text-2xl text-white mb-6 font-bold">UI/UX Design System</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed font-light">
                        A estética foi cuidadosamente calibrada para evocar modernidade sem causar fadiga visual. Utilizamos uma paleta "Dark Mode" nativa com acentos neon controlados.
                    </p>
                    
                    <ul class="space-y-4 text-sm font-tech tracking-wide text-gray-400">
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-blue-500 rounded-full shadow-[0_0_10px_#3b82f6]"></span>
                            Contraste WCAG AA Compliant
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-green-500 rounded-full shadow-[0_0_10px_#22c55e]"></span>
                            Feedback visual instantâneo
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-red-500 rounded-full shadow-[0_0_10px_#ef4444]"></span>
                            Layout Fluido Responsivo
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black border-t border-gray-900 pt-20 pb-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-10 border-b border-gray-900 pb-10 mb-10">
                <div>
                    <h2 class="text-3xl text-white font-tech font-bold mb-2">MEMOMIND</h2>
                    <p class="text-gray-500 text-sm max-w-md">Soluções tecnológicas acessíveis para neurodiversidade.</p>
                </div>
                <div class="flex gap-4">
                    <a href="https://github.com/gabriellatcc/Memomind" target="_blank" class="text-gray-500 hover:text-white transition text-xl"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="text-gray-500 hover:text-white transition text-xl"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 text-sm">
                <div>
                    <h5 class="text-white font-bold mb-4 uppercase text-xs tracking-widest text-blue-500">Equipe de Desenvolvimento</h5>
                    <ul class="grid grid-cols-2 gap-2 text-gray-400 font-tech uppercase">
                        <li>Érico Quintana</li>
                        <li>Gabriella Tavares</li>
                        <li>Maria Auxiliadora</li>
                        <li>Matheus Almeida</li>
                    </ul>
                </div>
                <div class="md:text-right">
                    <h5 class="text-white font-bold mb-4 uppercase text-xs tracking-widest text-blue-500">Orientação Acadêmica</h5>
                    <p class="text-gray-400 mb-1">Prof. Carlos Alberto do Nascimento</p>
                    <p class="text-gray-400">Prof. Carlos Henrique Loureiro Feichas</p>
                </div>
            </div>

            <div class="mt-16 text-center text-xs text-gray-700 font-tech uppercase tracking-widest">
                © 2025 FATEC Cruzeiro - Projeto Acelera. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    </script>
</body>
</html>