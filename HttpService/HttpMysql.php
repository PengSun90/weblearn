<?php

/**
 * Created by PhpStorm.
 * User: pengsun
 * Date: 3/16/17
 * Time: 1:44 AM
 */
class HttpMysql
{
    private $conn;          //数据库连接标识
    private $result;

    /**
     * mysql constructor.
     * @param $db_name
     * @param $conn
     * @param $msg
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function selectDb($dbname)
    {
        return $this->conn->selectDb($dbname);
    }

    public function creatDb($dbname)
    {
        return $this->conn->creatDb($dbname);
    }

    public function query($tableName, $column)
    {
        return $this->conn->query_array($tableName, $column);
    }

    public function insert($tableName, $column)
    {
        $this->conn->insert_array($tableName, $column);
    }

    public function update($tableName, $column = array(), $where = array())
    {
        $this->conn->update_array($tableName, $column, $where);
    }

    public function delete($tableName, $where = array())
    {
        $this->conn->delete_array($tableName, $where);
    }

    public function createTable($table_name, $tableParamArray)
    {
        $this->conn->createTable($table_name, $tableParamArray);
    }

}