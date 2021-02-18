<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CircleRegisterNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $auth_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($auth_code)
    {
        $this->auth_code = $auth_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('サークル登録')
                    ->view('circle.auth.text')
                    ->with(['auth_code' => $this->auth_code]);
    }
}
