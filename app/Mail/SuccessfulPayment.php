<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SuccessfulPayment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = Storage::disk('receipt')->path($this->file);
        return $this->markdown('emails.succesful-payment')
                    ->subject('Befizetési bizonylat')
                    ->attach($path, ['mime' => 'application/pdf']);
    }
}
