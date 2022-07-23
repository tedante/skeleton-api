<?php

namespace App\Repositories;

use Spatie\QueryBuilder\QueryBuilder;
use App\Interfaces\RepositoryInterface;

class BaseRepository implements RepositoryInterface {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function get($limit = 15, array $columns = ['*'], array $filters = [], array $includes = [], $sort = ["created_at"]) {
        $data = QueryBuilder::for($this->model)
                                ->allowedFields($columns)
                                ->allowedFilters($filters)
                                ->allowedIncludes($includes)
                                ->allowedSorts($sort)
                                ->paginate(
                                    $limit,
                                    $columns
                                );

        return $data;
    }

    public function getById($id, $columns = ['*'], array $includes = []) {
        $data = QueryBuilder::for($this->model)
                                ->allowedFields($columns)
                                ->allowedIncludes($includes)
                                ->find(
                                    $id,
                                    $columns
                                );

        return $data;
    }

    public function save($data) {
        $model = new $this->model;

        $result = $model::create($data);

        return $result;
    }

    public function update($data, $id) {
        $result = $this->model->find($id);

        $result->update($data);

        return $result;
    }

    public function delete($id) {
        $result = $this->model->find($id);
        $result->delete();

        return $result;
    }
}