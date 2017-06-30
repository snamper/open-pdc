<?php
namespace Index\Controller;
use Think\Controller;
class UserloginController extends Controller {
    public function _initialize(){
        if(ACTION_NAME !== 'Verify' and ACTION_NAME !== 'Logout'){
            $UserData = IfLogin();
            if(!$UserData){
                $UserData['UserName'] = '您还未登录。';
                $UserData['UID'] = '-1';
            }else{
                $User = M('User');
                $UserSystemData = $User->where($UserData)->select();//把数据给到下一个继承的控制器
                $UserSystemData['0']['data'] = CJson($UserSystemData['0']['data'],true);
                $UserSystemData['0']['scart'] = CJson($UserSystemData['0']['scart'],true);
                $UserSystemData['0']['hasshop'] = CJson($UserSystemData['0']['hasshop'],true);
                $this->UserSystemData = $UserSystemData['0'];
            }
            $this->assign('UserData',$UserData);
        }
    }
}