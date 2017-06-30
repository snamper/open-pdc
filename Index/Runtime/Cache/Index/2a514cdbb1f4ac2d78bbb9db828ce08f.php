<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="pocketmine插件,我的世界插件,pdc">
    <meta name="description" content="Pocket Developer Center开源插件站" />

    <link rel="stylesheet" href="/Public/css/uikit.min.css" />
    <link rel="stylesheet" href="/Public/css/uikit.almost-flat.min.css" />
    <link rel="stylesheet" href="/Public/css/style.css"/>
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
				<?php if($UserData['UID'] == '-1'){ echo '<li id="navbar-item-login"><a href="'.U('/Login').'">登录/注册</a></li>'; } else { echo '<li id="navbar-item-ucenter"><a href="'.U('/User/index').'">用户中心</a></li>
					<li id="navbar-item-logout"><a href="'.U('/Login/Logout').'">注销</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('Action'); if($action>9){ echo '<li id="navbar-item-admin"><a href="'.U('/Admin/index').'">管理中心</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('UserState'); ?>
                <li id="navbar-item-phar"><a href="http://mc.mctpa.net:8080/tools/phar/">插件打包</a></li>
				<li id="navbar-item-bbs"><a href="http://mcleague.xicp.net/bbs">论坛</a></li>
			</ul>
		</nav>
      </div>
    </div>
    <!-- 导航结束 -->

</header>
<div id="main_page" class="container">
<section id="zan-bodyer">


<!--<div><p class="pull-left"><?php echo getHeaderNotice();?></p></div>-->

<link  href="/Public/css/cropper.css" rel="stylesheet">
<script src="/Public/js/cropper.js"></script>
<style type="text/css">
.avatar-preview {
  margin-top: 15px;
  margin-right: 15px;
  border: 1px solid #eee;
  border-radius: 4px;
  background-color: #fff;
  overflow: hidden;
}

.avatar-preview:hover {
  border-color: #ccf;
  box-shadow: 0 0 5px rgba(0,0,0,.15);
}

.avatar-preview img {
  width: 100%;
}

.preview-lg {
  height: 100px;
  width: 100px;
}

.preview-md {
  height: 80px;
  width: 80px;
}

.preview-sm {
  height: 50px;
  width: 50px;
}

@media (min-width: 992px) {
  .avatar-preview {
    float: none;
  }
}

</style>
<!--调用布局的模板-->
<div class="uk-grid uk-margin-top uk-grid-small uk-margin-bottom ">
    <!--用户中心左侧菜单-->
    <?php echo W('Menu/User');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider">
            <!--TODO:设置用户资料-->
            <div id="UserAvatar" class="uk-hidden">.<?php echo ($UserSystemData['data']['avatar']); ?></div>
            <div class="uk-width-large-10-10 uk-float-right">  <!-- 修改头像 -->
                <form action="<?php echo U('User/UpAvatar');?>" method="post" id="pic" class="uk-form uk-form-horizontal">
                    <h2>更改头像：</h2>
                    <div class="upload-area" id="uploadarea">
                        <input type="file" id="lefile" style="display: none;">
                        <button class="btn btn-zan-solid-pi btn-block" id="selectimg"><i class="fa fa-upload"></i> | 选择图片</button>
                        <br />
                        <div id="imgbox" class="uk-width-large-6-10 uk-float-left"></div>
                        <br />
                        <div id="imgview" class="uk-width-large-3-10 uk-float-right" style="display: none;">
                            <h4>头像预览：</h4>
                            <div id="imgview-100" class="avatar-preview preview-lg" style="width: 100px; height: 100px;"></div>
                            <div id="imgview-80" class="avatar-preview preview-md" style="width: 80px; height: 80px;"></div>
                            <div id="imgview-50" class="avatar-preview preview-sm" style="width: 50px; height: 50px;"></div>
                            <br />
                        </div>
                        <br />
                    </div>
                    <br />
                    <button type="submit" style="display: none;" value="提交" class="btn btn-primary btn-block" id="UpAvatar">提交</button>
                </form>
                <!-- /修改头像 -->
                <hr />
            </div>
            <div class="uk-width-large-10-10 uk-float-right">
            <form class="uk-form uk-form-horizontal" method="post" action="/User/UpEdit">
                <h2>详细资料:</h2>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="nickname">昵称</label>
                    <div class="uk-form-controls">
                        <input type="text" name="nickname" id="nickname" placeholder="昵称" value="<?php echo ($UserSystemData['data']['nickname']); ?>">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label uk-width-1-2" for="QQ">QQ</label>
                    <div class="uk-form-controls ">
                        <input type="text" id="QQ" name="qq" placeholder="QQ" value="<?php echo ($UserSystemData['data']['qq']); ?>">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="PData">个人资料</label>
                    <div class="uk-form-controls">
                        <textarea id="PData" cols="30" rows="5" name="pdata" placeholder="个人资料" ><?php echo ($UserSystemData['data']['pdata']); ?></textarea>
                    </div>
                </div>
                <button type="submit" value="提交" class="uk-button btn-success uk-width-3-10 uk-margin uk-button-large" id="SubmitData">保存数据</button>
                <a class="" href="<?php echo U('Cpasswd/chance');?>"><div class="uk-button btn-danger uk-width-3-10 uk-margin uk-margin-top uk-float-right uk-button-large">修改密码</div></a>
            </form>
                </div>
        </div>
    </div>
    <!--中心模块结束-->
</div>
<script type="text/javascript">
var imgdata = {};
CKEDITOR.replace('pdata', {height: '240px',toolbar: [ 
    ['Bold','Italic','Underline','Strike','NumberedList','BulletedList','-','Image','TextColor','-','Outdent','Indent','Blockquote', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] 
]});
$('#SubmitData').click(function(e){
    $('#PData').val(CKEDITOR.instances.pdata.getData());
});
$('#selectimg').click(function(e){
    e.preventDefault();
    $('#lefile').click();
});
$('#lefile').change(function(){
    var files = $(this)[0].files;
    if(files.length > 0){
        var filename = files[0].name;
        if(filename.match(/(\.png|\.jpg|\.gif|\.bmp|\.svg|\.jpeg)$/g)){
            var formdata = new FormData();
            formdata.append("file", $("#lefile")[0].files[0]);
            $('#selectimg').attr({'disabled':'disabled'});
		    $('#selectimg').html('<i class="fa fa-cog fa-spin"></i> | 正在上传');
            $.ajax({
                type: "POST",
                url: "<?php echo U('/User/UploadImg');?>",
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(result) {
					$('#selectimg').html('<i class="fa fa-check"></i> | 上传完成');
					$('#imgbox').html('<img src="'+result.path+'">');
					$('#imgview').show();
					$('#imgbox > img').cropper({
                        aspectRatio: 1 / 1,
                        crop: function(data) {
                            imgdata.x = data.x;
                            imgdata.y = data.y;
                            imgdata.picw = data.width;
                            imgdata.pich = data.height;
                        },
                        preview: $('#imgview').find('.avatar-preview'),
                    });
                    $('#UpAvatar').show();
                },
                error: function(){
					$('#selectimg').removeAttr('disabled');
					$('#selectimg').html('<i class="fa fa-times"></i> | 上传失败');
				}
            });
        } else {
            alert('请选择图片文件');
        }
    }
});
$('#UpAvatar').click(function(e){
    e.preventDefault();
    $('#UpAvatar').attr({'disabled':'disabled'});
    $('#UpAvatar').html('<i class="fa fa-cog fa-spin"></i> | 正在上传');
    $.ajax({
        type: "POST",
        url: "<?php echo U('/User/UpAvatar');?>",
        data: imgdata,
        dataType: 'json',
        success: function(result) {
            $('#UpAvatar').removeAttr('disabled');
            if(result.status == 0){
			    $('#UpAvatar').html('<i class="fa fa-check"></i> | 头像修改完成');
			    $('#imgbox').fadeOut(500);
			    $('#imgview').fadeOut(500);
			    $('#UpAvatar').fadeOut(500);
			    $('#imgbox').html('');
			    message('success', '完成', result.message);
            } else {
                $('#UpAvatar').html('<i class="fa fa-times"></i> | 头像修改失败');
                message('error', '错误', result.message);
            }
			console.log(result);
        },
        
        error: function(){
			$('#UpAvatar').removeAttr('disabled');
			$('#UpAvatar').html('<i class="fa fa-times"></i> | 头像修改失败');
        }
    });
})
</script>

</div>
</section>
<footer id="zan-footer">
<section class="footer-space">
    <div class="footer-space-line"></div>
</section>
	<section class="zan-copyright">
		<div id="footer"><p>Copyright &copy; 2015-2017 MCTL | PDC插件站</p></div>
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