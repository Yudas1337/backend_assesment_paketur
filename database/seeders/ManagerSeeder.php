<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->create()
            ->each(function (User $user) {
                $user->assignRole(RoleEnum::MANAGER->value);
                $user->employeeDetail()->create([
                    'name' => fake()->name(),
                    'phone_number' => fake()->unique()->phoneNumber(),
                    'company_id' => Company::query()->first()->id,
                    'address' => fake()->address(),
                ]);
            });

        // for fixed employee for testing
        $user = User::query()
            ->create([
                'email' => 'manager@gmail.com',
                'password' => bcrypt('password'),
                'remember_token' => str_random(10),
                'email_verified_at' => now(),
            ]);

        $user->assignRole(RoleEnum::MANAGER->value);
        $user->employeeDetail()->create([
            'name' => fake()->name(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'company_id' => Company::query()->first()->id,
            'address' => fake()->address(),
        ]);
    }
}
