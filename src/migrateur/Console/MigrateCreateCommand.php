<?php
namespace migrateur\Console;

use Doctrine\DBAL\Connection;
use migrateur\Models\ConfigModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class MigrateCreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('migrate:create')
            ->setDescription('Generate a new migration')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name for the new migration'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = require_once(__DIR__.'/../../../bootstrap.php');
        /** @var ConfigModel $config */
        $config = $app['config'];
        /** @var Connection $db */
        $db = $app['db'];
        /** @var Filesystem $fs */
        $fs = $app['fs'];

        $name = $input->getArgument('name');
        $name = ucfirst($name);
        $timestamp = time();
        $migrationName = 'V'.$timestamp.'_'.$name;

        $template = '<?php

use migrateur\Service\MigrationService;

class '.$migrationName.' extends MigrationService
{

    public function up()
    {

        $this->add(\'\');

    }



}';







        $fs->dumpFile('migrateur/'.$migrationName.'.php', $template);

        $output->writeln('<info>Migration '.$migrationName.' created successfully</info>');

    }
}