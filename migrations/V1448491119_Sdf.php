<?php

use migrateur\Service\MigrationService;

class V1448491119_Sdf extends MigrationService
{

    public function up()
    {

        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (10,\'ljksdf\');');


    }



}