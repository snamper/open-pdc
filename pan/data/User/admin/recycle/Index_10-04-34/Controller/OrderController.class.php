<?php
namespace Index\Controller;
use Think\Controller;
use Vendor\AlipaySubmit as AlipaySubmit;
use Vendor\AlipayNotify as AlipayNotify;
class OrderController extends Controller
{
    public function Index(){
        $alipay_config['partner']		= '支付宝PID';
        $alipay_config['seller_email']	= '支付宝账号';
        $alipay_config['key']			= '支付宝Key';
        $alipay_config['sign_type']    = strtoupper('MD5');
        $alipay_config['input_charset']= strtolower('utf-8');
        $alipay_config['cacert']    = VENDOR_PATH.'Alipay/cacert.pem';
        $alipay_config['transport']    = 'http';
        Vendor('Alipay.alipay#config');
        Vendor('Alipay.lib.AlipayNotify#class');
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];
            //支付宝交易号
            $trade_no = $_GET['trade_no'];
            //交易状态
            $trade_status = $_GET['trade_status'];
            if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
                //根据订单号获取订单
                $DAO = M('Alipay');
                $orderLogDao = M('Alipaylog');
                $order = $DAO->where("ordernum='{$out_trade_no}'")->find();
                //如果订单不存在，设置为0
                if(empty($order)){
                    echo "fail";
                    exit;
                }
                if(($DAO->where("ordernum='".$out_trade_no."'")->getField('state')) !== '4'){
                    if(!($this->autosend($alipay_config,$trade_no,$out_trade_no))){//调用自动发货
                    	echo "自动发货失败。";
                    	exit;
                    }
                }
                //交易状态
                $trade_status = $_GET['trade_status'];
                $log = "支付宝记录, 状态：".$trade_status." 支付宝签名=".$_POST['sign'];
                $orderLog['orderid'] = (int)$order['aid'];
                $orderLog['adddate'] = Date("Y-m-d H:i:s");
                $orderLog['log'] = $log.CJson($_GET);
                $DAO->where("ordernum='{$out_trade_no}'")->setField('state',4);
                $orderLogDao->add($orderLog);
                $this->success('付款成功！请去支付宝确认收货。','http://my.alipay.com/',3);
            }
            else {
                $this->error('奇怪的数据？！','/',3);
            }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
           $this->error('验证失败','/',3);
        }
    }

    /**
     * 自动发货函数，提供支付宝配置和订单号即可
     */
    public function autosend($alipay_config,$trade_no,$out_trade_no){
    	$orderLogDao = M('Alipaylog');
                    //物流公司名称
                    $logistics_name = '盒子宅急送';
                    //必填
                    //物流运输类型
                    $transport_type = 'DIRECT';
                    /************************************************************/
                    //构造要请求的参数数组，无需改动
                    $parameter = array(
                        "service" => "send_goods_confirm_by_platform",
                        "partner" => trim($alipay_config['partner']),
                        "trade_no"	=> $trade_no,
                        "logistics_name"	=> $logistics_name,
                        "invoice_no"	=> '',
                        "transport_type"	=> $transport_type,
                        "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
                    );
                    //建立请求
                    vendor('Alipay.lib.alipay_submit#class');
                    $alipaySubmit = new AlipaySubmit($alipay_config);
                    $html_text = $alipaySubmit->buildRequestHttp($parameter);
                    //解析XML
                    $doc = new \DOMDocument();
                    $doc->loadXML($html_text);
                    //请在这里加上商户的业务逻辑程序代码
                    //解析XML
                    if( ! empty($doc->getElementsByTagName("alipay")->item(0)->nodeValue) ) {
                        $alipay = $doc->getElementsByTagName("is_success")->item(0)->nodeValue;
                        if($alipay == 'F'){
                            $orderLog['orderid'] = (int)$out_trade_no;
                            $log = "支付宝发货错误, 订购者id为商户交易号，错误代码：".$doc->getElementsByTagName( "alipay" )->item(1)->nodeValue;
                            $orderLog['adddate'] = Date("Y-m-d H:i:s");
                            $orderLog['log'] = $log;
                            $orderLogDao->add($orderLog);
                            return false;
                        }elseif($alipay == 'T'){
                            $oneDoc = $doc->getElementsByTagName( "out_order_no" )->item(0);
                            M('Alipay')->where("ordernum='{$out_trade_no}'")->setField('state',4);
                            $orderLog['orderid'] = (int)(M('Alipay')->where("ordernum='{$out_trade_no}'")->getField('userid'));
                            $log = "支付宝发货成功, 订购者id为商户交易号";
                            $orderLog['adddate'] = Date("Y-m-d H:i:s");
                            $orderLog['log'] = $log;
                            $orderLogDao->add($orderLog);
                            return true;
                        }
                    }
                    //自动发货结束
    }

    public function pay(){
        IfLogin();
        $id = I('get.id',0,'number_int');
        $DAO = M('Alipay');//订单数据库
        $order = $DAO->where("aid=".$id)->find();
        $error = "";
        if(!$order){
            $error = "订单不存在";
        }elseif($order['state'] == 1){
            $error = "此订单已经完成，无需再次支付！";
        }elseif($order['state'] == 3){
            $error = "此订单已经取消，无法支付，请重新下单！";
        }
        if($error != ""){
            $this->error($error,'/');
            return;
        }
        //支付宝
        $this->payWithAlipay($order);
    }
    /**
     * 以支付宝形式支付
     * @param unknown_type $order
     * @return \Vendor\提交表单HTML文本
     */
    private function payWithAlipay($order){
        header("Content-type: text/html; charset=utf-8");
        $alipay_config['partner']		= '支付宝PID';
        $alipay_config['seller_email']	= '支付宝账号';
        $alipay_config['key']			= '支付宝Key';
        $alipay_config['sign_type']    = strtoupper('MD5');
        $alipay_config['input_charset']= strtolower('utf-8');
        $alipay_config['cacert']    = VENDOR_PATH.'Alipay/cacert.pem';
        $alipay_config['transport']    = 'http';
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = C("HOST")."index.php/Order/notifyOnAlipay";
        //页面跳转同步通知页面路径
        $return_url = C("HOST")."index.php/Order/index";
        //卖家支付宝帐户
        $seller_email = $alipay_config['seller_email'];
        //必填
        //商户订单号, 从订单对象中获取
        $out_trade_no = $order['ordernum'];
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = $order['title'];
        //必填
        //付款金额
        $price = $order['price'];
        //必填
        $body = $order['title'];
        //商品展示地址
        $show_url = C('HOST');
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_partner_trade_by_buyer",
            "partner" => trim($alipay_config['partner']),
            "payment_type"=> $payment_type,
            "notify_url"=> $notify_url,
            "return_url"=> $return_url,
            "seller_email"=> $seller_email,
            "out_trade_no"=> $out_trade_no,
            "subject"=> $subject,
            "price"=> $price,
            "quantity"=> "1",
            "logistics_fee"=> "0.00",
            "logistics_type"=> "EXPRESS",
            "logistics_payment"=> "SELLER_PAY",
            "body"=> $body,
            "show_url"=> $show_url,
            "receive_name"=> "",
            "receive_address"=> "",
            "receive_zip"=> "",
            "receive_phone"=> "",
            "receive_mobile"=> "",
            "_input_charset"=> trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        Vendor('Alipay.alipay#config');
        vendor('Alipay.lib.alipay_submit#class');
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,'post','支付');
        echo $html_text;
    }
    /**
     * 支付宝异步通知
     */
    public function notifyOnAlipay(){
        $alipay_config['partner']       = '支付宝PID';
        $alipay_config['seller_email']  = '支付宝账号';
        $alipay_config['key']           = '支付宝Key';
        $alipay_config['sign_type']    = strtoupper('MD5');
        $alipay_config['input_charset']= strtolower('utf-8');
        $alipay_config['cacert']    = VENDOR_PATH.'Alipay/cacert.pem';
        $alipay_config['transport']    = 'http';
        require_once(VENDOR_PATH . "Alipay/lib/AlipayNotify.class.php");
        $orderLogDao = M('Alipaylog');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
        	if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
                $order = $_POST['trade_no'];
                $outorder = $_POST['out_trade_no'];
                $state = M('Alipay')->where("ordernum = '{$outorder}'")->getField('state');
                if($state !== '4'){
                	if($this->autosend($alipay_config,$order,$outorder)){
                		echo "success";
                		exit;
                	}
                }
            }
            if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
            }
            elseif($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
                //该判断表示卖家已经发了货，但买家还没有做确认收货的操作
            }
            elseif($_POST['trade_status'] == 'TRADE_FINISHED') {
                $out_trade_no = $_POST['out_trade_no'];
                $trade_no = $_POST['trade_no'];
                $DAO = M('Alipay');
                $order = $DAO->where("ordernum='{$out_trade_no}'")->find();
                if(!$order){
                    echo "fail";
                    exit;
                }
                else{
                    $orderId = (int)$order['aid'];
                }
                //该判断表示买家已经确认收货，这笔交易完成
                if(isset($order) && $order['state'] == '4'){
                    $trade_status = $_POST['trade_status'];
                    $log = "支付宝记录, 状态：".$trade_status." 支付宝签名=".$_POST['sign'];
                    $orderLog['orderid'] = (int)$orderId;
                    $orderLog['adddate'] = Date("Y-m-d H:i:s");
                    $resultInfo = $this->doAfterPaySuccess($_POST['out_trade_no']);
                    $log.= $resultInfo;
                    $orderLog['log'] = $log;
                    $orderLogDao->add($orderLog);
                }
            }
            elseif($_POST['trade_status'] == 'TRADE_CLOSED') {//交易关闭
                $out_trade_no = $_POST['out_trade_no'];
                $DAO = M('Alipay');
                $order = $DAO->where("ordernum='".$out_trade_no."'")->find();
                if(!$order){
                    echo "fail";
                    exit;
                }
                else{
                    $orderId = (int)$order['aid'];
                }
                if(isset($order) && $order['state'] !== 4){
                    $trade_status = $_POST['trade_status'];
                    $log = "支付宝记录, 状态：".$trade_status." 支付宝签名=".$_POST['sign'];
                    $orderLog['orderid'] = (int)$orderId;
                    $orderLog['adddate'] = Date("Y-m-d H:i:s");
                    M('Alipay')->where("ordernum = '{$out_trade_no}'")->setField('state',3);
                    $orderLog['log'] = $log;
                    $orderLogDao->add($orderLog);
                }
            }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            echo "success"; //返回成功标记给支付宝
        }
        else {
            /*//验证不通过时，也记录下来
            $orderLog['log'] = "支付宝记录, 但是验证不通过，签名=".$_POST['sign'];
            $orderLog['orderid'] = -1;
            $orderLog['adddate'] = Date("Y-m-d H:i:s");
            $orderLogDao->add($orderLog);
            //验证失败*/
            echo "fail";
        }
    }
    protected function doAfterPaySuccess($order){
        $ALipay = M('Alipay')->where("ordernum = '{$order}'")->setField('state',1);
        $uid = M('Alipay')->where("ordernum = '{$order}'")->getField('userid');
        $User = M('User')->where("uid = '{$uid}'")->setInc('Money',number_format($_POST['total_fee']*(1-0.012),2));
        if($ALipay and $User){
            return "充值完成，受益人{$order['userid']}，金额{$_POST['total_fee']}";
        }
        return '失败';
    }
}