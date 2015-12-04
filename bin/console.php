#!/usr/bin/env php
<?php
<<<<<<< HEAD:console.php
require __DIR__.'/vendor/autoload.php';
=======

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else if (is_file(__DIR__ . '/../../../autoload.php')) {
    require_once __DIR__ . '/../../../autoload.php';
} 
>>>>>>> 6055f5cd0e6f7f041f7ca67f5a8641dadd34a175:bin/console.php

use migrateur\Console\MigrateCheckCommand;
use migrateur\Console\MigrateCreateCommand;
use migrateur\Console\MigrateRunCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new MigrateCheckCommand());
$application->add(new MigrateCreateCommand());
$application->add(new MigrateRunCommand());
$application->run();