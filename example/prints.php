<?php

use krzysztofzylka\SimpleLibraries\Library\Console\Prints;

include('../vendor/autoload.php');

for ($i=0; $i <= 255; $i++) {
    Prints::print('Color ' . $i, true, false, $i);
}