<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Helpers\EnumHelper;
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

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
