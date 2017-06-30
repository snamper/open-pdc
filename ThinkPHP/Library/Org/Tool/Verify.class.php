<?php
namespace Org\Tool;

use Org\LZCompressor\LZString as LZString;

class Verify
{
    public function verify(){
		
    }

	public static function getToken(){
		$token = md5(time().rand(0,100));
		$time = time();
		$_SESSION['check'][$token]['check'] = false;
		$_SESSION['check'][$token]['time'] = $time;
		foreach(array_keys($_SESSION['check']) as $key){
			if($_SESSION['check'][$key]['time'] < time() - 3600*24){
				unset($_SESSION['check'][$key]);
			}
		}
		return $token;
	}
	
	public function checkValue($data, $key){
		if(!isset($_SESSION['check'][$key])){
			echo json_encode(['status' => 1, 'message' => '验证不通过！', 'newtoken' => $this::getToken()]);//发送新token
		} else {
    		$data = LZString::decompressFromBase64($data);
    		$data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($data), MCRYPT_MODE_CBC, '2333333333333333');
    		$data = str_replace([chr(0), '/'], ['', '\\/'], $data);
    		$data = json_decode($data, true);
    		//开始验证
    		$check = 0;
    		if($_SERVER['HTTP_USER_AGENT'] == $data['userAgent']){
    			$check ++;
    		}
    		
    		if($data['isPC'] == 1){
    			if($data['move'] >= 10){
    				$check ++;
    			}
    		} else {
    			if($data['move'] >= 1){
    				$check ++;
    			}
    		}
    		
    		if(strlen($data['appVersion']) > 10){
    			$check ++;
    		}
    		
    		$events = json_decode($data['events'], true);
    		if(count($events) >= 3){
    			$check ++;
    		}
    		
    		if($check == 4){
    			echo json_encode(['status' => 0, 'message' => '验证通过！', 'newtoken' => $this::getToken()]);
    			$_SESSION['check'][$key]['check'] = true;
    		} else {
    			$this::removeVerift($key);//删除旧token
    			echo json_encode(['status' => 1, 'message' => '验证不通过！', 'newtoken' => $this::getToken()]);//发送新token
    		}
		}
	}
	
    public static function checkVerify($key){
		return $_SESSION['check'][$key]['check'];
    }
	
	public static function removeVerify($key){
		unset($_SESSION['check'][$key]);
	}
}