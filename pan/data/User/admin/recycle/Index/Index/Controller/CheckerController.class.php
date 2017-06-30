<?php
namespace Index\Controller;
use Org\Tool\PluginAuthorization;
use Org\Tool\Message;
class CheckerController extends CheckerverityController//todo:这应该用一个判断是否为审核元的check
{
    public function index(){
        $this->title = '需要审核服务器列表';
        $this->data = M('Shop')->where("PluginState !='1'")->order('UpdateTime asc')->select();
        $this->display();
    }

    public function view(){
        header("Content-Type:text/html; charset=utf-8");
        $id = I('get.sid',0,'number_int');
        if($id == 0){
            $this->redirect('/Index');
        }
        $this->title = C('TITLE',null,"商品详细");
        $Shop = M('Shop')->where("sid = '{$id}'")->find();
        if(!$Shop){
            echo '找不到此商品，或已经通过审核';exit;
        }
        if($Shop['pluginstate'] == '1'){
            $this->redirect('/Index');
        }
        $ShopUser = M('User')->where("uid = {$Shop['uid']}")->find();
        $ShopUser['data'] = CJson($ShopUser['data'],true);
        $this->assign('ShopUser',$ShopUser);
        $Shop['tags'] = GetTags($Shop);
        $Shop['catalog'] = GetCatalog($Shop);
        $Shop['content'] = stripslashes($Shop['content']);
        $this->assign('Shop',$Shop);
        //结束
        $this->display();
    }

    public function changedata()
    {
        header("Content-Type:text/html; charset=utf-8");
        $content = $_POST['Content'];//获取富文本编辑器内容
        if (I('post.Price') > 20) {
            $this->error('价格请低于20元！');
            exit;
        }
        $SID = I('post.stime');
        $CheckOld = M('Shop')->where("OldPlugin = '{$SID}'")->find();
        if($CheckOld){
            $CheckOld = M('Shop')->where("SID = '{$CheckOld['sid']}'")->find();
            $SID = $CheckOld['sid'];
        }else{
            $CheckOld = M('Shop')->where("SID = '{$SID}'")->find();
        }
        if($CheckOld['pluginstate']=='1'){
            $this->error('禁止更改已发布服务器！');
            exit;
        }
        $Shop = D('Shop');
        $Data['Content'] = I('post.Content');
        $Data['Version'] = I('post.PMVersion');
        $Data['Price'] = I('post.Price');
        $Data['TAGS'] = I('post.TAGS');
        $Data['Catalog'] = I('post.Catalog');
        $Data['ShopName'] = I('post.ShopName');
        $CheckCreate = $Shop->create($Data,2);
        $info = getOtherPic($content);//使用函数 返回匹配地址 如果不为空则声称缩略图
        if ($info[0] !== '' and $info !== false) {
            $Shop->ThumbUrl = $info[0];
        }
        if(!$CheckCreate){
            dump($Shop->getError());
            exit;
        }
        $Shop->where("sid = {$SID}")->save();
        $User = M('User')->where("UID = '{$CheckOld['uid']}'")->find();
        PluginAuthorization::ShopStateSet($SID,'post',1);
        $superAdmin = getSuperAdminId();
        $message = new Message($superAdmin);
        $message->SendMessage($User['uid'],"你的服务器[{$Data['ShopName']}]资料已修改并通过审核","你的服务器[{$Data['ShopName']}]资料已经通过审核，管理员已经帮你修改。如有不符请重新修改。",'',2);
        echo '更改成功，平台已经通知版主。请去工单系统回复。';
        echo '<a href="'.U('/Checker/view',array('sid'=>$SID)).'">点击返回,继续审核</a>';
        exit;
        //提交结束
    }

    public function editpost($sid=''){
        header("Content-Type:text/html; charset=utf-8");
        if($sid == 0){
            $this->redirect('/Index');
        }
        $sid= (int)$sid;
        $Shop['SID'] = $sid;
        $CheckShop = M('Shop')->where($Shop)->find();
        $CheckShop['content'] = stripslashes($CheckShop['content']);
        $this->CheckShop=$CheckShop;
        $this->title = C('TITLE',null,"版主中心-编辑服务器");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '编辑服务器';
        //查找分类
        $Catalog = $CheckShop['catalog'];
        $Catalog = substr($Catalog,1,-1);
        $Catalogs = explode(',',$Catalog);
        unset($Catalog);
        $Catalog['name'] = 'Catalog';
        $Catalog = M('Option')->find($Catalog);
        $Catalog = json_decode($Catalog['value'],true);
        $CatalogData ='';
        foreach($Catalog as $key=>$value){
            $True = false;
            foreach($Catalogs as $have){
                if($value == $have){
                    $CatalogData .= "<input name='Catalog[]' type='checkbox' value='{$value}' checked='checked'/>$value<br>";
                    $True = true;
                    break;
                }
            }
            if($True == false)  $CatalogData .= "<input name='Catalog[]' type='checkbox' value='{$value}' />$value<br>";
        }
        //分类结束
        $this->TAGS = substr($CheckShop['tags'],1,-1);
        $version = new \Org\Tool\Shop();
        $version = $version->getVersion();
        $versionData = '<select class="uk-width-1-1" name="PMVersion">';
        foreach($version as $one){
            if($CheckShop['version'] == $one){
                $versionData .="<option value='{$one}' selected='selected'>$one</option>";
                break;
            }
            $versionData .="<option value='{$one}'>$one</option>";
        }
        $versionData .="</select>";
        $this->versionData = $versionData;
        $this->CatalogData = $CatalogData;
        $this->display();
    }

    public function postpass($pass='',$sid=''){
        if($pass=='' or $sid==''){//判断数据
            $this->redirect('/Index');
        }
        $pass = $pass=='yes'?1:0;
        $shop = M('Shop')->where("sid = '{$sid}'")->find();
        if($shop['pluginstate'] !=='1'){
            $check = PluginAuthorization::ShopStateSet((int)$sid,'post',$pass);
            if($check){
                echo '资料审核状态修改成功';
                echo '<br><a href="'.U('/Checker/view',array('sid'=>$sid)).'">点击返回,继续审核此服务器</a>';
                exit;
            }
        }

    }

    public function pluginpass($pass,$sid){
        if($pass=='' or $sid==''){//判断数据
            $this->redirect('/Index');
        }
        $pass = $pass=='yes'?1:0;
        $shop = M('Shop')->where("sid = '{$sid}'")->find();
        if($shop['pluginstate'] !=='1'){
            $check = PluginAuthorization::ShopStateSet((int)$sid,'plugin',$pass);
            if($check){
                echo '插件审核状态修改成功';
                echo '<br><a href="'.U('/Checker/view',array('sid'=>$sid)).'">点击返回,继续审核此插件</a>';
                exit;
            }
        }
    }

}