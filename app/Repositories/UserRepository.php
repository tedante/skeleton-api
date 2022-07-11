<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    protected $model;
    
    protected $searchable = [];

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function get($limit = 15, array $columns = ['*'], array $filters = [], array $include = [], $orderBy = "created_at", $orderType = "asc") {
        $data =  $this
                    ->model::query();
        
        // if (isset($filters)) {
        //     foreach($filters as $key => $value) {
        //         $filters = explode(",", $value);
                
        //         foreach ($filters as $item) {
        //             $data = $data->where($key, 'like', "%".$item."%");
        //         }
        //     }
        // }

        $data = $data
                    ->orderBy($orderBy, $orderType)
                    ->paginate(
                        $limit,
                        $columns
                    );
        
        return $data;
    }

    public function getById($id, $columns = ['*']) {
        return $this
                ->model
                ->find($id, $columns);
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