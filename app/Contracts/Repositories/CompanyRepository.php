<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\CompanyInterface;
use App\Models\Company;

class CompanyRepository extends BaseRepository implements CompanyInterface
{
    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    /**
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }
}
