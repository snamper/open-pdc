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
    <script src="<?php echo U('/Tools/js');?>" language="JavaScript" type="text/javascript"></script>
	<script src="/Public/js/bootstrap.min.js"></script>
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
<div class="uk-grid uk-margin-top uk-grid-small uk-margin-bottom">
    <!--用户中心左侧菜单-->
    <?php echo W('Menu/Developer');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider" />
            <div class="uk-alert uk-alert-danger">发布插件请确保阅读帮助中的版主事项</div>
			<div name="image" id="dropbox" style="min-width:300px;min-height:100px;border:3px dashed silver;"><br />
				<form method="post" class="form-horizontal" enctype="multipart/form-data" id="uploadform" onsubmit="return false;">
					<div class="form-inline">
						<input id="lefile" type="file" name="file" style="display:none" multiple="multiple" />
						&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" id="addfile"><i class="fa fa-plus"></i> | 添加插件</a> 
						<label>或拖动插件到此处上传</label>
					</div>
					<br />
					<br />
				</form>
				<table class="table table-hover">
					<thead>
						<tr>
							<td>#</td>
							<td>文件名</td>
							<td style="width:30%">进度</td>
							<td>状态</td>
						</tr>
					</thead>
					<tbody id="filelist">
						<tr id="file1" style="display:none">
							<td id="id">1</td>
							<td id="filename">文件名</td>
							<td id="progress">
								<div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressbar">
										<span class="sr-only"></span>
									</div>
								</div>
							</td>
							<td id="status"><p class="bg-info">上传中……</p></td>
						</tr>
					</tbody>
					<script type="text/javascript" src="js/main.js"></script>
				</table>
				<br />
			</div>
        </div>
    </div>
    <!--中心模块结束-->
    <script>
	CKEDITOR.replace('editor');
    </script>
</div>
</div>
</section>
<footer id="zan-footer">
<section class="footer-space">
    <div class="footer-space-line"></div>
</section>
	<section class="zan-copyright">
		<div id="footer"><p>Copyright &copy; 2015-2016 MCTL &nbsp;&nbsp;页面生成时间：<?php echo(round(microtime(true)-$GLOBALS['_beginTime'],4).'s'); ?> &nbsp;&nbsp;内存使用：<?php echo round($GLOBALS['_startUseMems']/1024);?>kb</p></div>
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