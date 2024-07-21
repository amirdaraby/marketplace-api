<?php

namespace App\Repositories\User;

use App\Enums\RolesEnum;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{

    public function listByRole(RolesEnum $role, array $columns = ["users.*"], array $relations = []);
}
