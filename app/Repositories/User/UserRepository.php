<?php

namespace App\Repositories\User;

use App\Enums\RolesEnum;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function listByRole(RolesEnum $role, array $columns = ["users.*"], array $relations = [])
    {
        return $this->model->query()->select($columns)->with($relations)
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', '=', $role->value)
            ->get();
    }
}
