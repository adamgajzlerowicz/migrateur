<?php


namespace migrateur\Service;
use Doctrine\DBAL\Connection;

class MigrationService {

    protected $app;
    protected $queries;
    /** @var Connection $db */
    protected $db;
    public function __construct($app){
        $this->app = $app;
        /** @var Connection $db */
        $this->db = $app['db'];
        $this->queries=array();

    }

    /**
     * @param Connection $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $this->add("");
    }

    public function down()
    {
        return true;
    }

    public function startTransaction(){
        $this->db->beginTransaction();
    }
    public function commitTransaction(){
        $this->db->commit();
    }
    public function rollbackTransaction(){
        $this->db->rollBack();
    }
    public function run(){
        $success = true;
        foreach($this->queries as $sql){
            if(strlen($sql)>0){
                if(!$this->db->query($sql)) {
                    $success = false;
                }
            }
        }
        return $success;
    }

    public function add($data){
        $this->queries[] = $data;
    }
    public function isThereQueries(){
        $thereIs = false;
        foreach($this->queries as $query){
            if(strlen($query)>0){
                $thereIs = true;
            }
        }
        return $thereIs;
    }

}