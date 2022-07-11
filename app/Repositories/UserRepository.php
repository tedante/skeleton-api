<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository {

    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function get($limit = 15, array $columns = ['*'], array $filters = [], array $includes = [], $sort = ["created_at"]) {
        $data = QueryBuilder::for(User::class)
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
        $data = QueryBuilder::for(User::class)
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

        $model->title = $data['title'];
        $model->description = $data['description'];

        $model->save();

        return $model->fresh();
    }

    public function update($data, $id) {
        
        $model = $this->model->find($id);

        $model->title = $data['title'];
        $model->description = $data['description'];

        $model->update();

        return $model;
    }

    public function delete($id) {
        
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }
}