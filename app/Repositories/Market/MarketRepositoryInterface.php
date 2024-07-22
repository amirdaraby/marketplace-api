<?php

namespace App\Repositories\Market;

use App\Repositories\BaseRepositoryInterface;

interface MarketRepositoryInterface extends BaseRepositoryInterface
{
    public function listNearly(int $x, int $y, array $columns = ['markets.*'], array $relations = []);
}
