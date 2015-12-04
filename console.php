#!/usr/bin/env php
<?php

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else if (is_file(__DIR__ . '/../../../autoload.php')) {
    require_once __DIR__ . '/../../../autoload.php';
}
use migrateur\Console\MigrateCheckCommand;
use migrateur\Console\MigrateCreateCommand;
use migrateur\Console\MigrateRunCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new MigrateCheckCommand());
$application->add(new MigrateCreateCommand());
$application->add(new MigrateRunCommand());
$application->run();