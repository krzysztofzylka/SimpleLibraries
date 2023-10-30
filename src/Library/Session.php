<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Session
 */
class Session {

    /**
     * Write
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public static function set(string $name, mixed $value) : void {
        $_SESSION[$name] = $value;
    }

    /**
     * Get
     * @param string $name
     * @return mixed (default if session not exists)
     */
    public static function get(string $name) : mixed {
        return $_SESSION[$name] ?? null;
    }

    /**
     * Unset
     * @param string $name
     * @return void
     */
    public static function delete(string $name) : void {
        unset($_SESSION[$name]);
    }

    /**
     * Check session exists
     * @param string $name
     * @return bool
     */
    public static function exists(string $name) : bool {
        return isset($_SESSION[$name]);
    }

    /**
     * Clean session
     * @return void
     */
    public static function clean() : void {
        session_unset();
        session_destroy();
        unset($_SESSION);
    }

}