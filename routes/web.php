<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

//Email verification
Route::get('/email/verify', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return view('auth.verify-email');
})->middleware(['auth', 'throttle:6,1'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

/*
Route::get('/license/test', function () {
    $form = \App\Models\Form::find(34);
    //\Illuminate\Support\Facades\Mail::to('test-xf8e00acq@srv1.mail-tester.com')->queue(new \App\Mail\FormAccepted($form));
    $pdf = PDF::loadView('coach.license', compact('form'));
    return $pdf->stream();
    //App\Jobs\createLicenseJob::dispatch($form); //license create
});
*/
//auth group
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    //organizer group
    Route::middleware(['checkType:organizer'])->prefix('organizer')->name('organizer.')->group(function () {
        Route::view('forms', 'organizer.forms')->name('forms');
    });

    Route::middleware(['checkType:coach'])->prefix('coach')->name('coach.')->group(function () {
        Route::get('/forms/success', [\App\Http\Controllers\formController::class, 'success']);
        Route::get('/forms/cart', [\App\Http\Controllers\formController::class, 'cart'])->name('forms.cart');
        Route::post('/forms/checkout', [\App\Http\Controllers\formController::class, 'checkout'])->name('forms.checkout');
        Route::resource('forms', \App\Http\Controllers\formController::class);
        Route::get('licences', [\App\Http\Controllers\formController::class, 'licences'])->name('licences');
        Route::get('payments', [\App\Http\Controllers\formController::class, 'payments'])->name('payments');
    });

    //Admin group
    Route::middleware(['checkType:admin'])->prefix('admin')->name('admin.')->group(function () {
        //Route::resource('teams', \App\Http\Controllers\Admin\teamController::class);
        Route::get('teams', [\App\Http\Controllers\Admin\teamController::class, 'index'])->name('teams.index');
        Route::get('competitors', [\App\Http\Controllers\Admin\competitorController::class, 'index'])->name('competitors.index');
        Route::get('forms', [\App\Http\Controllers\Admin\formController::class, 'index'])->name('forms.index');
        Route::get('forms/edit', [\App\Http\Controllers\Admin\formController::class, 'edit'])->name('forms.edit');

        Route::get('forms/export', [\App\Http\Controllers\ExportController::class, 'adminForms'])->name('forms.export');
    });

    //Super group
    Route::middleware(['checkType:super'])->prefix('super')->name('super.')->group(function () {
        Route::view('users', 'super.users')->name('users');
        Route::view('payments', 'super.payments')->name('payments');

        Route::get('payments/export', [\App\Http\Controllers\ExportController::class, 'superPayments'])->name('payments.export');
    });
});

//competitors import
Route::post('competitorsUpload', [\App\Http\Controllers\Admin\competitorController::class, 'upload'])->name('competitorsUpload');
//stripe webhook
Route::stripeWebhooks('stripe-webhook');

//Docs files
Route::get('/docs/{filename}', function ($filename = '') {
    $path = public_path('docs/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//File views
Route::get('/file/{filename}', function ($filename = '') {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//bizonylat views
Route::get('/receipt/{filename}', function ($filename = '') {
    $path = storage_path('app/receipt/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//license views
Route::get('/license/{filename}', function ($filename = '') {
    $path = storage_path('app/license/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//mandate views
Route::get('/mandate/{filename}', function ($filename = '') {
    $path = storage_path('app/mandate/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});
