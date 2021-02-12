<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PaymentsTable extends LivewireDatatable
{
    public $model = Payment::class;
    public $exportable = true;

    public function builder() {
        return Payment::query()->where('payments.teams_id', '=', request()->user()->teams_id);
    }

    public function columns() {
        return [
            Column::name('id')->label('ID')->alignCenter(),
            Column::name('stripe_id')->label('Fizető azon.')->alignCenter(),
            Column::name('forms.vnev')->label('Engedélyek')->alignCenter(),
            Column::callback(['amount_subtotal'], function ($amount_subtotal) {
                return substr($amount_subtotal, 0, -2) . " Ft";
            })->label('Részösszeg')->alignCenter(),
            Column::callback(['amount_total'], function ($amount_total) {
                return substr($amount_total, 0, -2) . " Ft";
            })->label('Összesen')->alignCenter(),
            Column::callback(['invoice'], function ($data) {
                return '<a href="/invoice/'.$data.'" target="_blank" class="text-blue-500 underline">Számla</a>';
            })->label('Számla')->alignCenter(),
            DateColumn::name('created_at')->label('Létrehozva')->format('Y.m.d H:i:s')->alignCenter(),
        ];
    }
}
