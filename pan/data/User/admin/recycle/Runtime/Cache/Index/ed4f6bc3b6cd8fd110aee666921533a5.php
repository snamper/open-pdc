<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="pocketmine插件,我的世界插件,pdc">
    <meta name="description" content="Pocket Developer Center开源插件站" />

    <link rel="stylesheet" href="/Public/css/uikit.min.css" />
    <link rel="stylesheet" href="/Public/css/uikit.almost-flat.min.css" />
    <!--<link rel="stylesheet" href="/Public/css/style.css"/>-->
    <script src="/Public/js/jquery.min.js"></script>
    <script src="<?php echo U('/Tools/js');?>" language="JavaScript" type="text/javascript"></script>
	<script src="/Public/js/bootstrap.min.js"></script>
    <meta name="toTop" content="true">
    <script src="/Public/js/uikit.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/Public/css/webuploader.css">
	<link rel='stylesheet' id='bootstrap-css'  href='/Public/css/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='fontawesome-css'  href='/Public/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='flexslider-css'  href='/Public/css/flexslider.css' type='text/css' media='all' />
	<link rel='stylesheet' id='zan-css'  href='/Public/css/zan.css' type='text/css' media='all' />
	<link rel='stylesheet' id='zan-css'  href='/Public/css/message.css' type='text/css' media='all' />
    <script src="/Public/js/components/grid.min.js" ></script>
	<script src="/Public/ckeditor/ckeditor.js" ></script>
	<script src="/Public/js/message.js" ></script>
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
	<!--[if lt IE 9]>
  <script src="/Public/css/a/modernizr.js"></script>
  <script src="/Public/css/a/respond.min.js"></script>
  <script src="/Public/css/a/html5shiv.js"></script>
	<![endif]-->


</head>
<body class="archive tag tag-34 tag-34">
<header id="zan-header">
    <!-- logo -->
    <div class="header">
      <a href="/" class="logo" data-toggle="animation"></a>
    </div>
    <!-- logo结束 -->
    <!-- 导航 -->
    <div class="navbar navbar-inverse" >
      <div class="container clearfix">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">下拉框</span>
            <span class="fa fa-reorder fa-lg"></span>
          </button>
        </div>
        <nav class="navbar-collapse collapse">
			<ul id="menu-navbar" class="nav navbar-nav">
				<li id="nvabar-item-index"><a href="<?php echo U('/Index/Index');?>">首页</a></li>
				<li id="nvabar-item-index"><a href="<?php echo U('/Wiki/');?>">帮助</a></li>
				<?php if($UserData['UID'] == '-1'){ echo '<li id="navbar-item-regpage"><a href="'.U('Login/Register').'">注册</a></li>
                    <li id="navbar-item-login"><a href="'.U('/Login').'">登录</a></li>'; } else { echo '<li id="navbar-item-ucenter"><a href="'.U('/User/index').'">用户中心</a></li>
					<li id="navbar-item-logout"><a href="'.U('/Login/Logout').'">注销</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('Action'); if($action>9){ echo '<li id="navbar-item-ucenter"><a href="'.U('/Admin/index').'">管理中心</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('UserState'); if($action==2){ echo '<li id="navbar-item-ucenter"><a href="'.U('/Checker/').'">审核中心</a></li>'; } ?>
				<li id="nvabar-item-index"><a href="http://mcleague.xicp.net">论坛</a></li>
			</ul>
		</nav>
      </div>
    </div>
    <!-- 导航结束 -->

</header>
<div id="main_page" class="container">
<section id="zan-bodyer">


<!--<div><p class="pull-left"><?php echo getHeaderNotice();?></p></div>-->
<!--调用布局的模板-->
<div class="row">
	<div class="col-md-8" id="mainstay">
		<article class="zan-post clearfix">
			<h2><?php echo ($Plug["title"]); ?></h2>
			<hr />
			<?php
 if(preg_match('/,/', $Plug['tags'])){ foreach(explode(',', $Plug['tags']) as $tag){ echo '<span class="label label-info">'.$tag.'</span>&nbsp;&nbsp;'; } } else { echo '<span class="label label-info">'.$Plug['tags'].'</span>'; } ?>
			<hr />
			<textarea id="contentdata" style="display: none;" rows="0" cols="0"><?php echo ($Plug["content"]); ?></textarea>
            <script>
            $(document).ready(function(){
                $('#content').html($('#contentdata').text());
            });
            </script>
            <div id="content"></div>
			<hr />
			<?php echo W('Comment/Sendcomment',array($Plug['pid']));?>
			<div class="uk-panel uk-panel-box uk-panel-box-secondary uk-margin uk-panel-header">
            <div class="uk-panel uk-panel-title" style="margin: 0;">用户评论：</div>
			<?php echo W('Comment/Getcomment',array($Plug['pid']));?>
			</div>
		</article>
	</div>
	<aside class="col-md-4" id="sidebar">
		<aside>
			<div class="panel panel-zan">
				<div class="panel-heading">开发者</div>
				<div style="margin-left: 20px;margin-top: 10px;margin-right: 20px;padding-bottom: 20px;">
					<div class="center-block">
						<?php
 if($Dev['data']['avatar']){ echo '<img class="uk-border-circle uk-float-left uk-margin-right" src="'.C('HOST').substr($Dev['data']['avatar'],1).'/avatar.jpg-avatar_80.jpg" width="80" height="80" alt="">'; }else{ echo '<img class="uk-border-circle uk-float-left uk-margin-right" src="'.C('HOST').'Public/images/placeholder_avatar.svg" width="80" height="80" alt="">'; } ?>
						<h3><?php echo ($Dev["data"]["nickname"]); ?></h3>
						<small class="uk-badge uk-badge-success"><?php echo GetDeveloperLevel($Dev);?></small>
						<hr />
						<p class="uk-margin"><?php echo ($Dev["data"]["pdata"]); ?></p>
					</div>
				</div>
			</div>
		</aside>
		<aside>
			<div class="panel panel-zan">
				<div class="panel-heading">操作</div>
				<div style="margin-left: 20px;margin-top: 10px;margin-right: 20px;padding-bottom: 20px;">
					<button class="btn btn-primary btn-block" onclick="location.href='<?php echo U('/download/index/', array('id' => $Plug['pid']));?>'">下载插件</button>
					<?php
 if($Plug['mode'] == 1){ ?><button class="btn btn-primary btn-block" onclick="location.href='<?php echo U('/Download/getZipLoader/');?>'">下载Zip插件读取器</button><?php
 } elseif($Plug['mode'] == 2){ ?><button class="btn btn-primary btn-block" onclick="location.href='<?php echo U('/Download/getZipLoader/');?>'">下载PmC插件读取器</button><?php
 }?>
				</div>
			</div>
		</aside>
	</aside>
</div>
</div>
</section>
<footer id="zan-footer">
<section class="footer-space">
    <div class="footer-space-line"></div>
</section>
	<section class="zan-copyright">
		<div id="footer"><p>Copyright &copy; 2015-2017 MCTL</p></div>
	</section>
</footer>
<script type="text/javascript" src="/Public/js/bootstrap-zan.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/audio.min.js"></script>
<script type="text/javascript" src="/Public/js/zan.js"></script>
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