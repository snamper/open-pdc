<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="PmPluign,我的世界pe,我的世界插件,pocketmine,插件购买">
    <meta name="description" content="PmPlugin Store是一个专注于Pocketmine-MP插件出售的平台，保护用户和开发者的权利，拥有独特的插件加载机制保证源码的
    安全，而用户也可以实时享受到最新的插件体验。" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/uikit/2.17.0/css/uikit.min.css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/uikit/2.17.0/css/uikit.almost-flat.min.css" />
    <link rel="stylesheet" href="/Public/css/style.css"/>
    <script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Public/js/index.js"></script>
    <meta name="toTop" content="true">
    <script src="http://cdn.bootcss.com/uikit/2.17.0/js/uikit.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/Public/css/webuploader.css">
    <script src="http://cdn.bootcss.com/uikit/2.17.0/js/components/grid.min.js" ></script>
    <script src="http://api.geetest.com/get.php?gt=<?php echo C('CAPTCHA_ID');;?>"></script>
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
                                <li class="uk-animation-shake uk-animation-hover"><a href="http://help.18tilab.com/" target="_blank"> 帮助中心</a></li>
                                <li class="uk-animation-shake uk-animation-hover"><a href="http://dwz.cn/mupocketmine" target="_blank"> 服务器出租（推荐）</a></li>
                                <li class=" uk-animation-hover" style="z-index: 200;">
                                    <a href="javascript:void(0)" id="search" onclick="return searchShow(this)">
                                        <i class="uk-icon uk-icon-search"></i>
                                    </a>
                                    <form action="<?php echo U('/Find');?>" target="_blank" class="uk-position-absolute uk-form uk-margin-small-top uk-hidden search-text" id="search-text" style="width: 200px;z-index: 500;right: 0px; padding: 10px; background-color: rgb(255, 255, 255); z-index: 500; border: 1px solid rgb(216, 216, 216); border-radius: 5px;">
                                        <input type="text" name="search" title="搜索" placeholder="搜索一下吧" class="uk-width-6-10 ">
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
                     <li ><a href="http://dwz.cn/boxpocketmine"> 服务器出租（推荐）</a></li>
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

<div class="uk-panel-box uk-panel-box-secondary uk-margin-large-top">

<article class="uk-article">

    <h1 class="uk-article-title">我购买了插件要怎么使用？？</h1>

    <p class="uk-article-lead">购买插件首先不要进行插件绑定，首先下载我们的数据获取插件（俗称客户端）请加群下载<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=3d0375023b89ec40dfc528cd69871d67e0cab9e1c38a432bd25c5e0505338bf8"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PmPlugin交流群" title="PmPlugin交流群"></a>，打开的时候可以看到你的ip，如果没看到，请输入在控制台输入autho ip 即可查看，请用所打印的ip进行绑定。</p>
    <hr class="uk-article-divider">

    <h2 id="breakpoints"><a href="#breakpoints" class="uk-link-reset">那绑定了怎么办？</a></h2>

    <p>如果你绑定了，有百分之50的几率是会可以运行的…………，但是如果你并没有使用的话，我方可以查看记录来决定是否更改ip。</p>

    <p>当然，每个插件每天都有一次修改ip的机会，你可以到时候修改。（因为客服人员一般不在。）</p>

</article>

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