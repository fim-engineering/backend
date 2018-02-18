<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;


class activateAccount extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $dbuseradd)
    {
        $this->user = $dbuseradd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this
      ->subject('Forum Indonesia Muda Registration User Verification')
      ->view('email.verificationUser');
    }
}
