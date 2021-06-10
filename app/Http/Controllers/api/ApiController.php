<?php


namespace App\Http\Controllers\api;


class ApiController
{

    /**
     * @param $data
     * @param $message
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($data
        , $message, $code = null){
        return response()->json(['data' => $data, 'message' => $message, 'success' => true], $code);
    }

    /**
     * @param $message
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message, $code = null){
        return response()->json(['data' => null , 'message' => $message, 'success' => false], $code);
    }
}
