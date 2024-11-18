<?php

namespace App\Http\Middleware;

use App\Response\HttpResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return HttpResponse::error(message: trans('alert.invalid_token'), code: Response::HTTP_UNAUTHORIZED);
            } else if ($e instanceof TokenExpiredException) {
                return HttpResponse::error(message: trans('alert.expired_token'), code: Response::HTTP_UNAUTHORIZED);
            } else {
                return HttpResponse::error(message: trans('alert.not_found_token'), code: Response::HTTP_UNAUTHORIZED);
            }
        }
        
        return $next($request);
    }
}
