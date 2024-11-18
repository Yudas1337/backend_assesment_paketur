<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ManagerInterface;
use App\Models\User;

class ManagerRepository extends BaseRepository implements ManagerInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
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
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        // TODO: Implement show() method.
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
