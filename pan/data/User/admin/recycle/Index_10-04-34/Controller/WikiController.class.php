<?php

namespace Index\Controller;
use Think\Controller;

class WikiController extends UserloginController{
    public function index(){
        $this->title = '帮助';
        $this->display();
    }

    public function term(){
        $this->title = '用户条款';
        $this->display();
    }

    public function developerone(){
        $this->title = '如何让我的服务器排名更高?';
        $this->display();
    }

    public function developertwo(){
        $this->title = '为什么我的提现申请被拒绝?';
        $this->display();
    }

    public function developerthree(){
        $this->title = '为什么我账户被删除了，降级了?';
        $this->display();
    }
    public function userone(){
        $this->title = '我购买了服务器要怎么使用？？';
        $this->display();
    }
}