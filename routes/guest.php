<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    // -----------------------------------------------------------------
    // create initial admin user
    Route::middleware('handle.admin.exists')->prefix('setup')->group(function () {
        Route::inertia('', 'setup/create-admin')->name('setup');
        Route::post('', Controllers\Setup\CreateInitialAdmin::class)->name('setup.store');
    });

    // -----------------------------------------------------------------
    // login
    Route::middleware('handle.application.setup')->group(function () {

        Route::inertia('login', 'auth/login')->name('login');
        Route::post('login', Controllers\Auth\LoginController::class)->name('login.store');
    });
});
