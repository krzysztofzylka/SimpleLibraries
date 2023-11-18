<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Math
 */
class Math {

    /**
     * String to float
     * @param mixed $floatString
     * @return float
     */
    public static function strToFloat(mixed $floatString): float {
        return (float)str_replace([',', ' '], ['', '.'], $floatString);
    }

}