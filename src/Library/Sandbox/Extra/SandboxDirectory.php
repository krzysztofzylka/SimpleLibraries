<?php

namespace krzysztofzylka\SimpleLibraries\Library\Sandbox\Extra;

use Exception;
use krzysztofzylka\SimpleLibraries\Library\Generator;

class SandboxDirectory {

    /**
     * Generate sandbox directory
     * @return string
     * @throws Exception
     */
    public static function generateSandboxDirectory() : string {
        return sys_get_temp_dir() . '/php_sandbox/' . Generator::uniqHash();
    }

}