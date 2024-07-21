<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function findByName(string $name)
    {
        return $this->model->query()->where('name', '=', $name)->firstOrFail();
    }

}
