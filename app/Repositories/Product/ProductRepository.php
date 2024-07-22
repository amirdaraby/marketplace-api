<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function listByMarketIds(array $marketIds, array $columns = ['*'], array $relations = [])
    {
        return $this->model->query()->select($columns)->with($relations)->whereIn('market_id', $marketIds)->get();
    }
}
