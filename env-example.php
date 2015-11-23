<?php

/** @var \migrateur\Models\ConfigModel $config */
$config = $app['config'];
$config->setHost('localhost');
$config->setDbname('companydatabases');
$config->setPassword('');
$config->setUser('root');

$config->setmainTableName('databasesettings');
$config->setUserColumn('dbusername');
$config->setPasswordColumn('dbpassword');
$config->setDatabaseColumn('dbname');
