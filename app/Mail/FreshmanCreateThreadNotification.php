<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FreshmanCreateThreadNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $freshman;
    protected $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($freshman, $title)
    {
        $this->freshman = $freshman;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('スレッドが作成されました')
                    ->view('circle.thread.textThread')
                    ->with(['freshman' => $this->freshman, 'title' => $this->title]);
    }
}
