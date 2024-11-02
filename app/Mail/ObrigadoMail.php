<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ObrigadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dadosMensagem;

    /**
     * Create a new message instance.
     */
    public function __construct(public $options)
    {
        $this->dadosMensagem = $options;
    }

    public function build()
    {
        return $this->view('emails.obrigado')
                    ->with(['mensagem' => $this->dadosMensagem->mensagem])
                    ->subject($this->dadosMensagem->assunto);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: $this->dadosMensagem->assunto,
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.inscricao',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
