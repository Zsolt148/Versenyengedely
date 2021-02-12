<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class createLicenseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($form)
    {
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = now()->format('Y.m.d');
        $form = $this->form;
        $comp = $form->competitor;
        $profile = $form->profile_photo;

        $pdf = PDF::loadView('coach.license', compact('form', 'comp', 'date', 'profile'));

        //save
        $filename = Str::random(12) . '.pdf';
        $pdf->save('storage/app/license/' . $filename);

        $form->license = $filename;
        $form->save();
    }
}
