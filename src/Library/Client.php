<?php

namespace krzysztofzylka\SimpleLibraries\Library;

class Client {

    /**
     * Get Client IP address
     * @return string
     */
    public static function getIP() : string {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }

}