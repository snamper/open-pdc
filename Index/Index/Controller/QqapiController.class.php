<?php
namespace Index\Controller;
use Think\Controller;
use Org\Tool\Broadcast;

class QqapiController extends Controller{
	public function index(){
		$this->ajaxReturn(['status' => 0, 'version' => '0.0.1']);
	}
	
	public function getlast(){
		$b = new Broadcast;
		$this->ajaxReturn($b->getLastBroadcast());
	}
	
	public function getuntill(){
		$last_id = I('get.id')?I('get.id'):1;
		$b = new Broadcast;
		$this->ajaxReturn($b->getBroadcastUntill($last_id));
	}
}