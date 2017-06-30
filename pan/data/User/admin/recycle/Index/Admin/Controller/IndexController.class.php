<?php
namespace Admin\Controller;
use Org\Tool\Costrecord;
use Org\Tool\Message;
use Think\Controller;
use Org\Tool\AdminTool as AdminTool;
use Org\Tool\Shop as Shop;
use Org\Tool\AdminPage as AdminPage;
use Org\Tool\Alipay;
use Org\Tool\Widget;
class IndexController extends IndexCheckController {
    public function index(){
        $this->title = '首页';
        $adminTool = new AdminTool();
        $this->money = $adminTool->getMouthIncome();
        $this->developerOutcome = $adminTool->getDeveloperOutcome();
        $this->newUser = $adminTool->getNewUser();
        $this->newComplain = $adminTool->getNewComplain();
        $allMoney = M('User')->sum('money');
        $this->surplusReceipts = M('User')->where("UserName = 'Null'")->getField('Money');
        $this->needMoney = $allMoney - $this->surplusReceipts;
        $this->display();
    }

    public function User(){
        $this->title = '用户版面';
        $num = 30;
        $find = I('get.find',false);
        if($find !== false){
            $map['_string'] = "concat (UserName,Email) like '%".$find."%'";
            $this->data = M('User')->where($map)->field('HasShop,SCart',true)->select();
            $this->count  = 1;
        }else{
            $this->data = M('User')->page(I('get.p',1,'number_int'),$num)->field('HasShop,SCart',true)->select();
            $this->count  = M('User')->count();
            $this->page = new AdminPage($this->count,$num);
            $this->page = $this->page->show();
        }
        $this->display('user');
    }

    public function Userchance($uid,$type){
        $this->title = '用户版面';
        if($type =='ip'){
            $this->userData = M('User')->where("uid = '{$uid}'")->field('HasShop,UserName,UID,Money')->find();
            $this->userPlugin = CJson($this->userData['hasshop'],true);
            $this->display();
        } else {
			echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>修改数据</title></head><body>';
        if($type =='developer'){
            M('User')->where("uid = '{$uid}'")->setField('Action','2');
            exit;
        }
        if($type =='stopuser'){
            M('User')->where("uid = '{$uid}'")->setField('UserState','1');
            echo '修改成功';
        }
        if($type =='startuser'){
            M('User')->where("uid = '{$uid}'")->setField('UserState','0');
            echo '修改成功';
        }
		if($type =='money'){
			$this->userData = M('User')->where("uid = '{$uid}'")->field('UserName,UID,Money')->find();
			M('User')->where("uid = '{$uid}'")->setField('Money',$this->userData['money']+intval(I('get.money')));
			$this->userData = M('User')->where("uid = '{$uid}'")->field('UserName,UID,Money')->find();
			echo '充值成功，余额'.$this->userData['money'];
		}
		echo '<br /><br /><button onclick="history.go(-1)">返回</button></body></html>';
		}
    }

    public function Userchanceip($uid,$index){
        $data = M('User')->where("uid = '{$uid}'")->getField('HasShop');
        $data = CJson($data,true);
        unset($data[(int)$index]['date']);
        M('User')->where("uid = '{$uid}'")->setField('HasShop',CJson($data));
        echo '重置成功';
        exit;
    }

    public function Record(){
        $this->title = '充值记录';
        $alipay = new Alipay();
        $this->count = $alipay->getCount();
        $page = (int)I('get.p',1);
        $Num = 20;
        $count      = $alipay->getCount();//默认count
        $where='';
        if($type = I('get.find')){//TODO:这里加输入条件
            $Data= $alipay->getAlipayByFindWithPage($page,$Num,$type);
        }elseif($type = I('get.getData')){
            switch($type){
                case 'date':
                    $order ='adddate desc';
                    $Data = $alipay->getAlipayWithPageAndWhereByOrder($page,$Num,$order);
                    break;
                case 'money':
                    $order ='price desc';
                    $Data = $alipay->getAlipayWithPageAndWhereByOrder($page,$Num,$order);
                    break;
                case 'uid':
                    $order ='userid desc';
                    $Data = $alipay->getAlipayWithPageAndWhereByOrder($page,$Num,$order);
                    break;
                case 'state':
                    $order ='state desc';
                    $Data = $alipay->getAlipayWithPageAndWhereByOrder($page,$Num,$order);
                    break;
                default:
                    break;
            }
        }else{
            $Data = $alipay->getAlipayWithPageByOrder($page,$Num);
        }
        $this->assign('list',$Data);// 赋值数据集
        $Page       = new AdminPage($count,$Num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function Shop(){
        $this->title = '所有商品';
        $Shop = new Shop();
        $Num = 10;
        $page = (int)I('get.p',1);
        $Data = $Shop->getShopWithUserByPage($page,$Num);
        $this->assign('list',$Data);// 赋值数据集
        $count      = $Shop->getCount();// 查询满足要求的总记录数
        $Page       = new AdminPage($count,$Num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $this->display();
    }

    public function Setting(){
        $Shop = new Shop();
        $slidename = I('post.slidename');
        $slide = I('post.slide');
        if($slidename[0] !== '' and $slide[0] !== ''){
            $data['slidename'] = $slidename;
            $data['slide']=$slide;
            AdminTool::setSlideData($data);
        }
        if(I('post.catalog') and IS_AJAX){
            $if = $Shop->addCatalog(I('post.catalog'));
            if($if){
                $this->ajaxReturn(array('state'=>1,'info'=>'添加目录成功'));
            }else{
                $this->ajaxReturn(array('state'=>0,'info'=>'添加目录失败'));
            }
        }
        if(I('post.version') and IS_AJAX){
            $if = $Shop->addVersion(I('post.version'));
            if($if){
                $this->ajaxReturn(array('state'=>1,'info'=>'添加版本成功'));
            }else{
                $this->ajaxReturn(array('state'=>0,'info'=>'添加版本失败'));
            }
        }
        //小工具的操作
        if(I('post.widget') == 1){
            $data = I('post.');
            $widget = new Widget();
            $widget->set($data);
        }
        //顶部公告栏
        if(I('post.header_notice') and IS_AJAX){
            $html = str_replace('\"', '"', I('post.header_notice'));
            $if = AdminTool::setHeaderNotice($html);
            if($if){
                $this->ajaxReturn(array('state'=>1,'info'=>'更新顶部公告栏成功'));
            }else{
                $this->ajaxReturn(array('state'=>0,'info'=>'更新顶部公告栏失败'.$html));
            }
        }
        $header_notice = AdminTool::getHeaderNotice();
        $this->assign('header_notice',$header_notice);

        $this->sliders = AdminTool::getSlideData();
        $this->version = $Shop->getVersion();
        $this->catalog = $Shop->getCatalog();
        $this->title = '设置';
        $this->display();
    }

    public function Massage(){
        $this->title = '投诉记录';
        $type =I('get.type',0);
        $state = I('get.state',0);
        $page = I('get.p',1);
        if(I('get.uid')){
            $this->uid= I('get.uid');
            $t = new Message(I('get.uid'));
            $this->Data =$t->GetReceiveMessage($page,6,$type,$state,I('get.uid'));
            $count = $t->GetReceiveMessageCount(0,$state);
        }else{
            $this->Data = $this->messageData->GetReceiveMessage($page,6,$type,$state);
            $count = $this->messageData->GetReceiveMessageCount(0,$state);
        }
        $page = new \Org\Tool\AdminPage($count,6);
        $this->page = $page->show();
        $this->display();
    }

    public function getAjaxMessage(){
        if(IS_AJAX){
            $mid = I('post.mid');
            $superUID = getSuperAdminId();
            $data = new Message($superUID);
            $this->ajaxReturn($data->ShowMessage($mid));
            exit;
        }
    }

    public function delMessage(){
        if(IS_AJAX){
            $mid = I('post.mesid');
            $over = M('Message')->where("mesid = {$mid}")->delete();
            $over = $over!==false?1:0;
            $this->ajaxReturn(array('state'=>$over));
            exit;
        }
    }
    public function readMessage(){
        if(IS_AJAX){
            $mid = I('post.mesid');
            $over = M('Message')->where("mesid = {$mid}")->setField('state',1);
            $over = $over!==false?1:0;
            $this->ajaxReturn(array('state'=>$over));
            exit;
        }
    }

    public function Sendmassage(){//这个是发送消息的单独页面，因为linux的url有问题，所以一个操作名中只能有一个大写字母
        $this->title = '发送消息';
        $this->display();
    }

    public function Sendtomessage(){
        $title = I('post.title');
        $content = I('post.content');
        $user = I('post.tosender');
        $mid = I('post.mid');
        $message = new \Org\Tool\Message(getSuperAdminId());
        if($user == 'user'){
            $message->SendMessage($message->GetSenderID($mid),'用户'.$title,$content,'',2);
            $this->success('发送给用户成功',U('Admin/Index/Massage'));
        }elseif($user == 'complaint'){
            $message->SendMessage($message->GetComplaintID($mid),'版主'.$title,$content,'',2);
            $this->success('发送被投诉者成功',U('Admin/Index/Massage'));
        }
    }

    public function Application(){
        $this->title = '提现申请';
        if(I('get.check') == 'yes'){
            $mid = I('get.mid');
            $check = M('Costrecord')->where("mid = '{$mid}'")->setField('State',1);
            if($check!==false){
                echo '修改状态成功';
                echo '<a href="'.U('/Admin/Index/application').'">返回提现列表</a>';
            }elseif($check === false){
                echo '修改状态失败';
                echo '<a href="'.U('/Admin/Index/application').'">返回提现列表</a>';
            }
            exit;
        }
        if(I('get.mid')){
            $mid = I('get.mid');
            $this->alipay = M('Costrecord')->where("mid = '{$mid}'")->find();
            $this->url = U('Admin/Index/Application',array('mid'=>$mid,'check'=>'yes'));
            $this->display('paypage');
            exit;
        }
        $Data = Costrecord::getAllATMWithPage(I('get.p'),16);
        $this->count = Costrecord::getCountATMAll();
        $this->assign('list',$Data);// 赋值数据集
        $Page       = new AdminPage($this->ATM,16);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function Complaint(){
        $this->title = '投诉反馈';
        $this->display();
    }

    public function uploadImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/Admin/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->uploadOne($_FILES['upload']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $url = $upload->rootPath.$info['savepath'].$info['savename'];
            $url=substr($url,1);
            $funcNum = $_GET['CKEditorFuncNum'] ;
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum,'$url');</script>";

        }
    }
}