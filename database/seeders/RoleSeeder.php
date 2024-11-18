<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Helpers\EnumHelper;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = EnumHelper::toArray(RoleEnum::class);

        foreach ($roles as $index => $role) {
            Role::create([
                'name' => $role
            ]);

            $user = User::query()->create([
                'name' => $role,
                'email' => strtolower(str_replace(' ', '_', $role)) . '@gmail.com',
                'password' => bcrypt('password'),
                'remember_token' => str_random(10),
                'email_verified_at' => now(),
                'company_id' => ($role != RoleEnum::SUPER_ADMIN->value) ? Company::query()->first()->id : null
            ]);

            $user->assignRole($role);
        }
    }
}
