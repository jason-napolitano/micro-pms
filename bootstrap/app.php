<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Configuration;
use Illuminate\Foundation\Application;
use Inertia\ExceptionResponse;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/verified.php',
            __DIR__ . '/../routes/guest.php',
        ]
    )
    ->withMiddleware(function (Configuration\Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class
        ]);
    })
    ->withExceptions(function (): void {
        Inertia::handleExceptionsUsing(callback: static function (ExceptionResponse $response) {
            $codes = [403, 404, 419, 500, 503];
            if (in_array($response->statusCode(), $codes, true)) {
                return $response->render('error', [
                    'status' => $response->statusCode(),
                ])->withSharedData();
            }
        });
    })->create();
