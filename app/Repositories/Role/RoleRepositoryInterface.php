<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function findByName(string $name);
}
