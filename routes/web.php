<?php
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;



$verificationLimiter = config('fortify.limiters.verification', '6,1');

Route::get('/', function () {
    return view('index');
});


Route::resource('email/verify/do', VerifyEmailController::class)
    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'throttle:'.$verificationLimiter])
    ->name('index','verification.verify');
Route::resource('qr'                , 'QrController');

