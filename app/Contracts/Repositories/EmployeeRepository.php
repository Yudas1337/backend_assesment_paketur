<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\EmployeeInterface;
use App\Enums\RoleEnum;
use App\Models\User;

class EmployeeRepository extends BaseRepository implements EmployeeInterface
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete($id);
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->role(RoleEnum::EMPLOYEE->value)
            ->with('employeeDetail')
            ->whereRelation('employeeDetail', 'company_id', '=', auth()->user()->employeeDetail->company_id)
            ->findOrFail($id);
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->role(RoleEnum::EMPLOYEE->value)
            ->with('employeeDetail')
            ->whereRelation('employeeDetail', 'company_id', '=', auth()->user()->employeeDetail->company_id)
            ->when(request()->sort, fn($query) => $query->orderBy('id', request()->sort))
            ->when(request()->search, fn($query) => $query->searchRelation('employeeDetail', 'name', request()->search))
            ->paginate(request()->perPage);
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
        $user = $this->model->query()->create([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $user->employeeDetail()->create([
            'name' => $data['name'],
            'user_id' => $user->id,
            'company_id' => $data['company_id'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address']
        ]);


        $user->assignRole(RoleEnum::EMPLOYEE->value);

        return $user;

    }

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        $show = $this->show($id);

        $show->update([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $show->employeeDetail()->update([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
        ]);

        return $show;
    }
}
