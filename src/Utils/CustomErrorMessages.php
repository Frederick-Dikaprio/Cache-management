<?php

namespace CheckDate\PinModule\Utils;

class CustomErrorMessages
{
    const MODEL_NOT_FOUND = "{model} with {key} = {value} does not exist";
    const COLLECTION_NOT_FOUND = "{collection} with {key} = {value} does not exist";

    public static function interpolate(string $message, array $context)
    {
        foreach ($context as $key => $value) {
            if (is_string($value) || (is_object($value) && method_exists($value, '__toString'))) {
                $replace[sprintf("{%s}", $key)] = $value;
            }
        }

        if (!$replace) {
            return $message;
        }

        foreach ($replace as $key => $value) {
            $message = preg_replace(sprintf("/%s/", $key), (string) $value, $message);
        }

        return $message;
    }
}
