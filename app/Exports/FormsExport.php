<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FormsExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function query()
    {
        return Form::query()
            ->with('team')
            ->where('status', 'accepted')
            ->where('payment', 'done')
            ->where('license', '<>', null);
    }

    public function map($form): array
    {
        return [
            $form->id,
            $form->team->name,
            $form->vnev . ' ' . $form->knev,
            Date::dateTimeToExcel($form->processed),
            $form->federal_reg_code . '/' . $form->processed->format('Y')

        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    public function headings(): array
    {
        return [
            '#ID',
            'Egyesület',
            'Név',
            'Kiállítás kelte',
            'Engedély száma',
        ];
    }
}
