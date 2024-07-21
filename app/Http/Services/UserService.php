<?php

namespace App\Http\Services;

use App\Enums\RolesEnum;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{

    public function __construct(protected UserRepositoryInterface $userRepository, protected RoleRepositoryInterface $roleRepository)
    {
    }

    public function createUser(array $creditinals, RolesEnum $role)
    {
        $role = $this->roleRepository->findByName($role->value);

        $creditinals['role_id'] = $role->id;

        return $this->userRepository->create($creditinals);
    }
}
