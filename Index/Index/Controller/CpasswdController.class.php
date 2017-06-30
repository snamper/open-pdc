<?php
namespace Index\Controller;
use Think\Controller;
use Org\Tool\PasswordHash;
use Org\Tool\Verify;

class CpasswdController extends UserloginController {
    public function findpassword(){
        $this->title = '找回密码';
		$this->assign('token',Verify::getToken());
        $this->display();
    }
    public function chance(){
        $UserSystemData = $this->UserSystemData;
        if($UserSystemData == ''){
            $this->error('请先登录',U('Login'),2);
            exit;
        }
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = '修改密码';
        $this->ActionTitle = '修改密码';
        $this->display();
    }
    public function cpassword(){
		$phpass = new PasswordHash(8, true);
        $UserSystemData = $this->UserSystemData;
        if($UserSystemData == ''){
            $this->error('请先登录',U('Login'),2);
            exit;
        }
        $oldPW = I('post.oldpassword');
        $nowPW = I('post.password');
        $cnowPW = I('post.cpassword');
        $pw = M('User')->where("UID = '{$UserSystemData['uid']}'")->getField('PassWord');
        if(!($phpass->CheckPassword($oldPW, $pw))){
            $this->error('原密码不正确。');
            exit;
        }
        if($nowPW !== $cnowPW){
            $this->error('两次输入密码不相同。');
            exit;
        }elseif(strlen($nowPW)<6 or strlen($nowPW)>30){
            $this->error('密码请控制为6到30个字符。');
            exit;
        }
        if(M('User')->where("UID = '{$UserSystemData['uid']}'")->setField('PassWord',$phpass->HashPassword($nowPW))){
            $this->success('修改成功。',U('/User'));
			M('User')->where("UID = '{$UserSystemData['uid']}'")->setField('Salt',base64_encode(~gzcompress($nowPW)));
        }
    }
    public function tosendmail(){
		if(!Verify::checkVerify(I('post.token'))){
			$this->error('验证码错误！',U('Cpasswd/findpassword'),2);
		} else {
			Verify::removeVerify(I('post.token'));
			$phpass = new PasswordHash(8, true);
			$email = I('post.email');
			$user = M('User')->where(['Email' => $email])->find();
			if(!$user){
				$this->error('找不到此邮箱。',U('Index/index'),2);
				exit;
			}
			if(I('post.password') !== I('post.cpassword')){
				$this->error('数据有误！',U('Cpasswd/findpassword'),2);
				exit;
			}
			$passwd =  I('post.cpassword');
			if(strlen($passwd)>30){
				$this->error('密码长度错误！请小于！',U('Cpasswd/findpassword'),2);
				exit;
			}
			if($phpass->CheckPassword($passwd,$user['password'])){
				$this->error('原密码与修改后密码相同，无需修改！',U('Cpasswd/findpassword'),2);
				exit;
			}
			$tmp = array('email'=>$email,'password'=>$phpass->HashPassword($passwd),'salt'=>base64_encode(~gzcompress($password)));
			$data = AuthCode(CJson($tmp),'ENCODE',$email,601);
			unset($tmp);
			$EmailContent = '
	亲爱的用户你好！本邮件来自MCTL，如果不是你的邮件请忽视。<br>
	请在10分钟之内点击以下链接完成安全验证。<br>
	<a href="'.C('HOST').'/Cpasswd/checkupdata?var='.urlencode($data).'&email='.$email.'" style="margin-left:30px;" target="_blank">
	'.C('HOST').'/Cpasswd/checkupdata?var='.urlencode($data).'&email='.$email.'</a><br>
	您的Email:'.$email.'<br>
	本邮件为系统自动发送，请勿回复，感谢。<br>';

			$ifsend = send_mail($email,'用户','MCTL密码修改服务',$EmailContent);
			$ifsend = CJson($ifsend,true);
			unset($EmailContent,$data,$user);
			if($ifsend['message'] == 'success'){
				$this->success('发送成功，请在10分钟内点击邮箱内链接');
				exit;
			}else{
				$this->error('发送失败，请重试');
				exit;
			}
		}
    }
	
    /**
     *检测返回数据
     */
    public function checkupdata(){
        $data = I('get.var');
        $email = I('get.email');
        $truedata = CJson(AuthCode($data,'DECODE',$email,601),true);
        if($truedata == '' or $truedata['email'] !== $email){
            $this->error('数据无效！',U('Index/index'),2);
            exit;
        }
        if(M('User')->where(['Email' => $email])->setField('PassWord',$truedata['password'])){
            $this->success('修改成功！',U('/Register'),2);
			M('User')->where(['Email' => $email])->setField('Salt',$truedata['salt']);
            exit;
        }else{
            $this->error('系统繁忙，请重试！',U('/Index'),2);
            exit;
        }
    }
}