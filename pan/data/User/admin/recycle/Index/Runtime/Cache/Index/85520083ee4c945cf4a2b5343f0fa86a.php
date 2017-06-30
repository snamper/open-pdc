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
<div class="uk-panel-box uk-panel-box-secondary uk-margin-large-top">
<article class="uk-article">
    <h1 class="uk-article-title">用户条款</h1>
    <p class="uk-article-lead">我们将严格的遵守用户条款的内容，请详细阅读。</p>
    <hr class="uk-article-divider">

    <h3><span style="color: #00ff00;"><strong>网站使用条例:</strong></span></h3>
    <p>网站用户保证，其向本网站提供的服务器资源、文章和评论不得并禁止直接或间接的:</p>
    <ol>
        <li>删除、隐匿、改变本网站及其他用户上显示或其中包含的任何专利、版权、商标或其他所有权声明；</li>
        <li>以任何方式干扰或企图干扰本网站及其他用户其任何部分或功能的正常运行；</li>
        <li>避开、尝试避开或声称能够避开任何内容保护机制；</li>
        <li>&nbsp;未事先经过原始用户的同意向任何非原始用户显示或以其他方式提供任何用户信息；</li>
        <li>&nbsp;请求、收集、索取或以其他方式从任何用户那里获取对本网站及其他用户的访问权；</li>
        <li>为任何用户自动登录到本网站代理身份验证凭据；</li>
        <li>提供跟踪功能，包括但不限于识别其他用户在个人主页上查看或操作；</li>
        <li>自动将浏览器窗口定向到其他网页；</li>
        <li>未经授权冒充他人或获取对本网站的访问权；或者未经用户明确同意，让任何其他人亲自识别该用户。</li>
        <li>禁止讨论一切违反以下条例的内容:（1） 反对宪法所确定的基本原则的；（2） 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；（3） 损害国家荣誉和利益的；（4） 煽动民族仇恨、民族歧视，破坏民族团结的；（5） 破坏国家宗教政策，宣扬邪教和封建迷信的；（6） 散布谣言，扰乱社会秩序，破坏社会稳定的；（7） 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；（8） 侮辱或者诽谤他人，侵害他人合法权益的；（9） 含有法律、行政法规禁止的其他内容的。</li>
        <li><span style="color: #ff0000;">禁止直接或间接的讨论、交流、进行和煽动他人进行服务器攻击</span></li>
    </ol>
</article>
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