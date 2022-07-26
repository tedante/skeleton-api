<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\UserService;

class UserController extends Controller {
    protected $service;
    protected $createValidationRules;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->createValidationRules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5',
            'name' => 'required|string',
        ];
    }

    public function index(Request $request) {
        $data = $this->service->get($request->query());

        return $this->responseSuccess($data);
    }

    public function show(Request $request, $id) {
        $data = $this->service->getById($id, $request->query());

        if(!$data) return $this->responseDataNotFound();
        return $this->responseSuccess($data);
    }

    public function create(Request $request) {
        $data = $request->json()->all();
        $validation = $this->createValidation($data);
        if ($validation !== null) return $validation;

        $data = $this->service->store($data);
        return $this->responseSuccess($data);
    }

    public function update(Request $request, $id) {
        $data = $request->json()->all();
        $validation = $this->createValidation($data);
        if ($validation !== null) return $validation;

        $data = $this->service->update($id, $data);
        
        if(!$data) return $this->responseDataNotFound();
        return $this->responseUpdateSuccess($data);
    }

    public function delete($id) {
        $data = $this->service->delete($id);
        
        if(!$data) return $this->responseDataNotFound();
        return $this->responseDeleteSuccess();
    }
}