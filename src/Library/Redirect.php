<?php

namespace SimpleLibraries\Library;

/**
 * Redirect
 */
class Redirect {

    /**
     * Redirect to url
     * @param string $url
     * @return never
     */
    public static function redirect(string $url) : never {
        header('location: ' . $url);

        exit;
    }

}