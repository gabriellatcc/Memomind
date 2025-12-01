<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPasswordNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $newPassword;

    /**
     * Cria uma nova instância da mensagem.
     *
     * @param string $newPassword A nova senha temporária gerada.
     */
    public function __construct(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * Define o envelope da mensagem (assunto e remetente).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sua Nova Senha Temporária',
            from: 'memomindacelera@gmail.com',
        );
    }

    /**
     * Obtém as definições de conteúdo da mensagem.
     * Define qual view Blade será usada.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_password',
            with: [
                'newPassword' => $this->newPassword,
            ],
        );
    }

    /**
     * Obtém os anexos para a mensagem.
     *
     * @return array<int,
     */
    public function attachments(): array
    {
        return [];
    }
}