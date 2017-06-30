<?php
namespace Index\Controller;
use Org\Tool\Comment;
use Think\Controller;

/**
 * @property mixed title
 */
class PluginController extends UserloginController {
    public function index(){ //跳回首页
        $this->redirect('/Index');
    }

    public function _empty($id){
        //把所有id转到GetShop
        $this->GetShop($id);
    }
    //一定要是保护方法
    protected function GetShop($id){
        $id = (int)$id;
        if($id === 0){ //空id回主页
            $this->redirect('/index');
        }
        $this->title = C('TITLE',null,"插件详情");
        $Plug = M('Plugin')->where("pid = {$id}")->find();
		if($Plug['pluginstate'] == 1 || $this->UserSystemData['action'] > 9){
			$data['fid']=$Plug['filefid'];
			$UserSystemData = $this->UserSystemData;
			$username=$UserSystemData['username'];
			$Plug['pList'] = M('User')->where("UserName = '{$username}'")->getField('HasDownload');//得到已经下载过的插件
			$Plug['pList'] = CJson($Plug['pList'],true);
			$PlugUser = M('User')->field('HasDownload',true)->where("uid = {$Plug['uid']}")->find();
			$PlugUser['data'] = CJson($PlugUser['data'],true);
			$this->assign('Dev',$PlugUser);
			$this->assign('Plug',$Plug);
			//结束
			$this->display('plugin');
		} else {
			$this->error('本插件正在审核中...', U('/Index/Index'));
		}
    }
}