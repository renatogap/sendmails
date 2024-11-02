<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GrupoWhatsappMail extends Mailable
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
        return $this->view('emails.grupo-whatsapp')
                    ->with(['mensagem' => $this->dadosMensagem->mensagem])
                    ->subject($this->dadosMensagem->assunto);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Grupo Whatsapp Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
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
