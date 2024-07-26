<?php

use App\Http\Controllers\QrController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\VerifyPaymentController;
use Illuminate\Support\Facades\Route;


Route::resource('verify-payment'    , VerifyPaymentController::class);
Route::resource('qr'                , QrController::class);




Route::resource('email/verify/do', VerifyEmailController::class)
    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
    ->name('index','verification.verify');
Route::get('/', function () {return view('index');});

