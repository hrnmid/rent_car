<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $otp,$name;
    public function __construct($name,$otp)
    {
        $this->otp=$otp;
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.signup');
        return $this->markdown('emails.signup')
        ->from('do-not-reply@indoboxasia.com', 'Indobox Asia')
        ->subject("Signup Successful");
    }
}
