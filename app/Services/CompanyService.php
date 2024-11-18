<?php

namespace App\Services;

use App\Contracts\Interfaces\CompanyInterface;
use App\Contracts\Interfaces\ManagerInterface;
use App\Jobs\ManagerAccountCreated;

readonly class CompanyService
{
    public function __construct(
        private CompanyInterface $company,
        private ManagerInterface $manager
    )
    {
    }


    /**
     * Handle Dispatch Manager Account.
     * @param array $data
     * @return bool|object
     */
    public function handleStoreCompany(array $data): void
    {
        $created_company = $this->company->store($data);

        dispatch(new ManagerAccountCreated($created_company, $this->manager));

    }

}
