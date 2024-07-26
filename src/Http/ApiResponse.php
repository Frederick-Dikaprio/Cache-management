<?php

namespace Caching\Management\Http;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data, int $status = 200): JsonResponse
    {
        $success = 'success';
        $response = (empty($data)) ? ['status' => $success] : ['status' => $success, 'data' => $data];
        return response()->json($response, $status, ['Content-Type' => 'application/json']);
    }

    public static function error(string $reason, int $status = 400, array $extra = []): JsonResponse
    {
        $data = ['status' => 'error', 'reason' => $reason];
        $response = $data + $extra;
        return response()->json(
            $response,
            $status,
            ['Content-Type' => 'application/json'],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
