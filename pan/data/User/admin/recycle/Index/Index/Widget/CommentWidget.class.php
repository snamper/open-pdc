<?php
namespace Index\Widget;
use Index\Controller\UserloginController;
use Org\Tool\Comment;
class CommentWidget extends UserloginController{//继承登录页
    public function getcomment($shopid){
        $this->shopid = $shopid;
        $comment = new Comment();
        $page = I('get.p');
        $num = 30;
        $commentCount = $comment->getShopCommentCount($shopid);
        $this->commentData = $comment->getShopCommentWithPage($shopid,$page,$num);
        $page = new \Think\Page($commentCount,$num);
        $this->page = $page->show();
        $this->display('Comment:getcomment');
    }

    public function sendcomment($shopid){
        $comNum = M('Comment')->where("useruid = '{$this->UserSystemData['uid']}' AND shopid = '{$shopid}'")->count();

        $shopNum = 0;
        foreach($this->UserSystemData['hasshop'] as $one){
            if($one['sid'] == $shopid){
                ++$shopNum;
            }
        }
        if($shopNum <1){
            return false;
        }
        if($comNum >= $shopNum){//判断评论次数
            return false;
        }
        $this->display('Comment:sendcomment');
    }
}