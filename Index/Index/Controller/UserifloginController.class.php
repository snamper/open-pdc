<?php
namespace Index\Controller;
use Think\Controller;
class UserifloginController extends Controller {
    public function _initialize(){
        $UserData = IfLogin();
        if(!$UserData){
            $this->error('请先登录',U('/Login'),3);
            exit;
        }
        $this->assign('UserData',$UserData);
        $User = M('User');
        $UserSystemData = $User->where($UserData)->select();//把数据给到下一个继承的控制器
        $UserSystemData['0']['data'] = CJson($UserSystemData['0']['data'],true);
        $this->UserSystemData = $UserSystemData['0'];
        if(($UserSystemData['0']['action'] == 0) and (strtolower(ACTION_NAME) !== 'action')){
            $this->error('请先激活你的邮箱',U('User/Action'),3);
        }elseif($UserSystemData['0']['action'] !== '0' and strtolower(ACTION_NAME) == 'action'){
            $this->error('非法操作',U('User/index'),3);
        }
    }
}