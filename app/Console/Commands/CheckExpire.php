<?php

namespace App\Console\Commands;

use App\Mail\ExpiredForm;
use App\Mail\ExpiredSport;
use App\Models\Form;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks expired forms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired_form = Form::query()
            ->where('status', 'accepted')
            ->where('form_valid', '<', now()->format('Y-m-d'))
            ->with('user')
            ->get();

        $expired_sport = Form::query()
            ->where('status', 'accepted')
            ->where('sport_valid', '<', now()->format('Y-m-d'))
            ->with('user')
            ->get();

        $count = 0;

        //expired forms
        $users = array();
        /*
         * Ha lejárt az engedély akkor nulláza az engedélyt, fizetést, fizetés azonosítót.
         * Emailt küld az érintett csapatvezetőknek
         */
        foreach($expired_form as $form) {
            $form->status = 'expired_form';
            $form->license = null;
            $form->payment = null;
            $form->save();
            $users[$form->user->id] = $form->user->name;
        }

        foreach($users as $id => $form) {
            $user = User::find($id);
            Mail::to($user)->queue(new ExpiredForm($user)); //groupby
        }

        //expired sports
        $users = array();
        /*
         * Ha lejárt a sportorvosi akkor nulláza a sportorvosi idejét, eredményét, érvényességét és a feltöltött fájlt.
         * Emailt küld az érintett csapatvezetőknek
         */
        foreach($expired_sport as $form) {
            $form->status = 'expired_sport';
            $form->sport_time = null;
            $form->can_race = null;
            $form->sport_valid = null;
            $form->sport_sheet = null;
            $form->save();
            $users[$form->user->id] = $form->user->name; //groupby
        }

        foreach($users as $id => $form) {
            $user = User::find($id);
            Mail::to($user)->queue(new ExpiredSport($user));
        }

        return 0;
    }
}
