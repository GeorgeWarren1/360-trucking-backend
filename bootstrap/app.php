<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\IdentifyTenant;
use App\Exceptions\Handler;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function () {
        return [
            IdentifyTenant::class,
        ];
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Set the exception handler
        // Check for a method in Exceptions to set the handler.
        // Without official docs, we guess that we return the handler class here.
        return Handler::class;
    })
    ->create();
