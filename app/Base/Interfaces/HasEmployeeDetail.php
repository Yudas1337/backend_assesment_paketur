<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasEmployeeDetail
{
    /**
     * Get the employee detail of the user.
     */
    public function employeeDetail(): HasOne;
}
