<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewLeadEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;

    /**
     * Crea una nuova istanza del messaggio.
     */
    public function __construct($_lead)
    {
        $this->lead = $_lead;
    }

    /**
     * Ottieni l'involucro del messaggio.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuova Email di Lead',
            replyTo: '',
        );
    }

    /**
     * Ottieni la definizione del contenuto del messaggio.
     */
    public function content(): Content
    {
        return new Content(
            view: 'layouts.mail.new-lead-email',
        );
    }

    /**
     * Ottieni gli allegati per il messaggio.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
