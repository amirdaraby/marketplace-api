<?php

namespace App\Http\Services;

use App\Enums\RolesEnum;
use App\Http\Requests\v1\Market\StoreRequest;
use App\Repositories\Market\MarketRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MarketService
{

    public function __construct(protected MarketRepositoryInterface $marketRepository, protected UserRepositoryInterface $userRepository, protected RoleRepositoryInterface $roleRepository)
    {
    }

    public function createMarket(StoreRequest $attributes)
    {
        DB::beginTransaction();
        try {
            $sellerRole = $this->roleRepository->findByName(RolesEnum::SELLER->value);
            $this->userRepository->updateById($attributes->validated('user_id'), ['role_id' => $sellerRole->id]);

            $market = $this->marketRepository->create([
                'name' => $attributes->validated('market_name'),
                'user_id' => $attributes->validated('user_id'),
            ]);

            $market->location()->create([
                'x' => $attributes->validated('location_x'),
                'y' => $attributes->validated('location_y'),
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new $e;
        }

        return $market;
    }
}
