<?php
namespace Index\Controller;
use Org\Tool\Verify;
class CheckController
{
    public function index(){
		$data = I('post.data');
		$key = I('post.token');
		$checker = new Verify();
        $checker->checkValue($data, $key);
    }
	
	public function sessions(){
		print_r($_SESSION);
		foreach(array_keys($_SESSION) as $key){
			unset($_SESSION[$key]);
		}
	}
}