<?php

include('../vendor/autoload.php');

$object = new stdClass();
$object->test = 'a';

$data = [
    'test' => 'a',
    'test2' => 'b',
    'test3' => [
        'test' => 'c',
        'test2' => 'd',
        'test3' => json_encode(['a', 'b', 'c', 'd'])
    ],
    'test4' => 123,
    'test5' => false,
    'test6' => true,
    'test7' => null,
    'test8' => function() {},
    'test9' => $object,
    'test10' => json_encode(['a' => 1, 'g', 'h' => 'aaa', '55' => json_encode(['as', 343])])
];

\krzysztofzylka\SimpleLibraries\Library\Debug::print_r($data);