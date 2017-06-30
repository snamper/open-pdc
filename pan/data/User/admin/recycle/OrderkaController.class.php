<?php
namespace Index\Controller;
use Think\Controller;
class OrderkaController extends Controller
{
    public function pay(){
        $user = IfLogin();
        if(!$user){
            echo '请登录';
            exit;
        }
        if(I('post.cnum')==''){
            echo '非法数据';
            exit;
        }
        $num = I('post.money',0,'number_int');
        $numlist=array(5,10,30,50,100);
        if(!in_array($num,$numlist)){
            $this->error('数据非法！请正确填写充值金额');
            exit;
        }
        if(!(ctype_alnum(I('post.cnum')) or ctype_digit(I('post.cnum')) or ctype_alpha(I('post.cnum')))){
            $this->error('数据非法！请正确填写卡号');
            exit;
        }
        if(!(ctype_alnum('post.cpwd') or ctype_digit(I('post.cpwd')) or ctype_alpha(I('post.cpwd')))){
            $this->error('数据非法！请正确填写卡密');
            exit;
        }
        $GUID = md5(date("YmdHis").$user['UID'].getGuid());
        $Data['ordernum'] = $GUID;
        $Data['userid'] = $user['UID'];
        $Data['title'] = "PmPlugin平台卡密充值[充值用户:{$user['UID']}|时间:".date("Y-m-d H:i:s").']';
        $Data['price'] = $num;
        $Data['adddate'] = Date("Y-m-d H:i:s");
        $t = array('ctype'=>I('post.ctype'));
        $Data['kadata']=CJson($t);
        $id = M('Alipay')->add($Data);
        $DAO = M('Alipay');//订单数据库
        $order = $DAO->where("aid=".$id)->find();
        $this->getPay($order,I('post.cnum'),I('post.cpwd'),$num,I('post.ctype'));
    }

    /**
     * 通知
     */
    public function notify(){
        $orderLogDao = M('Alipaylog');
        $config=C('KaPay');
        $orderid=$_REQUEST['orderid'];
        $restate=$_REQUEST['restate'];
        $ovalue=$_REQUEST['ovalue'];
        $sign=$_REQUEST['sign'];

        $resultstr='orderid='.$orderid;
        $resultstr.='&restate='.$restate;
        $resultstr.='&ovalue='.$ovalue.$config['userSign'];
        $keystr	=md5($resultstr);
        if($keystr==$sign) {//验证成功
            if($restate == '0') {
                $DAO = M('Alipay');
                $order = $DAO->where("ordernum='{$orderid}'")->find();
                if(!$order){
                    echo "fail";
                    exit;
                }
                else{
                    $orderId = (int)$order['aid'];
                }
                if(isset($order) && $order['state'] !== '1'&& $order['state'] !== '2'){
                    $log = "卡平台记录, 消息：".$restate;
                    $orderLog['orderid'] = (int)$orderId;
                    $orderLog['adddate'] = Date("Y-m-d H:i:s");
                    $resultInfo = $this->doAfterPaySuccess($orderid);
                    $log.= $resultInfo;
                    $orderLog['log'] = $log;
                    $orderLogDao->add($orderLog);
                }
            }else{
                $DAO = M('Alipay');
                $order = $DAO->where("ordernum='{$orderid}'")->find();
                if(!$order){
                    echo "fail";
                    exit;
                }
                else{
                    $orderId = (int)$order['aid'];
                }
                if(isset($order) && $order['state'] !== '1'&& $order['state'] !== '2' ){
                    $log = "卡平台记录,充值失败, 消息：".$restate;
                    $orderLog['orderid'] = (int)$orderId;
                    $orderLog['adddate'] = Date("Y-m-d H:i:s");
                    $resultInfo = $this->doAfterPayFail($orderId);
                    $log.= $resultInfo;
                    $orderLog['log'] = $log;
                    $orderLogDao->add($orderLog);
                }
            }
            echo "ok"; //返回成功标记
        }
        else {
            echo "fail";
        }
    }
    protected function getPay($order,$cardid,$cardpass,$value,$type){
        $config = C('KaPay');
        $parter			=	$config['userId'];
        $callbackurl	=	$config['result_url'];
        $orderid	=	$order['ordernum'];
        $keystr	=	"parter=".$parter;
        $keystr	.=	"&cardtype=".$type;
        $keystr	.=	"&cardno=".$cardid;
        $keystr	.=	"&cardpwd=".$cardpass;
        $keystr	.=	"&orderid=".$orderid;
        $keystr	.=	"&callbackurl=".$callbackurl;
        $keystr	.=	"&restrict=0";
        $keystr	.=	"&price=".$value;
        $keystr1	=	$keystr.$config['userSign'];
        $sign	=	md5($keystr1);
        $reqURL_onLine	= $config['gateWary'].'?'.$keystr.'&sign='.$sign;
        $result =	file_get_contents($reqURL_onLine); //提交
        if ($result	==	'0'){
            $this->success('提交成功,请耐心等待。用户中心有充值记录。',U('/User/recharge'),2);
                exit;
        }elseif($result=='-1'){
            $this->success('卡号密码错误',U('/User/recharge'),2);
            exit;
        }elseif($result=='-2'){
            $this->success('卡实际面值和提交时面值不符',U('/User/recharge'),2);
            exit;
        }elseif($result=='-3'){
            $this->success('成功状态，但卡实际面值和提交时面值不符',U('/User/recharge'),2);
            exit;
        }elseif($result=='-4'){
            $this->success('卡已经使用',U('/User/recharge'),2);
            exit;
        }else{
            $this->success('请确认卡号密码卡类型正确：'.$result,U('/User/recharge'),2);
            exit;
        }

    }
    protected function doAfterPaySuccess($order){
        $ALipay = M('Alipay')->where("ordernum = '{$order}'")->setField('state',1);
        $orderData = M('Alipay')->where("ordernum = '{$order}'")->find();
        $moeny = I('get.ovalue',0,'number_float');
        $fee = array(
            1=>0.88,
            2=>0.86,
            3=>0.85,
            4=>0.88,
            5=>0.84,
            6=>0.84,
            7=>0.87,
            8=>0.84,
            9=>0.87,
            10=>0.95,
            11=>0.95,
            12=>0.95,
            14=>0.84,
            15=>0.83,
            16=>0.8,
        );
        if($orderData['kadata']!=='0'){
            $cardid = CJson($orderData['kadata'],true);
            $cardid = (int)$cardid['ctype'];
        }else{
            $cardid = 16;
        }
        $money = $moeny*$fee[$cardid];
        $ALipay = M('Alipay')->where("ordernum = '{$order}'")->setField('price',$money);
        $User = M('User')->where("uid = '{$orderData['userid']}'")->setInc('Money',$money);
        if($ALipay and $User){
            return "充值完成，受益人{$order['userid']}，金额{$money},卡类型{$cardid}";
        }
        return '失败';
    }

    private function doAfterPayFail($orderid)
    {
        M('Alipay')->where("aid = '{$orderid}'")->setField('title','充值失败，请确认你的卡是否可用，或者请重试');
        M('Alipay')->where("aid = '{$orderid}'")->setField('state',2);
        return '充值失败'.CJson(I('get.'));
    }
}