<?php
namespace migrateur\Console;

use Doctrine\DBAL\Connection;
use migrateur\Models\ConfigModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCheckCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('migrate:check')
            ->setDescription('Check currently existing migrations')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = require_once(__DIR__.'/../../../bootstrap.php');
        /** @var ConfigModel $config */
        $config = $app['config'];
        /** @var Connection $db */
        $db = $app['db'];

        $query = "SHOW TABLES LIKE '".$config->getMigrationsTable()."'";
        $tableExists = $db->fetchAssoc($query);
        if(!$tableExists){
            $output->writeln('<comment>First run - creating migrations table</comment>');
            $query = "CREATE TABLE `".$config->getMigrationsTable()."` (
              `id` INT NOT NULL AUTO_INCREMENT ,
              `name` VARCHAR(45) NULL,
              `created_at` DATETIME NULL,
              PRIMARY KEY (`id`));";
            $db->executeQuery($query);
        }
        $output->writeln('   Status     |                  Migration Name');
        $output->writeln('---------------------------------------------------------------');

        $allMigrationFiles = $app['allMigrationFiles'];
        $migrationNames = $app['runMigrationNames'];
        $unRunMigrations = $app['unRunMigrations'];

        foreach($allMigrationFiles as $file){
           if(in_array($file,$unRunMigrations)){
               $output->writeln("<error>Down</error>          | ".$file."");
           }else{
               $output->writeln('<comment>UP</comment>            | '.$file.'');
           }
        }

    }
}