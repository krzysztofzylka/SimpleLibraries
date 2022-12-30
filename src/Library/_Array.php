<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Arrays
 */
class _Array {

    /**
     * Escape table
     * @param array $data
     * @return array
     */
    public static function escape(array $data) : array {
        $return = [];

        foreach($data as $name => $value) {
            $return[$name] = is_array($value) ? self::escape($value) : Strings::escape($value);
        }

        return $return;
    }

    /**
     * Trim
     * @param array $data
     * @return array
     */
    public static function trim(array $data) : array {
        $return = [];

        foreach($data as $name => $value) {
            $return[$name] = is_array($value) ? self::trim($value) : trim($value);
        }

        return $return;
    }

}