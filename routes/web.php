<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    if (config('config.home.active')) {
        return view('welcome');
    }
    return redirect()->away(config('config.home.redirect_url'));
})->name('home');

Route::get('/pay/{id}', [Controllers\OrderController::class, 'pay'])->name('pay');