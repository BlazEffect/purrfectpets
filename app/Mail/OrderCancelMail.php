<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCancelMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly int $orderId
    ){}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заказ успешно отменён',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.order-cancel',
            with: [
                'orderId' => $this->orderId
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
