<?php
namespace Index\Controller;
use Think\Controller;
use Org\Tool\Find;
class FindController extends UserloginController
{
    public function index(){
        $this->title = '搜索';
        $this->search = I('get.search');
        $data = str_replace("'", '', $this->search);
        $this->data = Find::findAllWithPage($data,I('get.p',1),12);
        $count      = Find::findAllCount($data);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function tag(){
        $this->title = '标签';
        $this->search = I('get.search');
        $data = Find::findTagsWithAllData($this->search,I('get.p',1),12);
        $this->data = $data['data'];
        $count      =$data['count'];// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    /*public function catalog(){
        $this->title = '目录';
        $this->search = I('get.search');
        $data = Find::findCatalogWithAllData($this->search,I('get.p',1),12);
        $this->data = $data['data'];
        $count      =$data['count'];// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }*/
}