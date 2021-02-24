<?php

namespace App\Http\Livewire;

use App\Models\Form;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Users extends Component
{

    public $idd, $name, $email, $type, $team, $confirmingUserDeletion = false, $deleteUserId;
    public $isOpen = false;
    protected $listeners = ['editUser', 'confirmUserDeletion'];

    protected $rules = [
        'idd' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'type' => 'required',
        'team' => 'required_if:type,coach',
    ];

    public function editUser($id) {
        $this->resetValidation();
        $user = User::findOrFail($id);
        if (request()->user()->cannot('update', $user)) abort(403);
        $this->idd = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->type = $user->type;
        $this->team = $user->teams_id;
        $this->isOpen = true;
    }

    public function save() {
        $this->validate();

        $user = User::findOrFail($this->idd);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->type = $this->type;
        $user->teams_id = ($this->team) ? $this->team : null;
        $user->save();

        $this->emit('saved');
        $this->emit('refreshLivewireDatatable');
        $this->isOpen = false;
    }

    public function confirmUserDeletion($id) {
        $this->confirmingUserDeletion = true;
        $this->deleteUserId = $id;
    }

    public function deleteUser() {
        $user = User::findOrFail($this->deleteUserId);
        if (request()->user()->cannot('update', $user)) abort(403);
        $this->deleteUserId = null;

        foreach($user->forms as $value) $value->delete();
        foreach($user->payments as $value) $value->delete();

        if($user->mandate) Storage::disk('mandate')->delete($user->mandate);

        $user->delete();

        $this->emit('refreshLivewireDatatable');
        $this->confirmingUserDeletion = false;
    }

    public function render()
    {
        return view('livewire.users');
    }
}
