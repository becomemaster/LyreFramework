<?php
/*
 --------------------------------------------------
 +            Lyre Framework  Author:倾旋         +
 --------------------------------------------------
 +            Email:payloads@aliyun.com           +
 Copyright ? 2016 - 2017 倾旋 All Rights Reserved.
 */
namespace Lyre\Drives;
class Db{
    //数据库驱动单例对象
    private static $db;

    //mysql对象
    public  $mysql;

    //字段
    private $Field;

    //主键
    public $Primary;
    /**
     * @param string $tableName 表名
     *说明：获取表操作对象及设置
     */
    private function __construct($tableName){
        $this->mysql=new MySQL($tableName);
        $this->Primary=$this->mysql->getPRI();
        $this->Field=$this->mysql->getField();
    }

    private function __clone(){
        //私有克隆防止clone对象
    }

    /**
     * @param string $tableName 表名
     * @return Db
     */
    public static function getDB($tableName){
        if(self::$db instanceof Db){
            return self::$db;
        }else{
            self::$db=new Db($tableName);
            return self::$db;
        }
    }

}


