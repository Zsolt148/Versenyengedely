<?php

namespace App\Http\Livewire;

use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LicencesTable extends LivewireDatatable
{
    public $model = Form::class;
    public $exportable = true;

    public function builder() {
        return Form::query()->where('forms.teams_id', '=', request()->user()->teams_id)
                            ->where('status', 'accepted')
                            ->where('payment', 'done');
    }

    public function columns()
    {
        return [
            //Column::checkbox(),
            Column::name('id')->label('ID')->alignCenter(),
            Column::name('competitor.federal_reg_code')->label('Szövetségi szám')->searchable()->alignCenter()->filterable(),
            Column::name('competitor.name')->label('Versenyző')->searchable()->alignCenter()->filterable(),
            Column::name('year')->label('Év')->searchable()->alignCenter()->filterable(Form::YEARS),
            Column::callback(['license'], function ($data) {
                if($data) {
                    return '<a href="/license/' . $data . '" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Versenyengedély</a>';
                }
            })->label('Versenyengedély')->alignCenter(),
            DateColumn::name('created_at')->label('Létrehozva')->format('Y.m.d')->alignCenter()
        ];
    }
}
