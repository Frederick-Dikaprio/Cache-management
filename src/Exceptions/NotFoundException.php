<?php

namespace Happynessarl\Caching\Management\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct($message = "Default message", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction()
    {
        echo "A custom function for this exception\n";
    }
}
