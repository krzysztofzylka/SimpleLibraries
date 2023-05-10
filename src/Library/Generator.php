<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use Exception;

/**
 * Generatory
 * @package Biblioteki
 */
class Generator {

    /**
     * Unikatowy identyfikator
     * @param ?int $length length to 512
     * @return string
     * @throws Exception
     */
    public static function uniqId(?int $length = null) : string {
        $uniqId = str_pad(random_int(1, 99999), 5, 0, STR_PAD_LEFT);
        $uniqId .= time();
        $uniqId .= str_replace('.', '', uniqid('', true));
        $uniqId .= uniqid();

        $uniqId = hash('sha512', $uniqId);

        if (!is_null($length)) {
            $uniqId = substr($uniqId, 0, $length);
        }

        return $uniqId;
    }

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