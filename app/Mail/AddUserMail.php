<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddUserMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email,$password,$name;
    public function __construct($name,$email,$password)
    {
        $this->email=$email;
        $this->password = $password;
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
        return $this->markdown('emails.adduser')
        ->from('support@indoboxasia.com', 'Indobox Asia')
        ->subject("Account Created in Indobox Asia");
    }
}
