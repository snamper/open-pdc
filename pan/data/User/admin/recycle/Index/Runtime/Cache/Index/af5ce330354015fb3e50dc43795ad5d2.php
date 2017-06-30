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
<div class="uk-margin-top">
    <div class="uk-panel uk-panel-box">
        <div data-uk-grid-margin="" class="uk-grid uk-grid-divider">
            <div class="uk-width-medium-1-2">
                <div class="uk-grid">
                    <div class="uk-width-1-5 uk-hidden-small uk-width-medium-1-5"></div>
                    <div class="uk-width-large-3-5 uk-width-medium-3-5 uk-width-small-1-1">
                        <div class="uk-panel">
                            <div class="b35"></div>
                            <h1>
                                <a class="b list_cat" href="#"><i class="uk-icon-user mb-a"></i> 用户注册</a>
                            </h1>
                            <form id="register-form" class="uk-form " href="/Register/ToRegister" method="POST" >
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
<!--                                <div class="uk-form-row">验证码：
                                    <div class="verify" id="verify"></div>
                                </div>-->
                                <div class="uk-form-row uk-text-small">
<!--                                    <label title="和谐社会,文明上网!" class="uk-float-left"> 当您注册时代表您已经阅读并已同意<a href="#" target="_blank" class="uk-link">《用户协议》</a></label>-->
                                </div>
                            </form>
                            <!-- 模态对话框 -->
                            <div id="checkdiv" class="uk-modal">
                                <div class="uk-modal-dialog">
                                    <a class="uk-modal-close uk-close"></a>
                                    <div class="uk-modal-header uk-text-center" id="checkdiv-header"><h2>正在加载中</h2></div>
                                    <div class="center" style="height: 200px;">
                                        <div class="uk-modal-spinner"></div>
										<script language="JavaScript" type="application/javascript">
var CheckIfEmpty=false;
    function Go(url){
        window.location=url;
    }
        if(CheckIfEmpty !== true){
            $('.auto-del').remove();
            ajaxdata = $("#register-form").serialize();
            $.ajax({
                url: "/Register/ToRegister",
                async:true,
                type: 'POST',
                dataType:'json',
                data:ajaxdata,
                error:function(){
                    alert("未知原因失败");
                },
                beforeSend:function(){
                    $("#checkdiv").find(".center").html('<div class="uk-text-center"><div class="uk-modal-spinner"></div></div>');
                    $("#checkdiv-header").text("正在加载中……");
                    $("#checkdiv-footer").text("正在加载中……");
                },
                success:function(data){
                    if(data == true){
                        $("#checkdiv").find(".center").html('<div class="uk-text-center"><h2>注册成功！</h2></div>');
                        $("#checkdiv-header").text("注册成功！");
                        $("#checkdiv-footer").text("注册成功！");
                        setTimeout(Go('/Register'),1000);
                        return true;
                    }else{
                        $("#checkdiv-header").html("<h2>注册失败！</h2>");
                        $("#checkdiv-footer").text('请检查上述问题，并重新提交')
                                .removeClass('uk-text-center').addClass('uk-text-right');
                        gt_captcha_obj.refresh();
                    }
                    var overdata = "";
                    $.each(data,function(k,value) {
                        $('#register-form').find("[name="+k+"]").addClass('form-red');
                        overdata += value+"<br>";
                        $("#checkdiv").find(".center").html(overdata).addClass("uk-text-center");
                    });
                }
            });
        }else{
            $("#checkdiv").find(".center").html('<div class="uk-text-center"><h2>信息填写不完整</h2></div>');
            $("#checkdiv-header").text("信息有误");
            $("#checkdiv-footer").html('信息有误');
            gt_captcha_obj.refresh();
            return true;
        }
    });
</script>

                                    </div>
                                    <div class="uk-modal-footer uk-text-center" id="checkdiv-footer">正在加载中</div>
                                </div>
                            </div>
                            <!-- 触发模态对话框的按钮 -->
							<script language="JavaScript">
							function reghref(){
								window.location.href='/Register/ToRegister?UserName='+document.getElementById("username").value+'&PassWord='+document.getElementById("password").value+'&CPassWord='+document.getElementById("cpassword").value+'&Email='+document.getElementById("email").value;
							}
							</script>
                            <div class="uk-form-row">
                                <button id="veritybutton" class="uk-button  uk-button-primary uk-width-medium-1-1 uk-width-large-1-1 uk-width-small-1-2 uk-button-large" name="submit" type="submit" onclick="javascript:reghref()" method="POST">立 即 注 册</button>
                            </div>
                            <div class="b35"></div>
                        </div>
                    </div>
                    <div class="uk-width-1-5 uk-hidden-small uk-width-medium-1-5"></div>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="uk-grid">
                    <div class="uk-width-1-6 uk-hidden-small uk-width-medium-1-6"></div>
                    <div class="uk-width-large-4-6 uk-width-medium-4-6 uk-width-small-1-1">
                        <div class="uk-panel">
                            <div class="b35"></div>
                            <h1 class="uk-text-center">
                                <a class="b" href="{：U('/Register')}">我已注册账号</a>
                            </h1>
                            <button onclick="javascript:window.location.href='<?php echo U('/Register');?>'" class="uk-button uk-button-large uk-button-success uk-width-1-1">立 即 登 录</button>
                            <div class="b20"></div>
                            <div class="uk-form-row">
<!--                                <h3><span class="uk-text-muted"> &nbsp;其他网站账号登录: &nbsp;</span>
                                    <a title="QQ登录"  href="#" class="uk-icon-button uk-icon-hover uk-icon-qq">
                                    </a> &nbsp;
                                </h3>-->
                            </div>
                            <div class="b20"></div>
                            <div class="uk-form-row uk-text-center">
                                <img alt="" src="/Public/images/login-banner.jpg"  style="border-radius: 5px">
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-6 uk-hidden-small uk-width-medium-1-6"></div>
                </div>
            </div>
        </div>
    </div>

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