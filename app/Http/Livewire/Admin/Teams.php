<?php

namespace App\Http\Livewire\Admin;

use App\Models\Team;
use Illuminate\Support\Facades\Http;
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

    public function sync() {
        $response = Http::get('https://mszuosz.hu/api/teams');

        $response->throw();

        $teams = $response->json();

        foreach($teams as $team) {
            Team::updateOrCreate(
                [
                    'name' => $team['name'],
                    'SA' => $team['SA'],
                ], [
                    'address' => $team['address'],
                    'webpage' => $team['webpage'],
                ]
            );
        }

        session()->flash('status', 'Sikeres szinkronizálás');
        $this->emit('refreshLivewireDatatable');
    }

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
