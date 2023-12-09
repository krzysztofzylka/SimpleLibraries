<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use Exception;

/**
 * Generatory
 * @package Biblioteki
 */
class Generator {

    /**
     * Int to bytes
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes(int $bytes, int $precision = 2) : string {
        $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        if ((int)$factor === 0) {
            $precision = 0;
        }

        return sprintf("%.{$precision}f %s", $bytes / (1024 ** $factor), $size[$factor]);
    }

}