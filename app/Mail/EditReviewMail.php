<?php

namespace App\Mail;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EditReviewMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Review $review
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'На сайте был изменён отзыв',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.edit-review',
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
