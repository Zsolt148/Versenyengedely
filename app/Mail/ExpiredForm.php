<?php

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredForm extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $forms = Form::where('forms.teams_id', $this->user->teams_id)
            ->where('payment', null)
            ->where('status', 'expired_form');

        return $this->markdown('emails.expired-form', ['forms' => $forms, 'url' => route('coach.forms.index')])
            ->subject('Lejárt versenyengedélykérelem');
    }
}
