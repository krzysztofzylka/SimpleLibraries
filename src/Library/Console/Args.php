<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console;

/**
 * Arguments reader
 */
class Args {

    /**
     * Get args in readable array
     * @param array $argv
     * @return array
     */
    public static function getArgs(array $argv) : array {
        $return = [
            'path' => $argv[0],
            'args' => [],
            'params' => []
        ];

        $isParam = false;
        $paramName = '';

        foreach ($argv as $i => $arg) {
            if ($i === 0) {
                continue;
            }

            if (str_starts_with($arg, '-')) {
                $isParam = true;
                $paramName = substr($arg, 1);
            } elseif ($isParam) {
                $isParam = false;
                $return['params'][$paramName] = $arg;
                $paramName = '';
            } else {
                $return['args'][] = $arg;
            }
        }

        return $return;
    }

}