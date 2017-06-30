<?php
namespace Index\Widget;
use Index\Controller\UserloginController;
use Org\Tool\Comment;
use Org\Tool\Verify;
class CommentWidget extends UserloginController{//继承登录页
    public function getcomment($pageid){
        $this->shopid = $pageid;
        $comment = new Comment();
        $page = I('get.p');
        $num = 30;
        $commentCount = $comment->getShopCommentCount($pageid);
        $this->commentData = $comment->getShopCommentWithPage($pageid,$page,$num);
        $page = new \Think\Page($commentCount,$num);
        $this->page = $page->show();
        $this->display('Comment:getcomment');
    }

    public function sendcomment($pageid){
		$this->assign('token',Verify::getToken());
        $this->display('Comment:sendcomment');
    }
}