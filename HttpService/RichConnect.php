<?php


/**
 * Created by PhpStorm.
 * User: pengsun
 * Date: 3/16/17
 * Time: 4:31 AM
 */
class RichConnect
{
    /**
     * @var string
     */
    private $db_host = 'localhost';
    /**
     * @var string
     */
    private $db_user = 'root';   //数据库主机
    /**
     * @var string
     */
    private $db_pwd = "hui@0318";

    /**
     * @var
     */
    private $conn;


    /**
     * coneect constructor.
     * @param string $db_host
     * @param string $db_user
     * @param string $db_pwd
     */
    public function __construct($db_host = "localhost", $db_user = "root", $db_pwd = "hui@0318")
    {
        if (!isset($db_host) || !isset($db_user) || !isset($db_pwd)) {
            return false;
        } else {
            $this->db_host = $db_host;
            $this->db_user = $db_user;
            $this->db_pwd = $db_pwd;
            $this->initConnect();
        }
    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param mixed $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }


    /**
     *
     */
    public function initConnect()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pwd);
        if ($this->conn) {
            LogUtils::getInstance()->log("connect");
            $this->query("SET NAMES utf8");
        }
    }


    /**
     * @param $dbname
     * @return bool
     */
    public function selectDb($dbname)
    {
        if ($this->conn) {
            if ($dbname != "") {
                if (mysqli_select_db($this->conn, $dbname)) {
                    LogUtils::getInstance()->log("mysql 连接成功");
                    return true;
                } else {
                    return $this->createDb($dbname);
                };
            }
        }
        return false;
    }

    /**
     * @param $dbname
     * @return bool
     */
    public function createDb($dbname)
    {
        $sql = "CREATE DATABASE " . $dbname;
        if ($this->query($sql)) {
            LogUtils::getInstance()->log("mysql 创建成功");
            return true;
        }
        return false;
    }

    public function createTable($table_name, $tableParamArray)
    {
        $tableParam = "";
        $sql = "create table $table_name (id int(11) not null auto_increment primary key,";
        foreach ($tableParamArray as $key => $value) {
            $tableParam .= $key . " " . $value;
            $tableParam .= ",";
        }
        $columnName = substr($tableParam, 0, strlen($tableParam) - 1);
        $columnName .= ")";
        $sql .= $columnName;
        LogUtils::getInstance()->log($sql);
        $this->query($sql);
    }
    /**
     * @param $tableName
     * @param array $column
     * @return array|null
     */
    public function query_array($tableName, $column = array())
    {
        $columnName = "";
        $sql = "SELECT * FROM $tableName";
        foreach ($column as $key => $value) {
            $columnName .= $key . "=" . "\"" . $value . "\"";
            $columnName .= "&&";
        }
        $columnName = substr($columnName, 0, strlen($columnName) - 2);

        if (!empty($columnName)) {
            $sql .= " WHERE $columnName";
        }
        LogUtils::getInstance()->log($sql);
        return $this->query_sql($sql);
    }

    /**
     * @param $p
     * @return array|null
     */
    public function query_sql($p)
    {
        if (($result = $this->query($p)) == true) {
            $reslist = array();
            $i = 0;
            while ($row = mysqli_fetch_row($result)) {
                $reslist[$i] = $row;
                $i++;
            }
            LogUtils::getInstance()->log("sql执行成功");
            return $reslist;
        } else {
            LogUtils::getInstance()->log("sql执行出错，错误编号：" . mysqli_errno($this->conn) . "错误原因：" . mysqli_error($this->conn));
            return null;
        }
    }


    /**
     * @param $tableName
     * @param array $batch
     * @return bool
     */
    public function insert_array_batch($tableName, $batch = array())
    {
        if (empty($batch)) return false;
        for ($i = 0; $i < count($batch); $i++) {
            if (!empty($batch[$i])) {
                $this->insert_array($tableName, $batch[$i]);
            }
        }
    }

    /**
     * @param $tableName
     * @param array $column
     * @return bool
     */
    public function insert_array($tableName, $column = array())
    {
        if (empty($column)) return false;
        $columnName = "";
        $columnValue = "";
        foreach ($column as $key => $value) {
            $columnName .= $key . ",";
            $columnValue .= "'" . $value . "',";
        }
        $columnName = substr($columnName, 0, strlen($columnName) - 1);
        $columnValue = substr($columnValue, 0, strlen($columnValue) - 1);
        $sql = "INSERT INTO $tableName($columnName) VALUES($columnValue)";
        return $this->insert_sql($sql);
    }

    /**
     * @param $p
     * @return bool
     */
    public function insert_sql($p)
    {
        if ($this->query($p)) {
            LogUtils::getInstance()->log("数据插入成功。新插入的id为：" . mysqli_insert_id($this->conn));
            return true;
        }
        return false;
    }


    /**
     * @param $tableName
     * @param array $column
     * @param array $where
     * @return bool
     */
    public function update_array($tableName, $column = array(), $where = array())
    {
        if (empty($column) || empty($where)) return false;
        $updateValue = "";
        $olddateValue = "";
        foreach ($column as $key => $value) {
            $updateValue .= $key . "='" . $value . "',";
        }
        foreach ($where as $key => $value) {
            $olddateValue .= $key . "='" . $value . "',";
        }
        $updateValue = substr($updateValue, 0, strlen($updateValue) - 1);
        $olddateValue = substr($olddateValue, 0, strlen($olddateValue) - 1);
        $sql = "UPDATE $tableName SET $updateValue WHERE $olddateValue";
        LogUtils::getInstance()->log($sql);
        return $this->insert_sql($sql);
    }

    /**
     * @param $sql
     * @return bool
     */
    public function update_sql($sql)
    {
        if ($this->query($sql)) {
            LogUtils::getInstance()->log("数据更新成功。受影响行数：" . mysqli_affected_rows($this->conn));
            return true;
        }
        return false;
    }


    /**
     * @param $tableName
     * @param array $batch
     * @return bool
     */
    public function delete_array_batch($tableName, $batch = array())
    {
        if (empty($batch)) return false;
        for ($i = 0; $i < count($batch); $i++) {
            if (!empty($batch[$i])) {
                $this->delete_array($tableName, $batch[$i]);
            }
        }
    }

    /**
     * @param $tableName
     * @param array $where
     * @return bool
     */
    public function delete_array($tableName, $where = array())
    {
        if (empty($where)) return false;

        $deletedateValue = "";
        foreach ($where as $key => $value) {
            $deletedateValue .= $key . "='" . $value . "',";
        }
        $deletedateValue = substr($deletedateValue, 0, strlen($deletedateValue) - 1);
        $sql = "DELETE FROM $tableName WHERE $deletedateValue";

        return $this->delete_sql($sql);

    }

    /**
     * @param $p
     * @return bool
     */
    public function delete_sql($p)
    {
        if ($this->query($p)) {
            LogUtils::getInstance()->log("数据删除成功。受影响行数：" . mysqli_affected_rows($this->conn));
            return true;
        }
        return false;
    }

    /**
     * @param $sql
     * @return bool|mysqli_result
     */
    function query($sql)
    {
        if ($this->conn) {
            if ($sql != "") {
                return mysqli_query($this->conn, $sql);
            }
        }
        return false;
    }


    /**
     * @return string
     */
    function error()
    {
        return mysqli_error();
    }

    /**
     *
     */
    function closeConnect()
    {
        if ($this->conn) {
            $this->close();
        }
    }
}