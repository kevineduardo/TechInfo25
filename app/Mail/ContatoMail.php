<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Setting;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param message
     * @param title
     * @return void
     */
    public function __construct($message, $title, $from)
    {
        $this->message = $message;
        $this->title = $title;
        $this->from = $from;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from, 'Your Application')
                    ->subject($this->title)
                    ->view('mails.contatomail')
                    ->with(['message'=>$this->message]);
    }
}
