<?php

namespace App\Http\Livewire\Admin;

use App\Models\Team;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TeamsTable extends LivewireDatatable
{
    public $model = Team::class;
    public $exportable = true;
    public $perPage = 15;

    public function columns() {
        return [
            Column::name('id')->label('#iD'),
            Column::name('name')->label('Név')->searchable(),
            Column::name('sa')->label('SA')->searchable()->alignCenter(),
            Column::name('address')->label('Cím')->searchable()->alignCenter(),
            Column::name('webpage')->label('Honlap')->alignCenter(),
        ];
    }
}
