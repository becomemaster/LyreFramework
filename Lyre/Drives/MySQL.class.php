<?php
/*
 --------------------------------------------------
 +            Lyre Framework  Author:倾旋         +
 --------------------------------------------------
 +            Email:payloads@aliyun.com           +
 Copyright ? 2016 - 2017 倾旋 All Rights Reserved.
 */
namespace Lyre\Drives;
class MySQL{

    //保存mysqli对象
    private $mysql;

    //结果
    public $result;

    //表名
    public $tableName;

    //连接数据库
    public function __construct($tableName){
        $this->mysql=new \mysqli(C('DB_HOST'),C('DB_USER'),C('DB_PASS'),C('DB_NAME'))or E($this->mysql->error,'info',0);
        $this->tableName=$tableName;
    }

    public function getAllTables(){
        $result=array();
        $rows=$this->query('show tables');
        while($row=$rows->fetch_assoc()){
            $result[]=$row;
        }
        return $result;
    }

    /**
     * @param $sql
     * @param string $type
     * @param bool|false $one
     * @return array
     * 说明：最后一个参数默认获取全部、若为true则获取一条
     */
    public function fetch($sql,$type='assoc',$one=false){
        $fetchType='fetch_'.$type;
        $result=$this->query($sql);
        if($one){
            return $result->$fetchType();
        }
        $allRes=array();
        while($row=$result->$fetchType()){
            $allRes[]=$row;
        }
        return $allRes;
    }

    public function getPRI(){
       $sql='desc '.$this->tableName;
       $result=$this->fetch($sql,'assoc');
        foreach ($result as $key) {
            if($key['Key']=='PRI'){
                return $key['Field'];
            }
            continue;
        }
        return null;
    }

    public function query($sql){
        $sql=$this->mysql->real_escape_string($sql);
        $status=$this->mysql->query($sql);
        if(!$status){
            $error='当前SQL语句出错：<pre style="color:#f0ad4e;font-size: 18px">'.$sql.'</pre>';
            $error.='错误信息：<pre style="color:#122b40;">'.$this->mysql->error.'</pre>';
            $error.='错误代码：<pre style="color:red;">'.$this->mysql->errno.'</pre>';
            E($error);
        }
        return $status;
    }

    public function getField(){
        $sql='desc '.$this->tableName;
        $result=$this->fetch($sql,'assoc');
        return G($result,'Field');
    }

    public function insert(){

    }

}