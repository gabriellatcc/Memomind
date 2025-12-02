<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMOMIND - Configurações do Sistema</title>
        
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/configuracoes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <style>
        .alert-info {
            background-color: #17a2b8;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .alert-danger {
            background-color: #dc3545;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-success {
             background-color: #28a745;
             color: white;
             padding: 15px;
             border-radius: 8px;
             margin-bottom: 20px;
             display: flex;
             align-items: center;
        }
        .alert-info i, .alert-success i { margin-right: 10px; }
        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body class="antialiased">
    
    @include('_sidebar_menu')

    <div class="bg-tech-grid"></div>
    <div class="ambient-light"></div>

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

    <div class="settings-container">
        
        <div class="settings-header">
            <div class="icon-box"><i class="fa-solid fa-user-gear"></i></div>
            <h2>Perfil & Segurança</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-check-circle"></i> <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                <i class="fa-solid fa-circle-info"></i> <span>{{ session('info') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i> 
                <span>Houve um erro na <br>atualização dos dados:</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="user-id-badge">
            <i class="fa-solid fa-fingerprint"></i>
            <span>UID: {{ optional($user)->id ?? 'USER-001' }}</span>
        </div>

        <form id="settings-form" class="settings-form" action="{{ route('settings.update') }}" method="POST">
            @csrf
            
            <div class="form-section">
                <h4 class="section-title">Dados de Acesso</h4>
                
                <div class="form-group">
                    <label for="username"><i class="fa-solid fa-user-tag"></i> Nome de Usuário</label>
                    <input type="text" id="username" name="username" 
                               placeholder="Ex: Dr. Silva" 
                               value="{{ old('username', optional($user)->name) }}" 
                               autocomplete="username"
                               required>
                    @error('username')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email"><i class="fa-solid fa-envelope"></i> Email (Registrado)</label>
                    <input type="email" id="email" name="email" 
                               value="{{ optional($user)->email ?? 'usuario@exemplo.com' }}" 
                               disabled>
                    <span class="input-note"><i class="fa-solid fa-lock"></i> Este campo não pode ser alterado.</span>
                </div>
            </div>

            <hr class="tech-divider">
            
            <div class="form-section">
                <h4 class="section-title text-warning">Credenciais de Segurança</h4>
                <p class="section-desc">Preencha apenas se desejar redefinir sua chave de acesso.</p>

                <div class="form-group">
                    <label for="password"><i class="fa-solid fa-key"></i> Nova Senha</label>
                    <input type="password" id="password" name="password" 
                               placeholder="••••••••" 
                               autocomplete="new-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation"><i class="fa-solid fa-shield-halved"></i> Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                               placeholder="••••••••" 
                               autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="save-button" id="save-button">
                <span class="btn-content">
                    <i class="fas fa-save"></i> Atualizar Sistema
                </span>
                <div class="btn-glitch"></div>
            </button>
        </form>
    </div>
</body>
</html>