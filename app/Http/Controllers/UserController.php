<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utils\Response;
use Exception;
use App\Repositories\UserRepository;

class UserController extends Controller {

    use Response;

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request) {
        try {
            $data = $this->repository->get();

            return $this->responseSuccess($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
}