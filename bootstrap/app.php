<?php

use App\Http\Middleware\JwtMiddleware;
use App\Response\HttpResponse as ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'jwt' => JwtMiddleware::class,
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ResponseHelper::error(message: trans('alert.invalid_token'));
            }
            return ResponseHelper::error(message: "Invalid Request");
        });

        $exceptions->render(function (UnauthorizedException $e, Request $request) {
            if ($request->is('api/*') && $e->getStatusCode() == Response::HTTP_FORBIDDEN) {
                return ResponseHelper::error(message: trans('alert.invalid_authorization'));
            }
            return ResponseHelper::error(message: "Invalid Request");
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {

            if ($request->is('api/*')) {
                return ResponseHelper::error(message: trans('alert.data_not_found'));
            }
            return ResponseHelper::error(message: "Invalid Request");
        });
    })->create();
