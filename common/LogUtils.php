<?php

/**
 * Created by PhpStorm.
 * User: pengsun
 * Date: 3/16/17
 * Time: 5:25 AM
 */
class LogUtils
{
    private $debug = true;

    private static $logUtils = null;


    //静态方法，单例统一访问入口
    static public function getInstance()
    {
        if (is_null(self::$logUtils) || isset (self::$logUtils)) {
            self::$logUtils = new self ();
        }
        return self::$logUtils;
    }


    public function log($message)
    {
        if ($this->debug) {
            echo $message;
            echo "\n";
        }
    }

    public function myVarDump($p)
    {
        if ($this->debug) {
            var_dump($p);
        }
    }
}