<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProcessingFinished extends Mailable
{
    use Queueable, SerializesModels;

    public $output;

    /**
     * Create a new message instance.
     *
     * @param array $errorMessages
     */
    public function __construct($output)
    {
        $this->output = $output;
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

        $this->subject('Source Analysis Completed');

        return $this->markdown('emails.processing-finished');
    }
}
