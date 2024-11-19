<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = RoleEnum::SUPER_ADMIN->value;
        $user = User::query()->create([
            'email' => strtolower(str_replace(' ', '_', $role)) . '@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($role);
    }
}
