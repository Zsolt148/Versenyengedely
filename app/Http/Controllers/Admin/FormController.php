<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index() {
        $formsCount = Form::query()
            ->where('status', Form::STATUS_PENDING)
            ->count();

        return view('admin.forms.index', [
            'formsCount' => $formsCount,
        ]);
    }

    public function edit() {
        return view('admin.forms.edit');
    }
}
