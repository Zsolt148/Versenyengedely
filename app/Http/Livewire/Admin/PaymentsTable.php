<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PaymentsTable extends LivewireDatatable
{
    public $model = Payment::class;
    public $exportable = false;
    public $customExport = 'super.payments.export';

    public function columns() {
        return [
            Column::name('id')->label('ID')->alignCenter(),
            Column::name('stripe_id')->label('Stripe azon.')->alignCenter(),
            Column::name('user.address.name')->label('Egyesület')->alignCenter()->searchable(),
            Column::callback(['user.address.zip', 'user.address.address'], function ($zip, $adr) {
                return $zip . ' ' . $adr;
            })->label('Címe')->alignCenter()->searchable(),
            Column::name('user.address.tax_id')->label('Adószáma')->alignCenter()->searchable(),
            Column::name('user.name')->label('Fizette')->alignCenter()->searchable(),
            Column::name('user.email')->label('Email')->alignCenter()->searchable(),
            Column::name('forms.vnev')->label('Sportolók')->truncate(30),
            //Column::callback(['amount_subtotal'], function ($amount_subtotal) {
            //    return substr($amount_subtotal, 0, -2) . " Ft";
            //})->label('Részösszeg')->alignCenter(),
            Column::callback(['amount_total'], function ($amount_total) {
                return substr($amount_total, 0, -2) . " Ft";
            })->label('Összesen')->alignCenter(),
            Column::callback(['receipt'], function ($data) {
                return '<a href="/receipt/'.$data.'" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Bizonylat</a>';
            })->label('Bizonylat')->alignCenter(),
            DateColumn::name('created_at')->label('Létrehozva')->format('Y.m.d H:i:s')->alignCenter(),
        ];
    }
}
