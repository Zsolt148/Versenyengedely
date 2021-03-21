<?php

namespace App\Http\Controllers;

use App\Exports\FormsExport;
use App\Exports\PaymentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function adminForms() {
        return Excel::download(new FormsExport(), 'engedelyek.xlsx');
    }

    public function superPayments() {
        return Excel::download(new PaymentsExport(), 'payments.xlsx');
    }
}
