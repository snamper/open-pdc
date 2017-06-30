<?php
namespace Index\Controller;
use Org\Tool\Alipay;
use Think\Controller;
use Vendor\ThinkImage\ThinkImage;
/**
 * @property  UserSystemData
 */
class UserController extends UserifloginController {
    public $UserSystemData;
    public function index(){
        $this->title = C('TITLE',null,"用户中心");
        $this->ActionTitle = '欢迎';
        $this->centect = '欢迎你回来'.session('UserName');
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->display();
    }

	public  function Action(){
        
        $UserSystemData = $this->UserSystemData;
        $this->title = C('TITLE',null,"用户中心-激活邮箱");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '请激活你的邮箱';
        $this->centect = '尊敬的'.$UserSystemData['username'].'<br>你好!<br>你注册本网站的邮箱是'.$UserSystemData['email'].'<br>为你的正常使用，
        您需要激活你的邮箱~<br><button class="btn btn-success send-email" type="button">点击发送激活邮件</button>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $(".send-email").click(function(){
                    $.ajax({
                        url:"../User/Action/send/yes",
                        data: {"hh":"hh"},
                        type:"get",
                        beforeSend:function(){
                            $(".send-email").text("发送中……").removeClass("btn-success").attr("disabled","");
                        },
                        success:function(data){
                            if(data["state"] == "1"){
                                message("success","","发送成功！");
								var time = 60;
								var loop = setInterval(function(){
									$(".send-email").text("再次发送("+time+")");
									time --;
									if(time <= 0){
										$(".send-email").text("再次发送").addClass("btn-success").removeAttr("disabled");
										clearInterval(loop);
									}
								}, 1000);
                            }else{
								message("waring","",data["info"]);
                                $(".send-email").text("发送").addClass("btn-success").removeAttr("disabled");
                            }
                        }
                    });
                });
            });
        </script>';
        if(I('get.send') == 'yes'){
            if(!S($UserSystemData['uid'])){
                S($UserSystemData['uid'],'send',60);
            }else{
                $this->ajaxReturn(array('state'=>'0','info'=>'请过60秒再发送！'));
                exit;
            }
            $CheckData = AuthCode($UserSystemData["email"],'ENCODE',$UserSystemData["email"],605);
            $EmailContent = '<div class="" id="qm_con_body" style="font-family: \'Microsoft Yahei\',Helvetica,Arial,sans-serif;">
<div id="mailContentContainer" class="qmbox qm_con_body_content">
<div style="border:1px solid #CCC;background:#F4F4F4;width:100%;text-align:left">
<div style="font-size:14px;margin-bottom:20px;">
<h3 style="margin-left:30px;"><div style="height:60px;background-color:#F4F4F4;line-height: 50px;"><img src="http://mcleague.xicp.net/logo.png" style="width:50px;height:50px;float: left;"><div style="
    float: left;
">亲爱的'.$UserSystemData["username"].'</div></div></h3>
<p style="margin-left:30px;">感谢注册 <a href="'.__ROOT__.'" target="_blank">MCTL</a>，请在10分钟之内点击以下链接完成安全验证，激活您的邮箱！</p>
<a href="'.C('HOST').'Login/Action?var='.urlencode($CheckData).'&email='.$UserSystemData["email"].'" style="margin-left:30px;" target="_blank">'.C('HOST').'Login/Action/?var='.urlencode($CheckData).'&email='.$UserSystemData["email"].'</a><br>
<p style="margin-left:30px;">您的Email：<a href="'.$UserSystemData["email"].'" target="_blank">'.$UserSystemData["email"].'</a></p>
<p style="margin-left:30px;">本邮件为系统自动发送，请勿回复，感谢。</p>
<p style="height:20px;border-top:1px #afb4db solid;margin:20px 20px 0;">&nbsp;</p>
<p style="margin-left:30px;">MCTL</p>
</div>
</div>
</div></div>';
$returnMail = send_mail($UserSystemData["email"],$UserSystemData["username"],'MCTL邮箱验证信息',$EmailContent);
$returnMail = CJson($returnMail,true);
            if($returnMail == 1){
                if(IS_AJAX){
                    $this->ajaxReturn(array('state'=>'1','info'=>'发送成功!请登录邮箱确认~'));
                    exit;
                }
                $this->centect =  '<div class="uk-alert uk-alert-success">发送成功!请登录邮箱确认~</div>';
            }else{
                if(IS_AJAX){
                    $this->ajaxReturn(array('state'=>'0','info'=>"发送失败,部分错误信息{$returnMail['errors'][0]}，请联系管理员。"));
                    exit;
                }
                $this->centect =  '<div class="uk-alert uk-alert-danger">发送失败，请联系管理员。部分错误信息'.$returnMail['errors'][0].'</div>';
            }
        }
        $this->display('index');
    }
/*
    public  function cart(){
        $UserSystemData = $this->UserSystemData;
        if(cookie('cart') == ''){
            cookie('cart',AuthCode(CJson($UserSystemData['scart']),'encode','cart',0));
        }else{
            $UserSystemData['scart'] = CJson(AuthCode(cookie('cart'),'DECODE','cart',0),true);
        }
        $this->assign('ShopData',$UserSystemData['scart']);
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-购物车");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '我的购物车';
        //TODO:数据的修改
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $Num = 10;
        $list = array_slice($UserSystemData['scart'],((int)I('get.p',1)-1)*$Num,$Num,true);
        if(IS_AJAX){
            $this->ajaxReturn(array('data'=>$list));
            exit;
        }
        $this->assign('list',$list);// 赋值数据集
        $count      = count($UserSystemData['scart']);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$Num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }*/
    public function downloads(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-已下载插件");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '下载过的插件';
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $Num = 10;
        $list = array_slice($UserSystemData['hasshop'],((int)I('get.p',1)-1)*$Num,$Num,true);
        if(IS_AJAX){
            $this->ajaxReturn(array('state'=>'1','data'=>$list));
            exit;
        }
        $this->assign('list',$list);// 赋值数据集
        $count      = count($UserSystemData['hasshop']);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$Num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    /*
    public function ChanceIp(){
        $UserSystemData = $this->UserSystemData;
        $SID = (int)I('get.chance','');
        $Ip = I('get.ip');
        $Port = I('get.port');
        if(!is_numeric($SID) or  !CheckIP($Ip)){
            $this->ajaxReturn(array('state'=>'0','info'=>"数据错误"));
            exit;
        }
        $ShopData = $UserSystemData['hasshop'];
        if(true){
            $Chance = ChangeShop($UserSystemData,$SID,$Ip,$Port);
            if($Chance){
                $this->ajaxReturn(array('state'=>'1','info'=>'修改成功！'));
                exit;
            }else{
                $this->ajaxReturn(array('state'=>'0','info'=>'修改失败，请联系管理员。错误代码:UC3'));
                exit;
            }
        }else{
            $this->ajaxReturn(array('state'=>'0','info'=>'此商品24小时内更改过，无法更改。'));
            exit;
        }
    }
	
	public function CUserName(){
		$UserSystemData = $this->UserSystemData;
		$SID = (int)I('get.chance','');
		$Port = I('get.port');
		$CUserName = I('get.username');
		if(!is_numeric($SID)){
            $this->ajaxReturn(array('state'=>'0','info'=>"数据错误"));
            exit;
        }
		$Chance = ChangeShop($UserSystemData,$SID,$CUserName);
		if($Chance!=true){
			$this->ajaxReturn(array('state'=>'0','info'=>$Chance));
		} else {
			$this->ajaxReturn(array('state'=>'1'));
		}
		
	}
	public function ActionServer(){
		$SID = (int)I('get.chance','');
	}

    public function Stopplugin(){
        $UserSystemData = $this->UserSystemData;
        $key = (int)I('get.id',false,'number_int');
        $UserSystemData['hasshop'];
        $do = I('get.do','stop');
        $do = $do == 'stop'?1:0;
        if($key===false){
            echo '抱歉，找不到你选择的服务器。';
            exit;
        }
        if($do === 1){
            if($UserSystemData['hasshop'][$key]['stop'] =='0' or !isset($UserSystemData['hasshop'][$key]['stop'])){
                $UserSystemData['hasshop'][$key]['stop']='1';
                M('User')->where("UID = '{$UserSystemData['uid']}'")->setField('HasShop',CJson($UserSystemData['hasshop']));
                $this->success('更改成功！',U('/User/bought'),2);
                exit;
            }else{
                $this->success('更改成功！',U('/User/bought'),2);
                exit;
            }
        }else{
            if($UserSystemData['hasshop'][$key]['stop'] =='1' or !isset($UserSystemData['hasshop'][$key]['stop'])){
                unset($UserSystemData['hasshop'][$key]['stop']);
                M('User')->where("UID = '{$UserSystemData['uid']}'")->setField('HasShop',CJson($UserSystemData['hasshop']));
                $this->success('更改成功！',U('/User/bought'),2);
                exit;
            }else{
                $this->success('更改成功！',U('/User/bought'),2);
                exit;
            }
        }
    }*/
    /**
     *添加购物车的操作
     */
     /*
    public function AddCart(){
        $UserSystemData = $this->UserSystemData;
        $Post = I('post.cart');
        $Post = AuthCode($Post,'DECODE','cart',0);
        if($Post){//这里判断用户关闭页面前，返回的购物车数据
            M('User')->where("uid = {$UserSystemData['uid']}")->cache(true)->setField('SCart',$Post);
            $this->ajaxReturn(array('state'=>'1','info'=>'成功'));
            exit;
        }
        if(IS_AJAX){//判断ajax IS_AJAX
            if(I('get.do') == 'del'){//删除的操作
                $SCID = I('get.scid');
                $SCID = (int)$SCID;
                $Cookie = CJson(AuthCode(cookie('cart'),'DECODE','cart',0),true);
                M('User')->where("uid = {$UserSystemData['uid']}")->setField('SCart',CJson($Cookie));
                unset ($Cookie[$SCID]);
                $Cookie = AuthCode(CJson($Cookie),'encode','cart',0);
                cookie('cart',$Cookie);
                $this->ajaxReturn(true);
                exit;
            }
            $GetData['sid'] = I('get.sid');
            $Shop = M('Shop')->where("sid = {$GetData['sid']}")->find();
            $GetData['sname'] = $Shop['shopname'];
            $GetData['num'] = I('get.num');
            $GetData['uid'] = $UserSystemData['uid'];
            $GetData['price'] = $Shop['price'];//加入时候的价格(要标注)
            $GetData['date'] = date('Y-m-d');
            if(in_array('',$GetData)){//判断时候有数据没有提交过来
                $this->ajaxReturn(array('state'=>'0','info'=>'提交数据有误'));
                exit;
            }
            $IfHave = false;
            $Cart = CJson(AuthCode(cookie('cart'),'DECODE','cart',0),true);
            foreach($Cart as &$CartOne){
                if($CartOne['sid'] == $GetData['sid']){
                    $CartOne['num'] += (int)$GetData['num'];
                    $IfHave = true;
                }
            }
            if(!$IfHave){
                $Cart[] = $GetData;
            }
            $Cart = AuthCode(CJson($Cart),'encode','cart',0);
            cookie('cart',$Cart);//本地设置不写入数据库,和js联动完成存入数据库
            $this->ajaxReturn(array('state'=>'1','info'=>'添加成功~'));
        }else{//不是ajax别凑热闹
            $this->redirect('Index/index');
            exit;
        }
    }
    public function record(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-消费记录");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '消费记录';
        $page = I('get.p');
        $num = 20;
        $countrecord = new \Org\Tool\Costrecord($UserSystemData['uid']);
        $list=$countrecord->getUserCostRecordWithPage($page,$num);
        $this->allnumber =$countrecord->getCountMoney();
            $this->assign('list',$list);// 赋值数据集
        $count      = $countrecord->getCount();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    public function recharge(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-充值记录");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '充值记录';
        $num = 10;
        $page = (int)I('get.p',1);
        $alipay = new Alipay();
        $Data = $alipay->getUserAlipayWithPage($UserSystemData['uid'],$page,$num);
        $this->assign('list',$Data);// 赋值数据集
        $count      = $alipay->getUserCount($UserSystemData['uid']);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    public function makepay(){
        $UserSystemData = $this->UserSystemData;
        $num = I('post.num',0,'number_int');
        if($num < 1){
            $this->error('数据非法！请正确填写充值金额');
            exit;
        }
        $GUID = md5(date("YmdHis").$UserSystemData['uid'].getGuid());
        $Data['ordernum'] = $GUID;
        $Data['userid'] = $UserSystemData['uid'];
        $Data['title'] = "MCTL服务器平台充值[充值用户:{$UserSystemData['uid']}|时间:".date("Y-m-d H:i:s").']';
        $Data['price'] = $num;
        $Data['adddate'] = Date("Y-m-d H:i:s");
        $tmp = M('Alipay')->add($Data);
        if($tmp){
            $this->redirect('Order/pay',array('id'=>$tmp));
            exit;
        }
    }


    public function torecharge(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-充值!");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '充值!(支付宝)';
        $this->display();
    }

    public function torechargeka(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-充值!");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '充值!(点卡)';
        $this->display();
    }
*/
    public function edit(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"用户中心-编辑资料");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '编辑资料';
        $this->display();
    }
    public function UploadImg(){
        $UserSystemData = $this->UserSystemData;
        $Info = array(
            'maxSize'       =>  1048576, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','png','gif','bmp','jpeg'), //允许上传的文件后缀
            'rootPath'      =>  './Public/Avatar/', //保存根路径
            'savePath'      =>  '', //保存路径
            'saveName'      =>  'temp', //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  'jpg', //文件保存后缀，空则使用原后缀
            'replace'       =>  true, //存在同名是否覆盖
            'hash'          =>  true, //是否生成hash编码
        );
        $upload = new \Think\Upload($Info);	// 实例化上传类
        $upload->subName = $UserSystemData['uid'];
        //头像目录地址
        $path = './Public/Avatar/';
        if(!$upload->upload()) {						// 上传错误提示错误信息
            $this->ajaxReturn(array('status'=>0,'info'=>$upload->getError()));
        }else{											// 上传成功 获取上传文件信息
            $temp_size = getimagesize($path.$UserSystemData['uid'].'/temp.jpg');
/*            if($temp_size[0] < 100 || $temp_size[1] < 100){//判断宽和高是否符合头像要求
                $this->ajaxReturn(array('status'=>0,'info'=>'图片宽或高不得小于100px！'));
            }*/
            $this->ajaxReturn(array('status'=>1,'path'=>__ROOT__.'/Public/Avatar/'.$UserSystemData['uid'].'/temp.jpg'));
        }
    }
    public function UpAvatar(){
        $UserSystemData = $this->UserSystemData;
        //图片裁剪数据
        $params = I('post.');						//裁剪参数
        if(!isset($params) && empty($params)){
            $this->error('参数错误！');
        }
        $params['picw'] = (float)$params['picw'];
        $params['pich'] = (float)$params['pich'];
        //头像目录地址
        $path = './Public/Avatar/';
        //保存到数据库中
        $UserSystemData['data']['avatar'] = $path.$UserSystemData['uid'];
        $Avatar = CJson($UserSystemData['data']);
        $User = M('User')->where("uid = '{$UserSystemData['uid']}'")->setField('Data',$Avatar);
        if(!$User and $User !== 0){
            $this->error('保存数据失败！');
            exit;
        }
        //要保存的图片
        $real_path = $path.$UserSystemData['uid'].'/avatar.jpg';
        //临时图片地址
        $pic_path = $path.$UserSystemData['uid'].'/temp.jpg';
        //实例化裁剪类
        $Think_img = new ThinkImage(THINKIMAGE_GD);
        //裁剪原图得到选中区域
        list($width,$height,,) = getimagesize($path.$UserSystemData['uid'].'/temp.jpg');
        $WTimes = ($params['w']/$params['picw'])*$width;
        $HTimes = ($params['h']/$params['pich'])*$height;
        $XTimes = ($params['x']/$params['picw'])*$width;
        $YTimes = ($params['y']/$params['pich'])*$height;
        $Think_img->open($pic_path)->crop($WTimes,$HTimes,$XTimes,$YTimes)->save($real_path);
        //生成缩略图
        $Think_img->open($real_path)->thumb(100,100, 1)->save($real_path.'-avatar_100.jpg');
        $Think_img->open($real_path)->thumb(80,80, 1)->save($real_path.'-avatar_80.jpg');
        $Think_img->open($real_path)->thumb(50,50, 1)->save($real_path.'-avatar_50.jpg');
        //删除临时图片
        $file = new \Think\Storage\Driver\File();
        $file->unlink($pic_path);
        $file->unlink($real_path);
        $this->success('上传头像成功');
    }
    public function UpEdit(){
        $UserSystemData = $this->UserSystemData;
        if(I('post.') == ''){
            $this->error('数据不能为空');
        }
        $Data['avatar'] = $UserSystemData['data']['avatar'];
        $Data['nickname'] = I('post.nickname','','string');
        $Data['qq'] = I('post.qq','','number_int');
        if($Data['qq'] == ''){
            $this->error('QQ不能为数字以外的数据。');
        }
        $Data['pdata'] = I('post.pdata');
        $Data = CJson($Data);
        $User = M('User')->where("uid = '{$UserSystemData['uid']}'")->setField('Data',$Data);
		M('User')->where("uid = {$UserSystemData['uid']}")->setField('Action',1);
        if($User){
            $this->success('更新成功');
            exit;
        }else{
           if($UserSystemData['data'] == CJson($Data,true)) {
               $this->success('更新成功');
               exit;
           }
            $this->error('更新失败。');
        }
    }
    public function message(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"消息中心-消息列表");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '消息中心';
        $Page = I('get.p',1,'number_int');
        $Message = new \Org\Tool\Message($UserSystemData['uid']);
        $MessageData = $Message->GetReceiveMessage($Page,10);
        $count      = $Message->GetAllCount();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('MessageData',$MessageData);
        $this->display();
    }
    public function MessageShow(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"消息中心");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '消息查看';
        $MESID = I('get.id',0,'number_int');
        if($MESID == 0){
            $this->error('无效的数据。');
            exit;
        }
        $Message = new \Org\Tool\Message($UserSystemData['uid']);
        $MessageData = $Message->ShowMessage($MESID);
        if(!$MessageData){
            $this->error('数据不存在。');
            exit;
        }
        $Message->ReadMessage($MESID);
        $this->assign('sender',$Message->GetSender($MESID));
        $this->assign('MessageData',$MessageData);
        $this->display();
    }
    public function MessageDel(){
        $UserSystemData = $this->UserSystemData;
        $MESID = I('get.mesid',0,'number_int');
        if($MESID == 0){
            $this->error('无效的数据。');
            exit;
        }
        $Message = new \Org\Tool\Message($UserSystemData['uid']);
        $MessageData = $Message->DelMessage($MESID);
        if($MessageData === false){
            $this->ajaxReturn(array('state'=>0));
            exit;
        }else{
            $this->ajaxReturn(array('state'=>1));
            exit;
        }
    }
    /*
    public function BuyCart(){//结账购物车的类
        $UserSystemData = $this->UserSystemData;
        $Post = I('post.data');
        if(IS_AJAX){//判断ajax IS_AJAX
            if($Post){//获取了可以读的php数组的购物车数据
                $Shop = M('Shop');
                $ShopDataSid = array();
                foreach($Post as $ShopOne){
                    $ShopDataSid[] = $ShopOne[0];
                }
                $data['SID'] = array('IN',$ShopDataSid);
                $ShopAll = $Shop->where($data)->select();//获取了商品了
                $ShopData = array();
                foreach($Post as $ShopOne){
                    if($ShopOne['pluginstate'] !== '1'){
                        continue;
                    }
                    $ShopOne[1] = abs($ShopOne[1]);
                    if($ShopOne[1] == 0) continue;
                    $ShopData[$ShopOne[0]] = $ShopOne[1];//储存key为sid，值为数量
                }
                //判断商品总价
                $AllPrice = 0;
                if(empty($ShopData)){//检测数据
                    $this->ajaxReturn(array('state'=>'0','info'=>'哎呀~好像没有你的商品呢~'));
                    exit;
                }
                foreach($ShopAll as $ShopOnce){//获取总价
                    $AllPrice += $ShopOnce['price']* $ShopData[$ShopOnce['sid']];
                }
                unset($ShopOnce);
                $User = D('User');
                if($UserSystemData['money'] < $AllPrice){
                    $this->ajaxReturn(array('state'=>'0','info'=>'余额不足,错误:U350'));
                    exit;
                }
                //批量购买
                $User->startTrans();//事务开启
                //先扣钱
                $NewMoney = $User->where("uid = {$UserSystemData['uid']}")->getField('Money');
                if($NewMoney >= $AllPrice){
                    AddCostRecord($AllPrice,$UserSystemData['uid'],0,CJson($Post),1,"扣除购买商品费用（购物车）");
                }else{
                    AddCostRecord($AllPrice,$UserSystemData['uid'],0,CJson($Post),1,"扣除购买商品费用（购物车）");
                    $User->rollback();
                    $this->ajaxReturn(array('state'=>'0','info'=>'余额不足，错误:U361'));
                    exit;
                }
                //一个一个给钱（开发者）（系统）
                $Fee = 0;
                $Check = false;
                    foreach($ShopAll as $ShopOnce){
                        $MoneyData = CountFee($ShopOnce['price']);
                        //手续费集合
                        $Fee +=$MoneyData['Fee']*$ShopData[$ShopOnce['sid']];
                        //数量判断
                        if(AddCostRecord($MoneyData['Other']*$ShopData[$ShopOnce['sid']],$ShopOnce['uid'],1,$UserSystemData['uid'],1,
                                "用户[{$UserSystemData['username']}]购买您的服务器[{$ShopOnce['shopname']}][{$ShopData[$ShopOnce['sid']]}个]。（已扣除手续费）")
                                and AddShop($UserSystemData,$ShopOnce['sid'],$ShopOnce['shopname'],$ShopData[$ShopOnce['sid']]) )
                            {
                                unset($MoneyData);
                                    $Check = true;
                                }else{
                                    $Check = false;
                                }
                         }
                if(isset($Fee)){
                    $ShopDataSid = CJson($ShopDataSid);
                    if(!AddCostRecord($Fee,0,1,$UserSystemData['uid'],1,"用户[{$UserSystemData['username']}]购买商品[{$ShopDataSid}]手续费")){
                        $Check = false;
                    }
                }else{
                    $Check = false;
                }
                if($Check){
                    $User->commit();
                    M('User')->where("uid = {$UserSystemData['uid']}")->setField('SCart','');
                    cookie('cart',null);
                    $this->ajaxReturn(array('state'=>'1','info'=>'购买成功！'));exit;
                }else{
                    $User->rollback();
                    $this->ajaxReturn(array('state'=>'0','info'=>'程序繁忙，请重试。'));exit;
                }
                //成功
            }
        }else{//不是ajax别凑热闹
            $this->redirect('Index/index');
            exit;
        }
    }
    public function BuyShop(){//用来接收ajax提交购买商品信息
        $UserSystemData = $this->UserSystemData;
        //获取数据
        if(!IS_AJAX and I('post.BuyCart',false)) {
            $this->ajaxReturn(array('state'=>'0','info'=>'数据发送有误。'));
            exit;
        }
        $SID = I('post.sid',0,'number_int');
        $Num = I('post.num',0,'number_int');
		$Count = I('post.count',0,'number_int');
        $Num = abs($Num);
        //判断数据合法性
        if((int)$SID == 0 or (int)$Num <= 0 or (int)$Count <= 0){
            $this->ajaxReturn(array('state'=>'0','info'=>'数据提交有误。'));exit;
        }
        //查询商品数据
        $Shop = M('Shop')->where("sid = {$SID}")->find();
        if(!$Shop){
            $this->ajaxReturn(array('state'=>'0','info'=>'商品不存在。'));exit;
        }
        if($Shop['pluginstate'] !== '1'){
            $this->ajaxReturn(array('state'=>'0','info'=>'商品未通过审核。'));exit;
        }
        //写入购买数据
        $User = D('User');
		$price = $Shop['price'] * $Count;
        for($i = 1;$i <= $Num;$i++){
            $User->startTrans();//事务处理开启！！
            if($UserTmp = $User->where("uid = {$UserSystemData['uid']}")->find()) {
                //判断余额
                if ((float)$UserTmp['money'] >= (float)$price) {
                    if (AddCostRecord($price,$UserSystemData['uid'],0,$Shop['uid'],1,"扣除购买[{$Shop['shopname']}]费用")) {//扣除消费者金额
                        //计算手续费，然后给开发者余额
                        $MoneyData = CountFee($Shop['price']);
                        if(AddCostRecord($MoneyData['Fee'],0,1,$UserSystemData['uid'],1,"用户[{$UserSystemData['username']}]购买商品[{$Shop['shopname']}]手续费") and
                            AddCostRecord($MoneyData['Other'],$Shop['uid'],1,$UserSystemData['uid'],1,
                                "用户[{$UserSystemData['username']}]购买您的服务器[{$Shop['shopname']}]。（已扣除手续费）")
                                and AddShop($UserSystemData,$Shop['sid'],$Shop['shopname'],1,$Count)){
                            $User->commit();//直接出去
                        }else{
                            $User->rollback();
                            $this->ajaxReturn(array('state'=>'0','info'=>'程序繁忙，请重试。'));exit;
                        }
                        //添加数据库消息
                    }else{
                        $User->rollback();
                        $this->ajaxReturn(array('state'=>'0','info'=>'程序繁忙，请重试。'));exit;
                    }
                }else{
                    $User->rollback();
                    $this->ajaxReturn(array('state'=>'0','info'=>'余额不足。'));exit;
                }
            }else{
                $User->rollback();
                $this->ajaxReturn(array('state'=>'0','info'=>'程序繁忙，请重试。'));exit;
            }
        }
        $this->ajaxReturn(array('state'=>'1','info'=>'购买成功！'));
        //返回完成购买数据or失败数据
    }*/
    /**
     *激活开发者
     */
     /*
    public function actionDeveloper(){//TODO:激活的一些步骤
        $UserSystemData = $this->UserSystemData;
        $this->title = '激活成功！';
        if($UserSystemData['action'] = 1){
            M('User')->where("uid = {$UserSystemData['uid']}")->setField('Action',1);
        }
        $this->display();
    }*/
}