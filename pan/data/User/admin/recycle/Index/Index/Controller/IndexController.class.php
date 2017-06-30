<?php
namespace Index\Controller;
use Org\Tool\PluginAuthorization;
use Think\Controller;
use Org\Tool\AdminTool;
class IndexController extends UserloginController {
    public $UserSystemData;
    public function index(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"MCTL");
        //解释一下下面limit是限制每页多少，page是显示第几页
        $num = 25;
        $page = I('get.p');
        $ShopData = M('Server')->where("PluginState ='1' AND Num >0")
            ->page($page,$num)->order('UpdateTime desc,SID desc')
            ->alias('s')
            ->join('__USER__ ON s.UID = __USER__.UID')
            ->field('UserName,ShopName,FindQQ,Version,Price,UpdateTime,Data,Sales,SID,Thumburl,Action,PlayerSolt,CPlayerSolt,MemaryLimit,DateLimit,Num,Content')
            ->select();
        $this->assign('list',$ShopData);// 赋值数据集
        $count      = M('Server')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setPrefix('Index/index/');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        //把商品数据输出出去
        $this->assign('ShopData',$ShopData);
        $this->sliders = AdminTool::getSlideData();
        $this->display();
    }
}