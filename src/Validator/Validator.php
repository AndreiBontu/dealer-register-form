<?php

namespace DealerRegisterForm\src\Validator;

class Validator
{
    /**
     * @param $value
     * @return bool
     */
    public static function required($value): bool {
        if (is_array($value)) {
            return !empty(array_filter($value, fn ($item) => !empty(trim($item))));
        }
        return !empty(trim($value));
    }

    /**
     * @param $value
     * @param  int $min
     * @param  float $max
     * @return bool
     */
    public static function string_length($value, int $min = 1, float $max = INF): bool
    {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function email($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @param $value
     * @param $pattern
     * @return bool
     */
    public static function pattern($value, $pattern): bool {
        return preg_match($pattern, $value);
    }

    /**
     * @param $value
     * @param  int  $min
     * @param  int  $max
     * @return bool
     */
    public static function range($value, int $min = 10, int $max = 15): bool
    {
        // Sanitize the input to remove any non-numeric characters
        $value = preg_replace('/\D/', '', $value);

        // Check if the length is within the specified range
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function array($value): bool {
        return is_array($value);
    }
}