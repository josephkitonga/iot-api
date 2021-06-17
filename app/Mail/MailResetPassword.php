<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $userData;
    protected $token;

    public function __construct($userData,$token)
    {
       //
       $this->userData = $userData;
       $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data = $this->userData;
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
        ->subject('Reset Password')
        ->view('mail.resetPassword', ['name' => $data->name,'token'=> $this->token])
        ->with([
            'email' => $data->email
        ]);
    }
}
