<?php

namespace App\Http\Livewire\Admin;

use App\Models\Competitor;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CompetitorsTable extends LivewireDatatable
{
    public $model = Competitor::class;
    public $exportable = true;
    public $perPage = 15;

    public function columns()
    {
        return [
            Column::name('id')->label('#ID')->alignCenter(),
            BooleanColumn::name('is_registered')->label('Regisztrált')->alignCenter(),
            Column::name('federal_reg_code')->label('Szövetségi kód')->searchable()->alignCenter(),
            Column::name('team_reg_code')->label('Egyesületi kód')->searchable()->alignCenter(),
            Column::name('name')->label('Név')->searchable()->alignCenter(),
            Column::name('birth')->label('Születési év')->searchable()->alignCenter(),
            Column::name('team.name')->label('Egyesület')->searchable(),
        ];
    }
}
