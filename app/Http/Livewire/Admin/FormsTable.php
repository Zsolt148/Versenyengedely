<?php

namespace App\Http\Livewire\Admin;

use App\Models\Form;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class FormsTable extends LivewireDatatable
{
    public $model = Form::class;
    public $exportable = false;

    public function builder() {
        return Form::query()->with('competitor', 'team');
    }

    public function columns()
    {
        return [
            //Column::checkbox(),
            Column::name('id')->label('ID')->alignCenter(),
            Column::name('competitor.name')->label('Sportoló')->searchable()->alignCenter(),
            Column::name('team.name')->label('Egyesület')->searchable()->alignCenter()->filterable(),
            //Column::name('vnev')->label('V.név')->searchable(),
            //Column::name('knev')->label('K.név')->searchable(),
            Column::name('year')->label('Év')->searchable()->alignCenter()->filterable(Form::YEARS),
            Column::callback(['status'], function ($status){
                return Form::STATUS[$status];
            })->label('Állapot')->searchable()->alignCenter()->filterable(Form::STATUS_LABEL),
            Column::callback(['payment'], function ($status){
                return Form::PAYMENT[$status];
            })->label('Fizetés')->searchable()->alignCenter()->filterable(Form::PAYMENT_LABEL),
            Column::callback(['data_sheet'], function ($data) {
                if($data) return '<a href="/file/'.$data.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Adatlap</a>';
            })->label('Adatlap')->alignCenter(),
            Column::callback(['sport_sheet'], function ($data) {
                if($data) return '<a href="/file/'.$data.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Sportorvosi</a>';
            })->label('Sportorvosi')->alignCenter(),
            Column::callback(['license'], function ($data) {
                if($data) return '<a href="/license/'.$data.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Versenyengedély</a>';
            })->label('Versenyengedély')->alignCenter(),
            DateColumn::name('created_at')->label('Létrehozva')->format('Y.m.d H:i:s')->alignCenter(),
            //DateColumn::name('updated_at')->label('Frissítve')->format('Y.m.d H:i:s')->alignCenter(),
            Column::callback(['id'], function ($id) {
                return view('tables.admin-form-actions', ['id' => $id]);
            })->label('Admin')->alignCenter(),
        ];
    }

    public function editForm($id) {
        return $this->redirect(route('admin.forms.edit', ["id" => $id]));
    }
}
