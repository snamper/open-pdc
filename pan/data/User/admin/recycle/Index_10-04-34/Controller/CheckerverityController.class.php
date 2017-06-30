<?php
namespace Index\Controller;
use Think\Controller;
class CheckerverityController extends Controller {
    public function _initialize(){
        $UserData = IfLogin();
        if(!$UserData){
            $this->error('请先登录','/Register',3);
            exit;
        }
        $this->assign('UserData',$UserData);
        $User = M('User');
        $UserSystemData = $User->field('HasShop,SCart',true)->where($UserData)->select();//把数据给到下一个继承的控制器
        $UserSystemData['0']['data'] = CJson($UserSystemData['0']['data'],true);
        $this->UserSystemData = $UserSystemData['0'];
        if($UserSystemData['0']['userstate'] !== '2'){
            $this->error('非法操作',U('/Index/index'),3);
        }
    }
}