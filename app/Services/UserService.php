<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($query) {
        $limit = $query["limit"] ?? 15;
        $columns = $this->getColumns($query); // ?fields[users]=id,name
        $filters = $this->getFilters($query); // ?filter[name]=hane&filter[is_active]=1
        $includes = $this->getIncludes($query); // ?include=categories
        $sort = $this->getSort($query); // ?sort=-id,name

        $data = $this->repository->get($limit, $columns, $filters, $includes, $sort);

        return $data;
    }

    public function getColumns($query) {
        if (isset($query["fields"]["users"])) {
            $columns = explode(",", $query["fields"]["users"]);

            return $columns;
        }

        return ['*'];
    }

    public function getIncludes($query) {
        if (isset($query["include"])) {
            $includes = []; 

            $includes = explode(",", $query["include"]);

            return $includes;
        }

        return [];
    }
    
    public function getFilters($query) {
        if (isset($query["filter"])) {
            $filters = [];

            foreach($query["filter"] as $key => $value) {
                array_push($filters, $key);
            }

            return $filters;
        }

        return [];
    }
    
    public function getSort($query) {
        if (isset($query["sort"])) {
            $sort = [];

            $sort = explode(",", $query["sort"]);

            return $sort;
        }

        return ['created_at'];
    }
}
