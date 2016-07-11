<?php
/*
 --------------------------------------------------
 +            Lyre Framework  Author:倾旋         +
 --------------------------------------------------
 +            Email:payloads@aliyun.com           +
 Copyright © 2016 - 2017 倾旋 All Rights Reserved.
 */


/**
 * @param string $opName    配置名
 * @return int|null|string  配置值
 * 说明：该函数不传入配置名 则返回站点全局配置数组
 */
function C($opName='')
{
    $opVal=array();     //配置匹配值
    $opEndVal=array();  //匹配最后配置
    $conf_var['GLOBAlS']=require CONF_PATH.'GlobalsConf.php';
    $conf_var['CONST']=require CONF_PATH.'ConstConf.php';
    $conf_var['DBCONF']=require CONF_PATH.'DBconf.php';
    $conf_var['ROUTE']=require CONF_PATH.'RouteConf.php';
    $conf_var['SITE']=require CONFIG_PATH.'config.php';
    /**
     * 配置文件优先级
     * ConstConf.php < DBconf.php < RouteConf.php < config.php
     */
    //如果为空、则返回所有配置
    if(empty($opName)){
        return $conf_var;
    }else{
        //获取所有优先配置
        foreach($conf_var as $key=>$val){
            if(isset($val[$opName])){
                $opVal[]=$val[$opName];
            }else{
                $opVal[]=NULL;
            }
        }
        //匹配最优先配置
        foreach($opVal as $key){
            if(is_string($key)||is_int($key)||is_bool($key)){
                $opEndVal[]=$key;
            }
        }
        //返回最优先配置
        if(count($opEndVal)==0 && APP_DEBUG || count($opEndVal)==0){
            E('NOT FOUND OPTION NAME :'.$opName);
        }
        return $opEndVal[count($opEndVal)-1];
    }
}

/**
 * @param string    $var     要打印的变量
 * @param bool|true $type   是否打印变量类型
 * 说明：该函数属于调试函数,建议不要在线上使用.
 */
function P($var,$type=true)
{
    echo '<pre>';
    if($type){
     var_dump($var);
    }else{
     print_r($var);
    }
    echo '</pre>';
}


/**
 * @param string $msg       提示信息
 * @param null   $page      显示页面名称
 * @param int    $time      跳转时间 单位：秒
 * 说明：APP_DEBUG为true后，所有的提示都将不跳转
 */
function E($msg,$page=null,$time=0){
    $time=APP_DEBUG?0:3;
    header('Content-type:text/html;charset=utf-8');
    if(empty($page)){
        require ERROR_PATH.'info.'.C('View_Name');
        die;
    }
    require ERROR_PATH.$page.'.'.C('View_Name');
    die;
}


function G($array,$key){
    $array_result=array();
    foreach($array as $k){
        if(isset($k[$key]) && !empty($k[$key])){
            $array_result[]=$k[$key];
        }
    }
    return $array_result;
}


function U($path){
    $url='/index.php/'.$path;
    echo $url;
}