<?php
namespace Org\Tool;
class GVerify
{
    /**使用Get的方式返回：challenge和capthca_id 此方式以实现前后端完全分离的开发模式 专门实现failback
     *获取极验数据
     */
    public function verify(){
        $GtSdk = new  \Org\Tool\GeetVerify();
        session('gtsdk',$GtSdk);
        $return = $GtSdk->register();
        if ($return) {
            session('gtsdk',1);
            $result = array(
                'success' => 1,
                'gt' => C('CAPTCHA_ID'),
                'challenge' => $GtSdk->challenge
            );
            echo json_encode($result);
        }else{
            session('gtsdk',0);
            $rnd1 = md5(rand(0,100));
            $rnd2 = md5(rand(0,100));
            $challenge = $rnd1 . substr($rnd2,0,2);
            $result = array(
                'success' => 0,
                'gt' => C('CAPTCHA_ID'),
                'challenge' => $challenge
            );
            session('challenge',$result['challenge']);
            echo json_encode($result);
        }
    }

    /**
     *检测验证码是否正确
     */
    public function checkVerify(){
		return true;
    }
}