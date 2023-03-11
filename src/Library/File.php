<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use Exception;
use krzysztofzylka\SimpleLibraries\Exception\SimpleLibraryException;

/**
 * Files
 */
class File {

    /**
     * Create dir
     * @param string|array $paths directory path or paths
     * @param int $permission permission (default 0777)
     * @return ?bool bool or null (if $paths is array)
     * @throws SimpleLibraryException
     */
    public static function mkdir(string|array $paths, int $permission = 0777) : ?bool {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                self::mkdir(self::repairPath($path), $permission);
            }

            return null;
        }

        if (file_exists($paths)) {
            return false;
        }

        if (@mkdir(self::repairPath($paths), $permission, true)) {
            return true;
        } else {
            throw new SimpleLibraryException(error_get_last()['message'], 0, ['paths' => $paths, 'permission' => $permission]);
        }
    }

    /**
     * Repair string path
     * @param string $path
     * @return string
     */
    public static function repairPath(string $path) : string {
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

        do {
            $path = str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path);
        } while (str_contains($path, DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR));

        return $path;
    }

    /**
     * Remove file
     * @param string $path
     * @return bool
     */
    public static function unlink(string $path) : bool {
        if (!file_exists($path)) {
            return false;
        }

        return unlink($path);
    }

    /**
     * Recursive scan directory
     * @param string $dir
     * @return array
     */
    public static function scanDir(string $dir) : array {
        $result = [];

        foreach(scandir($dir) as $filename) {
            if (str_starts_with($filename, '.')) {
                continue;
            }

            $filePath = $dir . '/' . $filename;

            if (is_dir($filePath)) {
                foreach (self::scanDir($filePath) as $childFilename) {
                    $result[] = $filename . '/' . $childFilename;
                }
            } else {
                $result[] = $filename;
            }
        }

        return $result;
    }

    /**
     * Create file
     * @param string $path
     * @param ?string $value
     * @return bool
     */
    public static function touch(string $path, ?string $value = null) : bool {
        if (file_exists($path)) {
            return false;
        }

        try {
            if (!$value) {
                touch($path);
            }

            file_put_contents($path, $value);

            return true;
        } catch (Exception) {
            return false;
        }
    }

}