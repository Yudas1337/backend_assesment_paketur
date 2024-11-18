<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Response\HttpResponse;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreCompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $company
    )
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreCompanyRequest $request): JsonResponse
    {
        $this->company->handleStoreCompany($request->validated());

        return HttpResponse::success(
            message: trans('alert.add_success'),
            code: Response::HTTP_CREATED
        );
    }
}
