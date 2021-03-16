<?php

namespace App\Http\Controllers;

use App\Exports\PaymentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function superPayments() {
        return Excel::download(new PaymentsExport(), 'payments.xlsx');
    }
}
