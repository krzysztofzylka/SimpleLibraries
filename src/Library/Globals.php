<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Globals
 */
class Globals {

    /**
     * Globals variables
     * @var array
     * @ignore
     */
    private static array $variables = [];

    /**
     * Read
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public static function set(string $name, mixed $value) : void {
        self::$variables[$name] = $value;
    }

    /**
     * Write
     * @param string $name
     * @param mixed $default default value (default null)
     * @return mixed
     */
    public static function get(string $name, mixed $default = null) : mixed {
        if (!isset(self::$variables[$name])) {
            return $default;
        }

        return self::$variables[$name];
    }

}