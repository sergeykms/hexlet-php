<?php

// Путь который будет использован при глобальной установке пакета
$autoloadPath1 = __DIR__ . '/home/sergeykms/.config/composer/vendor/autoload.php';
// Путь для локальной работы с проектом
$autoloadPath2 = __DIR__ . '/vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use HexletPhp\src\Runner;

print_r(Runner\run());


// fwrite(STDOUT, "Enter your given name: ");
// $name = trim(fgets(STDIN));
// fwrite(STDOUT, "Enter your last name: ");
// $lastname = trim(fgets(STDIN));
// // echo "Hello, $name $lastname!";
// fwrite(STDOUT, "Hello, $name $lastname!" . "\n");