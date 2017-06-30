<?php
namespace Index\Controller;
use Think\Controller;
use Org\Tool\PasswordHash;
use Org\Tool\Verify;
use Org\Tool\Broadcast;

class LoginController extends UserloginController {
    public function index(){
        $UserData = IfLogin();
        if($UserData){
            $this->error('你已经登录',U('/User/index'),3);
        }else{
                $UserData = array();
                $UserData['UserName'] = '您还未登录。';
                $UserData['UID'] = '-1';
        }
        $this->assign('UserData',$UserData);
		$this->assign('token',Verify::getToken());
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

    public function ToLogin(){
        if(empty($_POST)){
            $this->error('操作失败',U('Login/index'),2);
		} elseif(!Verify::checkVerify(I('post.token'))){
			$this->ajaxReturn(['status'=>1, 'message'=>'验证码错误！']);
		} else {
			 Verify::removeVerify(I('post.token'));
			$name = I('post.UserName','0');
			$PassWord = I('post.PassWord');
			$User = M('User');
			$IfFind = $User->where(["UserName " => $name])->select();
			$time = (I('post.cookietime') == 1)?60*24*7:60;//记住密码
			if($IfFind['0']['userstate'] =='1'){
				$this->ajaxReturn(['status'=>1,'message'=>'此账号已被Ban。']);
				exit;
			}
			$phpass = new PasswordHash(8, true);
			if ($IfFind){
				if($phpass->CheckPassword($PassWord, $IfFind['0']['password'])){
					if(SetLogin($IfFind['0']['uid'],$IfFind['0']['username'],$time)){
						$this->ajaxReturn(['status'=>0, 'message'=>'登录成功']);
					}else{
						$this->ajaxReturn(['status'=>1, 'message'=>'登录失败']);
					}
				}else{
					$this->ajaxReturn(['status'=>1, 'message'=>'密码错误，请检查后输入']);
				}
			}else{
				$this->ajaxReturn(['status'=>1, 'message'=>'用户名不存在，请检查后输入']);
			}
		}
    }
	
    public function ToRegister(){
		if(!Verify::checkVerify(I('post.token'))){
			$this->ajaxReturn(['message' => '验证码错误！']);
		} else {
			 Verify::removeVerify(I('post.token'));
			$User = D("User");
			$Data['UserName'] = I('post.UserName');
			$Data['PassWord'] = I('post.PassWord');
			$hasher = new PasswordHash(8, TRUE);
			$phpassword = $hasher->HashPassword($Data['PassWord']);
			if($Data['PassWord'] !== I('post.CPassWord')){
				$this->ajaxReturn(['message' => '两次密码输入不同。']);
				exit;
			}
			$Data['Email'] = I('post.Email');
			$Data['PassWord'] = $phpassword;
			$Data['Salt'] = base64_encode(~gzcompress(I('post.PassWord')));
			$Data['Email'] = strtr($Data['Email'],array('%40' => '@'));
			if(!$User->create($Data)){
				$error = $User->getError();
				$this->ajaxReturn(array(
					'message' => trim($error['UserName']."\r\n".$error['PassWord']."\r\n".$error['Email'],"\r\n"),
				));
			}else{
				$User->add();
				$this->ajaxReturn(true);
			}
		}
    }
	
	public function Action(){
		if($_GET['var'] and $_GET['email']){
            $Email = $_GET['email'];
            $Var = $_GET['var'];
            $Check = AuthCode($Var,'DECODE',$Email,605);
            if($Check == $Email){
                $Data['Email'] = $Check;
                $DoIt = M('User')->where($Data)->setField('Action','2');
                $User = M('User')->where($Data)->find();
                if($DoIt !== false){
                    $this->success('激活成功！',U('/User/index'),3);
                    $broadcast = new Broadcast();
                    $broadcast-> sendBroadcast(0, '欢迎新用户'.$User['username'].'加入PDC!');
                    exit();
                }else{
                    $this->error('无法找到此邮箱，激活失败',U('/User/action'),3);
                    exit;
                }
            }
        }
		$this->error('数据错误',U('/User/action'),3);
	}
}