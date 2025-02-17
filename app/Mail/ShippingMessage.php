<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShippingMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    public $shippingData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($shipment, $shipmentmessage)
    {
        //
        $this->message = $shipmentmessage;
        $this->shippingData = $shipment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('do-not-reply@indoboxasia.com', 'Indobox Asia')->markdown('emails.ShippingMessage');
    }
}
