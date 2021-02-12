<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\createLicenseJob;
use App\Mail\FormDenied;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FormsEdit extends Component
{
    public $form, $deny, $showDeny = false;

    public function submit($method) {
        switch ($method) {
            case 'accept':
                $this->form->status = 'accepted';
                $this->form->deny = null;
                $this->form->processed_by = auth()->user()->id;
                $this->form->processed = now()->format('Y-m-d H:i:s');
                $this->form->save();
                $this->emit('saved');
                $this->showDeny = false;
                $this->deny = '';
                break;
            case 'deny':
                $this->form->status = 'denied';
                $this->form->deny = $this->deny;
                $this->form->processed_by = auth()->user()->id;
                $this->form->processed = now()->format('Y-m-d H:i:s');
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
            $this->form = Form::find(request()->id);
            if(!$this->form) abort(404);
            $this->deny = $this->form->deny;
        }else {
            if(Form::where('status', 'pending')->exists()) {
                $this->form = Form::where('status', 'pending')->first();
            }else {
                $this->form = null;
            }
        }

        return view('livewire.admin.forms-edit');
    }
}
