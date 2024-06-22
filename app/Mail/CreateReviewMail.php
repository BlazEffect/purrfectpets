<?php

namespace App\Mail;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateReviewMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Review $review
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'На сайте был создан новый отзыв',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.create-review',
            with: [
                'review' => $this->review
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
