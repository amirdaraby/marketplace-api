<?php

namespace App\Repositories\Market;

use App\Models\Market;
use App\Repositories\BaseRepository;
use Illuminate\Database\Query\Builder;

class MarketRepository extends BaseRepository implements MarketRepositoryInterface
{
    public function __construct(Market $model)
    {
        parent::__construct($model);
    }

    public function listNearly(int $x, int $y, array $columns = ['markets.*'], array $relations = [])
    {
        return $this->model->query()->withWhereHas('location', function (Builder $query) use ($x, $y) {
            return $query->where(fn(Builder $query) => $query->where('x', '>=', $x + 20)->where('y', '>=', $y + 20))
                ->orWhere(fn(Builder $query) => $query->where('x', '<=', $x - 20)->where('y', '<=', $y - 20));
        });
    }
}
