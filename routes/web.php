<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

//auth group
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    //organizer group
    Route::middleware(['checkType:organizer'])->prefix('organizer')->name('organizer.')->group(function () {
        Route::view('forms', 'organizer.forms')->name('forms');
    });

    //Coach group TODO: middlewares
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
    });

    //Super group
    Route::middleware(['checkType:super'])->prefix('super')->name('super.')->group(function () {
        Route::view('users', 'super.users')->name('users');
        Route::view('payments', 'super.payments')->name('payments');
    });
});

//competitors import
Route::post('competitorsUpload', [\App\Http\Controllers\Admin\competitorController::class, 'upload'])->name('competitorsUpload');
//stripe webhook
Route::stripeWebhooks('stripe-webhook');

//File views
Route::get('/file/{filename}', function ($filename = '') {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//Invoice views
Route::get('/invoice/{filename}', function ($filename = '') {
    $path = storage_path('app/invoice/' . $filename);
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
