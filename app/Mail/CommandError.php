<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandError extends Mailable
{
    use Queueable, SerializesModels;

    public $errorMessages;

    /**
     * Create a new message instance.
     *
     * @param array $errorMessages
     */
    public function __construct($errorMessages)
    {
        $this->errorMessages = $errorMessages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $alertEmail = config('app.alerts_email', 'contact@activemill.com');
        $this->to($alertEmail);

        $this->subject('Error Processing Sources');

        return $this->markdown('emails.command-error');
    }
}
