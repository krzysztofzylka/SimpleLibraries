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
     * @param string|null $title Table title
     * @return void
     * @throws \Exception
     */
    public static function print_r(mixed $data, bool $var_type = false, ?string $title = null) : void {
        $data = is_callable($data) ? 'CALLABLE' : (is_object($data) ? (array)$data : $data);

        if (!is_array($data)) {
            echo $data;

            return;
        }

        echo '<table class="table table-sm mb-0">';

        if (!empty($title)) {
            echo '<tr><td class="text-light bg-dark" colspan="2">' . $title . '</td></tr>';
        }

        foreach ($data as $key => $value) {
            $type = gettype($value) === 'integer' ? 'int' : gettype($value);
            $isJson = false;

            if (is_string($value)
                && !empty($value)
                && (str_starts_with($value, '[') && str_ends_with($value, ']')
                    || str_starts_with($value, '{') && str_ends_with($value, '}'))
            ) {
                try {
                    $value = Json::fix($value);

                    if (Json::isJson($value)) {
                        $isJson = true;
                    }
                } catch (\Throwable) {
                }
            }

            if ($isJson) {
                $id = Generator::uniqId(15);
                $type .= ' (JSON)';

                ob_start();
                self::print_r(json_decode($value, true), $var_type);
                $valueArray = ob_get_contents();
                ob_get_clean();
                $script = 'x=document.getElementById(\'' . $id . '_array\');
                x2=document.getElementById(\'' . $id . '_json\');
                if(x.style.display === \'none\') {
                    x.style.display=\'block\';
                    x2.style.display=\'none\';
                } else {
                    x2.style.display=\'block\';
                    x.style.display=\'none\';
                }';

                $key .= ' <a onclick="' . str_replace(["\n", "\r"], '', $script) . '">[T]</a>';

                $value = '<div id="' . $id . '_json" style="display: none;">' . $value . '</div><div id="' . $id . '_array">' . $valueArray . '</div>';
            }

            echo '<tr><td style="width: 130px; background-color:#F0F0F0;">';
            echo '<strong title="' . $type . '">' . $key . '</strong> ';

            if ($var_type === true) {
                echo '<br /><span class="badge bg-secondary w-100">{' . $type . '}</span>';
            }

            echo '</td><td>';

            self::print_r($value === null ? 'NULL' : ($value === true ? 'TRUE' : ($value === false ? 'FALSE' : $value)), $var_type);
            echo "</td></tr>";
        }

        echo "</table>";
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