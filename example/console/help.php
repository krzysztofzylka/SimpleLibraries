<?php

include('../../vendor/autoload.php');

$help = new \krzysztofzylka\SimpleLibraries\Library\Console\Generator\Help();
$help->addHelp('help', 'Helpers');
$help->addHelp('create text <message>', 'Create message text');
$help->addHelp('create database table <table name> <column_1> ...', 'create table');
$help->render();