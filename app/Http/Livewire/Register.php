<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use WithFileUploads, PasswordValidationRules;

    public $type, $teams_id, $coach = false, $mandate, $name, $email, $password, $password_confirmation, $terms;

    /*
    protected $rules = [
        'type' => 'required',
        'teams_id' => 'required_if:type,coach',
        'mandate' => 'required_if:type,coach|exclude_if:teams_id,null|mimes:pdf,jpg,png|max:2048',
        'name' => 'required|string|max:190',
        'email' => 'required|string|max:190|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'terms' => 'required|accepted',
    ];
    */

    public function typeChanged() {
        if($this->type == 'coach') {
            $this->coach = true;
        }else {
            $this->coach = false;
        }
        $this->resetValidation();
    }

    public function register() {
        //$this->validate();

        $input['type'] = $this->type;
        $input['teams_id'] = $this->teams_id;
        $input['mandate'] = $this->mandate;
        $input['name'] = $this->name;
        $input['email'] = $this->email;
        $input['password'] = $this->password;
        $input['password_confirmation'] = $this->password_confirmation;
        $input['terms'] = $this->terms;

        Validator::make($input, [
            'type' => ['required'],
            'teams_id' => ['required_if:type,coach'],
            'mandate' => ['required_if:type,coach','exclude_if:teams_id,null', 'mimes:pdf,jpg,png', 'max:5120'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => ['required', 'accepted'],
        ])->validate();

        if($this->mandate && $this->mandate->isValid()) $file = str_replace("mandate/", "", $this->mandate->store('mandate'));

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => 'user',
            'teams_id' => $this->teams_id ?? null,
            'wannabe' => $this->type,
            'mandate' => $file ?? null,
            'password' => Hash::make($this->password)
        ]);

        UserRegistered::dispatch($user);

        session()->flash('status', 'Sikeres Regisztráció');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
