<?php

namespace App\Http\Controllers\Api\Manager;

use App\Contracts\Interfaces\ManagerInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\UpdateManagerRequest;
use App\Response\HttpResponse;
use Illuminate\Http\JsonResponse;

class UpdateManagerController extends Controller
{
    public function __construct(
        private readonly ManagerInterface $manager
    )
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param UpdateManagerRequest $request
     * @return JsonResponse
     */
    public function __invoke(UpdateManagerRequest $request): JsonResponse
    {
        $this->manager->update(auth()->id(), $request->validated());

        return HttpResponse::success(
            message: trans('alert.update_success'),
        );
    }
}
