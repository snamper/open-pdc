<?php
namespace Index\Widget;
use Think\Controller;
class MenuWidget extends Controller {
    /**
     *用户菜单栏
     */
    public function user(){
        $this->display('Menu:user');
    }

    /**
     *开发者菜单
     */
    public function developer(){
        $this->display('Menu:developer');
    }

}