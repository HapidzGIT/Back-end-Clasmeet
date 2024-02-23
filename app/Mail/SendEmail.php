<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $attachmentPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $attachmentPath)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->markdown('emails.send-email')
                        ->subject($this->subject)
                        ->with([
                            'message' => $this->message,
                        ]);

        if ($this->attachmentPath !== null) {
            $message->attach(storage_path('app/' . $this->attachmentPath));
        }

        return $message;
    }
}
