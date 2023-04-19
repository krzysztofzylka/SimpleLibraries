<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console;

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
     * @return void
     */
    public static function print(string $value, bool $timestamp = false, bool $exit = false): void {
        if ($timestamp) {
            echo '[' . Date::getSimpleDate() . '] ';
        }

        echo $value . PHP_EOL;

        if ($exit) {
            exit;
        }
    }

}