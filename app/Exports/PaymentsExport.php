<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, WithColumnWidths, ShouldAutoSize
{
    use Exportable;

    public function query()
    {
        return Payment::query();
    }

    public function map($payment): array
    {
        $competitors = array();
        foreach($payment->forms as $form) {
            array_push($competitors, $form->vnev . ' ' . $form->knev);
        }
        return [
            $payment->id,
            $payment->stripe_id,
            $payment->user->address->name, //team
            $payment->user->address->address . ' ' . $payment->user->address->zip,
            $payment->user->address->tax_id,
            $payment->user->name,
            $payment->user->email,
            implode(",", $competitors),
            substr($payment->amount_total, 0, -2),
            Date::dateTimeToExcel($payment->created_at),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'H' => 55,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'J' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    public function headings(): array
    {
        return [
            '#ID',
            'Stripe ID',
            'Egyesület',
            'Egyesület Címe',
            'Adószáma',
            'Fizető',
            'Fizető email címe',
            'Sportolók',
            'Összesen',
            'Létrehozva',
        ];
    }
}
