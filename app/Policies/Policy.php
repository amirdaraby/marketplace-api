<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Policy
{
    public function default(User $user, Model $model): bool
    {
        if ($model instanceof Authenticatable) {
            return $user->id === $model->id || $user->role->name === RolesEnum::ADMIN;
        }

        return $user->id === $model->user->id || $user->role->name === RolesEnum::ADMIN;
    }
}
