<?php
namespace Index\Controller;
use Think\Controller;
use Org\Tool\PluginAuthorization;
class DeveloperController extends DeveloperifloginController {
    public function index(){
        $this->title = C('TITLE',null,"发布中心");
        $this->ActionTitle = '欢迎';
        $this->centect = '欢迎你回来'.session('UserName');
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->display();
    }
    /**
     * 提交插件的接口,ajax用
     */
    public function SubmitPlugin(){
        //初始数据初始化START
        $Login = $this->UserSystemData;
        $EditPlugin = false;
        if(strlen(I('post.pid'))>0) { //判断是否更新
			$EditPlugin = true;
			$pid = I('post.pid');
		}
        if(I('post.QQ') =='' or I('post.QQ')=='0'){
			$this->ajaxReturn(array('error'=>'请填写联系方式'));
			return true;
		}
        
		/*if(M('Plugin')->where(array('FileFid' => I('post.fid')))->find() && $EditPlugin !== true){
			$this->ajaxReturn(array('status'=>1,'message'=>'插件已经存在！如需更新请选择编辑插件。'));
			return true;
		}*/
		
		$tags = str_replace('，', ',', I('post.tags'));
		
        //数据判断:END
        //数据构造START
        $Plug = D('Plugin');//构建自动验证的Model
        $Data = array();
        $Data['Title'] =  I('post.title');//名称
        $Data['Content'] = I('post.editor');//介绍内容
        $Data['Version'] = I('post.version');//插件版本
        $Data['FindQQ'] =  I('post.QQ');//联系QQ
        $Data['TAGS'] =  I('post.tags');//标签
        $Data['UID'] = intval($Login['uid']);//用户UID
		$Data['PluginState'] = 1;
		$Data['FID'] = I('post.fid'); //文件id
		if(I('post.mode') == 'opensource'){
			$Data['Mode'] = 1;
		} elseif(I('post.mode') == 'closesource') {
			$Data['Mode'] = 2;
		}
		
        if($EditPlugin){
            $CreateData = $Plug->create($Data,2);
        } else {
            $CreateData = $Plug->create($Data,1);
        }
		
        if(preg_match('/src=&quot;.*(\.png|\.jpg|\.gif|\.jpeg|\.bmp)&quot;/',$Data['Content'],$info)){
            $Plug->ThumbUrl = str_replace(array('src=','&quot;'),'',$info[0]);
        }

        if(!$CreateData){ //判断数据是否正确
			$this->ajaxReturn($Plug->getError());
			return true;
		}
		
        if($EditPlugin){
            $SPlugin['PID'] = $pid;
            $SPlugin['UID'] = $Login['uid'];
            $ifOwner = M('Plugin')->where($SPlugin)->select();//看一下这个pid的商品是不是这个UID用户拥有的
            if($ifOwner==false){
                $this->ajaxReturn(['status' => '1', 'message' => '权限不足']);
				unset($Data);
				return true;
            }
			unset($SPlugin);
        }
		try{
			if($EditPlugin){//编辑插件
				$Plugin = M('Plugin')->where("PID = '{$pid}'")->find(); //找到原先的插件
				$Plug->where("PID = '{$pid}'")->save();
			}else{//不是编辑进行新建操作
				$pid = $Plug->add();
			}
			if(preg_match('/,/', $tags)){
				foreach(explode(',', $tags) as $tag){
					if(M('tags')->where(['content' => $tag])->select()){
						M('tags')->where(['content' => $tag])->setInc('count', 1);
					} else {
						$tm = M('tags');
					$tm->data(['content' => $tag])->add();
					}
				}
			} else {
				if(M('tags')->where(['content' => $tags])->select()){
					M('tags')->where(['content' => $tags])->setInc('count', 1);
				} else {
					$tm = M('tags');
					$tm->data(['content' => $tags])->add();
				}
			}
		} catch(Exception $e) {
			$this->ajaxReturn(['status' => '1', 'message' => $e->getMessage()]);
		}
        $this->ajaxReturn(['status' => '0', 'pid' => $pid]);
    }
	
	
    public function AddServer(){
        //初始数据初始化START
        $Login = $this->UserSystemData;
            //判断重复数据END
        //数据判断:START{更新插件和新建插件的判断}
            //更新判定开始：START
			$SID = I('post.sid');
            $Edit = false;
            if(I('post.checkedit') == 'true' and $SID !== false) {$Edit = true;};//判断是否为更新：是EditPlugin为true
            //更新判定结束：END
        //初始数据初始化结束END
        if(I('post.QQ') =='' or I('post.QQ')=='0'){$this->ajaxReturn(array('error'=>'请填写联系方式'));exit;}
        if(M('Server')->where($Some)->find() and $Edit !== true){$this->ajaxReturn(array('error'=>'服务器已经存在！'));exit;}
        //数据判断:END
        //数据构造START
        $Shop = D('Server');//构建自动验证的Model

            $Data = array();
            $Data['ShopName'] =  I('post.ShopName');//名称
            $Data['Content'] = I('post.editor');//介绍内容
            $Data['Version'] = I('post.PMVersion');//服务器版本
            $Data['Price'] = intval(I('post.Price'));//价格
            $Data['FindQQ'] =  I('post.QQ');//联系QQ
            $Data['TAGS'] =  I('post.TAGS');//标签
            $Data['UID'] = intval($Login['uid']);//用户UID
            $Data['Version'] = I('post.PMVersion');//服务器版本
			$Data['ApiUserName'] = I('post.UserName');//API用户名
			$Data['ApiKey'] = I('post.ApiKey');//API密钥
			$Data['ApiUrl'] = I('post.ApiUrl');//API网址
			$Data['PlayerSolt'] = I('post.PlayerSolt');//玩家数量
			$Data['MemaryLimit'] = I('post.MemaryLimit');//内存限制
			$Data['DateLimit'] = I('post.DateLimit');//日期限制
			$Data['Num'] = I('post.Num');//剩余数量
			$Data['PluginState'] = 1;
        if($Edit){
            $CreateData = $Shop->create($Data,2);
        }else{
            $CreateData = $Shop->create($Data,1);
        }
		
		if(I('post.CPlayerSolt')==true){
			$Data['CPlayerSolt'] = 1;//玩家数量不限制
		} else {
			$Data['CPlayerSolt'] = 0;//玩家数量限制
		}

        $info=getOtherPic(I('post.editor'));//使用函数 返回匹配地址 如果不为空则声称缩略图
        if(preg_match('/src=&quot;.*(\.png|\.jpg|\.gif|\.jpeg|\.bmp)&quot;/',$Data['Content'],$info)){
            $Shop->ThumbUrl = str_replace(array('src=','&quot;'),'',$info[0]);
        }

        //数据构造END,进行数据判定，如果不通过返回

        if(!$CreateData){$this->ajaxReturn($Shop->getError());exit;}//判断
        if($Edit){
            $SPlugin['SID'] = $SID;
            $SPlugin['UID'] = $Login['uid'];
            $ifOwner = M('Server')->where($SPlugin)->select();//看一下这个SID的商品是不是这个UID用户拥有的
            if($ifOwner==false){
                $this->ajaxReturn(array('数据非法'=>'数据错误','uid'=>$SPlugin['UID'],'uid2'=>$Login['uid'],'sid'=>$SPlugin['SID']));unset($Data);exit;
            }unset($SPlugin);
        }
		try{
        //双逻辑判断START：当是更新操作时:否则；
        if($Edit){//是编辑的操作
            $Plugin = M('Server')->where("SID = '{$SID}'")->find();
            if($Plugin['pluginstate']!=='1'){
                $Shop->where("SID = '{$SID}'")->save();
                PluginAuthorization::ShopStateSet($SID,'post',0);
                PluginAuthorization::PluginAuthorization($SID,$this->UserSystemData);//提交更新的工单设置
                $OverSID = $SID;
            }else{//通过审核状态下:通过审核怎么会有oldplugin……应该是搜索oldplugin为当前sid的插件
                $NewPlugin = M('Server')->where("OldServer = '{$SID}'")->find();
                //判断一下是否有那个插件，有就保存到那里，没有就新建一个，并添加上OldPlugin
                if($NewPlugin==false){//没有的情况,那就新建呗
                    $Shop->OldServer = $SID;
                    $OverSID = $Shop->add();
                    //PluginAuthorization::ShopStateSet($OverSID,'post',0);
                    //PluginAuthorization::PluginAuthorization($OverSID,$this->UserSystemData);//提交更新的工单设置
                }else{//有插件的情况，保存一下
                    $Shop->where("SID = '{$NewPlugin['sid']}'")->save();
                    //PluginAuthorization::ShopStateSet($NewPlugin['sid'],'post',0);
                    //PluginAuthorization::PluginAuthorization($NewPlugin['sid'],$this->UserSystemData);//提交更新的工单设置
                    $OverSID = $NewPlugin['sid'];
                }
            }
        }else{//不是编辑进行新建操作
            $OverSID = $Shop->add();
            //PluginAuthorization::PluginAuthorization($OverSID,$this->UserSystemData);//提交新建的工单设置
        }
		} catch(Exception $e) {
			print $e->getMessage();
		}
        echo 'true';
    }

    public  function NewServer(){
        header("Content-Type:text/html; charset=utf-8");
        $this->title = C('TITLE',null,"版主中心-添加服务器");
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '发布服务器';
        $Check = md5(md5(time()).$UserSystemData['UID']);//隐藏域用的一个检测多开编辑页面的东西
        $Catalog['name'] = 'Catalog';
        $Catalog = M('Option')->find($Catalog);
        $Catalogs = json_decode($Catalog['value'],true);
        $CatalogData ='';
        trace(I('session.'));
        foreach($Catalogs as $key=>$value){
            $CatalogData .= "<input name='Catalog[]' type='checkbox' value='{$value}' />$value<br>";
        }
		$url = U('/Developer/AddServer');
        $this->centect = <<<HTML
        <div class="uk-alert uk-alert-danger">发布服务器请确保阅读帮助中的版主事项</div>
<form action="{$url}" method="post" class="uk-form uk-width-large-1-1 uk-grid" id="ServerData">
	<div class="uk-width-large-2-3">
	<div class="uk-panel ">
	<h2>服务器名称：</h2>
	    <div class="uk-form-row">
        <input name="ShopName" type="text" placeholder="名称" class="uk-width-large-1-1 uk-form-large">
        </div>
        <br>
        <textarea id="editor" class="ckeditor" name="editor"></textarea>
    </div>
    <!--左侧第一面板结束-->
    </div>
    <!--左侧结束-->
    <div class="uk-width-large-1-3">
    <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">定价：</div>
    <div class="uk-form-row uk-form-icon">
    <i class="uk-icon-money"></i><input name="Price" type="text" placeholder="价格" class="uk-width-large-9-10">
</div>
</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">服务器信息：<br><small>请确认API允许从外网访问</small></div>
    <div class="uk-form-row">
	<small>面板网址，如 http://www.example.com/ ，不用index.php</small>
    <input name="ApiUrl" type="text" placeholder="网址" class="uk-width-large-1-1">
	<small>用户名</small>
    <input name="UserName" type="text" placeholder="用户名" class="uk-width-large-1-1">
	<small>API密钥</small>
	<input name="ApiKey" type="text" placeholder="API密钥" class="uk-width-large-1-1">
	<small>玩家数量</small>
	<input name="PlayerSolt" type="text" placeholder="玩家数量" class="uk-width-large-1-1">
	<input name="CPlayerSolt" type="checkbox" placeholder="玩家数量不限制" value="false"><small>用户可以更改玩家数量</small><br />
	<small>内存大小</small>
	<input name="MemaryLimit" type="text" placeholder="内存大小" class="uk-width-large-1-1">
	<small>开服时间（天）</small>
	<input name="DateLimit" type="text" placeholder="开服时间" class="uk-width-large-1-1">
	<small>服务器数量</small>
	<input name="Num" type="text" placeholder="服务器数量" class="uk-width-large-1-1">
	</div>
</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">服务器版本：</div>
    <div class="uk-form-row">
        <input name="PMVersion" type="text" placeholder="服务器版本" class="uk-width-large-1-1">
</div>
</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">标签：<br><small>(多个标签请用英文逗号 , 间隔)</small></div>
    <div class="uk-form-row">
    <input name="TAGS" type="text" placeholder="标签" class="uk-width-large-1-1">
</div>

</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">联系QQ：</div>
    <div class="uk-form-row uk-form-icon">
    <i class="uk-icon-money"></i><input name="QQ" type="text" placeholder="QQ" class="uk-width-large-9-10">
</div>
</div>
<div class="uk-margin-top">
    <button id="SendServer" class="uk-button uk-button-large uk-button-primary uk-width-1-1" type="button">发布！</button>
        </div>
<!--右侧面板结束-->
</div>
<!--右侧结束-->
</form>
HTML;
        session($Check,'NULL');
        $this->display('index');
    }
	
	public  function NewPlugin(){
        header("Content-Type:text/html; charset=utf-8");
        $this->title = C('TITLE',null,"发布中心-添加插件");
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '发布插件';
        $Check = md5(md5(time()).$UserSystemData['UID']);//隐藏域用的一个检测多开编辑页面的东西
		$this->assign($url, U('/Developer/SubmitPlugin'));
        trace(I('session.'));
        session($Check,'NULL');
        $this->display();
    }
	
	public  function EditPlugin(){
        header("Content-Type:text/html; charset=utf-8");
        $this->title = C('TITLE',null,"发布中心-编辑插件");
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
		$pid = I('get.pid');
        $Plug['UID'] = $this->UserSystemData['uid'];
        $Plug['PID'] = $pid;
        $CheckPlug = M('Plugin')->where($Plug)->select();
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '编辑插件';
        $Check = md5(md5(time()).$UserSystemData['UID']);//隐藏域用的一个检测多开编辑页面的东西
		$this->assign('url', U('/Developer/SubmitPlugin'));
		$this->plug = $CheckPlug[0];
        trace(I('session.'));
        session($Check,'NULL');
        $this->display();
    }
	
	public function DelPlugin(){
		$pid = I('post.id');
		$plug = M('Plugin');
		$plugdata = $plug->where(array('PID' => $pid))->select();
		if($plugdata[0]['uid'] != $this->UserSystemData['uid']){
			$this->ajaxReturn(['status'=>'1', 'message'=>'权限不足']);
		} else {
			$ret = $plug->where(array('PID' => $pid))->delete();
			if(!$ret){
				$this->ajaxReturn(['status'=>'1', 'message'=>$ret->getError()]);
			} else {
				$this->ajaxReturn(['status'=>0]);
			}
		}
		
	}
	
    public  function EditServer(){
        if(!$_GET){
            $Url = U('Developer/NewServer');
            header("Location:{$Url}");
            exit;
        }else{
            $Sid = I('get.SID');
            $Shop['UID'] = $this->UserSystemData['uid'];
            $Shop['SID'] = $Sid;
            $CheckShop = M('Server')->where($Shop)->select();
            if(!$CheckShop){
                $Url = U('Developer/NewServer');
                $this->error('没有权利',$Url);
                exit;
            }
            $CheckShop = $CheckShop['0'];
        }
        header("Content-Type:text/html; charset=utf-8");
        $this->title = C('TITLE',null,"版主中心-编辑服务器");
        $UserData = IfLogin();
        $this->assign('UserData',$UserData);
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '编辑服务器';
        $this->assign('UserSystemData',$this->UserSystemData);
        $Check = md5(md5(time()).$UserData['UID']);//隐藏域用的一个检测多开编辑页面的东西
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
        $TAGS = substr($CheckShop['tags'],1,-1);
        $CheckShop['content'] = stripslashes($CheckShop['content']);
		$url = U('/Developer/AddServer');
        $this->centect = <<<HTML
        <div class="uk-alert uk-alert-danger">发布服务器请确保阅读帮助中的服主事项</div>
<form action="{$url}" method="post" class="uk-form uk-width-large-1-1 uk-grid" id="PluginData">
<input name="checkedit" value="true" type="hidden"></input>
<input name="sid" value="{$Sid}" type="hidden"></input>
	<div class="uk-width-large-2-3">
	<div class="uk-panel ">
	<h2>服务器名称：</h2>
	<div class="uk-form-row">
        <input name="ShopName" type="text" value="{$CheckShop['shopname']}" placeholder="名称" class="uk-width-large-1-1 uk-form-large">
        </div>
        <br>
        <div><textarea id="editor" class="ckeditor" name="editor">{$CheckShop['content']}</textarea></div>
    </div>
    <!--左侧第一面板结束-->
    </div>
    <!--左侧结束-->
    <div class="uk-width-large-1-3">
    <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">定价：</div>
    <div class="uk-form-row uk-form-icon">
    <i class="uk-icon-money"></i><input name="Price" type="text" value="{$CheckShop['price']}" placeholder="价格" class="uk-width-large-9-10">
</div>
</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">服务器信息：<br><small>请确认API允许从外网访问</small></div>
    <div class="uk-form-row">
	<small>面板网址，如 http://www.example.com/ ，不用index.php</small>
    <input name="ApiUrl" type="text" placeholder="网址" value="{$CheckShop['apiurl']}" class="uk-width-large-1-1">
	<small>用户名</small>
    <input name="UserName" type="text" placeholder="用户名" value="{$CheckShop['apiusername']}" class="uk-width-large-1-1">
	<small>API密钥</small>
	<input name="ApiKey" type="text" placeholder="API密钥" value="{$CheckShop['apikey']}" class="uk-width-large-1-1">
	<small>玩家数量</small>
	<input name="PlayerSolt" type="text" placeholder="玩家数量" value="{$CheckShop['playersolt']}" class="uk-width-large-1-1">
	<input name="CPlayerSolt" type="checkbox" placeholder="玩家数量不限制" value="false"><small>用户可以更改玩家数量</small><br />
	<small>内存大小</small>
	<input name="MemaryLimit" type="text" placeholder="内存大小" value="{$CheckShop['memarylimit']}" class="uk-width-large-1-1">
	<small>开服时间（天）</small>
	<input name="DateLimit" type="text" placeholder="开服时间" value="{$CheckShop['datelimit']}" class="uk-width-large-1-1">
	<small>服务器数量</small>
	<input name="Num" type="text" placeholder="服务器数量" value="{$CheckShop['num']}" class="uk-width-large-1-1">
	</div>
</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">服务器版本：</div>
    <div class="uk-form-row">
        <input name="PMVersion" type="text" placeholder="服务器版本" value="{$CheckShop['version']}" class="uk-width-large-1-1">
</div>
</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">标签：<br><small>(多个标签请用英文逗号 , 间隔)</small></div>
    <div class="uk-form-row">
    <input name="TAGS" type="text" placeholder="标签" value="{$CheckShop['tags']}" class="uk-width-large-1-1">
</div>

</div>
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-title">联系QQ：</div>
    <div class="uk-form-row uk-form-icon">
    <i class="uk-icon-money"></i><input name="QQ" type="text" placeholder="QQ" value="{$CheckShop['findqq']}" class="uk-width-large-9-10">
</div>
</div>
<div class="uk-margin-top">
    <button id="SendServer" class="btn btn-zan-solid-pi" type="button">发布！</button>
        </div>
<!--右侧面板结束-->
</div>
<!--右侧结束-->
</form>
HTML;
        $this->display('index');
    }
	
	
    public function MyServer(){
        $this->title = C('TITLE',null,"版主中心-我的服务器");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '已发布服务器';
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $num = 10;
        $Data = M('Server')->where("UID={$UserSystemData['uid']}")->order('sid desc')->page(I('get.p',1),$num)->select();
        $this->assign('ShopData',$Data);// 赋值数据集
        $count      =  $count = M('Server')->where("UID={$UserSystemData['uid']}")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display('myserver');
    }
	
	public function MyPlugin(){
        $this->title = C('TITLE',null,"发布中心-我的插件");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '已发布插件';
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $num = 10;
        $Data = M('Plugin')->where("UID={$UserSystemData['uid']}")->order('PID desc')->page(I('get.p',1),$num)->select();
        $this->assign('ShopData',$Data);// 赋值数据集
        $count      =  $count = M('Plugin')->where("UID={$UserSystemData['uid']}")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display('myplugin');
    }
	
    public function Sellrecord(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = C('TITLE',null,"版主中心-收入统计");
        $this->ActionName = __ACTION__;
        $this->ActionTitle = '收入统计';
        $num = 10;
        $page = I('get.p');
        $Data = M('Costrecord')->where("UserUID = {$UserSystemData['uid']} AND Type = 1")->page($page,$num)->select();
        $this->allgivemoney = M('Costrecord')->where("UserUID = {$UserSystemData['uid']} AND Type = 1")->sum('Number');
        $this->assign('list',$Data);// 赋值数据集
        $count      = M('Costrecord')->where("UserUID = {$UserSystemData['uid']} AND Type = 1")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    /**
     *提现申请
     *//*
    public function atm(){
        $UserSystemData = $this->UserSystemData;
        $this->title = '提现申请';
        $num = I('post.num');
        $togive = I('post.togive');
        $DeveloperName = I('post.type');
        if(!empty($_POST) and $togive == ''){
            $this->error('请填写收款账户（微信/QQ）');
            exit;
        }
        if(!empty($_POST) and $DeveloperName == ''){
            $this->error('请填写收款账户类型');
            exit;
        }
        if(((int)$num >= 1)){
            $havemoney = M('User')->where("uid = {$UserSystemData['uid']}")->getField('Money');
            if($num <= $havemoney){
                $if = AddCostRecord((int)$num,$UserSystemData['uid'],2,$UserSystemData['uid'],0,"用户[{$UserSystemData['username']}]提交的[{$num}]元提现申请。{$DeveloperName}账户:{$togive}");
                if($if){
                    $this->success('申请成功，我们会尽快处理，如果你被投诉，我们会延期执行并与您协商。','/Developer',4);
                    exit;
                }else{
                    $this->error('申请失败,请联系管理员','/Developer',2);
                    exit;
                }
            }else{
                $this->error('余额不足','/Developer',2);
                exit;
            }
        }
        $this->assign('UserSystemData',$UserSystemData);
        $this->display();
    }
    public function atmrecord(){
        $UserSystemData = $this->UserSystemData;
        $this->assign('UserSystemData',$UserSystemData);
        $this->title = '提现记录';
        $page = I('get.p');
        $num = 20;
        $countrecord = new \Org\Tool\Costrecord($UserSystemData['uid']);
        $list=$countrecord->getUserATMWithPage($UserSystemData['uid'],$page,$num);
        $this->assign('list',$list);// 赋值数据集
        $count      = $countrecord->getCountATMUser($UserSystemData['uid']);// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }*/
}