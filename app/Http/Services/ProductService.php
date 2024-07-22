<?php

namespace App\Http\Services;

use App\Repositories\Market\MarketRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class ProductService
{

    public function __construct(protected UserRepositoryInterface $userRepository, protected MarketRepositoryInterface $marketRepository, protected ProductRepositoryInterface $productRepository)
    {
    }

    public function productFromNearlyMarkets(int $userId)
    {
        $user = $this->userRepository->findOrFailById($userId, relations: ['location']);

        $location = $user->location;

        $markets = $this->marketRepository->listNearly($location->x, $location->y);

        $products = $this->productRepository->listByMarketIds($markets->pluck('id')->toArray());

        return $products;
    }
}
