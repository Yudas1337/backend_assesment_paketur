<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\HttpResponse;
use App\Services\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct(
        private readonly LogoutService $service
    )
    {
    }

    /**
     * Handle Logout Request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->service->handleLogout();
        return HttpResponse::success(message: trans('alert.logout_success'));

    }
}
