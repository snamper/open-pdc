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
<!--幻灯部分的主体-->
<div class="row">
<aside class="col-md-4" id="sidebar">
	<aside id="zan_posts_category-2">
		<div class="panel panel-zan hidden-xs">
			<div class="panel-heading">公告</div>
			<div style="margin-left: 20px;margin-top: 10px;margin-right: 20px;padding-bottom: 20px;">
			<?php echo getHeaderNotice();?></div>
		</div>
	</aside>
	<aside id="zan_posts_category-2">
		<div class="panel panel-zan hidden-xs">
			<div class="panel-heading">搜索</div>
			<ul class="list-group">
		<form method="get" id="searchform" class="form-inline clearfix" action="<?php echo U('/Find');?>">
			<input class="form-control" type="text" name="search" id="search" placeholder="搜索关键词...">
			<button class="btn btn-zan-solid-pi btn-small" onclick="submit();"><i class="fa fa-search"></i> 查找</button>
		</form>     
	</ul>
		</div>
	</aside>
	<?php echo W('Index/Tool/indexShow');?>
</aside>

      <div class="col-md-8" id="mainstay">
<?php if(is_array($PlugData)): $i = 0; $__LIST__ = $PlugData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Plug): $mod = ($i % 2 );++$i; $Plug['data'] = CJson($Plug['data'],true); if(empty($Plug['thumburl'])){ $Plug['thumburl'] = '/Public/images/mcbackground.jpg'; } ?>
<div id="article-list">
<article class="zan-post clearfix">
 <i class="fa fa-bookmark article-stick"></i> 
	<!-- 大型设备文章显示 -->
	<section class="visible-md visible-lg">
    <div class="category-cloud"><a rel="category tag"><?php echo ($Plug["tags"]); ?></a></div>
		<h3>
			<a href="<?php echo U('/Plugin/'.$Plug['pid']); ?>"><?php echo ($Plug["title"]); ?></a>
		</h3>
		<hr>
                  <div class="row">
          <div class="col-md-5">
            <figure class="thumbnail zan-thumb"><a href="<?php echo U('/Plugin/'.$Plug['pid']); ?>"><img width="400" height="240" src="<?php echo ($Plug['thumburl']); ?>" data-original="<?php echo ($Plug['thumburl']); ?>" class="lazy attachment-medium wp-post-image" alt="banner_10" style="height: 166.79999999999998px; display: block;"><noscript><img width="400" height="240" src="<?php echo ($Plug['thumburl']); ?>" class="attachment-medium wp-post-image" alt="banner_10" /></noscript></a></figure>  
          </div>            
          <div class="col-md-7 visible-lg zan-outline">
			<ul id="zi"><?php echo mb_substr(str_replace(array(' ','='),'',strip_tags(html_entity_decode($Plug['content']))), 0, 99, 'utf-8');?>....</ul></div>
          <div class="col-md-7 visible-md zan-outline">         
           
          </div>
        </div>
       
        <hr>
		<div class="pull-right post-info">
			<span><i class="fa fa-calendar"></i> <?php echo ($Plug["updatetime"]); ?></span>
			<span><i class="fa fa-user"></i> <a href="" title="由<?php echo getCanSeeName($Plug);?>发布" rel="author"><?php echo getCanSeeName($Plug);?>[<?php echo GetDeveloperLevel($Plug);?>]</a></span>
			<span><i class="fa fa-download"></i> <?php echo ($Plug["downloads"]); ?>次</span>
			<span><i class="fa fa-comment"></i> <?php echo getPluginComments($Plug['pid']);?>条</span>
      		</div>
	</section>
	<!-- 大型设备文章显示结束 -->

	<!-- 小型设备文章显示 -->
	<section class="visible-xs  visible-sm">
		<div class="title-article">
			<h4><a href="<?php echo U('/Plugin/'.$Plug['pid']); ?>"><?php echo ($Plug["title"]); ?></a></h4>
		</div>
		<p class="post-info">
			<span><i class="fa fa-calendar"></i> <?php echo ($Plug["updatetime"]); ?></span>
			<span><i class="fa fa-comment"></i> <?php echo getPluginComments($Plug['pid']);?>次</span>
			<span><i class="fa fa-tags"></i> <?php echo ($Plug["tags"]); ?></span>
		</p>
		<div class="content-article">
      <figure class="thumbnail"><a href="<?php echo U('/Plugin/'.$Plug['pid']); ?>"><img width="750" height="450" src="<?php echo ($Plug['thumburl']); ?>" data-original="<?php echo ($Plug['thumburl']); ?>" class="lazy attachment-large wp-post-image" alt="banner_10" style="display: block;"></a></figure>		
			<div class="well"><?php echo mb_substr(str_replace(array(' ','='),'',strip_tags(html_entity_decode($Plug['content']))), 0, 99, 'utf-8');?>....</div>
		</div>
		<a class="btn btn-zan-line-pp btn-block" href="<?php echo U('/Plugin/'.$Plug['pid']); ?>" title="详细阅读">阅读全文 <span class="badge"><?php echo ($Plug["downloads"]); ?></span></a>
	</section>
	<!-- 小型设备文章显示结束 -->

</article>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- 分页 -->
<?php echo ($page); ?>
<!--<div id="zan-page" class="clearfix">
	<ul class="pagination pagination-zan pull-right">
		<li> <a href="/">‹‹</a></li>
		<li><span>1</span></li>
		<li> <a href="/">››</a></li>
	</ul>
</div>-->
<!-- 分页结束 -->
</div>
<div class="panel-heading"></div>
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