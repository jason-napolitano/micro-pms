<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::middleware(['guest'])->group(function () {
    Route::inertia('register', 'auth/register')->name('register.index');
    Route::post('register', Controllers\Auth\RegisterController::class)->name('register.store');

    Route::inertia('login', 'auth/login')->name('login');
    Route::post('login', Controllers\Auth\LoginController::class)->name('login.store');
});
