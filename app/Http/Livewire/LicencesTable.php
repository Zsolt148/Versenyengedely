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
    public $exportable = false;
    public $perPage = 15;

    public function builder() {
        return Form::query()
            ->where('forms.teams_id', '=', request()->user()->teams_id)
            ->whereIn('status', [Form::STATUS_ACCEPTED, Form::STATUS_EXPIRED_SPORT])
            ->where('payment', Form::PAYMENT_DONE);
    }

    public function columns()
    {
        return [
            //Column::checkbox(),
            Column::name('id')->label('ID')->alignCenter(),
            Column::name('competitor.federal_reg_code')->label('Szövetségi szám')->searchable()->alignCenter(),
            Column::name('competitor.name')->label('Sportoló')->searchable()->alignCenter(),
            Column::name('year')->label('Év')->searchable()->alignCenter(),
            Column::callback(['license'], function ($data) {
                if($data) return '<a href="/license/' . $data . '" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Versenyengedély</a>';
            })->label('Versenyengedély')->alignCenter(),
            DateColumn::name('created_at')->label('Létrehozva')->format('Y.m.d')->alignCenter()
        ];
    }
}
