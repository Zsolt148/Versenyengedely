<?php

namespace App\Http\Livewire\Organizer;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;

class Competitors extends Component
{
    //use WithPagination;

    public $search, $year = '2021';
    //protected $result;

    public function render()
    {
        $result = Form::where('year', '=', $this->year)
                            ->where('status', '=', 'accepted')
                            ->where('payment', '=', 'done')
                            ->where(function($query) { //or where group
                                $query->where('vnev', 'like', '%' . $this->search . '%')
                                        ->orWhere('knev', 'like', '%' . $this->search . '%');
                            })
                            ->get();
                            //->paginate(5);

        return view('livewire.organizer.competitors', ['result' => $result]);
    }
}
