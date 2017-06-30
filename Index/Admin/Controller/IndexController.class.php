<?php
namespace Admin\Controller;
//use Org\Tool\Costrecord;
use Org\Tool\Message;
use Think\Controller;
use Org\Tool\AdminTool as AdminTool;
use Org\Tool\Shop as Shop;
use Org\Tool\AdminPage as AdminPage;
use Org\Tool\Widget;
use Org\Tool\Broadcast;

class IndexController extends IndexCheckController {
    public function index(){
		$count = array();
        $count['user'] = M('User')->count();
		$count['commit'] = M('Comment')->count();
		$count['plugin'] = M('Plugin')->count();
		$this->assign('count', $count);
        $this->display();
    }

    public function User(){
        $this->title = '用户版面';
        $num = 30;
        $find = I('get.find',false);
        if($find !== false){
            $map['_string'] = "concat (UserName,Email) like '%".$find."%'";
            $this->data = M('User')->where($map)->select();
            $this->count  = 1;
        }else{
            $this->data = M('User')->page(I('get.p',1,'number_int'),$num)->select();
            $this->count  = M('User')->count();
            $this->page = new AdminPage($this->count,$num);
            $this->page = $this->page->show();
        }
        $this->display('user');
    }
	
	public function Plugin(){
        $num = 30;
        $find = I('get.find',false);
        if($find !== false){
            $map['_string'] = "concat (Title,Content) like '%".$find."%'";
            $this->data = M('Plugin')->where($map)->order('UpdateTime desc,PID desc')->select();
            $this->count  = 1;
        }else{
            $this->data = M('Plugin')->page(I('get.p',1,'number_int'),$num)->order('UpdateTime desc,PID desc')->select();
            $this->count  = M('Plugin')->count();
            $this->page = new AdminPage($this->count,$num);
            $this->page = $this->page->show();
        }
        $this->display('plugin');
    }
	
	public function PluginCheck(){
        $num = 30;
        $find = I('get.find',false);
        if($find !== false){
            $map['_string'] = "concat (Title,Content) like '%".$find."%'";
            $this->data = M('Plugin')->where($map)->order('UpdateTime desc,PID desc')->select();
            $this->count  = 1;
        }else{
            $this->data = M('Plugin')->where(['PluginState' => 0])->page(I('get.p',1,'number_int'),$num)->order('UpdateTime asc,PID asc')->select();
            $this->count  = M('Plugin')->count();
            $this->page = new AdminPage($this->count,$num);
            $this->page = $this->page->show();
        }
        $this->display('plugincheck');
    }
	
	public function AccPlugin(){
		$broadcast = new Broadcast();
		$pid = I('post.id');
		$plug = M('Plugin');
		$plugdata = $plug->where(array('PID' => $pid))->find();
		$ret = $plug->where(array('PID' => $pid))->data(['PluginState' => 1])->save();
		if(!$ret){
			$this->ajaxReturn(['status'=>'1', 'message'=>$ret->getError()]);
		} else {
			$message = new \Org\Tool\Message(1);
			$message->SendMessage($plugdata['uid'],"你的插件[{$plugdata['title']}]已通过审核","你的插件[{$plugdata['title']}]已通过审核！<br>详细内容请见插件PID:<a href='".U('/Plugin/'.$plugdata['pid'])."' target='_blank'>{$plugdata['pid']}</a>");
			$broadcast->sendBroadcast($plugdata['uid'], '插件：'.$plugdata['title'].'发布了！'."\n".'请点击：'.rtrim(C('HOST'), '/').U('/Plugin/'.$plugdata['pid']).'查看详情');
			$this->ajaxReturn(['status' => 0]);
		}
	}
	
	public function Comment(){
        $num = 30;
        $find = I('get.find',false);
        if($find !== false){
            $map['_string'] = "concat (content) like '%".$find."%'";
            $this->data = M('Comment')->where($map)->select();
            $this->count  = 1;
        }else{
            $this->data = M('Comment')->page(I('get.p',1,'number_int'),$num)->select();
            $this->count  = M('Comment')->count();
            $this->page = new AdminPage($this->count,$num);
            $this->page = $this->page->show();
        }
        $this->display('comment');
    }

	public function DelComment(){
		$pid = I('post.id');
		$plug = M('Comment');
		$plugdata = $plug->where(array('comid' => $pid))->select();
		$ret = $plug->where(array('comid' => $pid))->delete();
		if(!$ret){
			$this->ajaxReturn(['status'=>'1', 'message'=>$ret->getError()]);
		} else {
			$this->ajaxReturn(['status'=>0]);
		}	
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

    public function Setting(){
        $slidename = I('post.slidename');
        $slide = I('post.slide');
        if($slidename[0] !== '' and $slide[0] !== ''){
            $data['slidename'] = $slidename;
            $data['slide']=$slide;
            AdminTool::setSlideData($data);
        }
        //小工具的操作
        if(I('post.widget') == 1){
            $data = I('post.');
            $widget = new Widget();
            $widget->set($data);
        }
        //顶部公告栏
        if(I('post.header_notice')){
            $html = str_replace('\"', '"', I('post.header_notice'));
            $if = AdminTool::setHeaderNotice($html);
            if($if){
                $this->success('更新公告栏成功', U('/Admin/Index/Setting'));
            }else{
                $this->error('更新公告栏失败', U('/Admin/Index/Setting'));
            }
        }
        $header_notice = AdminTool::getHeaderNotice();
        $this->assign('header_notice',$header_notice);

        $this->sliders = AdminTool::getSlideData();
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

    /*public function Application(){
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
    }*/

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