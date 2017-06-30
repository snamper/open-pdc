<?php

namespace Admin\Controller;

use Think\Controller;

class IndexCheckController extends Controller {

    public function _initialize(){

        $user = IfLogin();
        if(!$user){
            $this->error('请登录',U('/Register'));
            exit;
        }
        if((int)(M('User')->where("uid = {$user['UID']}")->getField('Action')) !== 10){
            $this->error('你没有权限访问',U('/Index/index'));
            exit;
        }
        $superUID = getSuperAdminId();

        $this->messageData = new \Org\Tool\Message($superUID);

        $this->messageNum = $this->messageData->GetReceiveMessageCount(0,0);

        $this->messageNum0 = $this->messageData->GetReceiveMessageCount(0,0);

        $this->messageNum2 = $this->messageData->GetReceiveMessageCount(0,1);

        $this->ATM = \Org\Tool\Costrecord::getCountATMAll();

    }

}