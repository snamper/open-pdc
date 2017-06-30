<?php

namespace Index\Widget;
use Think\Controller;
class BaseController extends Controller{
//用于Widget获取模板地址并输出
    public function template($template){
        $this->display(T($template));
    }
}