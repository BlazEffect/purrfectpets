<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderProperty;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreateUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Order $order,
        public readonly OrderProperty $orderProperty,
    ){}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заказ успешно создан',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.order-create-user',
            with: [
                'order' => $this->order,
                'orderProperties' => $this->orderProperty
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
