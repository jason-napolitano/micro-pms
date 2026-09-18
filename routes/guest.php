<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    // -----------------------------------------------------------------
    // create initial admin user
    Route::middleware('handle.application.setup')->prefix('setup')->group(function () {
        Route::inertia('', 'setup')->name('setup');
        Route::post('', Controllers\SetupController::class)->name('setup.store');
    });

    // -----------------------------------------------------------------
    // login
    Route::middleware('handle.login.requests')->group(function () {
        Route::inertia('login', 'auth/login')->name('login');
        Route::post('login', Controllers\Auth\LoginController::class)->name('login.store');
    });
});
