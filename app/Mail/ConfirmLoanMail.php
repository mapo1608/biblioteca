<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmLoanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $book;
    public $start_date;
    public $expiration_date;

    /**
     * Create a new message instance.
     */
    public function __construct($book, $start_date, $expiration_date)
    {
        $this->book = $book;
        $this->start_date = $start_date;
        $this->expiration_date = $expiration_date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Conferma avvio prestito',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            /* Versione per inviare una mail di semplice testo */
            /* text: 'email.confirm_loan_mail', */

            /* Versione per inviare una mail con lo stile html / css */
            view: 'email.confirm_loan_mail_better',
            with: [
                'book' => $this->book,
                'start_date' => $this->start_date,
                'expiration_date' => $this->expiration_date, 
            ],
        );
    }

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
