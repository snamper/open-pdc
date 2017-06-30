<?php
namespace Org\Tool;

class PluginAuthorization{
    protected static $kf;
    protected static $config;
    public static function KF5(){
        Vendor('KF5.KFClient');
        self::$config = C('KF5CONFIG');
        $config = self::$config;
        self::$kf = new \KFClient($config['yourDomain'],$config['email']);
    }

    public static function KF5User($email){
        Vendor('KF5.KFClient');
        self::$config = C('KF5CONFIG');
        $config = self::$config;
        return new \KFClient($config['yourDomain'],$email);
    }
    /**
     *提交新建插件的设置审核
     */
    public static function PluginAuthorization($sid,$user){
        self::KF5();
        $kf = self::$kf;
        $config = self::$config;
        $kf->setAuth('token',$config['token']);
        $User = (array)$kf->users()->search($user['email']);
        if(empty($User['users'])){
            $info = array('name'=>$user['username']."[{$user['uid']}]",'email'=>$user['email']);
            $kf->users()->create($info);
        }
        self::sendTicketByEmail($sid,$user);
    }

    /**
     *插件审核通过
     */
    public static function ShopStateSet($sid,$type,$check){
        $shop = M('Shop')->where("sid = '{$sid}'")->find();
        $check = (int)$check==1 or $check=='yes'?1:0;
        if($shop['pluginstate']!=='1'){
            if($type=='all'){
                M('Shop')->where("sid = '{$sid}'")->setField('PluginState',1);
                self::afterPass($shop['uid'],$shop);
                return true;
            }elseif($type=='post'){
                $data = CJson($shop['pluginstate'],true);
                if($data['plugin'] == '1' and $check==1){
                    M('Shop')->where("sid = '{$sid}'")->setField('PluginState',1);
                    self::afterPass($shop['uid'],$shop);
                    return true;
                }
                $data = (array)$data;
                $data['post'] = $check;
                M('Shop')->where("sid = '{$sid}'")->setField('PluginState',CJson($data));
                return true;
            }else{
                $data = CJson($shop['pluginstate'],true);
                if($data['post'] == '1' and $check==1){
                    M('Shop')->where("sid = '{$sid}'")->setField('PluginState',1);
                    self::afterPass($shop['uid'],$shop);
                    return true;
                }
                $data = (array)$data;
                $data['plugin'] = $check;
                M('Shop')->where("sid = '{$sid}'")->setField('PluginState',CJson($data));
                return true;
            }
        }
        return false;
    }

    public static function afterPass($uid,$shop){
        $message = new \Org\Tool\Message(getSuperAdminId());
        $message->SendMessage($uid,"你的服务器[{$shop['shopname']}]已经通过审核","你的服务器[{$shop['shopname']}]已经通过审核，目前已经上架");
        if(isset($shop['oldplugin']) and $shop['oldplugin']!==''){
            $sid = $shop['sid'];
            unset($shop['sid']);
            $data['UID']=$shop['uid'];
            $data['Price']=$shop['price'];
            $data['ShopName']=$shop['shopname'];
            $data['ThumbUrl']=$shop['thumburl'];
            $data['Version']=$shop['version'];
            $data['FindQQ']=$shop['findqq'];
            $data['Content']=$shop['content'];
            $data['TAGS']=$shop['tags'];
            $data['Catalog']=$shop['catalog'];
            $data['UpdateTime']=date("Y-m-d");
            $data['FileFID']=$shop['filefid'];
            $data['OldPlugin'] = 0;
            $data['PluginState']=1;
            if($shop['oldplugin']!=='0'){
                //删除原来记录
                M('Shop')->where("SID = '{$sid}'")->delete();
                M('Shop')->where("SID = '{$shop['oldplugin']}'")->save($data);
                M('File')->where("FID = '{$shop['filefid']}'")->setField('CheckUse',$shop['oldplugin']);
                //有待测试
            }
            unset($shop);
        }
        echo '服务器审核完成，已经上架';
        echo '<br><a href="'.U('/Index').'">点击待审核列表</a><br>';
    }

    public static function getShopState($sid,$type=''){
        $state = M('Shop')->where("sid = '{$sid}'")->getField('PluginState');
        if($state == '1'){
            return '商品审核已通过';
        }elseif($state =='0'){
            return '商品审核未通过';
        }
        if($type==''){
                return CJson($state,true);
        }elseif($type=='post'){
            $t=CJson($state,true);
            if($t['post']=='1'){
                return '资料审核已通过';
            }else{
                return '资料审核未通过';
            }
        }else{
            $t=CJson($state,true);
            if($t['plugin']=='1'){
                return '服务器审核已通过';
            }else{
                return '服务器审核未通过';
            }
        }
    }

    /**
     *发送工单
     */
    public static function sendTicketByEmail($sid,$user){
        $config = self::$config;
        //构造审核数据
        $linkData = array(
            array('查看详细数据',C('HOST').U('/Checker/view',array('sid'=>$sid))),
            array('编辑资料',C('HOST').U('/Checker/editpost',array('sid'=>$sid))),
            array('资料通过审核',C('HOST').U('/Checker/postpass',array('pass'=>'yes','sid'=>$sid))),//需要加一个确认的步骤.
            array('服务器通过审核',C('HOST').U('/Checker/pluginpass',array('pass'=>'yes','sid'=>$sid))),//需要加一个确认的步骤
            array('资料不通过审核',C('HOST').U('/Checker/postpass',array('pass'=>'no','sid'=>$sid))),//需要加一个确认的步骤.
            array('服务器不通过审核',C('HOST').U('/Checker/pluginpass',array('pass'=>'no','sid'=>$sid))),//需要加一个确认的步骤
        );
        $linkData = createLinkToCheck($linkData);
        $otherData['date']=date('Y-m-d H:i:s');
        $textData=<<<HTML
<h2>[服务器审核][用户:{$user['username']}][服务器SID:{$sid}]</h2>
<p>发送日期：{$otherData['date']}。
</p>
<p>
{$linkData}
</p>
HTML;
        ;
        $json = array('title'=>"[插件审核][用户:{$user['username']}][插件SID:{$sid}]",
            'comment'=>array('content'=>$textData),
            "custom_fields"=>array(
                array(//下面两个字段是必要字段
                    "name"=>"field_3840",
                    "value"=>"true"
                ),
                array(
                    "name"=>"field_3702",
                    "value"=>"问题提交"
                ),
            )
        );
        $kfUser = self::KF5User($user['email']);
        $kfUser->setAuth('token',$config['token']);
        $kfUser->requests()->create($json);
    }

    public static function getPluginReview($sid){
        $data = M('Shop')->where("sid = '{$sid}'")->getField('PluginState');
        if($data =='1'){
            echo '<span style="color: green">商品已通过审核</span>';
        }elseif($data =='0'){
            echo '<span style="color: orangered">商品正在审核</span>';
        }else{
            $data = CJson($data,true);
            $info='';
            if($data['plugin']=='1'){
                $info.='<span style="color: green">服务器已通过审核</span><br>';
            }else{
                $info.='<span style="color: orangered">服务器未通过或还在进行审核</span><br>';
            }
            if($data['post']=='1'){
                $info.='<span style="color: green">资料已通过审核</span>';
            }else{
                $info.='<span style="color: #ffd100">资料未通过或还在进行审核</span>';
            }
            echo $info;
        }
    }
	
	public static function getServerReview($sid){
        $data = M('Server')->where("sid = '{$sid}'")->getField('PluginState');
        if($data =='1'){
            echo '<span style="color: green">商品已通过审核</span>';
        }elseif($data =='0'){
            echo '<span style="color: orangered">商品正在审核</span>';
        }else{
            $data = CJson($data,true);
            $info='';
            if($data['plugin']=='1'){
                $info.='<span style="color: green">服务器已通过审核</span><br>';
            }else{
                $info.='<span style="color: orangered">服务器未通过或还在进行审核</span><br>';
            }
            if($data['post']=='1'){
                $info.='<span style="color: green">资料已通过审核</span>';
            }else{
                $info.='<span style="color: #ffd100">资料未通过或还在进行审核</span>';
            }
            echo $info;
        }
    }

    public static function getPluginReviewWithData($data){
        if($data =='1'){
            echo '<span style="color: green">商品已通过审核</span>';
        }elseif($data =='0'){
            echo '<span style="color: orangered">商品正在审核</span>';
        }else{
            $data = CJson($data,true);
            $info='';
            if($data['plugin']=='1'){
                $info.='<span style="color: green">插件已通过审核</span><br>';
            }else{
                $info.='<span style="color: orangered">插件未通过或还在进行审核</span><br>';
            }
            if($data['post']=='1'){
                $info.='<span style="color: green">资料已通过审核</span>';
            }else{
                $info.= '<span style="color: #ffd100">资料未通过或还在进行审核</span>';
            }
            echo $info;
        }
    }
}