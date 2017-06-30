<?php
namespace Org\Tool;
class Comment{//评论类
    /**发送评论
     * @param $title
     * @param $level
     * @param $sid
     * @param $username
     * @param string $content
     * @param string $find
     * @return bool
     */
    public function sendComment($sid,$username,$uid,$contentData='',$find=''){
        $content['content']=$contentData;
        $content['find'] = $find;
        $data['pageid'] = (int)$sid;
        $data['useruid']=$uid;
        $data['username']=$username;
        $data['content']=$contentData;
        $data['commentdate'] = date("Y-m-d h:i:s");
        $check = M('Comment')->add($data);
        if($check){
            return $check;
        }else{
            return false;
        }
    }

    /**获取一条评论
     * @param $comid
     * @return mixed
     */
    public function getComment($comid){
        $data = M('Comment')->where("comid = '{$comid}'")->find();
        $data['content'] = htmlspecialchars_decode($data['content']);
        return $data;
    }

    /**获取商品下的评论
     * @param $sid
     * @return mixed
     */
    public function getShopCommentWithPage($sid,$page,$num){
        $data = M('Comment')->where("pageid = '{$sid}'")->order('commentdate desc')->page($page,$num)->select();
        foreach($data as &$one){
            $one['content'] = htmlspecialchars_decode($one['content']);
        }
        return $data;
    }
	
	/**获取商品下的评论数量
     * @param $sid
     * @return int
     */
    public function getCommentCountWithPage($sid){
        $data = M('Comment')->where("pageid = '{$sid}'")->count();
        return $data;
    }

	
    /**获取商品星级
     * @param $sid
     * @return array
     */
	 /*
    public static function getShopLevel($sid){//获取商品星级
        $data = M('Comment')->field('level')->where("pageid = '{$sid}'")->select();
        $level = array(1=>0,2=>0,3=>0,4=>0,5=>0);
        foreach($data as $one){
               $level[$one['level']] = $level[$one['level']]+1;
        }
        return $level;
    }*/

    /**获取商品星级数量
     * @param $sid
     * @return mixed
     */
	 /*
    public static function getShopLevelCount($sid){//获取商品星级数量
        $data = M('Comment')->where("pageid = '{$sid}' and parentcomid=0")->count();
        return $data;
    }*/

    /**删除一条用户评论
     * @param $comid
     * @return mixed
     */
    public function DelComment($comid){
        return M('Comment')->delete($comid);
    }

    /**获取评论数量
     * @param $sid
     * @return mixed
     */
    public function getShopCommentCount($sid){
        return M('Comment')->where("pageid = '{$sid}'")->count();
    }

    /**设置评论时候有用
     * @param $comid
     * @param $yes
     * @return bool
     */
    public function commentUseful($comid,$yes){
        $data = M('Comment')->where("comid = '{$comid}'")->getField('ifuseful');
        $data = CJson($data,true);
        if($data == 0){
            $data = array();
        }
        if($yes==1){
            cookie('comment-'.$comid,'up');
            $data['up'] = (int)$data['up']+1;
        }else{
            cookie('comment-'.$comid,'down');
            $data['down'] = (int)$data['down']+1;
        }
        $data['all'] = (int)$data['up']-(int)$data['down'];
        $data = CJson($data);
        return M('Comment')->where("comid ='{$comid}'")->setField('ifuseful',$data);
    }
}