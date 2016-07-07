<?php
/*
 --------------------------------------------------
 +            Lyre Framework  Author:倾旋         +
 --------------------------------------------------
 +            Email:payloads@aliyun.com           +
 Copyright © 2016 - 2017 倾旋 All Rights Reserved.
 */
class LyreRUN{
    public function __construct(){
        $this->initConst();
        $this->initConfig();
        $this->initRoutes();
        $this->initAutoLoad();
        $this->initRunMethod();
    }
    /**
     * 定义常量
     */
    private function initConst(){
        //系统路径分隔符
        if(!defined('DS')){
            define('DS',DIRECTORY_SEPARATOR);
        }
        //项目目录
        if(!defined('ROOT_PATH')){
            define('ROOT_PATH',getcwd().DS);
        }
        //框架架构层
        if(!defined('LYRE_PATH')){
            define('LYRE_PATH',ROOT_PATH.'Lyre'.DS);
        }
        //核心底层
        if(!defined('KERNEL_PATH')){
            define('KERNEL_PATH',LYRE_PATH.'Kernel'.DS);
        }
        //扩展库层
        if(!defined('EXPAND_PATH')){
            define('EXPAND_PATH',LYRE_PATH.'Expand'.DS);
        }
        //框架配置层
        if(!defined('CONF_PATH')){
            define('CONF_PATH',LYRE_PATH.'Conf'.DS);
        }
        //Public静态资源及插件层
        if(!defined('PUBLIC_PATH')){
            define('PUBLIC_PATH',ROOT_PATH.'Public'.DS);
        }

        //项目目录
        if(!defined('APP_PATH')){
            define('APP_PATH',ROOT_PATH.'Application'.DS);
        }

        //项目目录
        if(!defined('CONFIG_PATH')){
            define('CONFIG_PATH',APP_PATH.'Config'.DS);
        }

        //插件路径
        if(!defined('PLUGINS_PATH')){
            define('PLUGINS_PATH',PUBLIC_PATH.'plugins'.DS);
        }
        //上传绝对路径
        if(!defined('UPLOAD_PATH')){
            define('UPLOAD_PATH',PUBLIC_PATH.'Upload'.DS);
        }
        //定义类文件扩展名
        if(!defined('__CLASSNAME__')){
            define('__CLASSNAME__','.class.php');
        }
    }

    private function initConfig(){
        $GLOBALS['config']=require CONF_PATH.'RouteConf.php';
    }

    private function initRoutes(){
        $p=isset($_REQUEST['P'])?$_REQUEST['P']:$GLOBALS['config']['Default_Plat'];       //当前平台名
        $c=isset($_REQUEST['C'])?$_REQUEST['C']:$GLOBALS['config']['Default_Controller']; //当前控制器名
        $a=isset($_REQUEST['A'])?$_REQUEST['A']:$GLOBALS['config']['Default_Action'];//当前方法名
        //检测平台是否存在
        if(is_dir(APP_PATH.$p.DS)){
            define('CONTROLLER_PATH',APP_PATH.$p.DS.'Controller'.DS);
        }else{
            exit;
        }
        define('__ACTION__', $a);
        define('__CONTROOLER__',$c);
        define('__URL__',CONTROLLER_PATH);    //当前控制器的目录
        define('__VIEW__',APP_PATH.$p.DS.'View'.DS);//当前视图的目录
        define('__MODEL__',APP_PATH.$p.DS.'Model'.DS);//当前Model的目录
    }
    private function initAutoLoad(){
        spl_autoload_register('self::Auto');
    }
    private function Auto($className){
        if(is_file(APP_PATH.$className.__CLASSNAME__)){
            require APP_PATH.$className.__CLASSNAME__;
        }else if(is_file(ROOT_PATH.$className.__CLASSNAME__)){
            require ROOT_PATH.$className.__CLASSNAME__;
        }
    }
    private function initRunMethod(){
        $class=__CONTROOLER__;
        $action=__ACTION__;
        $ObjName=new $class();
        $ObjName->$action();
    }
}


