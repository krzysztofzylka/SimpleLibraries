<?php

namespace krzysztofzylka\SimpleLibraries\Library;

class Server {

    /**
     * Get meminfo
     * @return array
     */
    public static function getMeminfo(): array
    {
        $data = explode("\n", file_get_contents("/proc/meminfo"));
        $meminfo = [];

        foreach ($data as $line) {
            list($key, $val) = explode(":", $line);
            $meminfo[$key] = trim($val);
        }

        return $meminfo;
    }

    /**
     * Get ram info
     * @return array
     */
    public static function getRamInfo(): array
    {
        $meminfo = self::getMeminfo();

        return [
            'total' => $meminfo['total'],
            'free' => $meminfo['free'],
            'use' => $meminfo['total'] - $meminfo['free']
        ];
    }

    /**
     * Get cpu usage
     * @return array
     */
    public static function getCpuUsage(): array
    {
        $cpuUsage = sys_getloadavg();

        return [
            1 => $cpuUsage[0],
            5 => $cpuUsage[1],
            15 => $cpuUsage[2]
        ];
    }

}