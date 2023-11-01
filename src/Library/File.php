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

    /**
     * Copy file if not exists or source modify date is newer
     * @param string $sourcePath source path
     * @param string $destinationPath destination path
     * @return bool
     */
    public static function copy(string $sourcePath, string $destinationPath) : bool {
        $destinationModify = file_exists($destinationPath) ? filemtime($destinationPath) : 0;
        $sourceModify = file_exists($sourcePath) ? filemtime($sourcePath) : 0;

        if (!file_exists($destinationPath) || $sourceModify > $destinationModify) {
            return copy($sourcePath, $destinationPath);
        }

        return false;
    }

    /**
     * Get file extension
     * @param string $path
     * @return string
     */
    public static function getExtension(string $path) : string {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * Get content type
     * @param string $fileExtension
     * @return false|string
     */
    private static function getContentType(string $fileExtension): false|string
    {
        $images = ['gif', 'png', 'webp', 'bmp', 'avif'];
        $text = ['css', 'csv'];
        $video = ['mp4', 'webm'];
        $application = ['zip', 'xml', 'rtf', 'pdf', 'json'];
        $font = ['woff2', 'woff', 'ttf', 'otf'];
        $audio = ['wav', 'pus', 'aac'];

        if (in_array($fileExtension, $images)) {
            return 'image/' . $fileExtension;
        } elseif (in_array($fileExtension, $text)) {
            return 'text/' . $fileExtension;
        } elseif (in_array($fileExtension, $video)) {
            return 'video/' . $fileExtension;
        } elseif (in_array($fileExtension, $application)) {
            return 'application/' . $fileExtension;
        } elseif (in_array($fileExtension, $font)) {
            return 'font/' . $fileExtension;
        } elseif (in_array($fileExtension, $audio)) {
            return 'audio/' . $fileExtension;
        }

        return match ($fileExtension) {
            'jpeg', 'jpg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'text' => 'text/plain',
            'doc' => 'application/msword',
            'js', 'mjs' => 'text/javascript',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            '7z' => 'application/x-7z-compressed',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xul' => 'application/vnd.mozilla.xul+xml',
            '3gp' => 'video/3gpp',
            '3g2' => 'video/3gpp2',
            'xhtml' => 'application/xhtml+xml',
            'xls' => 'application/vnd.ms-excel',
            'vsd' => 'application/vnd.visio',
            'rar' => 'application/vnd.rar',
            'ts' => 'video/mp2t',
            'tif', 'tiff' => 'image/tiff',
            'tar' => 'application/x-tar',
            'sh' => 'application/x-sh',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'ppt' => 'application/vnd.ms-powerpoint',
            'php' => 'application/x-httpd-php',
            'ogx' => 'application/ogg',
            'ogv' => 'video/ogg',
            'mp3' => 'audio/mpeg',
            'mid', 'midi' => 'audio/midi',
            'jsonld' => 'application/ld+json',
            'jar' => 'application/java-archive',
            'ics' => 'text/calendar',
            'ico' => 'image/vnd.microsoft.icon',
            'htm', 'html' => 'text/html',
            'gz' => 'application/gzip',
            'epub' => 'application/epub+zip',
            'eot' => 'application/vnd.ms-fontobject',
            'csh' => 'application/x-csh',
            'cda' => 'application/x-cdf',
            'bz2' => 'application/x-bzip2',
            'bz' => 'application/x-bzip',
            'bin' => 'application/octet-stream',
            'awz' => 'application/vnd.amazon.ebook',
            'avi' => 'video/x-msvideo',
            'arc' => 'application/x-freearc',
            'abw' => 'application/x-abiword',
            'x3d' => 'application/vnd.hzn-3d-crossword',
            'mseq' => 'application/vnd.mseq',
            'pwn' => 'application/vnd.3m.post-it-notes',
            'ace' => 'application/x-ace-compressed',
            'dir' => 'application/x-director',
            'apk' => 'application/vnd.android.package-archive',
            'aiff' => 'audio/x-aiff',
            'atom' => 'application/atom+xml',
            'torrent' => 'application/x-bittorrent',
            'c' => 'text/x-c',
            'deb' => 'application/x-debian-package',
            'dts' => 'audio/vnd.dts',
            'flv' => 'video/x-flv',
            'f4v' => 'video/x-f4v',
            'cer' => 'application/pkix-cert',
            'java' => 'text/x-java-source',
            'jsx' => 'text/jsx',
            'kml' => 'application/vnd.google-earth.kml+xml',
            'kmz' => 'application/vnd.google-earth.kmz',
            'm4a' => 'audio/x-m4a',
            'm4v' => 'video/x-m4v',
            'm4p' => 'application/mp4',
            'm4u' => 'video/vnd.mpegurl',
            'm3u8' => 'application/vnd.apple.mpegurl',
            'm3u' => 'audio/x-mpegurl',
            'latex' => 'application/x-latex',
            'kwd' => 'application/vnd.kde.kword',
            'kon' => 'application/vnd.kde.kontour',
            'ser' => 'application/java-serialized-object',
            'karbon' => 'application/vnd.kde.karbon',
            'kfo' => 'application/vnd.kde.kformula',
            'flw' => 'application/vnd.kde.kivio',
            default => false
        };
    }

}