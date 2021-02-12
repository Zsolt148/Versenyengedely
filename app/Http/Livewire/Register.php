<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Register extends Component
{
    public $type, $teams_id, $coach = false;

    public function typeChanged() {
        if($this->type == 'coach') {
            $this->coach = true;
        }else {
            $this->coach = false;
        }
    }

    public function render()
    {
        return view('livewire.register');
    }
}
