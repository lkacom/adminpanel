<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome2');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('qr-code', function () {
    $path = public_path().'/qr-code.png';
    $filename = '/qr-code.png';
    QRCode::text('QR Code Generator for Laravel!')
        ->setOutfile($path )
        ->png();
    return '<img src=' . $filename . '>';
});

