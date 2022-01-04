<?php

namespace App\Http\Livewire;

use App\Models\Form;
use Livewire\Component;

class Cart extends Component
{
    public $forms, $total = 0, $disabled = true;
    public $selectedForms = [], $selectedNewForms = [];

    public function mount() {
        //$query = Form::where([['status', 'accepted'], ['forms.teams_id', request()->user()->teams_id], ['payment', 'none']]);
        $query = Form::query()
            ->where('forms.teams_id', request()->user()->teams_id)
            ->where('payment', null)
            ->where('status', 'accepted')
            ->with('payments');

        if($query->get()->isNotEmpty()) {
            $this->forms = $query->get();
        }else {
            $this->forms = array();
        }

    }

    public function formClicked() {
        $this->selectedForms = array_filter($this->selectedForms);
        $this->selectedNewForms = array_filter($this->selectedNewForms);
    }

    public function render()
    {
        if(auth()->user()->address) $this->disabled = false;

        $this->total = (count($this->selectedNewForms) * 3000) + (count($this->selectedForms) * 1500);

        if($this->total == 0) $this->disabled = true;

        return view('livewire.cart');
    }
}
