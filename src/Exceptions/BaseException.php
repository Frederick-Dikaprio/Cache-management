<?php

namespace Caching\Management\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Caching\Management\Http\ApiResponse;

abstract class BaseException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        $result = null;
        if ($request) {
            $result = ApiResponse::error($this->getMessage(), $this->getCode());
        }
        
        return $result;
    }
}
