<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="mcs,mc技术联盟服务器,我的世界服务器出租">
    <meta name="description" content="Mcs是一个新生的服务器出售平台，在这里再无买服的烦恼，各面板商也可以在此发布商品。" />

    <link rel="stylesheet" href="/Public/css/uikit.min.css" />
    <link rel="stylesheet" href="/Public/css/uikit.almost-flat.min.css" />
    <!--<link rel="stylesheet" href="/Public/css/style.css"/>-->
    <script src="/Public/js/jquery.min.js"></script>
    <script src="/Public/js/index.js"></script>
    <meta name="toTop" content="true">
    <script src="/Public/js/uikit.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/Public/css/webuploader.css">
	<link rel='stylesheet' id='bootstrap-css'  href='/Public/css/a/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='fontawesome-css'  href='/Public/css/a/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='flexslider-css'  href='/Public/css/a/flexslider.css' type='text/css' media='all' />
	<link rel='stylesheet' id='zan-css'  href='/Public/css/a/zan.css' type='text/css' media='all' />
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
				<?php if($UserData['UID'] == '-1'){ echo '<li id="navbar-item-regpage"><a href="'.U('Register/Register').'">注册</a></li>
                    <li id="navbar-item-login"><a href="'.U('/Register').'">登录</a></li>'; } else { echo '<li id="navbar-item-ucenter"><a href="'.U('/User/index').'">用户中心</a></li>
					<li id="navbar-item-logout"><a href="'.U('/Register/Logout').'">注销</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('Action'); if($action>9){ echo '<li id="navbar-item-ucenter"><a href="'.U('/Admin/index').'">管理中心</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('UserState'); if($action==2){ echo '<li id="navbar-item-ucenter"><a href="'.U('/Checker/').'">审核中心</a></li>'; } ?>
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
<!--开始无脑循环商品内容-->
<div class="uk-margin-large-top uk-panel uk-panel-box uk-panel-box-secondary uk-form-horizontal">
<form action="<?php echo U('/Find/tag');?>" target="_self" method="get" class="uk-form ">
    <div class="uk-width-large-1-10 uk-h2 uk-float-left" style="padding: 5px 0;">搜索标签:</div>
    <input name="search" class="uk-form-large uk-width-large-9-10 uk-float-right" title="搜索" placeholder="搜索" value="<?php echo ($search); ?>">
</form>
    <div class="uk-clearfix"></div>
    <br>
<div class="uk-grid uk-margin-top  uk-margin-bottom" data-uk-grid>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Shop): $mod = ($i % 2 );++$i;?><div class="uk-width-large-1-4 uk-width-medium-1-3 uk-width-small-1-2 uk-width-1-1 uk-flex uk-margin-bottom thumb_hover" data-shop="<?php echo ($Shop["sid"]); ?>">
            <div class="uk-panel uk-panel-box uk-panel-header uk-overflow-container box-shadow" style="overflow-x:hidden">
                <div class="uk-panel-teaser">
                    <a class="uk-overlay-toggle" href="<?php echo U("/Shop/".$Shop['sid']);?>" target="_blank">
                    <div class="uk-overlay uk-animation-hover">
                        <img src="<?php echo ($Shop["thumburl"]); ?>"width="100%">
                        <div class="uk-overlay-area uk-animation-scale-down"></div>
                    </div>
                    </a>
                </div>
                <div class="uk-panel uk-text-truncate">
                    <?php if(($Shop['sales']) > "100"): ?><div class="uk-badge uk-badge-danger" style="margin-top: -5px;"><i class="uk-icon-fire"></i> 热门</div>
                        <?php else: ?>
                        <i class="uk-icon-bookmark-o mb-a"></i><?php endif; ?>
                    <a href='<?php echo U("/Shop/".$Shop['sid']);?>' target="_blank" class="b uk-width-1-1" title="<?php echo ($Shop["shopname"]); ?>"><?php echo ($Shop["shopname"]); ?></a>
                </div>

                <p class="uk-text-muted uk-text-small">
                    <span >￥<?php echo ($Shop["price"]); ?></span>
                    <span class="uk-float-right">PM:<?php echo ($Shop["version"]); ?></span>
                </p>
                <a href="<?php echo U('/Shop/'.$Shop['sid']);?>" target="_blank">
                    <div class="uk-button uk-button-primary uk-button-large uk-width-1-1  button-buy mr5" data-url="<?php echo ($Shop['sid']); ?>">
                        <!-- uk-width-medium-1-1 uk-width-small-1-1-->
                        <i class="uk-icon-money"></i> 购买</div></a>

            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>


</div>
</div>
<!--循环结束-->
<?php echo ($page); ?>
<!--购物车的ajax操作-->
<script src="/Public/js/components/grid.min.js"></script>
</div>
</section>
<footer id="zan-footer">
<section class="footer-space">
    <div class="footer-space-line"></div>
</section>
	<section class="zan-copyright">
		<div id="footer"><p>Copyright &copy; 2015-2016 MCTL</p></div>
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