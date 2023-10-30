<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Integer
 */
class Integer {

    /**
     * Convert string to float
     * @param string $int
     * @return float
     */
    public static function strToFloat(string $int) : float {
        if (str_contains($int, '.') && str_contains($int, ',')) {
            $int = str_replace(',', '', $int);
        }

        return floatval(str_replace(',', '.', trim($int)));
    }

    /**
     * String is integer
     * @param $string
     * @return bool
     */
    public static function isStringInt($string) : bool {
        return !preg_match('/[^0-9]/', $string) > 0;
    }

}