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

        //定义框架加载常量
        $this->initConst();

        //引入自定义函数
        $this->initFunctions();

        //检查站点配置状态
        $this->initCheck();

        //初始化路由
        $this->initRoutes();

        //注册自动加载类函数
        $this->initAutoLoad();

        //执行加载方法
        $this->initRunMethod();
    }


    /**
     * 检查站点配置状态
     */
    private function initCheck(){
        if(C('FrameworkWorking')==false || WORK==false){
            E(C('Close_Info').'请联系'.C('Admin_Email'),'close',0);
        }
    }




    /**
     * 定义框架核心常量
     * 说明：该方法内所有常量都可以在入口文件优先定义
     */
    private function initConst(){
        //是否关站
        if(!defined('WORK')){
            define('WORK',true);
        }
        //是否调试
        if(!defined('APP_DEBUG')){
            define('APP_DEBUG',false);
        }
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
        //模板引擎目录
        if(!defined('TEMP_PATH')){
            define('TEMP_PATH',KERNEL_PATH.'Smarty'.DS);
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
        //Error错误页面目录
        if(!defined('ERROR_PATH')){
            define('ERROR_PATH',ROOT_PATH.'Error'.DS);
        }
        //项目目录
        if(!defined('APP_PATH')){
            define('APP_PATH',ROOT_PATH.'Application'.DS);
        }
        //项目模板缓存目录
        if(!defined('CACHE_PATH')){
            define('CACHE_PATH',APP_PATH.'Cache'.DS);
        }
        //项目模板编译文件目录
        if(!defined('COMP_PATH')){
            define('COMP_PATH',APP_PATH.'Compile'.DS);
        }
        //项目配置文件目录
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

    /**
     * 引入框架自定义工具函数
     */
    private function initFunctions(){
        require_once 'Kernel/Functions.php';
    }

    /**
     * 初始化路由
     * 说明:该方法不需要修改、自动读取配置文件参数
     */
    private function initRoutes(){
        //当前平台名
        $p=isset($_REQUEST[C('Plat_Name')])?htmlspecialchars($_REQUEST[C('Plat_Name')]):C('Default_Plat');

        //当前控制器名
        $c=isset($_REQUEST[C('Controller_Name')])?htmlspecialchars($_REQUEST[C('Controller_Name')]):C('Default_Controller');

        //当前方法名
        $a=isset($_REQUEST[C('Action_Name')])?htmlspecialchars($_REQUEST[C('Action_Name')]):C('Default_Action');

        //定义控制器
        define('__CONTROOLER__',$p.DS.C('ControllerPath').DS.$c.C('ControllerName'));

        //检测平台是否存在
        if(is_dir(APP_PATH.$p.DS)){
            define('CONTROLLER_PATH',APP_PATH.$p.DS.C('ControllerPath').DS);
        }else{
            E('平台不存在：'.APP_PATH.$p.DS);
            exit;
        }
        //定义当前方法名常量 ：__ACTION__
        define('__ACTION__',$a.C('ActionName'));

        //定义当前控制器的目录常量：__URL__
        define('__URL__',CONTROLLER_PATH);

        //定义当前视图的目录常量：__VIEW__
        define('__VIEW__',APP_PATH.$p.DS.C('ViewPath').DS);

        //定义当前模型常量：__MODEL__
        define('__MODEL__',APP_PATH.$p.DS.C('ModelPath').DS);

        //检查控制器是否存在
        if(!is_file(APP_PATH.__CONTROOLER__.__CLASSNAME__)){
            E('控制器不存在：'.APP_PATH.__CONTROOLER__.__CLASSNAME__);
            exit;
        }
    }


    /**
     * 注册自动加载类函数
     * 说明：Auto()方法为当前类自动加载函数
     */
    private function initAutoLoad(){
        spl_autoload_register('self::Auto');
    }


    /**
     * @param string $className 当前缺少类名
     * @return int
     * 说明：改方法 Switch节点处可扩展其他插件目录
     */
    private function Auto($className){

        //优先检查控制器类名
        if(is_file(APP_PATH.$className.__CLASSNAME__)){

            //包含控制器
            require APP_PATH.$className.__CLASSNAME__;

            //结束此次加载寻找
            return 0;

            //检查根扩展类名
        }else if(is_file(ROOT_PATH.$className.__CLASSNAME__)){
            //包含扩展
            require ROOT_PATH.$className.__CLASSNAME__;
            //结束此次加载寻找
            return 0;
        }

       //分割获取缺少剩余类
       $list=explode('\\',$className);

       //获得缺少类名
       $loadName=$list[count($list)-1];

       //扩展加载方法
       switch($loadName){

           //优先匹配Smarty引擎
           case 'Smarty':
               //包含Smarty
               require TEMP_PATH.$loadName.__CLASSNAME__;
               //跳出此次加载寻找
               break;
           /*
            * 此节点待扩展其他目录寻找……
            * */
       }
    }

    /**
     * 执行加载方法
     * 说明：该方法建议不要修改
     */
    private function initRunMethod(){
        $class=__CONTROOLER__;
        $action=__ACTION__;
        $ObjName=new $class();
        $ObjName->$action();
    }
    
}


