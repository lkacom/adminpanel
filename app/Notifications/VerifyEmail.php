<?php

namespace App\Notifications;

use App\Mail\VerificationCodeMail;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification
{

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable)
    {
        return new VerificationCodeMail ($notifiable);
    }

}
