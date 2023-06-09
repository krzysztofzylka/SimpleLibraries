<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Debuging
 */
class Debug {

    /**
     * print_r in table (with bootstrap)
     * @param mixed $data Input data
     * @param bool $var_type Show vae type in table
     * @param string $title Table title
     * @return void
     */
    public static function print_r(mixed $data, bool $var_type = false, ?string $title = null) : void {
        if (is_object($data)) {
            $data = (array)$data;
        }

        if (is_array($data)) {
            echo '<table class="table table-sm mb-0">';

            if (!is_null($title)) {
                echo '<tr><td class="text-light bg-dark" colspan="2">' . $title . '</td></tr>';
            }

            foreach ($data as $key => $value) {
                $type = gettype($value);

                if ($type === 'integer') {
                    $type = 'int';
                }

                echo '<tr><td style="width: 130px; background-color:#F0F0F0;">';
                echo '<strong title="' . $type . '">' . $key . '</strong> ';

                if ($var_type === true) {
                    echo '<br /><span class="badge bg-secondary w-100">{' . $type . '}</span>';
                }

                echo '</td><td>';
                self::print_r($value === null ? 'NULL' : ($value === true ? 'true' : ($value === false ? 'false' : $value)), $var_type);
                echo "</td></tr>";
            }

            echo "</table>";

            return;
        }

        echo $data;
    }

    /**
     * Dump
     * @param ...$data
     * @return string
     */
    public static function dump(...$data) : string {
        return '<pre>' . var_export($data, true) . '</pre>';
    }

}