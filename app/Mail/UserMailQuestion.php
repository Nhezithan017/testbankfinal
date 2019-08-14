<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserMailQuestion extends Mailable
{
    use Queueable, SerializesModels;

    public $courses;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($courses)
    {
        $this->courses = $courses;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-mailsend');
    }
}
