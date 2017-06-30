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
<div class="uk-grid uk-margin-top uk-grid-small uk-margin-bottom">
    <!--用户中心左侧菜单-->
    <?php echo W('Menu/User');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10 ">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider">
            <table class="uk-table uk-table-striped uk-table-hover uk-form">
                <thead>
                <tr>
                    <th width="60%">插件名称</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody style="background-color: #fff;" class="boughtData">
                <?php if(is_array($list)): foreach($list as $key=>$Shop): ?><tr data-shop-id="<?php echo ($key); ?>">
                        <td style="line-height: 27px;"><?php echo ($Shop["shopname"]); ?></td>
                        <td ><div class="uk-button-group">
						<button class="uk-button btn-primary cusername" id="cusername"> 查看 </button>
                        </div>
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
<script src="/Public/js/components/notify.min.js"></script>
<script language="javascript">
    $('.uk-table').on("click",".cusername",function(){
				$(this).parent().find('.cusername').hide();
				$(this).parent().find('.submit_username').show();
                var Div = $(this).parent().parent().parent();
                Username = Div.find('.shop-username').text();
                Div.find('.shop-username').html("<input type='text' class='shop-username-input' value="+Username+">");
				var submit_username = $(this).parent().find('.submit_username');
				var cusername_button = $(this);
            }
    ).on("click",".submit_username",function(){
        var Div = $(this).parent().parent().parent();
        username = Div.find('.shop-username-input').val();
        if(username == ''){
            umessage('<i class="uk-icon-refresh uk-icon-circle" style="color: #ff0d00 ;"></i> 用户名不能为空',{status:'info',timeout:1000});
            return;
        }
        if(username == Username){
            umessage('<i class="uk-icon-refresh uk-icon-circle" style="color: #04ff70 ;"></i> 无改动',{status:'info',timeout:1000});
            Div.find('.shop-username').html('<div class="uk-badge">'+username+'</div>');
            $(this).parent().find('.submit_username').hide();
			$(this).parent().find('.cusername').show();
            return;
        }
        SID = $(this).attr('data-shop-sindex');
        $.get('/User/CUserName',{'chance':SID,'username':username,'port':Div.find('.shop-port').text()},function(data){
            if(data['state'] == '1'){
                umessage('<i class="uk-icon-refresh uk-icon-circle" style="color: #04ff70 ;"></i> 更改成功',{status:'info',timeout:1000});
                Div.find('.shop-username').html('<div class="uk-badge">'+username+'</div>');
				$(this).parent().find('.submit_username').hide();
				$(this).parent().find('.cusername').show();
                return true;
            }else{
                umessage('<i class="uk-icon-refresh uk-icon-circle" style="color: #ff0d00 ;"></i> '+data['info'],{status:'info',timeout:1000});
				console.log(data['info']);
                return true;
            }
        })
    })
</script>
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