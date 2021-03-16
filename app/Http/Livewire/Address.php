<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Address as Adr;

class Address extends Component
{

    public $name, $zip, $address, $team_address, $tax_id;

    protected $rules = [
        'name' => 'required',
        'zip' => 'required|integer',
        'address' => 'required',
        'tax_id' => 'required',
    ];

    public function mount() {
        $team = request()->user()->team;
        $this->team_address = request()->user()->address ?? array();

        if($this->team_address) {
            $this->name = $this->team_address['name'];
            $this->zip = $this->team_address['zip'];
            $this->address = $this->team_address['address'];
            $this->tax_id = $this->team_address['tax_id'] ?? null;
        }else {
            $this->tax_id = null;
            $this->name = $team->name;
            if($team->address != '-') {
                $this->zip = explode(" ", $team->address)[0];
                $this->address = explode(" ", $team->address, 2)[1];
            }
        }
    }

    public function store() {
        $this->validate();

        Adr::updateOrCreate(
            ['teams_id' => request()->user()->team->id],
            [
                'name' => $this->name,
                'zip' => $this->zip,
                'address' => $this->address,
                'tax_id' => $this->tax_id
            ]
        );

        $this->emit('saved');
        $this->dispatchBrowserEvent('hasAddress');
    }

    public function editAddress() {
        $this->team_address = null;
    }

    public function render() {
        return view('livewire.address');
    }
}
