<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class formController extends Controller
{
    public function index() {
        return view('admin.forms.index');
    }

    public function edit() {
        return view('admin.forms.edit');
    }
}
