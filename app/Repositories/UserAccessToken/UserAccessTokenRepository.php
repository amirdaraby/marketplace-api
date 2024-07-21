<?php

namespace App\Repositories\UserAccessToken;

use App\Models\UserAccessToken;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class UserAccessTokenRepository extends BaseRepository implements UserAccessTokenRepositoryInterface
{
    public function __construct(UserAccessToken $model)
    {
        parent::__construct($model);
    }

    public function generate(int $userId)
    {
        return $this->create([
            'user_id' => $userId,
            'token' => hash('sha256', Str::random(60)),
        ]);
    }
}
