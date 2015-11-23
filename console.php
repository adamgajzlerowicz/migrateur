#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use migrateur\Console\MigrateCheckCommand;
use migrateur\Console\MigrateCreateCommand;
use migrateur\Console\MigrateRunCommand;
use Symfony\Component\Console\Application;


$application = new Application();
$application->add(new MigrateCheckCommand());
$application->add(new MigrateCreateCommand());
$application->add(new MigrateRunCommand());
$application->run();