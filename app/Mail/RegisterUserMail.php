<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public array $userProfile,
        public string $password
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Регистрация на сайте',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.register-user',
            with: [
                'user' => $this->user,
                'userProfile' => $this->userProfile,
                'password' => $this->password
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
