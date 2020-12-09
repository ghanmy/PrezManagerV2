<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class SimpleEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $result;
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {	
		$subject=utf8_encode('Prez Manager : Bienvenue sur Prez Manager');
        return $this->subject($subject)->markdown('Mails.SimpleEmail');
    }
}
