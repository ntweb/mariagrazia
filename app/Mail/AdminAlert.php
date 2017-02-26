<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;

class AdminAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $m;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Mailmessage $m)
    {        
        $this->m = $m;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('admin-alert')->view('email.adminalert');
    }
}
