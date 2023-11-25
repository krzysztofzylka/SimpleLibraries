<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Integer
 */
class Integer {

    /**
     * String is integer
     * @param $string
     * @return bool
     */
    public static function isStringInt($string) : bool {
        return !preg_match('/[^0-9]/', $string) > 0;
    }

    /**
     * Check if a number is in the specified range
     * @param int $number
     * @param int $min
     * @param int $max
     * @return bool
     */
    public static function isInRange(int $number, int $min, int $max) : bool {
        return ($number >= $min) && ($number <= $max);
    }

}