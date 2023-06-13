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

    /**
     * Get froma rray usign string with dots example:
     * ['a' => ['b' => 'ok']]
     * string to get b:
     * a.b
     * @param string $name
     * @param array $array
     * @return mixed
     */
    public static function getFromArrayUsingString(string $name, array $array) : mixed {
        $arrayData = '$array[\'' . implode('\'][\'', explode('.', $name)) . '\']';

        return @eval("return $arrayData;");
    }

    /**
     * Merge recursive distinct array
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function mergeRecursiveDistinct(array $array1, array $array2) : array {
        $return = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($return[$key]) && is_array($return[$key])) {
                $return[$key] = self::mergeRecursiveDistinct($return[$key], $value);
            } else {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    /**
     * In array keys
     * @param string $name
     * @param array $array
     * @return bool
     */
    public static function inArrayKeys(string $name, array $array) : bool {
        return in_array($name, array_keys($array));
    }

    /**
     * Reduction array
     * @param array $array
     * @param int $nthElement
     * @param bool $lastKey
     * @return array
     */
    public function reduction(array $array, int $nthElement = 2, bool $lastKey = true) : array {
        $i = 1;
        $first = true;
        $arrayLastKey = array_key_last($array);

        foreach (array_keys($array) as $key) {
            if ($lastKey && $key === $arrayLastKey) {
                continue;
            }

            if ($i === $nthElement) {
                $i = 1;
            } elseif (!$first) {
                unset($array[$key]);
                $i++;
            }

            $first = false;
        }

        return $array;
    }

}