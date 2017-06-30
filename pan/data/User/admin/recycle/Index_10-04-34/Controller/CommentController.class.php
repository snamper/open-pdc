<?php
namespace Index\Controller;
use \Org\Tool\Comment;
class CommentController extends UserifloginController
{
    public function setUseful(){
        $comid = I('post.comid');
        $type = I('post.type');
        $type = $type=='up'?1:0;
        $if = session("comment-{$comid}");
        if($if == NULL){
            $comment = new Comment();
            $comment->commentUseful($comid,$type);
            session('comment-'.$comid,1);
            $this->ajaxReturn(true);
            exit;
        }else{
            $this->ajaxReturn(false);
            exit;
        }
    }
    public function sendcomment(){
        header('Content-type:text/html;charset=utf-8');
        if(!IS_POST){
            exit;
        }
        $data = I('post.');
        $comNum = M('Comment')->where("useruid = '{$this->UserSystemData['uid']}' AND pageid = '{$data['pid']}'")->count();

        $comment = new Comment();//$t代表临时…………tmp
        $t = $comment->sendComment($data['pid'],getCanSeeName($this->UserSystemData),$this->UserSystemData['uid'],$data['content'],$data['find']);
        if($t){
            $message = new \Org\Tool\Message($this->UserSystemData['uid']);
            $UPlug = M('Plugin')->where(['PID' => $data['pid']])->select();
			$UPlug = $UPlug[0];
            $message->SendMessage($UPlug['uid'],"你的插件[{$UPlug['title']}]有一条新评论","你的商品[{$UPlug['title']}]有一条新评论。<br>
评论者:{$this->UserSystemData['username']}<br>详细内容请见插件PID:<a href='".U('/Plugin/'.$UPlug['pid'])."' target='_blank'>{$UPlug['pid']}</a>");
            redirect(I('server.HTTP_REFERER').'#comment-'.$t);
            exit;

        }else{
            $this->error('发送失败，请重试');
        }
    }
}