<?php

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredSport extends Mailable
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
            ->where('status', 'expired_sport');

        return $this->markdown('emails.expired-sport', ['forms' => $forms, 'url' => route('coach.forms.index')])
            ->subject('Lejárt sportorvosi vizsgálat');
    }
}
