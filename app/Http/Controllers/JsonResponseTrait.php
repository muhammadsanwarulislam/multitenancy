<?php


namespace App\Http\Controllers;


use Illuminate\Http\Response;

trait JsonResponseTrait
{
    public function successJsonResponse($message, $data = [], $statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'code'      => $statusCode,
            'message'   => $message,
            'data'      => $data
        ], $statusCode);
    }

    public function errorJsonResponse($message, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'code'      => $statusCode,
            'message'   => $message
        ], $statusCode);
    }

    public function unAuthenticatedJsonResponse($message, $statusCode = Response::HTTP_FORBIDDEN)
    {
        return response()->json([
            'code'      => $statusCode,
            'message'   => $message
        ], $statusCode);
    }

    public function createdJsonResponse($message, $data = [], $statusCode = Response::HTTP_CREATED)
    {
        return response()->json([
            'code'      => $statusCode,
            'message'   => $message,
            'data'      => $data,
        ], $statusCode);
    }

    public function badJsonResponse($message, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'code'      => $statusCode,
            'message'   => $message
        ], $statusCode);
    }

}
