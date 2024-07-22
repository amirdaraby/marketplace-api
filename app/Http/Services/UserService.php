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

    public function createUser(array $creditinals, RolesEnum $role, int $locationX, int $locationY)
    {
        $role = $this->roleRepository->findByName($role->value);

        $creditinals['role_id'] = $role->id;

        $user = $this->userRepository->create($creditinals);

        $user->location()->create([
            'x' => $locationX,
            'y' => $locationY,
        ]);

        return $this->userRepository->create($creditinals);
    }
}
