<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\User;

class UserPolicy extends Policy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, User $model)
    {
        return $this->default($user, $model);
    }

    public function update(User $user, User $model)
    {
        return $this->default($user, $model);
    }

    public function delete(User $user, User $model)
    {
        return $this->default($user, $model);
    }
}
