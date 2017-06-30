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
<div class="uk-panel uk-panel-box uk-panel-box-secondary uk-margin-large-top">
    <div data-uk-grid-margin="" class="uk-grid uk-grid-divider">
        <div class="uk-width-medium-1-2 uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-1-5 uk-hidden-small uk-width-medium-1-5"></div>
                <div class="uk-width-large-3-5 uk-width-medium-3-5 uk-width-small-1-1">
                    <div class="uk-panel">
                        <div class="b35"></div>
                        <h1 class="list_cat">
                            <a class="b" href=""><i class="uk-icon-user mb-a"></i> 用户登录</a>
                        </h1>
                        <form action="<?php echo U('/Login/ToLogin');?>" method="post" class="uk-form" id="Dform">
                            <div class="uk-form-row">
                                <div class="uk-form-icon uk-width-1-1">
                                    <i class="uk-icon-user"></i>
                                    <input type="text" placeholder="请输入账号" value="" id="username" name="UserName" class="uk-width-1-1 uk-form-width-large uk-form-large" maxlength="20">
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-form-icon uk-form-password uk-width-1-1">
                                    <i class="uk-icon-lock"></i>
                                    <input type="password" placeholder="请输入密码" value="" id="password" name="PassWord" class="uk-width-1-1 uk-form-width-large uk-form-large" maxlength="20">
                                </div>
                            </div>
                            <!--<br>
                            验证码：<br>请输入MC技术联盟的英文缩写（大写英文字母4个）
                            <div class="uk-form-row">
                                <div class="uk-form-icon uk-width-1-1">
									<input type="text" placeholder="请输入验证码" value="" id="verify" name="Verify" class="uk-width-1-1 uk-form-width-large uk-form-large" maxlength="20"><br>
	                                </div>
                            </div>-->
                            <div class="uk-form-row">
                                <div class="verify" id="verify"></div>
                            </div>
                            <div class="uk-form-row">
                                <button class="uk-button btn-primary uk-width-medium-1-1 uk-width-large-1-1 uk-width-small-1-2 uk-button-large" name="submit" type="submit" id="dologin">立 即 登 录</button>
                            </div>
                            <div class="uk-form-row uk-text-small uk-margin-small-top">
                                <label title="" class="uk-float-left">
								<div class="switch">
									<input type="checkbox" id="cookietime" value="1" name="cookietime"> 
								</div>
								保持登录7天（公共电脑慎用）
								</label>
                                <a href="<?php echo U('Cpasswd/findpassword');?>" class="uk-float-right uk-link uk-link-muted">忘记密码?</a>
                            </div>
                            <div class="b20"></div>
                            <div class="b35"></div>
                        </form>
                    </div>
                </div>
                <div class="uk-width-1-5 uk-hidden-small"></div>
            </div>
        </div>
		<script>
			$('#dologin').click(function(e){
				e.preventDefault();
    			if(!InputCheck('#Dform')){
    					message('error','错误：','请完整填写信息');
    					$("#veritybutton").removeAttr('disabled');
    					$("#veritybutton").text("立 即 注 册");
    			} else {
    				$.ajax({
    					url: "<?php echo U('/Login/ToLogin');?>",
    					async: true,
    					type: 'POST',
    					dataType: 'json',
    					data: $("#Dform").serialize(),
    					beforeSend: function(){
    						$("#dologin").attr({"disabled":"disabled"});
    						$("#dologin").text("正在登录……");
    					},
    					success: function(data){
    						console.log(data);
    						if(data.status == 1){
    							message('error', '错误', data.message);
    							$("#dologin").removeAttr("disabled").text("重 新 登 录");
    						} else if(data.status == 0){
    							message('success', '成功', data.message);
    							setTimeout(function(){
    								window.location.href = "<?php echo U('/User/');?>";
    							}, 5000);
    						}
    					},
    				});
    			}
			});
		</script>
        <div class="uk-width-medium-1-2 uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-1-6 uk-hidden-small uk-width-medium-1-6"></div>
                <div class="uk-width-large-4-6 uk-width-medium-4-6 uk-width-small-1-1">
                    <div class="uk-panel">
                        <div class="b35"></div>
                        <h1 class="uk-text-center">
                            立即注册
                        </h1>
                        <form id="register-form" class="uk-form " href="<?php echo U('/Login/ToRegister');?>" method="POST" >
                                <div class="uk-form-row">
                                    <div class="uk-form-icon">
                                        <i id="dusername" class="uk-icon-user"></i>
                                        <input type="text" placeholder="请输入账号" autocomplete="off"  id="username" name="UserName" class="uk-form-width-large uk-form-large" title="" maxlength="20" >
                                    </div>
                                </div>
                                <div class="uk-form-row parentCls">
                                    <div class="uk-form-icon">
                                        <i id="demail" class="uk-icon-envelope"></i>
                                        <input type="text" placeholder="请输入邮箱" autocomplete="off"  id="email" name="Email" class="uk-form-width-large uk-form-large inputElem" title="">
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-form-icon uk-form-password">
                                        <i id="dpassword" class="uk-icon-lock"></i>
                                        <input type="password" placeholder="请输入密码" value="" autocomplete="off"  id="password" name="PassWord" class="uk-form-width-large uk-form-large" title="" maxlength="30">
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-form-icon uk-form-password">
                                        <i id="dcpassword" class="uk-icon-unlock-alt"></i>
                                        <input type="password" placeholder="请再次输入密码" value="" autocomplete="off"  id="cpassword" name="CPassWord" class="uk-form-width-large uk-form-large" title="" maxlength="30">
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <button id="veritybutton" class="uk-button  btn-primary uk-width-medium-1-1 uk-width-large-1-1 uk-width-small-1-2 uk-button-large" name="submit">立 即 注 册</button>
                                </div>
                                <script language="JavaScript">
							    $('#veritybutton').click(function(e){
							        e.preventDefault();
    								$("#veritybutton").attr({"disabled":"disabled"});
    								$("#veritybutton").text("正在注册……");
    								if(!InputCheck('#register-form')){
    									message('error','错误：','请完整填写信息');
    									$("#veritybutton").removeAttr('disabled');
    									$("#veritybutton").text("立 即 注 册");
    									$('input.uk-form-danger').keyup(function(){
    					                    $(this).removeClass('uk-form-danger');
    					                });
    								} else {
    									var AjaxData;
    									AjaxData = $("#register-form").serialize();
    									console.log(AjaxData);
    									$.ajax({
    										url: "<?php echo U('/Login/ToRegister');?>",
    										async:true,
    										type: 'POST',
    										dataType:'json',
    										data:AjaxData,
    										error:function(e){
    											message('error','错误',"未知原因失败");
    											$("#veritybutton").removeAttr('disabled');
    											$("#veritybutton").text("立 即 注 册");
    											console.log(e);
    										},
    										success:function(data){
    											if(data!=true){
    												message('error','错误',data.message);
    												$("#veritybutton").removeAttr('disabled');
    												$("#veritybutton").text("立 即 注 册");
    											} else if(data==true){
    												setTimeout(function(){
    													window.location.href='<?php echo U('/Login');?>';
    												}, 2000);
    											}
    										}
    									});
    								}
							});
							</script>
                            </form>
                    </div>
                </div>
                <div class="uk-width-1-6 uk-hidden-small uk-width-medium-1-6"></div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="http://cdn.bootcss.com/uikit/2.17.0/js/components/tooltip.min.js"></script>

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