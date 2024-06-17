<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackFormMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $fio,
        public string $email,
        public string $message
    ){}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Обращение с формы обратной связи',
        );
    }

    public function content(): Content
    {
        $data = collect([
            'fio' => $this->fio,
            'email' => $this->email,
            'message' => $this->message
        ]);

        return new Content(
            view: 'mails.feedback-form',
            with: [
                'data' => $data
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
