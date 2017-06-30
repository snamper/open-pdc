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
    <?php echo W('Menu/User');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10 ">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider">
            <!--<div class="uk-alert "><span class="uk-h2">注意：更改ip后一日之内无法再次更改！使用方法详细请见 <a target="_blank" href="http://help.18tilab.com/posts/view/62984/" class="uk-button uk-button-success">用户指南</a>客户端请加群下载：<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=3d0375023b89ec40dfc528cd69871d67e0cab9e1c38a432bd25c5e0505338bf8"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PmPlugin交流群" title="PmPlugin交流群"></a></span></div>-->
            <table class="uk-table uk-table-striped uk-table-hover uk-form">
                <thead>
                <tr>
                    <th width="15%">服务器名称</th>
                    <th width="20%">管理网址（点击进入）</th>
                    <th width="15%">端口</th>
					<th width="15%">用户名</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody style="background-color: #fff;" class="boughtData">
                <?php if(is_array($list)): foreach($list as $key=>$Shop): ?><tr data-shop-id="<?php echo ($key); ?>">
                        <td style="line-height: 27px;"><?php echo ($Shop["shopname"]); ?>
                            <?php if(isset($Shop['stop']) AND $Shop['stop'] == '1'){ echo '[已停用]'; } ?>
                        </td>
                        <td style="line-height: 27px;" class="shop-ip" onclick="window.open('<?php echo ($Shop["ip"]); ?>')"><div class="uk-badge"><?php echo ($Shop["ip"]); ?></div></td>
                        <td style="line-height: 27px;" class="shop-port"><div class="uk-badge uk-badge-warning"><?php echo ($Shop["port"]); ?></div></td>
						<td style="line-height: 27px;" class="shop-username"><div class="uk-badge uk-badge-warning"><?php echo ($Shop["username"]); ?></div></td>
                        <td ><div class="uk-button-group">
						<button class="uk-button uk-button-success cusername" id="cusername"> 更改用户名 </button>
						<button class="uk-button uk-button-success submit_username" id="submit_username" style="display:none;"> 确定 </button>
                            <div class="uk-button-dropdown" data-uk-dropdown>
                                <!-- 拨动下拉菜单的按钮 -->
                                <button class="uk-button uk-button-danger"><i class="uk-icon uk-icon-bars"></i> 更多 <i class="uk-icon-caret-down"></i></button>
                                <!-- 下拉菜单 -->
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav uk-nav-dropdown">
										<li><a target="_blank" href="<?php echo U('/Shop/'.$Shop['sid']);?>" >
                                            <i class="uk-icon uk-icon-tags"></i> 查看商品详情</a></li>
                                        <li>
                                        <li><a target="_blank" href="<?php echo U('/Sendmessage/complaint',array('sid'=>$Shop['sid']));?>" >
                                            <i class="uk-icon uk-icon-envelope-o"></i> 投诉服务器</a></li>
                                        <li><?php if(isset($Shop['comment']) AND $Shop['comment'] == 1){ echo '<a target="_blank"
                                                     style="background-color: #fafafa;color: #999;border-color: rgba(0,0,0,.06);box-shadow: none;text-shadow: 0 1px 0 #fff;cursor: default;"
                                                     href="javascript:void (0)">
                                            <i class="uk-icon uk-icon-comment"></i> 已经评论了</a>'; }else{ echo '<a target="_blank"  href='.U('/Shop/'.$Shop['sid'].'#send-comment').' >
                                            <i class="uk-icon uk-icon-comment-o"></i> 评论</a>'; } ?></li><!--
                                        <li class="uk-nav-divider"></li>
                                        <li>
                                            <?php if(isset($Shop['stop']) AND $Shop['stop'] == '1'){ echo '<a href="'.U('/User/Stopplugin',array('id'=>$key,'do'=>'start')).'">
                                                <i class="uk-icon uk-icon-toggle-off"></i> 启用服务器</a>'; }else{ echo '<a href="'.U('/User/Stopplugin',array('id'=>$key,'do'=>'stop')).'">
                                                <i class="uk-icon uk-icon-toggle-on"></i> 停用服务器</a>'; } ?>
                                        </li>-->
                                    </ul>
                                </div>
                            </div>

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