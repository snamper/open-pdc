<?php
namespace Index\Controller;
use Think\Controller;
class ErrorController extends UserloginController {
    public function 404(){
        $this->error('404 Not Found!','javascript:history.back(-1);',6);
    }
}