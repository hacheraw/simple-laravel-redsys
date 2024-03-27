<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    if (config('config.home.active')) {
        return view('welcome');
    }
    return redirect()->away(config('config.home.redirect_url'));
})->name('home');

Route::get('/pay/{code}', [Controllers\OrderController::class, 'pay'])->name('pay');
Route::get('/ok/{uuid}', [Controllers\OrderController::class, 'status'])->name('ok');
Route::get('/ko/{uuid}', [Controllers\OrderController::class, 'status'])->name('ko');