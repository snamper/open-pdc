<?php
namespace Org\Tool;
class Alipay {
    protected $alipay;
    public function __construct(){
        $this->alipay = M('Alipay');
    }

    public function getCount(){
        return $this->alipay->count();
    }

    public function getAlipayWithPageByOrder(&$page,&$Num,$order=''){
        return $this->alipay->page($page,$Num)->order($order)->select();
    }

    public function getAlipayWithPageAndWhereByOrder(&$page,&$Num,$order='',$where = ''){
        return $this->alipay->where($where)->page($page,$Num)->order($order)->select();
    }

    public function getAlipayByFindWithPage($page,$Num,$where){
        return M('Alipay')->where("CONCAT(`adddate`,`userid`,`price`,'aid','state') LIKE  '%{$where}%'")->page($page,$Num)->select();
    }

    public function getUserAlipayWithPage($uid,$page,$num){
        return $this->alipay->where("userid = {$uid}")->order('aid desc')->page($page,$num)->select();
    }

    public function getUserCount($uid){
        return $this->alipay->where("userid = {$uid}")->count();
    }
}
