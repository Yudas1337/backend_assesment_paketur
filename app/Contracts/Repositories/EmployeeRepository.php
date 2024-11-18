<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\EmployeeInterface;
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
        // TODO: Implement delete() method.
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        // TODO: Implement get() method.
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
        $role = $data['role'];
        $data['password'] = bcrypt($data['password']);

        unset($data['role']);
        $user = $this->model->query()->create($data);

        $user->assignRole($role);
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
        // TODO: Implement update() method.
    }
}
