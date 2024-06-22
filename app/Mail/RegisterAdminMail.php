<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly array $userProfile
    ){}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новый пользователь зарегистрировался на сайте',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.register-admin',
            with: [
                'user' => $this->user,
                'userProfile' => $this->userProfile,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
