<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FreshmanCreateMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $freshman;
    protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($freshman, $content)
    {
        $this->freshman = $freshman;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('メッセージが投稿されました')
                    ->view('circle.thread.textMessage')
                    ->with(['freshman' => $this->freshman, 'content' => $this->content]);
    }
}
