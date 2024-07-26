<?php

namespace Happynessarl\Caching\Management\Exceptions;

use Illuminate\Http\Response;
use Happynessarl\Caching\Management\Exceptions\BaseException;

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
