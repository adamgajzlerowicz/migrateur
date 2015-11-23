<?php
namespace migrateur\Console;

use Carbon\Carbon;
use Doctrine\DBAL\Connection;
use migrateur\Models\ConfigModel;
use migrateur\Service\MigrationService;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateRunCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('migrate:migrate')
            ->setDescription('Run migrations')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $app = require_once('bootstrap.php');
        /** @var ConfigModel $config */
        $config = $app['config'];
        /** @var Connection $db */
        $db = $app['db'];

        $unRunMigrations = $app['unRunMigrations'];

        if(count($unRunMigrations)>0) {
            foreach ($unRunMigrations as $name) {
                require_once('migrations/' . $name);
                $className = substr($name, 0, -4);
                /** @var MigrationService $migration */
                $migration = new $className($app);
                $migration->up();
                $hasRun = false;
                foreach($app['databases'] as $database){
                    $app->register(new DoctrineServiceProvider(), array(
                        'dbs.options' => array (
                            $database['dbname'] => array(
                                'driver'    => 'pdo_mysql',
                                'host'      => 'localhost',
                                'dbname'    => $database['dbname'],
                                'user'      => $database['dbusername'],
                                'password'  => $database['dbpassword'],
                                //'charset'   => 'utf8mb4',
                            )
                        )
                    ));

                    $migration->setDb($app['dbs'][$database['dbname']]);
                    $migration->startTransaction();
                    try{
                        if ($migration->isThereQueries()) {
                            if ($migration->run()) {
                                $hasRun = true;
                            }
                        }
                        $migration->commitTransaction();
                    } catch(\Exception $e) {
                        $migration->rollbackTransaction();
                        throw $e;
                    }

                }
                if($hasRun){
                    $table = $config->getMigrationsTable();
                    $query = 'INSERT INTO `' . $table . '` (`name`, `created_at`) VALUES ("' . $name . '","' . Carbon::now()->format('Y-m-d H:i:s') . '");';
                    $db->exec($query);
                    $output->writeln("<info>    Running migration: $name </info>");
                }
            }
        }else{
            $output->writeln("<comment>    All up to date!</comment>");
        }


    }
}