<?php

namespace App\Http\Livewire;

use App\Models\Form;
use Livewire\Component;

class Cart extends Component
{
    public $forms, $selectedForms = [], $total = 0, $disabled = true;

    public function mount() {
        $query = Form::where([['status', 'accepted'], ['forms.teams_id', request()->user()->teams_id], ['payment', 'none']]);
        if($query->get()->isNotEmpty()) {
            $this->forms = $query->get();
        }else {
            $this->forms = array();
        }

    }

    public function formClicked() {
        $this->selectedForms = array_filter($this->selectedForms);
    }

    public function render()
    {
        if(auth()->user()->address) $this->disabled = false;
        $this->total = count($this->selectedForms) * 1000;
        if($this->total == 0) $this->disabled = true;
        return view('livewire.cart');
    }
}
