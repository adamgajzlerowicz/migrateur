<?php
use Knp\Provider\ConsoleServiceProvider;
use migrateur\Models\ConfigModel;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else if (is_file(__DIR__ . '/../../../autoload.php')) {
    require_once __DIR__ . '/../../../autoload.php';
} 


$app = new Silex\Application();

$app['config'] = new ConfigModel();
$app['debug'] = true;
$app['fs'] = new Filesystem();
$app['finder'] = new Finder();

date_default_timezone_set('Europe/London');

require_once('env.php');
$config->setMigrationsTable('migrations');

$app->register(
    new ConsoleServiceProvider(),
    array(
        'console.name' => 'MyConsoleApp',
        'console.version' => '0.1.0',
        'console.project_directory' => __DIR__ . "/.."
    )
);

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => $config->getHost(),
        'dbname'    => $config->getDbname(),
        'user'      => $config->getUser(),
        'password'  => $config->getPassword()
    ),
));


$query = "SHOW TABLES LIKE '".$config->getMigrationsTable()."'";
$tableExists = $app['db']->fetchAssoc($query);
if(!$tableExists){
    $output->writeln('<comment>First run - creating migrations table</comment>');
    $query = "CREATE TABLE `".$config->getMigrationsTable()."` (
              `id` INT NOT NULL AUTO_INCREMENT ,
              `name` VARCHAR(45) NULL,
              `created_at` DATETIME NULL,
              PRIMARY KEY (`id`));";
    $app['db']->executeQuery($query);
}

function dd($data = ''){
    var_dump($data);
    exit;
}

$app['databases'] = array();
$query = "select * from ".$config->getMainTableName();
$databases = $app['db']->fetchAll($query);
$app['databases'] = $databases;

$files = $app['finder']->files()->in('migrations');
$query = "select * from migrations";
$migrations = $app['db']->fetchAll($query);
$migrationNames = array();
$unRunMigrations = array();
$allMigrationFiles = array();
foreach($migrations as $migration){
    $name = $migration['name'];
    $migrationNames[] = $name;
}
foreach($files as $file){
    $allMigrationFiles[] = $file->getRelativePathname();
    if(!in_array($file->getRelativePathname(),$migrationNames)){
        $unRunMigrations[]=$file->getRelativePathname();
    }
}
$unRunMigrations = array_unique($unRunMigrations);

$app['allMigrationFiles'] = $allMigrationFiles;
$app['runMigrationNames'] = $migrationNames;
$app['unRunMigrations'] = $unRunMigrations;


return $app;
