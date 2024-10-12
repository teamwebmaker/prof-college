<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function sendMail()
    {
        Mail::to('liliana.aqimishvili@gmail.com')->send(new MailNotify($this->data));

        return 'Email sent successfully';
    }
    public function build()
    {
        return $this->subject('Mail Notify')
            ->view('emails.notify')
            ->with('data', $this->data);
    }
}
