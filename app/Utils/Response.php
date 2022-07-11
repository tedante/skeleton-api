<?php
namespace App\Utils;

use Illuminate\Http\JsonResponse;

trait Response
{
    public function responseApi($data = [], $message = null, $code = 500){
        return new JsonResponse([
            'code' => $code,
            'message' => $message,
            'data'   => $data
        ], $code);
    }

    public function responseSuccess($data = [], $message = "success", $code = 200){
        return $this->responseApi($data, $message, $code);
    }

    public function responseError($data = [], $message = "Internal server error", $code = 500){
        return $this->responseApi($data, $message, $code);
    }

    public function responseStoreSuccess($data = []){
        return $this->responseSuccess($data, "Data has been stored", 201);
    }
    
    public function responseUpdateSuccess($data = []){
        return $this->responseSuccess($data, "Data has been updated", 200);
    }
    
    public function responseDeleteSuccess(){
        return $this->responseSuccess([], "Data has been deleted", 200);
    }

    public function responseErrorValidation($data = []){
        return $this->responseApi($data, "Validation Error", 422);
    }

    public function responseDataNotFound(){
        return $this->responseApi([], "Data not found", 404);
    }
}
