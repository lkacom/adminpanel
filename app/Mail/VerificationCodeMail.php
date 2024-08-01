<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct( User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $this->to($this->user->email);
        $this->subject('Email verification code: '.$this->user->verification_code);
        return $this->view('emails.verification-mail-code');
    }
}
