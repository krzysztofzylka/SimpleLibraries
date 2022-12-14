<?php

namespace SimpleLibraries\Library;

/**
 * Requests
 */
class Request {

    /**
     * If request has POST data
     * @return bool
     */
    public static function isPost() : bool {
        return !empty($_POST);
    }

    /**
     * If request has GET data
     * @return bool
     */
    public static function isGet() : bool {
        return !empty($_GET);
    }

    /**
     * Get POST data
     * @param string $name
     * @param mixed|null $value default value
     * @return mixed
     */
    public static function getPostData(string $name, mixed $value = null) : mixed {
        if (!is_null($value)) {
            $_POST[$name] = $value;

            return true;
        }

        return $_POST[$name] ?? null;
    }

    /**
     * Get GET data
     * @param string $name
     * @param mixed|null $value Default value
     * @return mixed
     */
    public static function getGetData(string $name, mixed $value = null) : mixed {
        if (!is_null($value)) {
            $_GET[$name] = $value;

            return true;
        }

        return $_GET[$name] ?? null;
    }

    /**
     * Get _FILES
     * @return ?array
     */
    public static function getFiles() : ?array {
        return $_FILES;
    }

    /**
     * Get all escape POST data
     * @return array
     */
    public static function getAllPostEscapeData() : array {
        return _Array::escape($_POST);
    }

    /**
     * Check if request is ajax
     * @return bool
     */
    public static function isAjaxRequest() : bool {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

}