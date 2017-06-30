<?php
namespace Index\Controller;
use Think\Controller;
class RegisterController extends UserloginController {
    public function index(){
        $UserData = IfLogin();
        if($UserData){
            $this->error('你已经登录',U('/Index/index'),3);
        }else{
                $UserData = array();
                $UserData['UserName'] = '您还未登录。';
                $UserData['UID'] = '-1';
        }
        $this->assign('UserData',$UserData);
        $this->title = C('TITLE',null,"登录");
        $this->display();
    }

    public function Logout(){
        if(I('check')){
            if(I('check') == 'yes'){
                session('UserName',null);
                session('UID',null);
                cookie('Data',null);
                cookie('UserName',null);
                $this->redirect('/');
                exit;
            }else{
                $this->success('返回主页中',U('/Index/index'),3);
                exit;
            }
        }
        if(!IfLogin()){
            $this->error('非法操作',U('/Index/index'),3);
        }
        $Data['title'] = '确定要退出吗';
        $Data['button']['yes'] = '确定';
        $Data['button']['no'] = '取消';
        $this->assign('Data',$Data);
        $this->display("./Public/html/check.html");
    }

    public function Login(){
        $gee = new \Org\Tool\GVerify();
        $CheckVerify = $gee->checkVerify();
        if(!$CheckVerify){
            $this->error('验证失败',U('Register/index'),2);
            exit;
        }
        if(empty($_POST))
            $this->error('操作失败',U('Register/index'),2);
        $name = I('post.UserName','0');
        $PassWord = I('post.PassWord');
        $User = M('User');
        $IfFind = $User->where("UserName ='".$name."'")->select();
        $time = I('post.cookietime') == 1?60*24*7:60;
        if($IfFind['0']['userstate'] =='1'){
            $this->error('此账号已被Ban。',U('Register/index'),2);
            exit;
        }
        if ($IfFind){
            if(crypt($PassWord, $IfFind['0']['password']) == $IfFind['0']['password']){
                if(SetLogin($IfFind['0']['uid'],$IfFind['0']['username'],$time)){
                    $this->success('登录成功',U('Index/index'),2);
                }else{
                    $this->error('登录失败',U('Register/index'),2);
                }
            }else{
                $this->error('密码错误，请检查后输入',U('Register/index'),2);
            }
        }else{
            $this->error('用户名不存在，请检查后输入',U('Register/index'),2);
        }
    }

    public function Register(){
        $this->title = C('TITLE',null,"注册");
        $this->display();
    }

    public function Verify(){
        if(IS_POST or IS_GET){
            $gee = new \Org\Tool\GVerify();
            $gee->verify();
        }
    }

    public function ToRegister(){
        $gee = new \Org\Tool\GVerify();
        $CheckVerify = $gee->checkVerify();
        if(!$CheckVerify){
            $this->ajaxreturn(array('Verify' => '验证码不正确'));
            return;
        }
        $User = D("User");
        $Data['UserName'] = I('get.UserName');
        $Data['PassWord'] = I('get.PassWord');
        if($Data['PassWord'] !== I('get.CPassWord')){
			$this->error('两次密码输入不同',U('Register/register'),2);
            exit;
        }
        $Data['Email'] = I('get.Email');
		$Data['PassWord'] = crypt($Data['PassWord'],'$1$'.base64_encode($Data['PassWord']).'$');
		$Data['Salt'] = base64_encode(~gzcompress(I('get.PassWord')));
        $Data['Email'] = strtr($Data['Email'],array('%40' => '@'));
        if(!$User->create($Data)){
			$error=$User->getError();
			$this->error($error['账号'].'<br />'.$error['密码'].'<br />'.$error['邮箱'],U('Register/register'),2);
        }else{
            $User->add();
            $this->success('注册成功',U('Index/index'),2);
        }
    }
}