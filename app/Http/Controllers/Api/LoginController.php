<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Response\HttpResponse;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginService $service
    )
    {
    }

    /**
     * Handle Login user.
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $handle = $this->service->handleLogin($request);

        if (!$handle) return HttpResponse::error(message: trans('alert.login_failed'));

        return HttpResponse::success(
            LoginResource::make($handle),
            trans('alert.login_success'));
    }
}
