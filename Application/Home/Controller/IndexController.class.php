<?php
namespace Home\Controller;


use Lyre\Drives\Db;
use Lyre\Kernel\Controller;
use Lyre\Kernel\Model;

class IndexController extends Controller{
    public function index(){
      $this->display();
    }
    public function show(){
      $this->display();
    }

    public function create(){
        //获得单例对象
        $M=new Model('info');
        $this->display();
    }
}