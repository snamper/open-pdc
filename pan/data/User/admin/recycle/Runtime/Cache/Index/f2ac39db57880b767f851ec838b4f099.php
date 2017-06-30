<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="mcs,mc技术联盟服务器,我的世界服务器出租">
    <meta name="description" content="Mcs是一个新生的服务器出售平台，在这里再无买服的烦恼，各面板商也可以在此发布商品。" />

    <link rel="stylesheet" href="/Public/css/uikit.min.css" />
    <link rel="stylesheet" href="/Public/css/uikit.almost-flat.min.css" />
    <link rel="stylesheet" href="/Public/css/style.css"/>
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
    <script src="/Public/js/components/grid.min.js" ></script>
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
<div class="uk-panel-box uk-panel-box-secondary uk-margin-large-top">
<article class="uk-article">
    <h1 class="uk-article-title">如何让服务器排名更高？</h1>
    <p class="uk-article-lead">我们并没有对服务器进行特殊的排名，但是你可以通过一些其他的方法来获取点击</p>
    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-3">
            <div class="uk-panel">
                <h2 class="uk-panel-title">一个明白的名字</h2>
                <p>用户第一眼就可以看到你的服务器的名字，如果取一个适合的而且明白的表达了面包内容的名字会让用户喜欢点击。</p>
            </div>
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel">
                <h2 class="uk-panel-title uk-text-bold">一个美丽的特色图片</h2>
                <p>虽然我们没有提供特色图片的上传位置，但是我们会自动获取你插件详细中的第一张图片。</p>
            </div>
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel">
                <h2 class="uk-panel-title">适当的标签和目录</h2>
                <p>用户有时候会第一时间搜索一些目录或者关键词，如果你的标签和目录中正好包含了他们，你便会出现在他们面前。</p>
            </div>
        </div>

    </div>
    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-3">
            <div class="uk-panel">
                <h2 class="uk-panel-title">销量</h2>
                <p>如果你的销量够多的话，我们会自动的靠前排名，而且你会获得一个美丽的徽章。</p>
            </div>
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel">
                <h2 class="uk-panel-title">用户投诉反应</h2>
                <p>虽然其他用户是看不到这些投诉的，但是我们会详细的记录下每一个投诉，一遍排名的优化</p>
            </div>
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel">
                <h2 class="uk-panel-title uk-text-bold">你的信誉</h2>
                <p>我们会不定期的更改首页的幻灯片，也许下一个就是你。</p>
            </div>
        </div>
    </div>

    <hr class="uk-article-divider">

    <h2 id="breakpoints"><a href="#breakpoints" class="uk-link-reset">关于特色图片</a></h2>

    <p>之所以新开一版面说明这个是因为他真的很重要。</p>

    <p>你也许可以看到，在首页，我们会随机的放出服务器。虽然大家不一定会去点击它，但是如果你有一个好看的特色图片，或者有用的特色图片的话，被点击的记录会<strong>高很多</strong></p>


</article>
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