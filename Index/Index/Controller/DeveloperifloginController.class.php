<?php
namespace Index\Controller;
use Think\Controller;
class DeveloperifloginController extends Controller {
    public $UserSystemData;
    public function _initialize(){
        $UserData = IfLogin();
        if(!$UserData){
            $this->error('请先登录',U('/Login'),3);
        }
        $this->assign('UserData',$UserData);
        $User = M('User');
        $UserSystemData = $User->where($UserData)->find();//把数据给到下一个继承的控制器
        $UserSystemData['data'] = CJson($UserSystemData['data'],true);
        $this->UserSystemData = $UserSystemData;
        if($UserSystemData['action'] == '0'){
            $this->error('请先激活你的邮箱',U('User/Action'),3);
        }
    }
}