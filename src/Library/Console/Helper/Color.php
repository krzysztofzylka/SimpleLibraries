<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console\Helper;

class Color {

    /**
     * generate color
     * @param int|string|null $color
     * @return string
     */
    public static function generateColor(null|int|string $color = null) : string {
        $color = self::getColorNumber($color);

        return "\033[{$color}m";
    }

    /**
     * Get color number
     * @param int|string|null $color
     * @return int|string
     */
    public static function getColorNumber(null|int|string $color = null) : int|string {
        if (is_int($color)) {
            return $color;
        } elseif (is_null($color)) {
            return 0;
        }

        switch ($color){
            case 'black':
                $color = 30;
                break;
            case 'gray':
                $color = 90;
                break;
            case 'red':
                $color = 91;
                break;
            case 'green':
                $color = 92;
                break;
            case 'yellow':
                $color = 93;
                break;
            case 'blue':
                $color = 94;
                break;
            case 'graylight':
                $color = 98;
                break;
            case 'bg-white':
                $color = 7;
                break;
            case 'bg-gray':
                $color = 100;
                break;
            case 'bg-red':
                $color = 101;
                break;
            case 'bg-green':
                $color = 102;
                break;
            case 'bg-yellow':
                $color = 103;
                break;
            case 'bg-blue':
                $color = 104;
                break;
            default:
                $color = 37;
                break;
        }

        return $color;
    }

}