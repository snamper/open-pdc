<?php
namespace Org\Tool;
class Broadcast{
    public function sendBroadcast($uid,$contentData=''){
        $data['content'] = str_replace("\r", '', $contentData);
        $data['uid'] = $uid;
        $check = M('Broadcast')->add($data);
        if($check){
            return $check;
        }else{
            return false;
        }
    }
    public function getBroadcast($bid){
        $data = M('Broadcast')->where(['bid' => $bid])->find();
    }
	
    public function getBroadcastUntill($bid){
        $data = M('Broadcast')->where('`bid` > ' . intval($bid))->order('time desc')->select();
        return $data;
    }
	
	public function getLastBroadcast(){
        $data = M('Broadcast')->order('time desc')->limit(1)->find();
        return $data;
    }
}