<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha - Memomind</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJ8uR2KFA3A8sW1sFpE+xU68h3z3N6N6jS7L4h4E0j/A3iTj2v7+2u3A2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">

    <style>
        /* --- 1. RESET GLOBAL --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* --- Variáveis Globais (Tech Palette) --- */
        :root {
            --bg-dark: #09090b;
            --text-primary: #ededed;
            --text-muted: #94a3b8;
            
            --glass-bg: rgba(255, 255, 255, 0.02);
            --glass-border: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(0, 0, 0, 0.4);
            
            --neon-red: #d60f0f;
            --neon-green: #2ed30d;
            --neon-blue: #3b82f6;
            --neon-yellow: #dabf0e;
        }

        /* --- Reset e Layout --- */
        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            justify-content: center;
        }

        /* --- Background Tech (Grid) --- */
        .bg-tech-grid {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -2;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(circle at center, black 30%, transparent 100%);
            -webkit-mask-image: radial-gradient(circle at center, black 30%, transparent 100%);
        }

        .ambient-light {
            position: fixed;
            top: 10%; left: 50%; transform: translate(-50%, -50%);
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            z-index: -1;
            filter: blur(80px);
        }
        
        /* --- Container Principal Glass (Agora o Modal Único) --- */
        .modal-container {
            width: 90%;
            max-width: 400px;
            padding: 40px 30px;
            background: linear-gradient(145deg, rgba(255,255,255,0.04) 0%, rgba(255,255,255,0.01) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--neon-green);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(46, 211, 13, 0.3);
            position: relative;
            text-align: center;
            margin: auto;
        }


        /* Botão de Fechar */
        .close-button {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
            transition: color 0.2s;
            z-index: 10;
        }
        .close-button:hover {
            color: var(--neon-red);
        }

        /* Título do Modal */
        .modal-container h2 {
            color: white;
            font-weight: 700;
            margin-bottom: 10px;
            font-family: 'Rajdhani', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 1.5rem;
        }

        /* Descrição */
        .modal-container .description {
            font-size: 0.9rem;
            line-height: 1.4;
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        /* Input de Email */
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input {
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid var(--glass-border);
            border-radius: 6px;
            background: var(--input-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            outline: none;
            box-sizing: border-box;
            transition: all 0.3s;
            width: 100%;
        }
        .input-group input:focus {
            border-color: var(--neon-green);
            box-shadow: 0 0 10px rgba(46, 211, 13, 0.4);
        }

        /* Botão Enviar do Modal */
        .send-button {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--neon-green);
            border-radius: 6px;
            background: var(--neon-green);
            color: var(--bg-dark); 
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Rajdhani', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .send-button:hover {
            background: var(--bg-dark); 
            color: var(--neon-green);
            box-shadow: 0 0 20px var(--neon-green);
            transform: translateY(-2px);
        }
        .send-button:disabled {
            background: rgba(34, 197, 94, 0.5);
            border-color: rgba(34, 197, 94, 0.2);
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }
        .send-button i { margin-right: 8px; }

        /* --- Ícone (Cadeado Font Awesome) --- */
        .padlock-icon {
            color: var(--neon-green);
            font-size: 60px; 
            margin-bottom: 20px;
            display: inline-block;
            filter: drop-shadow(0 0 8px rgba(46, 211, 13, 0.6));
        }

        /* --- Alerts Tech Style --- */
        .alert {
            padding: 12px 15px;
            margin-bottom: 25px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            display: flex; 
            align-items: center; 
            gap: 10px;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: var(--neon-green);
            box-shadow: 0 0 5px rgba(34, 197, 94, 0.3);
            text-align: left; 
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--neon-red);
            box-shadow: 0 0 5px rgba(239, 68, 68, 0.3);
            text-align: left;
        }

        /* ------------------------------------- */
        /* --- Responsividade Geral --- */
        /* ------------------------------------- */
        @media (max-width: 768px) {
            .modal-container {
                padding: 30px 20px;
                margin-top: 20px;
            }
            .modal-container h2 { 
                font-size: 1.3rem; 
            }
            .padlock-icon {
                font-size: 50px;
            }
            .send-button { 
                font-size: 1rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="bg-tech-grid"></div>
    <div class="ambient-light"></div>

    <div id="resetModal" class="modal-container">
        
        <button class="close-button" onclick="closeModal()">X</button>

        <i class="fas fa-lock padlock-icon"></i>

        <h2>Redefinir Senha</h2>

        <p class="description" id="formDescription">
            Por favor, insira o Email vinculado à sua conta. Enviaremos uma senha temporária aleatória para este endereço.
        </p>

        <div id="alertContainer">
        </div>

        <form id="resetForm" onsubmit="handleFormSubmit(event)">
            
            <div class="input-group">
                <input type="email" id="emailInput" name="email" placeholder="email@exemplo.com" required>
            </div>
            
            <button type="submit" id="sendButton" class="send-button">Enviar</button>
        </form>

    </div>

    <script>
        function closeModal() {
            window.history.back(); 
            
            const modal = document.getElementById('resetModal');
            if (modal) {
                modal.style.display = 'none';
            }
            
            console.log('Tentativa de retornar à página anterior (simulação de fechamento).');
        }

        function openModal() {
            const modal = document.getElementById('resetModal');
            if (modal) {
                modal.style.display = 'block';
            }
        }

        /**
         * Intercepta o envio do formulário para simular o sucesso e fechar o modal.
         * @param {Event} event - O evento de envio do formulário.
         */
        function handleFormSubmit(event) {
            event.preventDefault(); 

            const emailInput = document.getElementById('emailInput');
            const sendButton = document.getElementById('sendButton');
            const alertContainer = document.getElementById('alertContainer');
            const formDescription = document.getElementById('formDescription');

            alertContainer.innerHTML = '';
            sendButton.disabled = true;
            sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...'; 
            
            formDescription.style.opacity = 0;

            setTimeout(() => {
                const successMessage = `
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> 
                        Email enviado com sucesso! Por favor, busque por memomindacelera@gmail.com (Verifique também a caixa de Spam).
                    </div>
                `;
                alertContainer.innerHTML = successMessage;
                
                sendButton.innerHTML = 'Enviado!';
                
                setTimeout(() => {
                    closeModal();
                }, 2000); 

            }, 500);
        }

        window.onload = openModal;
    </script>

</body>
</html>