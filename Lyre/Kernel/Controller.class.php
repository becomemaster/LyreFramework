<?php
/*
 --------------------------------------------------
 +            Lyre Framework  Author:倾旋         +
 --------------------------------------------------
 +            Email:payloads@aliyun.com           +
 Copyright © 2016 - 2017 倾旋 All Rights Reserved.
 */
namespace Lyre\Kernel;
class Controller{
    /**
     * @var object Smarty实例
     */
 protected $smarty;


    /**
     * 自动装填模板引擎以及其他操作
     */
 public function __construct(){

     //引入模板引擎
     $this->smarty=new \Smarty();

     //是否缓存
     $this->smarty->caching=C('Cache_View');

     //视图文件夹
     $this->smarty->setTemplateDir(__VIEW__);

     //编译目录
     $this->smarty->setCompileDir(COMP_PATH);

     //设置缓存目录
     $this->smarty->setCacheDir(CACHE_PATH);
 }


    /**
     * @param  string $funcName   未知的函数名
     * @param  string $funcVal    未知函数参数
     * @return int
     * 说明：调用不存在的方法时自动执行此方法
     */
 public function __call($funcName,$funcVal){
     $info='方法名'.$funcName.'() 不存在，请检查代码是否正常';
     if(APP_DEBUG){
         E($info);
     }
     E($info,null,3);
     return 0;
 }


    /**
     * @param string $fileName  显示模板文件
     * 说明：模板文件不存在则选择视图目录下当前方法名模板文件显示
     */
 public function display($fileName=''){
     if(empty($fileName)){
        $view= __VIEW__.__ACTION__.'.'.C('View_Name');
        if(is_file($view)){
            $this->smarty->display($view);
            exit;
        }else{
            E('模板文件不存在：'.$view);
        }
     }
     $this->smarty->display($fileName);
 }


    /**
     * @param string $var  变量名
     * @param string$val  变量名
     * 说明：将变量导入模板
     */
 public function assign($val,$var){
     $this->smarty->assign($val,$var);
 }

 public function error($msg,$url,$time=3){

 }

}