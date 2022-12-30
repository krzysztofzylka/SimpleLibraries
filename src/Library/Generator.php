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
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

}