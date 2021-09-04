<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UsersRegistrationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        Log::debug('Testing Constructor Mail: ' . $this->username);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation Users Registration')
            ->markdown('mails.users-registration-confirmation-mail')
            ->with([
                'username' => $this->username,
                'password' => $this->password,
            ]);
    }
}
