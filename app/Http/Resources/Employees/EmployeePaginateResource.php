<?php

namespace App\Http\Resources\Employees;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePaginateResource extends JsonResource
{
    protected array $paginate;

    public function __construct($resource, $paginate)
    {
        parent::__construct($resource);
        $this->paginate = $paginate;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = collect($this->resource->items())->map(function ($user) {
            return [
                'name' => $user->name,
                'phone_number' => $user->phone_number,
                'address' => $user->address,
            ];

        })->all();

        return [
            'data' => $data,
            'paginate' => $this->paginate,
        ];
    }
}
