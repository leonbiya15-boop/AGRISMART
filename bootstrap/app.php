<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EstAdministrateur::class,
            'contremaitre' => \App\Http\Middleware\EstContremaitre::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthorizationException $e, $request) {
            if (! $request->expectsJson()) {
                return back()->with('error', "Vous n'avez pas encore accès à cette action.");
            }
        });

        $exceptions->render(function (HttpExceptionInterface $e, $request) {
            if ($e->getStatusCode() === 403 && ! $request->expectsJson()) {
                return back()->with('error', "Vous n'avez pas encore accès à cette action.");
            }
        });
    })->create();