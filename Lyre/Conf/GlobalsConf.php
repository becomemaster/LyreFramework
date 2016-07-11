<?php
return array(
    //----------------------------------------- 框架加载配置

    'ControllerPath'=>  'Controller',   //控制器目录名
    'ActionName'=>      '',             //方法后缀
    'ControllerName'=>  'Controller',   //控制器后缀
    'ViewPath'=>        'View',         //视图目录名
    'ModelPath'=>       'Model',        //模型目录名
    'FrameworkWorking'=> true,          //站点状态  true为开启 false为关闭

    //----------------------------------------- 数据库配置

    'DB_TYPE'=>'mysql',                 //数据库类型 支持PDO、Mysql
    'DB_HOST'=>'127.0.0.1',             //数据库地址
    'DB_USER'=>'root',                  //数据库用户
    'DB_PASS'=>'root',                  //数据库密码
    'DB_NAME'=>'jokeDB',                 //数据库名

    //----------------------------------------- 框架路由引入配置

     'Default_Plat'        =>  'Home',  //默认平台
     'Default_Controller'  =>  'Index', //默认控制器名
     'Default_Action'      =>  'index', //默认方法名
     'Controller_Name'     =>  'C',     //控制器参数名
     'Action_Name'         =>  'A',     //方法参数名
     'Plat_Name'           =>  'P',      //平台参数名
     'View_Name'           =>  'html',   //模板文件扩展名
     'Close_Info'          =>  '站点处于关闭状态~! ',   //关闭状态的提示信息
     'Admin_Email'         =>  'root@localhost',   //管理员邮箱
      'Cache_View'         =>  false        //是否缓存模板
);