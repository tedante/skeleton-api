<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utils\Response;
use Exception;
use App\Services\UserService;

class UserController extends Controller {

    use Response;

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request) {
        // dd($request->query(), $request->query()["fields"]);
        
        try {
            $data = $this->service->get($request->query());

            return $this->responseSuccess($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}