<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Interfaces\EmployeeInterface;
use App\Helpers\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\Employees\EmployeeDetailResource;
use App\Http\Resources\Employees\EmployeePaginateResource;
use App\Models\User;
use App\Response\HttpResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly EmployeeInterface $employee)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = $this->employee->get();
        return HttpResponse::success(
            EmployeePaginateResource::make($data, PaginateHelper::getPaginate($data)),
            trans('alert.fetch_data_success'),
            pagination: true
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return JsonResponse
     */
    public function store(EmployeeRequest $request): JsonResponse
    {
        return HttpResponse::success(
            $this->employee->store($request->validated()),
            trans('alert.add_success'),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $employee): JsonResponse
    {
        return HttpResponse::success(
            EmployeeDetailResource::make($this->employee->show($employee->id)),
            trans('alert.fetch_data_success')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param User $employee
     * @return JsonResponse
     */
    public function update(EmployeeRequest $request, User $employee): JsonResponse
    {
        $this->employee->update($employee->id, $request->validated());
        return HttpResponse::success(
            message: trans('alert.update_success')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $employee
     * @return JsonResponse
     */
    public function destroy(User $employee): JsonResponse
    {
        $this->employee->delete($employee->id);
        return HttpResponse::success(
            message: trans('alert.delete_success')
        );
    }
}
