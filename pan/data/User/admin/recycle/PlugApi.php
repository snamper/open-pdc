<?php
namespace Index\Controller;
use Think\Controller;
class ApiController extends Controller{
	public function index(){
		$this->ajaxReturn(['sources' => ['pdc' => 'Pocket Developer Center']]);
	}
	
	public function pdc(){
		print_r($_SERVER);
	}
}