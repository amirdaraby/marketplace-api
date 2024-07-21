<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
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

        $permissions = [];
        $permissionEnums = PermissionsEnum::values();
        foreach ($permissionEnums as $permissionEnum) {
            $permissions[$permissionEnum] = Permission::query()->createOrFirst([
                'name' => $permissionEnum,
            ]);
        }

        $roles[RolesEnum::ADMIN->value]->permissions()->sync(array_keys($permissions, 'id'));
        $roles[RolesEnum::SELLER->value]->permissions()->sync([
            $permissions[PermissionsEnum::SELLER_UPDATE->value]['id'],
            $permissions[PermissionsEnum::PRODUCT_CREATE->value]['id'],
            $permissions[PermissionsEnum::PRODUCT_UPDATE->value]['id'],
            $permissions[PermissionsEnum::PRODUCT_DELETE->value]['id'],
        ]);
    }
}
