<?php

namespace App\Http\Livewire;

use App\Models\Kindergarten;
use App\Models\User;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UsersTable extends LivewireDatatable
{
    public $model = User::class;
    //public $hideable = 'select';
    public $exportable = false;
    public $beforeTableSlot = 'tables.users-selected';
    public $type, $kinder, $changeType = false, $acceptType = false, $action;

    protected $rules = [
      'type' => 'required',
    ];

    public function columns() {
        return [
            Column::checkbox(), NumberColumn::name('id')->alignCenter()->label('#ID'),
            Column::name('name')->label('Név')->alignCenter()->searchable(),
            //DateColumn::name('birth')->label('Szül.')->editable(),
            Column::name('email')->label('Email')->alignCenter()->searchable(),
            DateColumn::name('email_verified_at')->alignCenter()->label('Megerősítve'),
            Column::callback(['type'], function ($type) {
                return User::TYPES[$type];
            })->label('Jogosultság')->alignCenter()->filterable(User::TYPES),
            Column::callback(['wannabe'], function ($type) {
                if($type) return User::TYPES[$type];
            })->label('Regisztrált mint')->alignCenter()->filterable(User::TYPES),
            Column::name('team.name')->label('Egyesület')->alignCenter()->searchable(),
            Column::callback(['mandate'], function ($mandate) {
                if($mandate) return '<a href="/mandate/'.$mandate.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Meghatalm.</a>';
            })->label('Meghatalm.')->alignCenter()->searchable(),
            DateColumn::name('created_at')->label('Létrehozva')->alignCenter()->format('Y.m.d'),
            Column::callback(['id'], function ($id) {
                return view('tables.user-actions', ['id' => $id]);
            })->label('Admin')->alignCenter()
        ];
    }

    public function updateSelected() {
        if(!empty($this->selected) && !empty($this->action)) {
            switch($this->action) {
                case 'changeType':
                    $this->validate();
                    foreach($this->selected as $key => $value) {
                        $u = User::find($value);
                        if(request()->user()->cannot('update', $u)) abort(403);
                        $u->type = $this->type;
                        $u->save();
                    }
                    $this->emit('saved');
                    //$this->emit('refreshLivewireDatatable');
                    break;
                case 'acceptType':
                    foreach($this->selected as $key => $value) {
                        $u = User::find($value);
                        if(request()->user()->cannot('update', $u)) abort(403);
                        if($u->wannabe) {
                            $u->type = $u->wannabe;
                            $u->save();
                        }
                    }
                    $this->emit('saved');
                default:
                    //
                    break;
            }
        }
    }

    public function changeAction() {
        if(!empty($this->action)) {
            switch($this->action) {
                case 'changeType':
                    $this->hideAll();
                    $this->changeType = true;
                    break;
                case 'acceptType':
                    $this->hideAll();
                    $this->acceptType = true;
                default:
                    //$this->hideAll();
                    break;
            }
        }else {
            $this->hideAll();
        }
    }

    public function hideAll() {
        $this->changeType = false;
        $this->acceptType = false;
    }

    public function editUser($id) {
        $this->emit('editUser', $id);
    }

    public function confirmUserDeletion($id) {
        $this->emitUp('confirmUserDeletion', $id);
    }

}
