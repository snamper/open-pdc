<?php
namespace Index\Controller;
use Think\Controller;
use Org\Tool\PluginAuthorization;
use Org\Tool\Verify;
use Org\Tool\Broadcast;

class DeveloperController extends DeveloperifloginController {
    public function index(){
        $this->title = C('TITLE',null,"发布中心");
        $this->ActionTitle = '欢迎';
        $this->centect = '欢迎你回来'.session('UserName');
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->display();
    }
    /**
     * 提交插件的接口,ajax用
     */
    public function SubmitPlugin(){
		if(!Verify::checkVerify(I('post.token'))){ //验证码错误
			$this->ajaxReturn(['status' => '1', 'message' => '验证码错误']);
		} else {
			//初始数据初始化START
			$Login = $this->UserSystemData;
			$broadcast = new Broadcast;
			$EditPlugin = false;
			if(strlen(I('post.pid'))>0) { //判断是否更新
				$EditPlugin = true;
				$pid = I('post.pid');
			}
			if(I('post.QQ') =='' or I('post.QQ')=='0'){
				$this->ajaxReturn(array('error'=>'请填写联系方式'));
				return true;
			}
			
			/*if(M('Plugin')->where(array('FileFid' => I('post.fid')))->find() && $EditPlugin !== true){
				$this->ajaxReturn(array('status'=>1,'message'=>'插件已经存在！如需更新请选择编辑插件。'));
				return true;
			}*/
			
			$tags = str_replace('，', ',', I('post.tags'));
			
			//数据判断:END
			//数据构造START
			$Plug = D('Plugin');//构建自动验证的Model
			$Data = array();
			$Data['Title'] =  I('post.title');//名称
			$Data['Content'] = I('post.editor');//介绍内容
			$Data['Version'] = I('post.version');//插件版本
			$Data['Package'] = I('post.package');//插件包名
			$Data['FindQQ'] =  I('post.QQ');//联系QQ
			$Data['TAGS'] =  I('post.tags');//标签
			$Data['Catelogue'] =  I('post.catelogue');//分类
			$Data['Or'] =  I('post.or');//原创或转载
			if(!$EditPlugin){
				$Data['UID'] = intval($Login['uid']);//用户UID
				$Data['PluginState'] = 0;
				$Data['Avaliable'] = 0;
			} else {
				$Data['UpdateContent'] = I('post.updatecontent');//更新介绍
			}
			$Data['FID'] = I('post.fid'); //文件id
			if(I('post.mode') == 'opensource'){
				$Data['Mode'] = 1;
			} elseif(I('post.mode') == 'closesource') {
				$Data['Mode'] = 2;
			} elseif(I('post.mode')=='default'){
				$Data['Mode'] = 3;
			} elseif(I('post.mode')=='multi'){
				
			}
			
			if($EditPlugin){
				$CreateData = $Plug->create($Data,2);
			} else {
				$CreateData = $Plug->create($Data,1);
			}
			
			if(preg_match('/src=\"?(.+\.(jpg|gif|bmp|bnp|png))/i',html_entity_decode($Data['Content']),$info)){
				$Plug->ThumbUrl = str_replace(['src=', '"'], ['',''], $info[0]);
			}

			if(!$CreateData){ //判断数据是否正确
				$this->ajaxReturn($Plug->getError());
				return true;
			}
			
			if($EditPlugin){
				$SPlugin['PID'] = $pid;
				$SPlugin['UID'] = $Login['uid'];
				$ifOwner = M('Plugin')->where($SPlugin)->select();//看一下这个pid的商品是不是这个UID用户拥有的
				if($this->UserSystemData['action'] < 9 && $ifOwner==false){
					$this->ajaxReturn(['status' => '1', 'message' => '权限不足']);
					unset($Data);
					return true;
				}
				unset($SPlugin);
			}
			try{
				if($EditPlugin){//编辑插件
					$Plugin = M('Plugin')->where("PID = '{$pid}'")->find(); //找到原先的插件
					$Plug->where("PID = '{$pid}'")->save();
				}else{//不是编辑进行新建操作
					$pid = $Plug->add();
				}
				if(preg_match('/,/', $tags)){
					foreach(explode(',', $tags) as $tag){
						if(M('tags')->where(['content' => $tag])->select()){
							M('tags')->where(['content' => $tag])->setInc('count', 1);
						} else {
							$tm = M('tags');
						$tm->data(['content' => $tag])->add();
						}
					}
				} else {
					if(M('tags')->where(['content' => $tags])->select()){
						M('tags')->where(['content' => $tags])->setInc('count', 1);
					} else {
						$tm = M('tags');
						$tm->data(['content' => $tags])->add();
					}
				}
			} catch(Exception $e) {
				$this->ajaxReturn(['status' => '1', 'message' => $e->getMessage()]);
			}
			if($EditPlugin){
				$broadcast->sendBroadcast($Login['uid'], '插件：'.$Data['Title'].'更新到了'.$Data['Version'].'！'."\n".$Data['UpdateContent']."\n".'请点击：'.rtrim(C('HOST'), '/').U('/Plugin/'.$pid).'查看详情');
			}
			$this->ajaxReturn(['status' => '0', 'pid' => $pid]);
		}
    }
	
	public  function NewPlugin(){
        header("Content-Type:text/html; charset=utf-8");
        $this->title = C('TITLE',null,"发布中心-添加插件");
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '发布插件';
        $Check = md5(md5(time()).$UserSystemData['UID']);//隐藏域用的一个检测多开编辑页面的东西
		$catelogue = M('Tags')->where(['mode' => 1])->select();
		$this->assign('catelogue', $catelogue);
		$this->assign('url', U('/Developer/SubmitPlugin'));
		$this->assign('token',Verify::getToken());
        trace(I('session.'));
        session($Check,'NULL');
        $this->display();
    }
	
	public  function EditPlugin(){
        header("Content-Type:text/html; charset=utf-8");
        $this->title = C('TITLE',null,"发布中心-编辑插件");
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
		$pid = I('get.pid');
        $Plug['PID'] = $pid;
        $CheckPlug = M('Plugin')->where($Plug)->select();
		if($CheckPlug[0]['uid'] != $UserSystemData['uid'] && $UserSystemData['action'] < 9){
			$this->error('权限不足！','/Developer',2);
			return true;
		}
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '编辑插件';
        $Check = md5(md5(time()).$UserSystemData['UID']);//隐藏域用的一个检测多开编辑页面的东西
		$catelogue = M('Tags')->where(['mode' => 1])->select();
		$this->assign('catelogue', $catelogue);
		$this->assign('url', U('/Developer/SubmitPlugin'));
		$this->assign('token',Verify::getToken());
		$this->plug = $CheckPlug[0];
        trace(I('session.'));
        session($Check,'NULL');
        $this->display();
    }
	
	public function DelPlugin(){
		$pid = I('post.id');
		$plug = M('Plugin');
		$plugdata = $plug->where(array('PID' => $pid))->select();
		if($this->UserSystemData['action'] < 9 && $plugdata[0]['uid'] != $this->UserSystemData['uid']){
			$this->ajaxReturn(['status'=>'1', 'message'=>'权限不足']);
		} else {
			$ret = $plug->where(array('PID' => $pid))->delete();
			if(!$ret){
				$this->ajaxReturn(['status'=>'1', 'message'=>$ret->getError()]);
			} else {
				$this->ajaxReturn(['status'=>0]);
			}
		}
	}
	
	public function CAvaliable(){
		$pid = I('post.id');
		$plug = M('Plugin');
		$mode = I('post.mode');
		$plugdata = $plug->where(array('PID' => $pid))->select();
		if($this->UserSystemData['action'] < 9 && $plugdata[0]['uid'] != $this->UserSystemData['uid']){
			$this->ajaxReturn(['status'=>'1', 'message'=>'权限不足']);
		} else {
			if($mode == 0){
				$ret = $plug->where(array('PID' => $pid))->setField('Avaliable', 0);
			} else {
				$ret = $plug->where(array('PID' => $pid))->setField('Avaliable', 1);
			}
			if(!$ret){
				$this->ajaxReturn(['status'=>'1', 'message'=>$ret->getError()]);
			} else {
				$this->ajaxReturn(['status'=>0]);
			}
		}
	}
	
	public function MyPlugin(){
        $this->title = C('TITLE',null,"发布中心-我的插件");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '已发布插件';
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $num = 10;
        $Data = M('Plugin')->where("UID={$UserSystemData['uid']}")->order('PID desc')->page(I('get.p',1),$num)->select();
        $this->assign('ShopData',$Data);// 赋值数据集
        $count      =  $count = M('Plugin')->where("UID={$UserSystemData['uid']}")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display('myplugin');
    }
	
    public function Sellrecord(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"版主中心-收入统计");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '收入统计';
        $num = 10;
        $page = I('get.p');
        $Data = M('Costrecord')->where("UserUID = {$UserSystemData['uid']} AND Type = 1")->page($page,$num)->select();
        $this->allgivemoney = M('Costrecord')->where("UserUID = {$UserSystemData['uid']} AND Type = 1")->sum('Number');
        $this->assign('list',$Data);// 赋值数据集
        $count      = M('Costrecord')->where("UserUID = {$UserSystemData['uid']} AND Type = 1")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    /**
     *提现申请
     *//*
    public function atm(){
        $UserSystemData = $this->UserSystemData;
        $this->title = '提现申请';
        $num = I('post.num');
        $togive = I('post.togive');
        $DeveloperName = I('post.type');
        if(!empty($_POST) and $togive == ''){
            $this->error('请填写收款账户（微信/QQ）');
            exit;
        }
        if(!empty($_POST) and $DeveloperName == ''){
            $this->error('请填写收款账户类型');
            exit;
        }
        if(((int)$num >= 1)){
            $havemoney = M('User')->where("uid = {$UserSystemData['uid']}")->getField('Money');
            if($num <= $havemoney){
                $if = AddCostRecord((int)$num,$UserSystemData['uid'],2,$UserSystemData['uid'],0,"用户[{$UserSystemData['username']}]提交的[{$num}]元提现申请。{$DeveloperName}账户:{$togive}");
                if($if){
                    $this->success('申请成功，我们会尽快处理，如果你被投诉，我们会延期执行并与您协商。','/Developer',4);
                    exit;
                }else{
                    $this->error('申请失败,请联系管理员','/Developer',2);
                    exit;
                }
            }else{
                $this->error('余额不足','/Developer',2);
                exit;
            }
        }
        $this->assign('UserSystemData',$UserSystemData);
        $this->display();
    }
    public function atmrecord(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = '提现记录';
        $page = I('get.p');
        $num = 20;
        $countrecord = new \Org\Tool\Costrecord($UserSystemData['uid']);
        $list=$countrecord->getUserATMWithPage($UserSystemData['uid'],$page,$num);
        $this->assign('list',$list);// 赋值数据集
        $count      = $countrecord->getCountATMUser($UserSystemData['uid']);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }*/
}