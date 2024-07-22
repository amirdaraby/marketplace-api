<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [];
        $roleEnums = RolesEnum::values();

        foreach ($roleEnums as $roleEnum) {
            $roles[$roleEnum] = Role::query()->createOrFirst([
                'name' => $roleEnum,
            ]);
        }
    }
}
