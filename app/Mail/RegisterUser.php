<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email;
    protected $activation_code;
    protected $name;

    public function __construct($email,$activation_code,$name)
    {
        //
        $this->email = $email;
        $this->name = $name;
        $this->activation_code = $activation_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {

        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->subject('User Invite')
            ->view('mail.acceptInvitation', ['name' => $this->name,'token'=> $this->activation_code])
            ->with([
                'email' => $this->email
            ]);
    }

}
