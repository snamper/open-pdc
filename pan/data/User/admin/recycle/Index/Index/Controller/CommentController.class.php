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
        if($data['title'] == ''){//数据验证
            $this->error('请填写标题');
            exit;
        }
        if(utf8_strlen($data['title'])<5 or (!empty($data['content']) and utf8_strlen($data['content'])<20)){
            $this->error('标题应该有5字以上，如果有内容，请输入20字以上');
            exit;
        }
        $comNum = M('Comment')->where("useruid = '{$this->UserSystemData['uid']}' AND shopid = '{$data['sid']}'")->count();
        $shopNum = 0;
        foreach($this->UserSystemData['hasshop'] as $one){
            if($one['sid'] == $data['sid']){
                ++$shopNum;
            }
        }
        if($shopNum <1){
            $this->error('你没有购买此服务器，无权评论。');
            exit;
        }
        if($comNum >= $shopNum){//判断评论次数
            $this->error('评价次数过多');
            exit;
        }
        $comment = new Comment();//$t代表临时…………tmp
        $t = $comment->sendComment($data['title'],$data['levelnum'],$data['sid'],getCanSeeName($this->UserSystemData),$this->UserSystemData['uid'],$data['content'],$data['find']);
        if($t){
            $hasshop = $this->UserSystemData['hasshop'];
            foreach($hasshop as $k=>$one){
                if($one['sid'] == $data['sid'] and $one['comment']!==1){
                    $hasshop[$k]['comment']=1;
                    break;
                }
            }
            M('User')->where("UID = '{$this->UserSystemData['uid']}'")->setField('HasShop',CJson($hasshop));
            $message = new \Org\Tool\Message($this->UserSystemData['uid']);
            $UShop = M('Shop')->where("sid = '{$data['sid']}'")->select();
            $message->SendMessage($UShop['uid'],"你的商品[{$UShop['shopname']}]有一条新评论","你的商品[{$UShop['shopname']}]有一条新评论。<br>
评论者:{$this->UserSystemData['username']}<br>详细内容请见商品SID:<a href='".U('/Shop/'.$UShop['sid'])."' target='_blank'>{$UShop['sid']}</a>");
            redirect(I('server.HTTP_REFERER').'#comment-'.$t);
            exit;

        }else{
            $this->error('发送失败，请重试');
        }
    }
}