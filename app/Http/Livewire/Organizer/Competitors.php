<?php

namespace App\Http\Livewire\Organizer;

use App\Models\Form;
use Livewire\Component;

class Competitors extends Component
{
    public $search, $team, $year;

    public function mount()
    {
        $this->year = now()->format('Y');
    }

    public function render()
    {
        $query = Form::query()
            ->where('payment', Form::PAYMENT_DONE)
            ->whereIn('status', [Form::STATUS_ACCEPTED, Form::STATUS_EXPIRED_FORM])
            ->with('team');

        /* paginated
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
                $query
                    ->where('vnev', 'like', '%' . $this->search . '%')
                    ->orWhere('knev', 'like', '%' . $this->search . '%')
                    ->orWhere('title', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.organizer.competitors', ['result' => $query->get()]);
    }
}
