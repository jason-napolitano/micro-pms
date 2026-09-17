<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // -------------------------------------
    // index redirect (temporary fix)
    Route::redirect('', 'properties');

    // -------------------------------------
    // make-ready's
    Route::prefix('make-ready')->group(function () {
        Route::post('', [Controllers\MakeReadyController::class, 'store'])
            ->name('make-ready.store');

        Route::patch('status/{makeReady}', [Controllers\MakeReadyController::class, 'updateStatus'])
            ->name('make-ready.update-status');

        // -------------------------------------
        // make-ready items
        Route::patch('item/schedule/{item}', [Controllers\MakeReadyItemController::class, 'updateScheduling'])
            ->name('make-ready.item.update-schedule');

        Route::patch('item/assignee/{item}', [Controllers\MakeReadyItemController::class, 'updateAssignee'])
            ->name('make-ready.item.update-assignee');

        Route::patch('item/notes/{item}', [Controllers\MakeReadyItemController::class, 'updateNotes'])
            ->name('make-ready.item.update-notes');

        Route::patch('item/status/{item}', [Controllers\MakeReadyItemController::class, 'updateStatus'])
            ->name('make-ready.item.update-status');

        // -------------------------------------
        // make-ready item types
        Route::patch('types/visibility', [Controllers\MakeReadyController::class, 'updateVisibleItems'])
            ->name('make-ready.items.type.visibility')->withTrashed();

        Route::patch('types/reorder', [Controllers\MakeReadyController::class, 'reorder'])
            ->name('make-ready.items.types.reorder')->withTrashed();
    });

    // -------------------------------------
    // properties
    Route::prefix('properties')->group(function () {
        Route::get('', [Controllers\PropertyController::class, 'index'])
            ->name('properties.index');

        Route::delete('{property}', [Controllers\PropertyController::class, 'destroy'])
            ->name('properties.destroy');

        Route::get('{property:code}', [Controllers\PropertyController::class, 'show'])
            ->name('properties.show');

        Route::post('', [Controllers\PropertyController::class, 'store'])
            ->name('properties.store');
    });

    // -------------------------------------
    // units
    Route::prefix('units')->group(function () {
        Route::post('{unit}', [Controllers\UnitController::class, 'destroy'])
            ->name('units.destroy');

        Route::post('', [Controllers\UnitController::class, 'store'])
            ->name('units.store');
    });

    // -------------------------------------
    // floor-plans
    Route::prefix('floor-plans')->group(function () {
        Route::post('{floorPlan}', [Controllers\FloorPlanController::class, 'destroy'])
            ->name('floor-plans.destroy');

        Route::post('', [Controllers\FloorPlanController::class, 'store'])
            ->name('floor-plans.store');
    });

    // -------------------------------------
    // users
    Route::prefix('users')->group(function () {
        Route::get('', [Controllers\UserController::class, 'index'])
            ->name('users.index');

        Route::get('profile/{user:username?}', [Controllers\UserController::class, 'show'])
            ->name('users.show');

        Route::patch('{user}', [Controllers\UserController::class, 'update'])
            ->name('users.update');

        Route::post('', [Controllers\UserController::class, 'store'])
            ->name('users.store');

        Route::delete('{user}', [Controllers\UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::post('image', [Controllers\UserController::class, 'updateImage'])
            ->name('users.image');

        Route::patch('assign-property/{user}/{property}', [Controllers\UserController::class, 'assignProperty'])
            ->name('users.assign-property');
    });

    // -------------------------------------
    // vendors
    Route::resource('vendors', Controllers\VendorController::class);

    // ------------------------------------------------------------------------
    // logout
    Route::post('logout', Controllers\Auth\LogoutController::class)
        ->name('logout');
});
