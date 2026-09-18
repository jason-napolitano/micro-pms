<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration;
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
            HandleInertiaRequests::class,
        ]);
        $middleware->alias([
            'handle.application.setup' => \App\Http\Middleware\HandleApplicationSetup::class,
            'handle.login.requests'    => \App\Http\Middleware\HandleLoginRequests::class,
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
