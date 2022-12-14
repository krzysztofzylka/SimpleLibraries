<?php

namespace SimpleLibraries\Library;

/**
 * Strings
 */
class Strings {

    /**
     * Repair links
     * @param string $url
     * @return string
     */
    public static function repairUrl(string $url) : string {
        do {
            $url = str_replace('//', '/', $url);
        } while (str_contains($url, '//'));

        return $url;
    }

    /**
     * Escape string
     * @param string $string
     * @return string
     */
    public static function escape(string $string) : string {
        return addslashes($string);
    }

    /**
     * Clean string and use lowercase
     * @param string $string ciąg znaków
     * @return string
     */
    public static function lowerCleanString(string $string) : string {
        return trim(strtolower(htmlspecialchars($string)));
    }

    /**
     * Remove all special chars from string
     * @param string $data
     * @return string
     */
    public static function clean(string $data) : string {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $data));
    }

    /**
     * Get first x words
     * @param string $string
     * @param int $length
     * @return string
     */
    public static function substrWithoutLastWord(string $string, int $length) : string {
        $string = substr($string, 0, $length);
        $explodeString = explode(' ', $string);
        $lastWord = end($explodeString);

        return substr($string, 0, $length - (strlen($lastWord) + 1));
    }

}