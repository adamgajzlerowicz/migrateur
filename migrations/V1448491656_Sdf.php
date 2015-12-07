<?php

use migrateur\Service\MigrationService;

class V1448491656_Sdf extends MigrationService
{

    public function up()
    {

        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (120,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (1220,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (1230,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (1420,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (12420,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (14320,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (14240,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (14205,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (14206,\'ljksdf\');');
        $this->add('INSERT INTO  `foo` (`id`,`blah`) VALUES (142043,\'ljksdf\');');


    }



}