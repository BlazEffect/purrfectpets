<?php

namespace App\Services;

use App\Mail\FeedbackFormMail;
use App\Mail\OrderCancelMail;
use App\Mail\OrderCreateAdminMail;
use App\Mail\OrderCreateUserMail;
use App\Mail\RegisterAdminMail;
use App\Mail\RegisterUserMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @param User $user
     * @param array $profileData
     * @param string $password
     * @return void
     */
    public function sendRegistrationEmails(User $user, array $profileData, string $password): void
    {
        Mail::to($user->email)->queue(new RegisterUserMail($user, $profileData, $password));
        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new RegisterAdminMail($user, $profileData));
    }

    /**
     * @param string $fio
     * @param string $email
     * @param string $message
     * @return void
     */
    public function sendFeedbackEmail(string $fio, string $email, string $message): void
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue((new FeedbackFormMail($fio, $email, $message))
        );
    }

    /**
     * @param $user
     * @param $order
     * @param $orderProperty
     * @return void
     */
    public function sendOrderCreatedUserMail($user, $order, $orderProperty): void
    {
        Mail::to($user->email)
            ->queue(new OrderCreateUserMail($order, $orderProperty)
        );
    }

    /**
     * @param $order
     * @param $orderProperty
     * @return void
     */
    public function sendOrderCreatedAdminMail($order, $orderProperty): void
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new OrderCreateAdminMail($order, $orderProperty)
        );
    }

    /**
     * @param $user
     * @param $orderId
     * @return void
     */
    public function sendOrderCancelledMail($user, $orderId): void
    {
        Mail::to($user->email)
            ->queue(new OrderCancelMail($orderId)
        );
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new OrderCancelMail($orderId)
        );
    }
}
