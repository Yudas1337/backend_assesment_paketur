<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Interfaces\ManagerInterface;
use App\Helpers\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\UpdateManagerRequest;
use App\Http\Resources\Manager\ManagerDetailResource;
use App\Http\Resources\Manager\ManagerPaginateResource;
use App\Models\User;
use App\Response\HttpResponse;
use Illuminate\Http\JsonResponse;

class ManagerController extends Controller
{
    public function __construct(
        private readonly ManagerInterface $manager
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = $this->manager->get();
        return HttpResponse::success(
            ManagerPaginateResource::make($data, PaginateHelper::getPaginate($data)),
            trans('alert.fetch_data_success'),
            pagination: true
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $manager): JsonResponse
    {
        return HttpResponse::success(
            ManagerDetailResource::make($this->manager->show($manager->id)),
            trans('alert.fetch_data_success')
        );
    }

    /**
     * Update Manager From Current Session.
     *
     * @param UpdateManagerRequest $request
     * @param User $manager
     * @return JsonResponse
     */
    public function update(UpdateManagerRequest $request, User $manager): JsonResponse
    {
        $this->manager->update(auth()->id(), $request->validated());

        return HttpResponse::success(
            message: trans('alert.update_success'),
        );
    }
}
