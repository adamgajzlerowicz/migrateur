<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20/11/2015
 * Time: 09:28
 */

namespace migrateur\Models;


class ConfigModel {

    protected $mainTableName;
    protected $userColumn;
    protected $passwordColumn;
    protected $databaseColumn;
    protected $migrationsTable;
    protected $host;
    protected $dbname;
    protected $user;
    protected $password;

    /**
     * @return mixed
     */
    public function getMigrationsTable()
    {
        return $this->migrationsTable;
    }

    /**
     * @param mixed $migrationsTable
     */
    public function setMigrationsTable($migrationsTable)
    {
        $this->migrationsTable = $migrationsTable;
    }


    /**
     * @return mixed
     */
    public function getMainTableName()
    {
        return $this->mainTableName;
    }

    /**
     * @param mixed $mainTableName
     */
    public function setMainTableName($mainTableName)
    {
        $this->mainTableName = $mainTableName;
    }

    /**
     * @return mixed
     */
    public function getUserColumn()
    {
        return $this->userColumn;
    }

    /**
     * @param mixed $userColumn
     */
    public function setUserColumn($userColumn)
    {
        $this->userColumn = $userColumn;
    }

    /**
     * @return mixed
     */
    public function getPasswordColumn()
    {
        return $this->passwordColumn;
    }

    /**
     * @param mixed $passwordColumn
     */
    public function setPasswordColumn($passwordColumn)
    {
        $this->passwordColumn = $passwordColumn;
    }

    /**
     * @return mixed
     */
    public function getDatabaseColumn()
    {
        return $this->databaseColumn;
    }

    /**
     * @param mixed $databaseColumn
     */
    public function setDatabaseColumn($databaseColumn)
    {
        $this->databaseColumn = $databaseColumn;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * @param mixed $dbname
     */
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}