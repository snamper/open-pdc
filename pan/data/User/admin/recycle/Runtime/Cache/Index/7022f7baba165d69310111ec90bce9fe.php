<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="PmPluign,我的世界pe,我的世界插件,pocketmine,插件购买">
    <meta name="description" content="PmPlugin Store是一个专注于Pocketmine-MP插件出售的平台，保护用户和开发者的权利，拥有独特的插件加载机制保证源码的
    安全，而用户也可以实时享受到最新的插件体验。" />
	<link rel='stylesheet' id='bootstrap-css'  href='http://liangzi.laicuo.top/zb_users/theme/baobk/a/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='fontawesome-css'  href='http://liangzi.laicuo.top/zb_users/theme/baobk/a/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='flexslider-css'  href='http://liangzi.laicuo.top/zb_users/theme/baobk/a/flexslider.css' type='text/css' media='all' />
	<link rel='stylesheet' id='zan-css'  href='http://liangzi.laicuo.top/zb_users/theme/baobk/a/zan.css' type='text/css' media='all' />

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
	<script src="/Public/ckeditor/ckeditor.js" ></script>
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
  <script src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/modernizr.js"></script>
  <script src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/respond.min.js"></script>
  <script src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/html5shiv.js"></script>
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
				<?php if($UserData['UID'] == '-1'){ echo '<li id="navbar-item-regpage"><a href="'.U('Register/Register').'">注册</a></li>
                    <li id="navbar-item-login"><a href="'.U('/Register').'">登录</a></li>'; } else { echo '<li id="navbar-item-ucenter"><a href="'.U('/User/index').'">用户中心</a></li>
					<li id="navbar-item-logout"><a href="'.U('/Register/Logout').'">注销</a></li>'; } ?>
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
<div class="uk-grid uk-margin-top uk-grid-small uk-margin-bottom">
    <!--用户中心左侧菜单-->
    <?php echo W('Menu/Developer');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider">
            <div class="uk-alert-success uk-alert">你一共收入了<?php echo ($allgivemoney); ?>元</div>
            <table class="uk-table uk-table-striped uk-table-hover uk-form">
                <thead>
                <tr>
                    <th width="8%" class="uk-text-center">交易ID</th>
                    <th width="20%" class="uk-text-center">金额</th>
                    <th width="20%">日期</th>
                    <th width="20%">备注</th>
                    <th width="8%" class="uk-text-center">状态</th>
                </tr>
                </thead>
                <tbody style="background-color: #fff;" class="boughtData" valign="middle">
                <?php if(is_array($list)): foreach($list as $key=>$record): ?><tr>
                        <td style="vertical-align: middle"  class="uk-text-center"><?php echo ($record["mid"]); ?></td>
                        <td style="vertical-align: middle"  class="uk-text-center"><span class="btn btn-primary"><?php echo ($record["number"]); ?></span></td>
                        <td style="vertical-align: middle"   ><?php echo ($record["date"]); ?></td>
                        <td style="vertical-align: middle"   ><?php echo ($record["note"]); ?></td>
                        <td style="vertical-align: middle"   class="uk-text-center">
                            <?php switch($record['state']){ case '1'; echo '<i class="uk-icon-circle" style="color: #04ff70;"></i>'; break; case '2'; echo '<i class="uk-icon-circle" style="color: #ff0d00;"></i>'; break; default; echo '<i class="uk-icon-circle" style="color: #FFCA00;"></i>'; break; } ?>
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
</section>
<footer id="zan-footer">
<section class="footer-space">
    <div class="footer-space-line"></div>
</section>
	<section class="zan-copyright">
		<div id="footer"><p>Copyright &copy; 2015-2016 MCTL</p></div>
	</section>
</footer>
<script type="text/javascript" src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/bootstrap-zan.js"></script>
<script type="text/javascript" src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/bootstrap.min.js"></script>
<script type="text/javascript" src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/audio.min.js"></script>
<script type="text/javascript" src="http://liangzi.laicuo.top/zb_users/theme/baobk/a/zan.js"></script>
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