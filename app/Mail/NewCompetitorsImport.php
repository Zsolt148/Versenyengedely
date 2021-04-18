<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCompetitorsImport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $missing;
    private $young;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($missing, $young)
    {
        $this->missing = $missing;
        $this->young = $young;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-competitors-import', ['missing' => $this->missing, 'young' => $this->young])
                    ->subject('Sportoló importálás');
    }
}
