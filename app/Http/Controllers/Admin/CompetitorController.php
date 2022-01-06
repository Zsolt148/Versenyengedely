<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CheckComptetitorImport;
use App\Imports\CompetitorImport;
use App\Mail\NewCompetitorsImport;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Mail;

class CompetitorController extends Controller
{
    public function index() {
        return view('admin.competitors');
    }

    public function upload(Request $request) {
        
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $import = new CompetitorImport;
        Excel::import($import, $request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);

        $missingComps = $import->getMissingComps();
        $youngComps = $import->getYoungComps();

        if($missingComps || $youngComps) {
            Mail::to(auth()->user())->queue(new NewCompetitorsImport($missingComps, $youngComps));
        }

        return redirect()->back()->with('status', 'Sikeres importálás!');
    }
}
