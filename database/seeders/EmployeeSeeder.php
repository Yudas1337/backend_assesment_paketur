<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(1)
            ->create()
            ->each(function (User $user) {
                $user->assignRole(RoleEnum::EMPLOYEE->value);
                $user->employeeDetail()->create([
                    'name' => fake()->name(),
                    'phone_number' => fake()->unique()->phoneNumber(),
                    'company_id' => Company::query()->first()->id,
                    'address' => fake()->address(),
                ]);
            });
    }
}
