<?php

namespace App\Http\Resources\Employees;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->employeeDetail->name,
            'phone_number' => $this->employeeDetail->phone_number,
            'address' => $this->employeeDetail->address,
        ];
    }
}
