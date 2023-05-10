<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console;

use krzysztofzylka\SimpleLibraries\Library\Console\Helper\Color;
use krzysztofzylka\SimpleLibraries\Library\Date;

/**
 * Prints
 */
class Prints {

    /**
     * Print data
     * @param string $value
     * @param bool $timestamp
     * @param bool $exit
     * @param string|int|null $color line color
     * @return void
     */
    public static function print(string $value, bool $timestamp = false, bool $exit = false, string|int $color = null) : void {
        if (!is_null($color)) {
            echo Color::generateColor($color);
        }

        if ($timestamp) {
            echo '[' . Date::getSimpleDate() . '] ';
        }

        echo $value . PHP_EOL;

        if (!is_null($color)) {
            echo Color::generateColor();
        }

        if ($exit) {
            exit;
        }
    }

    /**
     * Simple print
     * @param string $value
     * @return void
     */
    public static function sprint(string $value) : void {
        echo $value;
    }

}