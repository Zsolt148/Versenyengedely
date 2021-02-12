<?php

namespace App\Http\Livewire\Admin;

use App\Models\Team;
use Livewire\Component;

class Teams extends Component
{
    public $openNew = false, $name, $sa, $address, $webpage;

    protected $rules = [
        'name' => 'required',
        'sa' => 'required',
        'address' => 'required',
        'webpage' => 'nullable',
    ];

    public function store() {
        $this->validate();

        Team::create([
            'name' => $this->name,
            'SA' => $this->sa,
            'address' => $this->address,
            'webpage' => $this->webpage,
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->openNew = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.teams');
    }
}
