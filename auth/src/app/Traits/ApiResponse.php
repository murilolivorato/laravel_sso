<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    public function successResponse($data, $code = Response::HTTP_OK)
    {
         return response()->json($data, $code);
    }
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json(['message' => $message, 'code' => $code], $code);
        //return response()->json(['error' => $message, 'code' => $code], $code);
    }
    public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
