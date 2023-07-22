<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use krzysztofzylka\SimpleLibraries\Exception\SimpleLibraryException;

/**
 * Hashing
 */
class Hash {

    /**
     * Salt
     * @var string
     * @ignore
     */
    protected static string $salt = 'SimpleLibraries';

    /**
     * Hash list
     * @var array
     * @ignore
     */
    protected static array $hashList = [
        'md5' => ['number' => '001'],
        'sha256' => ['number' => '002'],
        'pbkdf2' => ['number' => '003'],
        'sha512' => ['number' => '004'],
        'crc32' => ['number' => '005'],
        'ripemd256' => ['number' => '006'],
        'snefru' => ['number' => '007'],
        'gost' => ['number' => '008'],
        'xxh32' => ['number' => '009'],
        'xxh64' => ['number' => '010'],
        'xxh3' => ['number' => '011'],
        'xxh128' => ['number' => '012'],
        'crc32c' => ['number' => '013']
    ];

    /**
     * Hashowanie ciągu znaków
     * @param string $string
     * @param string $algorithm Alghoritm, default pbkdf2 (md5, sha256, pbkdf2, sha512, crc32, ripemd256, snefri, gost)
     * @return string
     * @throws SimpleLibraryException
     */
    public static function hash(string $string, string $algorithm = 'pbkdf2') : string {
        $return = '${type}${hash}';

        switch ($algorithm) {
            case 'sha256':
            case 'sha512':
            case 'crc32':
            case 'ripemd256':
            case 'snefru':
            case 'gost':
            case 'xxh32':
            case 'xxh64':
            case 'xxh3':
            case 'xxh128':
            case 'crc32c':
                $return = str_replace(
                    [
                        '{type}',
                        '{hash}'
                    ],
                    [
                        self::$hashList[$algorithm]['number'],
                        hash($algorithm, $string)
                    ],
                    $return
                );
                break;
            case 'md5':
                $return = str_replace(
                    [
                        '{type}',
                        '{hash}'
                    ],
                    [
                        self::$hashList[$algorithm]['number'],
                        md5($string)
                    ],
                    $return
                );
                break;
            case 'pbkdf2':
                if (!function_exists('hash_pbkdf2')) {
                    return throw new SimpleLibraryException('Unknown function hash_pbkdf2');
                }

                $return = str_replace(
                    [
                        '{type}',
                        '{hash}'
                    ],
                    [
                        self::$hashList[$algorithm]['number'],
                        hash_pbkdf2('sha256', $string, self::$salt, 4096, 20)
                    ],
                    $return
                );
                break;
        }

        return $return;
    }

    /**
     * Check hash
     * @param string $hash
     * @param string $string
     * @return bool
     * @throws SimpleLibraryException
     */
    public static function checkHash(string $hash, string $string) : bool {
        $hashNumber = str_replace('$', '', substr($hash, 0, 4));
        $hashIndex = array_search($hashNumber, array_column(self::$hashList, 'number'));

        if (is_bool($hashIndex)) {
            return false;
        }

        $hashName = array_keys(self::$hashList)[$hashIndex];

        return $hash === self::hash($string, $hashName);
    }

    /**
     * Set salt for pbkdf2
     * @param string $salt
     * @return void
     */
    public static function setSalt(string $salt) : void {
        self::$salt = $salt;
    }

}