<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function listByMarketIds(array $marketIds, array $columns = ['*'], array $relations = []);

}
