<?php

namespace App\HelperModule;

use Illuminate\Http\JsonResponse;

class Helper
{
    /**
     * @param $status
     * @param $data
     * @param $message
     * @return JsonResponse
     */
    public static function jsonResponse($status = null, $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $status);
    }
}
