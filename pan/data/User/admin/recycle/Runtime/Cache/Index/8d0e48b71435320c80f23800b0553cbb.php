<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="MCTL,我的世界pe,我的世界插件,pocketmine,插件下载,MC技术联盟,我的世界">
    <meta name="description" content="MCTL是一个开放的插件共享中心。" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/uikit/2.17.0/css/uikit.min.css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/uikit/2.17.0/css/uikit.almost-flat.min.css" />
    <link rel="stylesheet" href="/Public/css/style.css"/>
    <script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Public/js/index.js"></script>
	<script src="/Public/ckeditor/ckeditor.js"></script>
    <meta name="toTop" content="true">
    <script src="http://cdn.bootcss.com/uikit/2.17.0/js/uikit.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/Public/css/webuploader.css">
    <script src="http://cdn.bootcss.com/uikit/2.17.0/js/components/grid.min.js" ></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script language="JavaScript">
        function searchShow(e){
            var search = $(e).parent().find($('.search-text'));
            if(search.hasClass('uk-hidden')){
                search.removeClass('uk-hidden');
            }else{
                search.addClass('uk-hidden')
            }
            return false;
        }
    </script>


</head>
<body style="position:relative;" onload="">
<div class="uk-navbar uk-navbar-attached nav-bg ">
    <div class="uk-container-center uk-container uk-position-relative">
        <div style="font-size: 20px;line-height: 40px;z-index: 999;" class="uk-float-left uk-margin-right uk-position-absolute">
            <div class="uk-float-left uk-panel"><a href="<?php echo U('/Index');?>" style="text-decoration: none; outline: unset;">
            <div class="uk-float-left uk-animation-shake uk-animation-hover" style="border: 2px dashed rgba(255, 255, 255, 0.4); border-radius: 6px; box-shadow: 0px 0px 0px 4px rgb(225, 225, 225), 2px 1px 6px 4px rgba(10, 10, 0, 0.5); background-color: rgb(225, 225, 225); z-index: 999; position: relative; top: -20px; padding: 30px 30px 40px; left: -20px;">

                <!--<img src="../Public/images/logo.png" height="80px" width='80px' title="Logo" alt="Logo">-->
                <span style="color: rgb(104, 104, 104); font-size: 30px; text-shadow: 0px 2px 1px rgb(255, 255, 255);"><?php echo C('APPNAME');;?></span>
            </div></a>
                <div class="uk-float-left uk-margin-left" style="line-height: 50px;">
                    <!--<span class="uk-float-left"><?php echo ($title); ?></span>-->
                </div>
            </div>
        </div>
        <div class="uk-hidden-small uk-float-right ">
            <div >
                <div class="uk-float-right uk-vertical-align uk-position-relative">
                    <div class="uk-float-left">
                        <nav class="uk-navbar uk-float-left uk-margin-right " style="background: rgb(255, 255, 255) none repeat scroll 0 0; border-radius: 0;border: 1px solid rgba(204, 204, 204, 0.43);">
                            <ul class="uk-navbar-nav">
                                <li class="uk-animation-shake uk-animation-hover"><a href="<?php echo U('User/torecharge');;?>" target="_blank"> 充值中心</a></li>
                                <li class="uk-animation-shake uk-animation-hover"><a href="<?php echo U('/Wiki');;?>" target="_blank"> 帮助中心</a></li>
                                <li class="uk-animation-shake uk-animation-hover"><a href="http://bbs.mctpa.net" target="_blank"> MC技术联盟论坛 </a></li>
                                <li class=" uk-animation-hover" style="z-index: 200;">
                                    <a href="javascript:void(0)" id="search" onclick="return searchShow(this)">
                                        <i class="uk-icon uk-icon-search"></i>
                                    </a>
                                    <form action="<?php echo U('/Find');?>" target="_blank" class="uk-position-absolute uk-form uk-margin-small-top uk-hidden search-text" id="search-text" style="width: 200px;z-index: 500;right: 0px; padding: 10px; background-color: rgb(255, 255, 255); z-index: 500; border: 1px solid rgb(216, 216, 216); border-radius: 5px;">
                                        <input type="text" name="search" title="搜索" placeholder="咻的一下" class="uk-width-6-10 ">
                                        <button class="uk-button uk-button-primary uk-float-right">Find!</button>
                                    </form>
                                </li>
                                <?php if($UserData['UID'] == '-1'){ echo '<li class="uk-animation-shake uk-animation-hover"><a href="'.U('Register/Register').'"> 注册</a></li>
                                    <li class="uk-animation-shake uk-animation-hover"><a href="'.U('/Register').'"> 登录</a></li>'; } ?>
                            </ul>
                        </nav>

                        <?php if($UserData['UID'] == '-1'){ echo '<img class="uk-comment-avatar uk-border-rounded uk-animation-shake uk-animation-hover uk-margin-remove" src="'.C('HOST').'Public/images/placeholder_avatar.svg" width="42" height="42" alt="">'; }elseif($UserSystemData['data']['avatar']){ echo '<img class="uk-comment-avatar uk-border-rounded uk-animation-shake uk-animation-hover uk-margin-remove" src="'.C('HOST').substr($UserSystemData['data']['avatar'],2).'/avatar.jpg-avatar_50.jpg" width="42" height="42" alt="">'; }else{ echo '<img class="uk-comment-avatar uk-border-rounded uk-animation-shake uk-animation-hover uk-margin-remove" src="'.C('HOST').'Public/images/placeholder_avatar.svg" width="42" height="42" alt="">'; } ?>
                            <div class="uk-float-right uk-vertical-align-bottom uk-margin-small-left" style="line-height: 20px;">
                                <small class="uk-position-relative">
                                    <?php echo getCanSeeName($UserSystemData);?>
                                </small><br>
                                <?php if($UserData['UID'] == '-1'){ echo '<small>
                                    </small>'; }else{ echo '<small><a href="'.U('/User/index').'">用户中心 </a>
                                    <span class="uk-position-relative" style="top: -8px;">
                                    '.getUserMessageNumber($UserSystemData).'
                                    </span>
                                       :<a href="/Register/Logout">退出</a>
                                    </small>'; } ?>
                            </div>

                    </div>
                </div>
            </div>
        <!-- 手机菜单 -->
        </div>
            <a href="#navleft" style="right: -10px" class="uk-navbar-toggle uk-visible-small uk-float-right uk-position-relative" data-uk-offcanvas></a>
        <div id="navleft" class="uk-offcanvas">
            <div class="uk-offcanvas-bar">
                <ul class="uk-nav uk-nav-offcanvas uk-nav uk-nav-parent-icon" data-uk-nav>
                <li><div class="uk-nav-divider"></div></li>
                <li style="padding: 10px 10px;"><form action="<?php echo U('/Find');?>"  class=" uk-form search-text" id="search-text" >
                                        <input type="text" name="search" title="搜索" placeholder="搜索一下吧" class=" uk-width-1-1">
                                        <button class="uk-button uk-button-primary uk-float-right uk-position" style="position: absolute; right: 10px;">Find!</button>
                                    </form></li>
                    <li ><a href="<?php echo U('User/torecharge');;?>"> 充值中心</a></li>
                    <li ><a href="<?php echo U('/Wiki');;?>"> 帮助中心</a></li>
                     <li ><a href="http://bbs.mctpa.net"> 服务器出租（推荐）</a></li>
                    <li><div class="uk-nav-divider"></div></li>
                    
                    <?php if($UserData['UID'] == '-1'){ echo '<li ><a href="'.U('Register/Register').'"> 注册</a></li>
                                    <li><a href="'.U('/Register').'"> 登录</a></li>'; } ?>
                    <div class="uk-nav-header"><?php echo getCanSeeName($UserSystemData);?></div>
                    <?php if($UserData['UID'] == '-1'){ echo ''; }else{ echo '<li class="uk-position-relative">
                                            <a href="'.U('/User/index').'">用户中心
                                        '.getUserMessageNumber($UserSystemData).'</a></li>
                                       <li><a href="/Register/Logout">退出</a></li>
                                    </small>'; } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--以上部分均为导航-->
<!--页面主体开始-->
<div class="uk-container uk-container-center warp uk-margin-top uk-position-relative uk-margin-bottom" id="warp" style="min-height: 700px;">
<div class="uk-alert uk-alert-success uk-margin-large-top"><?php echo getHeaderNotice();?></div>




<!--调用布局的模板-->
<div class="uk-grid uk-margin-top uk-grid-small uk-margin-bottom">
    <!--用户中心左侧菜单-->
    <?php echo W('Menu/Developer');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider">
            <table class="uk-table uk-table-striped uk-table-hover ">
                <thead>
                <tr>
                    <th>插件名称</th>
                    <th>审核状态</th>
                    <th class="uk-text-right">购买量</th>
                    <th class="uk-text-right">操作</th>
                </tr>
                </thead>
                <tbody style="background-color: #fff;">
                <?php if(is_array($ShopData)): foreach($ShopData as $key=>$Shop): ?><tr>
                        <td style="line-height: 27px;"><?php echo ($Shop["shopname"]); if($Shop['oldplugin']!=='0'){ echo '[更新后版本]'; } ?></td>
                        <td style="line-height: 27px;"><?php echo getPluginReview($Shop['sid']);;?></td>
                        <td class="uk-text-right"><div class="uk-badge"><?php echo ($Shop["sales"]); ?></div></td>
                        <td class="uk-text-right"><div class="uk-button-group">
                            <a class="uk-button uk-button-success" href="/Developer/EditPlugin/SID/<?php echo ($Shop["sid"]); ?>">编辑</a>
                            <a class="uk-button uk-button-danger" href="#">删除</a>
                        </div>
                        <!--TODO：这里的删除不是指删除这个商品，而是将这个插件归为系统的插件，并且不再出售-->
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
                <!--头部部分-->
            </table>
            <?php echo ($page); ?>
        </div>
    </div>
    <!--中心模块结束-->
</div>
</div>

<!--主体部分结束-->

<!--底部开始-->

<footer  class="pmfooter">

    <div class="uk-container uk-container-center uk-text-center">



        <ul class="uk-subnav uk-subnav-line uk-flex-center">
            <li><a href="http://www.mctpa.net/" rel="nofollow" target="_blank">量子网络的插件站</a></li>
            <li><a href="http://pl.zxda.net" rel="nofollow" target="_blank">ZXDA 插件站</a></li>
          

        </ul>



        <div class="uk-panel">

            <p>
                <br class="uk-hidden-small"></p>

            <a href="/"><?php echo C('APPNAME');?></a>
			<script language="javascript" type="text/javascript" src="http://js.users.51.la/18713117.js"></script>

        </div>



    </div>

</footer >

<!--底部结束-->

<div id="floatTools" class="rides-cs" style="height:210px;">
  <div class="floatL">
    <a id="aFloatTools_Show" class="btnOpen" title="查看在线客服" style="top:20px;display:block" href="javascript:void(0);">展开</a>
    <a id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" style="top:20px;display:none" href="javascript:void(0);">收缩</a>
  </div>
  <div id="divFloatToolsView" class="floatR" style="display: none;height:188px;width: 140px;">
    <div class="cn">
      <h3 class="titZx" style="margin: 0;">MCTL在线客服</h3>
      <ul style="margin: 0;">
        <li><span>量子网络</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1587937102&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1587937102:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></li>
      </ul>
	  <ul style="margin: 0;">
        <li><span>山山</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1430510136&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1430510136:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li>
      </ul>
	  <ul style="margin: 0;">
        <li><span>XiaoBin</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1823592552&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1823592552:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li>
      </ul>
    </div>
  </div>
</div>
<script>
    $(function(){
        $("#aFloatTools_Show").click(function(){
            $('#divFloatToolsView').animate({width:'show',opacity:'show'},100,function(){$('#divFloatToolsView').show();});
            $('#aFloatTools_Show').hide();
            $('#aFloatTools_Hide').show();              
        });
        $("#aFloatTools_Hide").click(function(){
            $('#divFloatToolsView').animate({width:'hide', opacity:'hide'},100,function(){$('#divFloatToolsView').hide();});
            $('#aFloatTools_Show').show();
            $('#aFloatTools_Hide').hide();  
        });
    });
</script>
</body>

</html>