<?php

namespace App\Interfaces;

interface RepositoryInterface {
    public function get($limit, array $columns, array $filters, array $includes, $sort);
    public function getById($id, $columns, array $includes);
    public function save($data);
    public function update($data, $id);
    public function delete($id);
}