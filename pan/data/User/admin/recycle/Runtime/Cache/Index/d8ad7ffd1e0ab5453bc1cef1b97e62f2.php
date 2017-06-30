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
    <?php echo W('Menu/Developer');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider" />
			<form action="<?php echo U('/Developer/SubmitPlugin');?>" method="post" class="uk-form uk-width-large-1-1 uk-grid" id="PlugData">
				<div class="uk-width-large-2-3">
				<div class="uk-panel">
				<input type="text" name="pid" value="<?php echo ($plug["pid"]); ?>" style="display: none;" />
				<h2>插件名称：</h2>
					<div class="uk-form-row">
					<input name="title" type="text" placeholder="名称" value="<?php echo ($plug["title"]); ?>" class="uk-width-large-1-1 uk-form-large" />
					</div>
					<br>
					<textarea id="editor" class="ckeditor" name="editor" style="width: 100%; height: 832px;"><?php echo ($plug["content"]); ?></textarea>
					<br />
				</div>
				<!--左侧第一面板结束-->
				</div>
				<!--左侧结束-->
				<div class="uk-width-large-1-3">
			<div class="uk-panel uk-panel-box uk-panel-box-secondary">
				<input type="file" name="file" id="lefile" style="display:none;"/>
				<input type="text" name="fid" id="fileid" style="display:none;" value="<?php echo ($plug["filefid"]); ?>"/>
				<button class="btn btn-zan-solid-pi btn-block" id="upload"><i class="fa fa-upload"></i> | 更改插件</button>
				<hr />
				<div id="mode">
					<label class="radio-inline">
						<input type="radio" id="plustate-1" value="opensource" <?php if($plug['mode']==1) echo'checked';?>> 开源
					</label>
					<label class="radio-inline">
						<input type="radio" id="plustate-2" value="closesource" <?php if($plug['mode']==2) echo'checked';?>> 闭源
					</label>
				</div>
				<input type="text" id="fmode" name="mode" value="<?php if($plug['mode']==1) echo'opensource'; else echo 'closesource';?>" style="display: none;" />
			</div>
			<div class="uk-panel uk-panel-box uk-panel-box-secondary">
				<div class="uk-panel-title">插件版本：</div>
				<div class="uk-form-row">
					<input name="version" type="text" placeholder="插件版本" value="<?php echo ($plug["version"]); ?>" class="uk-width-large-1-1">
			</div>
			</div>
			<div class="uk-panel uk-panel-box uk-panel-box-secondary">
				<div class="uk-panel-title">标签：<br><small>(多个标签请用逗号 , 间隔)</small></div>
				<div class="uk-form-row">
				<input name="tags" type="text" placeholder="标签" value="<?php echo ($plug["tags"]); ?>" class="uk-width-large-1-1">
			</div>

			</div>
			<div class="uk-panel uk-panel-box uk-panel-box-secondary">
				<div class="uk-panel-title">QQ：</div>
				<div class="uk-form-row">
				<input name="QQ" type="text" placeholder="QQ" value="<?php echo ($plug["findqq"]); ?>" class="uk-width-large-1-1">
			</div>
			</div>
			<div class="uk-margin-top">
				<button id="SendPlug" class="btn btn-primary btn-block" type="button">发布！</button>
					</div>
			<!--右侧面板结束-->
			</div>
			<!--右侧结束-->
			</form>
        </div>
    </div>
    <!--中心模块结束-->
    <script language="javascript">
	CKEDITOR.replace('editor');
	$('#upload').click(function(e){
		e.preventDefault();
		$('#lefile').click();
	});
	
	$('#lefile').change(function(){
		$('#upload').attr({'disabled':'disabled'});
		$('#upload').html('<i class="fa fa-cog fa-spin"></i> | 正在上传');
		var files = $(this)[0].files;
		if(files.length != 0){
			console.log(files);
			var filename = files[0].name;
			if (filename != '' && filename.match(/(\.phar|\.zip)$/g)) {
				var formdata = new FormData();
				formdata.append("file", files[0]);
				formdata.append("mode", $('#mode input[type=radio]:checked').val());
				var request = $.ajax({
					type: "POST",
					url: "<?php echo U('/Tools/UploadPhar');?>",
					data: formdata, //这里上传的数据使用了formData 对象
					dataType: 'json',
					processData : false,
					contentType : false,
					//上传成功后回调
					success: function(xhr){
						console.log(xhr);
						$('#upload').removeAttr('disabled');
						$('#fmode').val($('#mode input[type=radio]:checked').val());
						$('#upload').html('<i class="fa fa-check"></i> | 上传完成');
						$('#fileid').val(xhr.id);
					},
					error: function(){
						$('#upload').removeAttr('disabled');
						$('#upload').html('<i class="fa fa-times"></i> | 上传失败');
					}
				});
			} else if (!filename.match(/(\.phar|\.zip)$/g)) {
				alert('请选择phar或zip文件！');
			}
		}
	});
	
	$('#SendPlug').click(function(){
		if(InputCheck('#PlugData')){
			var AjaxData;
			$('#editor').val(CKEDITOR.instances.editor.getData());
            AjaxData = $("#PlugData").serialize();
			$.ajax({
                url: $('#PlugData').attr('action'),
                async: true,
                type: 'POST',
                dataType: 'json',
                data: AjaxData,
                error:function(e){
                    message('error','错误',"未知原因失败");
					$("#SendPlug").removeAttr("disabled");
					console.log(e);
                },
                beforeSend:function(){
                    $("#SendPlug").attr({"disabled":"disabled"});
					$("#SendPlug").text("正在发布……");
                },
                success:function(data){
                    if(data.status == '0'){
						message('success','消息','添加成功！插件id：' + data.pid);
						setTimeout(function(){
							window.location = '<?php echo U('/Developer/');?>';
						}, 2000);
                        return true;
                    } else if(data.status == '1'){
						message('warning','Waring',data.message);
						$("#SendPlug").removeAttr("disabled");
						$("#SendPlug").text("发布！");
                        return true;
                    } else {
						message('error','错误',"未知原因失败");
						$("#SendPlug").removeAttr("disabled");
					}
                }
            });
		} else {
			message('warning','Waring','请完整填写信息！');
            return true;
		}
	});
    </script>
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