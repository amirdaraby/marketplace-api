<?php

namespace App\Repositories\UserAccessToken;

interface UserAccessTokenRepositoryInterface
{
    public function generate(int $userId);

}
