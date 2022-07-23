<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Utils\Response;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Response;

    public function createValidation($data) {
        $validation = Validator::make($data, $this->createValidationRules);

        if ($validation->fails()) {
            return $this->responseErrorValidation($validation->errors()->get('*'));
        }

        return null;
    }
}
