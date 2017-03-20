<?php
/**
 * Created by PhpStorm.
 * User: pengsun
 * Date: 3/16/17
 * Time: 1:53 AM
 */

include "RichConnect.php";
include "HttpMysql.php";
include "../common/LogUtils.php";


$db_name = "rich";
$db_table_name = "loginInfor";
//$db_QueryParameters = array("id" => 3);
//$db_InsertParameters = array("name" => "王五22");
//$db_updateParameters = array("name" => "奖章");
//
//
$connect = new RichConnect();
$mysql = new HttpMysql($connect);
//
////
//if ($mysql->selectDb($db_name)) {//数据库
////    $course = $mysql->query($db_table_name, $db_QueryParameters);
////    LogUtils::getInstance()->myVarDump($course);
//////    $mysql->insert($db_table_name, $db_InsertParameters);
//////    $mysql->update($db_table_name, $db_updateParameters, $db_InsertParameters);
////    $mysql->delete($db_table_name, $db_QueryParameters);
//
//}
if (isset($_GET["name"]) && $_GET["name"]) {
    $loginInfor = array();
    $loginInfor["name"] = $_GET["name"];
    $loginInfor["password"] = $_GET["passWord"];
    if ($mysql->selectDb($db_name)) {//数据库
        if ($mysql->insert("logininfor", $loginInfor)) {
            echo "hello" . $_GET["name"];
        }
    } else {
        echo "请输入姓名";
    }
}



