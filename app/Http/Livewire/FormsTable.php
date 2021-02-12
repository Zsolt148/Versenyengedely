<?php

namespace App\Http\Livewire;

use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class FormsTable extends LivewireDatatable
{
    public $model = Form::class;
    public $exportable = true;

    public function builder() {
        return Form::query()->where('forms.teams_id', '=', request()->user()->teams_id);
    }

    public function columns()
    {
        return [
            //Column::checkbox(),
            Column::name('id')->label('ID')->alignCenter(),
            Column::name('federal_reg_code')->label('Szövetségi szám')->alignCenter()->searchable()->filterable(),
            Column::callback(['title', 'vnev', 'knev'], function ($title, $vnev, $knev) {
                return $title . ' ' . $vnev . ' ' . $knev;
            })->label('Versenyző')->searchable()->alignCenter()->filterable(),
            //Column::name('vnev')->label('V.név')->searchable(),
            //Column::name('knev')->label('K.név')->searchable(),
            Column::name('year')->label('Év')->searchable()->alignCenter()->filterable(Form::YEARS),
            Column::callback(['status'], function ($status) {
                return Form::STATUS[$status];
            })->label('Állapot')->searchable()->alignCenter()->filterable(Form::STATUS_LABEL),
            /*
            Column::callback(['status', 'turn_in', 'processed'], function ($status, $turn_in, $processed){
                return $this->getStatus($status, $turn_in, $processed);
            })->label('Állapot')->searchable()->alignCenter()->filterable(Form::STATUS_LABEL),
            */
            Column::callback(['payment'], function ($status){
                return Form::PAYMENT[$status];
            })->label('Fizetés')->searchable()->alignCenter()->filterable(Form::PAYMENT_LABEL),
            Column::callback(['profile_photo'], function ($data) {
                if($data) return '<a href="/file/' . $data . '" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Profilkép</a>';
            })->label('Profilkép')->alignCenter(),
            Column::callback(['data_sheet'], function ($data) {
                if($data) return '<a href="/file/'.$data.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Adatlap</a>';
            })->label('Adatlap')->alignCenter(),
            Column::callback(['sport_sheet'], function ($data) {
                if($data) return '<a href="/file/'.$data.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Sportorvosi</a>';
            })->label('Sportorvosi')->alignCenter(),
            DateColumn::name('created_at')->label('Létrehozva')->alignCenter()->format('Y.m.d'),
            Column::callback(['id'], function ($id) {
                return view('tables.coach-form-actions', ['id' => $id]);
            })->label('Szerk.')->alignCenter(),
        ];
    }

    public function editForm($id) {
        return redirect()->route('coach.forms.create', ["id" => $id]);
    }

    public function showForm($id) {
        $form = Form::find($id);
        return redirect()->route('coach.forms.show', $form);
    }

    protected function getStatus($status, $turn_in, $processed) {
        $status = $return = Form::STATUS[$status];
        if($turn_in) $return = $status . '<br><span class="text-sm">Benyújtva: ' . date("Y.m.d H:i", strtotime($turn_in)) .'</span>';
        if($processed) $return = $status . '<br><span class="text-sm">Feldolgozva: ' . date("Y.m.d H:i", strtotime($processed)) .'</span>';
        return $return;
    }
}
