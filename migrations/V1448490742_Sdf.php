<?php

use migrateur\Service\MigrationService;

class V1448490742_Sdf extends MigrationService
{

    public function up()
    {

        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (10,\'ljksdf\');');


    }



}