<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Interfaces\EmployeeInterface;
use App\Helpers\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employees\EmployeeDetailResource;
use App\Http\Resources\Employees\EmployeePaginateResource;
use App\Models\User;
use App\Response\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
