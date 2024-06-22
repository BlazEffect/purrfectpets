<?php

namespace App\Services;

use App\Mail\CreateReviewMail;
use App\Mail\EditReviewMail;
use App\Mail\FeedbackFormMail;
use App\Mail\OrderCancelMail;
use App\Mail\OrderCreateAdminMail;
use App\Mail\OrderCreateUserMail;
use App\Mail\RegisterAdminMail;
use App\Mail\RegisterUserMail;
use App\Models\Order;
use App\Models\OrderProperty;
use App\Models\Review;
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
        Mail::to($user->email)
            ->queue(new RegisterUserMail($user, $profileData, $password));
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new RegisterAdminMail($user, $profileData));
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
            ->queue((new FeedbackFormMail($fio, $email, $message)));
    }

    /**
     * @param User $user
     * @param Order $order
     * @param OrderProperty $orderProperty
     * @return void
     */
    public function sendOrderCreatedUserMail(User $user, Order $order, OrderProperty $orderProperty): void
    {
        Mail::to($user->email)
            ->queue(new OrderCreateUserMail($order, $orderProperty));
    }

    /**
     * @param Order $order
     * @param OrderProperty $orderProperty
     * @return void
     */
    public function sendOrderCreatedAdminMail(Order $order, OrderProperty $orderProperty): void
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new OrderCreateAdminMail($order, $orderProperty));
    }

    /**
     * @param User $user
     * @param int $orderId
     * @return void
     */
    public function sendOrderCancelledMail(User $user, int $orderId): void
    {
        Mail::to($user->email)
            ->queue(new OrderCancelMail($orderId));
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new OrderCancelMail($orderId));
    }

    /**
     * @param Review $review
     * @return void
     */
    public function sendCreateReviewMail(Review $review): void
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new CreateReviewMail($review));
    }

    /**
     * @param Review $review
     * @return void
     */
    public function sendEditReviewMail(Review $review): void
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue(new EditReviewMail($review));
    }
}
