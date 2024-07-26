<?php

namespace CheckDate\PinModule\Exceptions;

use Illuminate\Http\Response;

class CachedItemNotFoundException extends BaseException
{
    public function __construct(
        string $message = "",
        int $code = Response::HTTP_NOT_FOUND,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
