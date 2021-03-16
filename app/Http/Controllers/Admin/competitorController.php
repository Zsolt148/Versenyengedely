<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CheckComptetitorImport;
use App\Imports\CompetitorImport;
use Illuminate\Http\Request;
use Excel;

class competitorController extends Controller
{
    public function index() {
        return view('admin.competitors');
    }

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        Excel::import(new CompetitorImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);
        //Excel::import(new CheckComptetitorImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);

        return redirect()->back();
    }
}
