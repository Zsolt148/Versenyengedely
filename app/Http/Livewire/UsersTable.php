<?php

namespace App\Http\Livewire;

use App\Models\Kindergarten;
use App\Models\User;
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
            Column::checkbox(), NumberColumn::name('id')->label('ID'), //Column::name('vnev')->label('V. név')->searchable()->editable(),
            //Column::name('knev')->label('K. név')->searchable()->editable(),
            Column::name('name')->label('Név')->searchable()->editable(), //DateColumn::name('birth')->label('Szül.')->editable(),
            Column::name('email')->label('Email')->searchable()->editable(), DateColumn::name('email_verified_at')->label('Megerősítve'), Column::callback(['type'], function ($type) {
                return User::TYPES[$type];
            })->label('Típus')->filterable(User::TYPES), Column::callback(['wannabe'], function ($type) {
                if($type) return User::TYPES[$type];
            })->label('Regisztrált mint')->filterable(User::TYPES), Column::name('team.name')->label('Egyesület')->searchable(), DateColumn::name('created_at')->label('Létrehozva')->format('Y.m.d'), Column::callback(['id'], function ($id) {
                return view('tables.user-actions', ['id' => $id]);
            })->label('Admin'),];
    }

    public function updateSelected() {
        if(!empty($this->selected) && !empty($this->action)) {
            switch($this->action) {
                case 'changeType':
                    $this->validate();
                    foreach($this->selected as $key => $value) {
                        $u = User::find($value);
                        $u->type = $this->type;
                        $u->save();
                    }
                    $this->emit('saved');
                    //$this->emit('refreshLivewireDatatable');
                    break;
                case 'acceptType':
                    foreach($this->selected as $key => $value) {
                        $u = User::find($value);
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
