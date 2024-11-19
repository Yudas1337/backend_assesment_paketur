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
            'company_id' => $data['company_id']
        ]);


        $user->assignRole($data['role']);

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
            ->findOrFail($id);
    }
}
