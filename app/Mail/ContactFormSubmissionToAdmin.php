<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormSubmissionToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    public $name;

    /** @var string */
    public $phone;

    /** @var string */
    public $date;

    /** @var string */
    public $description;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $phone
     * @param string $date
     * @param string $description
     * @return void
     */
    public function __construct($name, $phone, $date, $description = '')
    {
        $this->name        = $name;
        $this->phone       = $phone;
        $this->date        = $date;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact')
            ->subject('Planks Website Party Request');
    }
}
