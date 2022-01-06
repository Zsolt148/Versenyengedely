<?php

use App\Http\Controllers\Admin\CompetitorController;
use App\Http\Controllers\Admin\FormController as AdminFormController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

//Email verification
Route::get('/email/verify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return view('auth.verify-email');
})->middleware(['auth', 'throttle:6,1'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
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

        Route::get('/forms/success', [FormController::class, 'success']);
        Route::get('/forms/cart', [FormController::class, 'cart'])->name('forms.cart');
        Route::post('/forms/checkout', [FormController::class, 'checkout'])->name('forms.checkout');

        Route::get('licences', [FormController::class, 'licences'])->name('licences');
        Route::get('payments', [FormController::class, 'payments'])->name('payments');

        Route::resource('forms', FormController::class);
    });

    //Admin group
    Route::middleware(['checkType:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('teams', [TeamController::class, 'index'])->name('teams.index');

        Route::get('competitors', [CompetitorController::class, 'index'])->name('competitors.index');
        Route::post('competitorsUpload', [CompetitorController::class, 'upload'])->name('competitorsUpload');

        Route::get('forms', [AdminFormController::class, 'index'])->name('forms.index');
        Route::get('forms/edit', [AdminFormController::class, 'edit'])->name('forms.edit');

        Route::get('forms/export', [ExportController::class, 'adminForms'])->name('forms.export');
    });

    //Super group
    Route::middleware(['checkType:super'])->prefix('super')->name('super.')->group(function () {

        Route::view('users', 'super.users')->name('users');
        Route::view('payments', 'super.payments')->name('payments');

        Route::get('payments/export', [ExportController::class, 'superPayments'])->name('payments.export');
    });
});

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
