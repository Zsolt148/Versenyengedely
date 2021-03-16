<?php

namespace App\Http\Livewire\Organizer;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;

class Competitors extends Component
{
    //use WithPagination;

    public $search, $team, $year = '2021';
    //protected $result;

    public function render()
    {
        $query = Form::where('payment', 'done')
            ->with('team')
            ->where(function ($query) {
                $query->where('status', 'accepted')
                    ->orWhere('status', 'expired_sport');
            });
        /*
        $result = Form::where('year', $this->year)
                            ->where('payment', 'done')
                            ->where(function ($query) {
                                $query->where('status', 'accepted')
                                    ->orWhere('status', 'expired_sport');
                            })
                            ->where(function($query) { //or where group
                                $query->where('vnev', 'like', '%' . $this->search . '%')
                                        ->orWhere('knev', 'like', '%' . $this->search . '%');
                            })
                            ->get();
                            //->paginate(5);
        */

        if($this->year) {
            $query = $query->where('year', $this->year);
        }

        if($this->team) {
            $query = $query->where('teams_id', $this->team);
        }

        if($this->search) {
            $query = $query->where(function($query) { //or where group
                $query->where('vnev', 'like', '%' . $this->search . '%')
                    ->orWhere('knev', 'like', '%' . $this->search . '%')
                    ->orWhere('title', 'like', '%' . $this->search . '%');
            });
        }

        $result = $query->get();

        return view('livewire.organizer.competitors', ['result' => $result]);
    }
}
