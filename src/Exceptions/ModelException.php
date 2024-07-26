<?php

namespace Happynessarl\Caching\Management\Exceptions;

use Illuminate\Http\Response;
use Throwable;

class ModelException extends BaseException
{
    public function __construct(
        string $message,
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
