<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use Ahc\Json\Fixer;

/**
 * Json
 */
class Json {

    /**
     * Is json
     * @param string $string
     * @return bool
     */
    public static function isJson(string $string): bool
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Fix JSON
     * @param string $json
     * @return string
     */
    public static function fix(string $json): string
    {
        $json = str_replace(['\M', "\P"], ['\/M', '\/P'], $json);

        return (new Fixer)->silent()->missingValue(true)->fix($json);
    }

}