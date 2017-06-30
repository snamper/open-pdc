<?php
namespace Org\Tool;
class Message {
    protected $UID;
    protected $Error = array();
    public $Content ='';
    function __construct($UID){
        $this->UID = $UID;
    }

    /**获取错误信息
     * @param string $Name
     * @param string $Error
     * @return bool
     */
    protected function SetError($Name = '',$Error = ''){
        if(!empty($Name) and !empty($Error)){
            $this->Error[$Name] = $Error;
            return true;
        }
        return false;
    }

    /**获取错误信息
     * @return array
     */
    function GetError(){
        return $this->Error;
    }

    /**获取发送的全部消息
     * @return bool|mixed
     */
    function GetSendMessage(){
        return M('Message')->where("senderuid = {$this->UID}")->cache(true)->select();
    }

    /**获取接收的信息
     * @return bool|mixed,返回数据或者失败消息
     */
    function GetReceiveMessage($Page = 1,$Num = 10,$type=1,$state='',$user=''){
        if($state===''){
            $Data = M('Message')->where("receiveuid = {$this->UID}")->page($Page,$Num)->join('__USER__ ON __MESSAGE__.senderuid = __USER__.uid')->select();
        }elseif($user !==''){
            $state = (int)$state;
            $Data = M('Message')->where("complaint = {$user} and type={$type} and state={$state}")->page($Page,$Num)->join('__USER__ ON __MESSAGE__.complaint = __USER__.uid')->select();
        }
        else{
            $state = (int)$state;
            $Data = M('Message')->where("receiveuid = {$this->UID} and type={$type} and state={$state}")->page($Page,$Num)->join('__USER__ ON __MESSAGE__.senderuid = __USER__.uid')->select();
        }
        foreach($Data as &$One){
            $One['data'] = CJson($One['data'],true);
            $One['content'] = CJson($One['content'],true);
            unset($One['hasshop']);
            unset($One['scart']);
        }
        return $Data?$Data:false;
    }

    /**获取消息数量
     * @param int $type
     * @return mixed
     */
    public function GetReceiveMessageCount($type=1,$state=false){
        if($state===false){
            return M('Message')->where("receiveuid = {$this->UID}  and type='{$type}'")->count();
        }else{
            return M('Message')->where("receiveuid = {$this->UID}  and type='{$type}' and state='{$state}'")->count();
        }
    }

    /**发送消息
     * @param string $ToUID ，接收人的uid
     * @param string $title,标题
     * @param string $Content ，内容
     * @return bool ,是否成功
     */
    function SendMessage($ToUID = '',$title = '',$Content = '',$other = '',$type = 1,$complaint=''){
        if(!$ToUID) {
            $this->SetError(__FUNCTION__,'ToUID不存在');
        }
        if($Content=='' and $this->Content=='') $this->SetError(__FUNCTION__,'没有消息');
        $Message = $Content?$Content:$this->Content;
        $Message = utf8_substr($Message,0,1000);
        if($title==''){
            $title = utf8_substr($Message,0,30).'......';
        }else{
            $title = utf8_substr($title,0,30);
        }
        if($complaint!==''){
            $Data['complaint'] = $complaint;
        }
        $MessageData=array();
        $MessageData['title'] = $title;
        $MessageData['content'] = $Message;
        $MessageData = CJson($MessageData);
        $Data['receiveuid'] = $ToUID;
        $Data['senderuid'] = $this->UID;
        $Data['date'] = date("Y-m-d");
        $Data['state'] = 0;
        $Data['type']=$type;
        $Data['content'] = $MessageData;
        if($other !== ''){
            $Data['info'] = $other;
        }
        return (bool)(M('Message')->add($Data));
    }

    function getComplaintSome($sid){
        return (bool)M('Message')->where("senderuid = {$this->UID} and type = 0 and info = {$sid}");
    }

    /**设置信息为已读
     * @param string $MESID
     * @return bool
     */
    function ReadMessage($MESID = ''){
        if(!$MESID) {
            $this->SetError(__FUNCTION__,'消息数据为空');
            return false;
        }
        if(M('Message')->where("mesid = {$MESID} AND receiveuid = {$this->UID}")->getField('state') == 0) {
            return M('Message')->where("mesid = {$MESID} AND receiveuid = {$this->UID}")->setField('state', 1);
        }else{
            return true;
        }
    }


    /**显示单条信息
     * @param string $MESID
     * @return bool|mixed|string
     */
    function ShowMessage($MESID = ''){
        if(!$MESID) {
            $this->SetError(__FUNCTION__,'消息数据为空');
            return false;
        }
        return CJson(M('Message')->where("mesid = {$MESID} AND receiveuid = {$this->UID}")->getField('content'),true);
    }

    /**获取发送者
     * @param string $MESID
     * @return bool|mixed
     */
    function GetSender($MESID = ''){
        if(!$MESID) {
            $this->SetError(__FUNCTION__,'消息数据为空');
            return false;
        }
        $Data = M('Message')->
        where("receiveuid = {$this->UID} AND mesid = {$MESID}")->
        join('__USER__ ON __MESSAGE__.receiveuid = __USER__.uid')->cache(true)->getField('UserName');
        return $Data;
    }

    function GetSenderID($MESID = ''){
        if(!$MESID) {
            $this->SetError(__FUNCTION__,'消息数据为空');
            return false;
        }
        $Data = M('Message')->
        where(" mesid = {$MESID}")->getField('senderuid');
        return $Data;
    }

    function GetComplaintID($MESID = ''){
        if(!$MESID) {
            $this->SetError(__FUNCTION__,'消息数据为空');
            return false;
        }
        $Data = M('Message')->
        where("mesid = {$MESID}")->cache(true)->getField('complaint');
        return $Data;
    }


    function DelMessage($MESID = ''){
        if(!$MESID) {
            $this->SetError(__FUNCTION__,'消息数据为空');
            return false;
        }
        return M('Message')->where("mesid = {$MESID} AND receiveuid = {$this->UID}")->delete();
    }

    public function GetAllCount()
    {
        return M('Message')->where("receiveuid = {$this->UID}")->count();
    }

    public function GetAllCountWithState()
    {
        return M('Message')->where("receiveuid = '{$this->UID}' AND state='0'")->count();
    }
}