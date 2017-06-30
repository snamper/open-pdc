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

<link rel="stylesheet" type="text/css" href="/Public/css/jquery.Jcrop.min.css" media="all">
<link rel="stylesheet" type="text/css" href="/Public/js/uploadify-v3.1/uploadify.css" media="all">
<script type="text/javascript" src="/Public/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/Public/js/uploadify-v3.1/jquery.uploadify-3.1.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="/Public/js/ThinkBox/jquery.ThinkBox.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/js/ThinkBox/css/ThinkBox.css" media="all">
<style type="text/css">
    .main{
        margin: 0 auto;
        padding: 15px;
        width: 750px;
        font-family: "microsoft yahei";
        background-color: #F5F5F5;
    }
    .cf:before,.cf:after {
        display: table;
        content: "";
        line-height: 0;
    }
    .cf:after {
        clear: both;
    }
    .cf {
        *zoom: 1;
    }
    .upload-area {
        position: relative;
        float: left;
        margin-right: 30px;
        width: 200px;
        height: 200px;
        background-color: #F5F5F5;
        border: 2px solid #E1E1E1;
    }
    .upload-area .file-tips {
        position: absolute;
        top: 90px;
        left: 0;
        padding: 0 15px;
        width: 170px;
        line-height: 1.4;
        font-size: 12px;
        color: #A8A8A3;
        text-align: center;
    }
    .userup-icon {
        display: inline-block;
        margin-right: 3px;
        width: 16px;
        height: 16px;
        vertical-align: -2px;
        background: url("/Public/img/userup_icon.png") no-repeat;
    }
    .uploadify-button {
        line-height: 120px!important;
        text-align: center;
    }
    .preview-area {
        float: left;
    }
    .tcrop {
        clear: right;
        font-size: 14px;
        font-weight: bold;
    }
    .update-pic .crop {
        background: url("/Public/img/mystery.png") no-repeat scroll center center #EEEEEE;
        float: left;
        margin-bottom: 20px;
        margin-top: 10px;
        overflow: hidden;
    }
    .crop100 {
        height: 100px;
        width: 100px;
    }
    .crop60 {
        height: 60px;
        margin-left: 20px;
        width: 60px;
    }
    .preview {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 11;
        width: 200px;
        height: 200px;
        overflow: hidden;
        background:#fff;
        display: none;
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
            <div class="uk-width-large-3-10 uk-float-right  uk-hidden-small ">  <!-- 修改头像 -->
                <h2>更改头像：</h2>
                <form action="<?php echo U('User/UpAvatar');?>" method="post" id="pic" class="update-pic cf">
                    <div class="upload-area">
                        <input type="file" id="user-pic">
                        <div class="file-tips">支持JPG,PNG,GIF，图片请小于1MB，尺寸不小于100*100。</div>
                        <div class="preview hidden" id="preview-hidden"></div>
                    </div>
                    <div class="preview-area">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="hidden" id="picw" name="picw" />
                        <input type="hidden" id="pich" name="pich" />
                        <input type="hidden" id='img_src' name='src'/>
                        <div class="tcrop">头像预览</div>
                        <div class="crop crop100"><img id="crop-preview-100" src="" alt=""></div>
                        <div class="crop crop60"><img id="crop-preview-60" src="" alt=""></div>
                        <div class="uk-button-group uk-width-1-1">
                        <a  class="uppic-btn save-pic uk-button uk-button-primary uk-width-1-2" style="clear: left;" href="javascript:;">保存</a>
                        <a class="uppic-btn reupload-img uk-button uk-button-danger uk-width-1-2" href="javascript:$('#user-pic').uploadify('cancel','*');">重新上传</a>
                        </div>
                    </div>
                </form>
                <!-- /修改头像 -->
            </div>
            <div class="uk-width-large-6-10 uk-float-left uk-grid uk-margin-left">
            <form class="uk-form uk-form-horizontal  " method="post" action="/User/UpEdit">
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
                <button type="submit" value="提交" class="uk-button uk-button-success uk-width-3-10 uk-margin uk-button-large" >提交</button>
                <a class="" href="<?php echo U('Cpasswd/chance');?>"><div class="uk-button uk-button-danger uk-width-3-10 uk-margin uk-margin-top uk-float-right uk-button-large" >修改密码</div></a>
            </form>
                </div>
        </div>
    </div>
    <!--中心模块结束-->
</div>
<script type="text/javascript">
    $(function(){
        //上传头像(uploadify插件)
        $("#user-pic").uploadify({
            'queueSizeLimit' : 1,
            'removeTimeout' : 0.5,
            'preventCaching' : true,
            'multi'    : false,
            'swf' 			: '/Public/js/uploadify-v3.1/uploadify.swf',
            'uploader' 		: '<?php echo U("User/UploadImg");?>',
            'buttonText' 	: '<i class="userup-icon"></i>上传头像',
            'width' 		: '200',
            'height' 		: '200',
            'fileTypeExts'	: '*.jpg; *.png; *.gif;',
            'onInit':function(){
                if( !$("#UserAvatar").is(":empty")){
                    var avatar = $('#UserAvatar').text();
                    //两个预览窗口赋值
                    $('#crop-preview-100').attr('src',avatar+'/avatar.jpg-avatar_100.jpg?random='+Math.random()).height('100px').css('max-width','none');
                    $('#crop-preview-60').attr('src',avatar+'/avatar.jpg-avatar_50.jpg?random='+Math.random()).height('60px').css('max-width','none');
                    //隐藏表单赋值
                    $('#img_src').val(avatar);
                }
            },
            'onUploadSuccess' : function(file, data, response){
                var data = $.parseJSON(data);
                if(data['status'] == 0){
                    $.ThinkBox.error(data['info'],{'delayClose':3000});
                    return;
                }
                var preview = $('.upload-area').children('#preview-hidden');
                preview.show().removeClass('hidden');
                //两个预览窗口赋值
                $('.crop').children('img').attr('src',data['path']+'?random='+Math.random());
                //隐藏表单赋值
                $('#img_src').val(data['path']);
                //绑定需要裁剪的图片
                var img = $('<img />');
                preview.append(img);
                preview.children('img').attr('src',data['path']+'?random='+Math.random());
                var crop_img = preview.children('img');
                crop_img.attr('id',"cropbox").show();
                var img = new Image();
                img.src = data['path']+'?random='+Math.random();
                //根据图片大小在画布里居中
                img.onload = function(){
                    var img_height = 0;
                    var img_width = 0;
                    var real_height = img.height;
                    var real_width = img.width;
                    if(real_height > real_width && real_height > 200){
                        var persent = real_height / 200;
                        real_height = 200;
                        real_width = real_width / persent;
                    }else if(real_width > real_height && real_width > 200){
                        var persent = real_width / 200;
                        real_width = 200;
                        real_height = real_height / persent;
                    }
                    if(real_height < 200){
                        img_height = (200 - real_height)/2;
                    }
                    if(real_width < 200){
                        img_width = (200 - real_width)/2;
                    }
                    preview.css({width:(200-img_width)+'px',height:(200-img_height)+'px'});
                    preview.css({paddingTop:img_height+'px',paddingLeft:img_width+'px'});
                };
                //裁剪插件

                $('#cropbox').Jcrop({
                    bgColor:'#333',   //选区背景色
                    bgFade:true,      //选区背景渐显
                    fadeTime:1000,    //背景渐显时间
                    allowSelect:false, //是否可以选区，
                    allowResize:true, //是否可以调整选区大小
                    aspectRatio: 1,     //约束比例
                    minSize : [100,100],//可选最小大小
                    boxWidth : 200,		//画布宽度
                    boxHeight : 200,	//画布高度
                    onChange: showPreview,//改变时重置预览图
                    onSelect: showPreview,//选择时重置预览图
                    setSelect:[ 0, 0, 100, 100],//初始化时位置
                    onSelect: function (c){	//选择时动态赋值，该值是最终传给程序的参数！
                        $('#x').val(c.x);//需裁剪的左上角X轴坐标
                        $('#y').val(c.y);//需裁剪的左上角Y轴坐标
                        $('#w').val(c.w);//需裁剪的宽度
                        $('#h').val(c.h);//需裁剪的高度
                    }
                },function(){
                    var Jcrop_api;
                    Jcrop_api = this;
                    var info = Jcrop_api.getBounds();
                    /*var picbox =  $('.jcrop-holder');
                    var width = picbox.children('img').css('width');
                    var height = picbox.children('img').css('height');*/
                    $('#picw').val(info[0]);
                    $('#pich').val(info[1]);

                });
                //提交裁剪好的图片
                $('.save-pic').click(function(){
                    if($('#preview-hidden').html() == ''){
                        $.ThinkBox.error('请先上传图片！');
                    }else{
                        //由于GD库裁剪gif图片很慢，所以长时间显示弹出框
                        $.ThinkBox.success('图片处理中，请稍候……',{'delayClose':30000});
                        $('#pic').submit();
                    }
                });
                //重新上传,清空裁剪参数
                var i = 0;
                $('.reupload-img').click(function(){
                    $('#preview-hidden').find('*').remove();
                    $('#preview-hidden').hide().addClass('hidden').css({'padding-top':0,'padding-left':0});
                });
            }
        });
        //预览图
        function showPreview(coords){
            var img_width = $('#cropbox').width();
            var img_height = $('#cropbox').height();
            //根据包裹的容器宽高,设置被除数
            var rx = 100 / coords.w;
            var ry = 100 / coords.h;
            $('#crop-preview-100').css({
                width: Math.round(rx * img_width) + 'px',
                height: Math.round(ry * img_height) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px',
                'max-width':'none'
            });
            rx = 60 / coords.w;
            ry = 60 / coords.h;
            $('#crop-preview-60').css({
                width: Math.round(rx * img_width) + 'px',
                height: Math.round(ry * img_height) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px',
                'max-width':'none'
            });
        }
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