<?php
namespace Index\Controller;
use Org\Tool\Comment;
use Think\Controller;

/**
 * @property mixed title
 */
class ShopController extends UserloginController {
    /**
     *首页……其实这里是可以监听空操作然后获取id来得到商品的
     */
    public function index(){
        $this->redirect('/Index');
    }

    public function _empty($id){
        //把所有id转到GetShop
        $this->GetShop($id);
    }
    //一定要是保护方法
    protected function GetShop($id){
        $id = (int)$id;
        if($id === 0){
            $this->redirect('Shop/index');
        }
        $this->levelnum = Comment::getShopLevelCount($id);
        $this->level = Comment::getShopLevel($id);
        $this->title = C('TITLE',null,"商品详细");
        $Shop = M('Shop')->where("sid = {$id}")->find();
        if($Shop['pluginstate'] !== '1'){
            $this->error('此服务器正在审核中',U('/Index'));
        }
		$data['fid']=$Shop['filefid'];
		$UserSystemData = $this->UserSystemData;
		$username=$UserSystemData['username'];
		$Shop['pList'] = M('User')->where("UserName = '{$username}'")->getField('HasShop');//得到已经购买的插件
		$Shop['pList'] = CJson($Shop['pList'],true);
		$a=0;
		$Shop['isBuy']=false;
		while(empty($Shop['pList'][strval($a)])!=true){
			if($Shop['pList'][strval($a)]['sid']==intval($id)){
				$Shop['isBuy']=true;
			}
			$a=$a+1;
		}
		$Shop['file']='/Download?fid=0';
        $ShopUser = M('User')->field('HasShop,SCart',true)->where("uid = {$Shop['uid']}")->find();
        $ShopUser['data'] = CJson($ShopUser['data'],true);
        $this->assign('ShopUser',$ShopUser);
        $Shop['tags'] = GetTags($Shop);
        $Shop['catalog'] = GetCatalog($Shop);
        $this->assign('Shop',$Shop);
        //结束
        $this->display('shop');
    }
}