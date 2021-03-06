<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\createLicenseJob;
use App\Mail\FormAccepted;
use App\Mail\FormDenied;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class FormsEdit extends Component
{
    public $form, $deny, $showDeny = false, $logs;

    public function submit($method) {
        switch ($method) {
            case 'accept':
                $this->form->status = Form::STATUS_ACCEPTED;
                $this->form->deny = null;

                $this->form->processed_by = auth()->user()->id;
                $this->form->processed = now();
                $this->form->form_valid = now()->format('Y') . '-12-31';

                $this->form->save();

                Mail::to($this->form->user)->queue(new FormAccepted($this->form));
                $this->emit('saved');

                $this->showDeny = false;
                $this->deny = '';
                break;
            case 'deny':
                $this->form->status = Form::STATUS_DENIED;
                $this->form->deny = $this->deny; //reason

                $this->form->processed_by = auth()->user()->id;
                $this->form->processed = now();
                $this->form->form_valid = null;

                $this->form->save();

                Mail::to($this->form->user)->queue(new FormDenied($this->form));
                $this->emit('saved');

                $this->showDeny = false;
                $this->deny = '';
                break;
            default:
                break;
        }
    }

    public function render()
    {
        if(request()->id) {
            $this->form = Form::findOrFail(request()->id);
            $this->deny = $this->form->deny;
        }else {
            if(Form::where('status', Form::STATUS_PENDING)->exists()) {
                $this->form = Form::where('status', Form::STATUS_PENDING)->first();
            }else {
                $this->form = null;
            }
        }

        //log null
        $this->logs = null;
        //ha a form nem model akkor nem tolti be a logot
        if($this->form instanceof \Illuminate\Database\Eloquent\Model) {
            $this->logs = Activity::query()
                ->where('log_name', 'Form')
                ->where('subject_id', $this->form->id)
                ->orderBy('created_at', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();
            //dd($this->logs);
        }

        return view('livewire.admin.forms-edit');
    }
}
