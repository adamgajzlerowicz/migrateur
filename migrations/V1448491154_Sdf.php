<?php

use migrateur\Service\MigrationService;

class V1448491154_Sdf extends MigrationService
{

    public function up()
    {

        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (14,\'ljksdf\');');


    }



}