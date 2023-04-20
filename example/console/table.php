<?php

use krzysztofzylka\SimpleLibraries\Library\Console\Generator\Table;

include('../../vendor/autoload.php');

$table = new Table();
$table->setData([
    [
        'a' => '1',
        'b' => '2',
        'f' => '12344'
    ],
    [
        'a' => 'lorem ipsum',
        'b' => 'lorem ipsum lorem ipsum',
        'f' => 'sagdasdgasd gasd gasdgasdgasdg'
    ]
]);
$table->addColumn('test', 'a');
$table->addColumn('test column 2', 'b');
$table->addColumn('xx', 'f');
$table->render();