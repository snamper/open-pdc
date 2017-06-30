<?php
namespace Index\Controller;
use Org\Tool\Shop;

class SendmessageController extends UserifloginController{
    public function index(){
        $this->redirect(U('/Index/index'));
        exit;
    }

    public function Complaint(){
        $userData = $this->UserSystemData;
        $sid = I('get.sid');
        $tmp = \array_search($sid,i_array_column($userData['hasshop'], 'sid'));//搜索是否有这个插件
        if($tmp === false){
            $this->redirect('/Index/index');
            exit;
        }
        $this->plugin = M('Shop')->where("sid = {$sid}")->getField('ShopName');
        $this->title = '投诉';
        $this->ActionTitle = '投诉服务器';
        $this->display();
    }

    public function toSendComplaint(){
        $gee = new \Org\Tool\GVerify();
        $CheckVerify = $gee->checkVerify();
        if(!$CheckVerify){
            $this->error('请滑动验证',U('Sendmessage/Complaint',array('sid'=>I('post.sid'))),2);
            exit;
        }
        $userData = $this->UserSystemData;
        $title = I('post.title');
        $content = I('post.content');
        if($title =='' or $content ==''){
            $this->error('消息填写不完整',U('Sendmessage/Complaint',array('sid'=>I('post.sid'))),2);
            exit;
        }
        $messgae = new \Org\Tool\Message($userData['uid']);
        if(!($messgae->getComplaintSome(I('post.sid')))){
            $this->success('你已经投诉过了，我们会尽快处理此事务',U('/User'),2);
            exit;
        }
        $SuperAdmin = getSuperAdminId();
        if($messgae->SendMessage($SuperAdmin,$title,$content,I('post.sid'),0,Shop::getShopOwn(I('post.sid')))){
            $this->success('发送成功，我们会尽快处理此事务',U('/User'),2);
            exit;
        }else{
            $this->error('发送失败，请重试',U('Sendmessage/Complaint',array('sid'=>I('post.sid'))),2);
            exit;
        }
    }
}