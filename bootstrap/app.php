<?php

use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\checkIfAuthenticated;
use App\Http\Middleware\checkIfOsa;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));

        $middleware->alias([
            'admin' => CheckIfAdmin::class,
            'osa' => checkIfOsa::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
