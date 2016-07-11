<?php
/*
 --------------------------------------------------
 +            Lyre Framework  Author:倾旋         +
 --------------------------------------------------
 +            Email:payloads@aliyun.com           +
 Copyright © 2016 - 2017 倾旋 All Rights Reserved.
 */
namespace Lyre\Kernel;
use Lyre\Drives\Db;

class Model{
    public $db;
    public function __construct($tableName){
        $this->db=Db::getDB($tableName);
        $this->db->mysql->query('select * from sss');
        echo $this->db->Primary;
    }


}