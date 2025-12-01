<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos básicos inline para garantir compatibilidade com a maioria dos clientes de email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border-top: 5px solid #2ed30d;
        }
        .header {
            background-color: #09090b;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            line-height: 1.6;
            color: #333333;
        }
        .password-box {
            background-color: #e9e9e9;
            padding: 15px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 20px 0;
            border-radius: 4px;
            border: 1px dashed #cccccc;
        }
        .footer {
            background-color: #f8f8f8;
            color: #999999;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Memomind - Redefinição de Senha</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Olá,</p>
            <p>Recebemos uma solicitação para redefinir a senha da sua conta Memomind. Abaixo está a sua nova senha temporária:</p>

            <div class="password-box">
                {{ $newPassword }}
            </div>

            <p>
                <strong>Importante:</strong> Recomendamos que você faça login imediatamente com esta senha e a altere para uma de sua preferência na seção de Configurações.
            </p>
            <p>
                Se você não solicitou esta alteração, por favor, ignore este e-mail. Sua senha original permanecerá inalterada (até que a senha temporária seja usada).
            </p>

            <p>Atenciosamente,<br>A Equipe Memomind</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            Este e-mail foi enviado por memomindacelera@gmail.com. Não é necessário responder.
        </div>
    </div>
</body>
</html>