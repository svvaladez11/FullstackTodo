<?php

use App\Ship\Core\Loaders\MiddlewaresLoader;
use App\Ship\Core\Loaders\RoutesLoader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [new RoutesLoader()->loadWebRoutes()],
        api: [new RoutesLoader()->loadApiRoutes()],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append([new MiddlewaresLoader()->loadMiddlewares()]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
    })->create();
