<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function list(array $columns = ["*"], array $relations = [], string $orderBy = null, string $orderByDirection = 'asc')
    {
        return $this->model->query()->select($columns)->with($relations)
            ->when($orderBy, fn(Builder $query) => $query->orderBy($orderBy, $orderByDirection))
            ->get();
    }

    public function listPaginated(array $columns = ["*"], array $relations = [], int $perPage = 50, string $orderBy = null, string $orderByDirection = 'asc')
    {
        return $this->model->query()->select($columns)->with($relations)
            ->when($orderBy, fn(Builder $query) => $query->orderBy($orderBy, $orderByDirection))
            ->paginate($perPage);
    }


    public function findOrFailById(int $id, array $columns = ["*"], array $relations = [])
    {
        return $this->model->query()->select($columns)->with($relations)->findOrFail($id);
    }

    public function findOrNullById(int $id, array $columns = ["*"], array $relations = [])
    {
        return $this->model->query()->select($columns)->with($relations)->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->query()->create($attributes);
    }

    public function updateById(int $id, array $attributes = [])
    {
        return $this->model->query()->findOrFail($id)->lockForUpdate()->update($attributes);
    }

    public function deleteById(int $id)
    {
        return $this->model->query()->findOrFail($id)->delete();
    }

}
