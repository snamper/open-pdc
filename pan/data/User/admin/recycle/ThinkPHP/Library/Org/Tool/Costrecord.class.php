<?php
namespace Org\Tool;
class Costrecord {
    public $costrecord;
    public $uid;
    public function __construct($uid){
        $this->costrecord = M('Costrecord');
        $this->uid = $uid;
    }

    public function getUserCostRecordWithPage($page,$num){
        return $this->costrecord->where("UserUID = {$this->uid}  AND Type = '0'")->order('mid desc')->page($page,$num)->select();
    }

    public function getCount(){
        return $this->costrecord->where("UserUID = {$this->uid}  AND Type = '0'")->count();
    }

    public function getCountMoney(){
        $tmp = $this->costrecord->where("UserUID = {$this->uid}  AND Type = '0'")->sum('Number');
        return  $tmp>0?$tmp:0;
    }

    /**获取全部提款记录
     * @return int|mixed
     */
    public static function getAllATMWithPage($page,$num){
        $tmp =  M('Costrecord')->where("Type = '2'")->page($page,$num)->order('MID desc')->select();
        return  $tmp;
    }

    public static function getUserATMWithPage($uid,$page,$num){
        $tmp =  M('Costrecord')->where("Type = '2' and UserUid ={$uid} and Anumber = {$uid}")->page($page,$num)->select();
        return  $tmp;
    }

    public static function getCountATMUser($uid){
        $tmp =  M('Costrecord')->where("Type = '2' and UserUid ={$uid} and Anumber = {$uid}")->count();
        return  $tmp>0?$tmp:0;
    }

    /**获取全部提款数量
     * @return int
     */
    public static function getCountATMAll(){
        $tmp =  M('Costrecord')->where("Type = '2' AND State='0'")->count();
        return  $tmp>0?$tmp:0;
    }
}
