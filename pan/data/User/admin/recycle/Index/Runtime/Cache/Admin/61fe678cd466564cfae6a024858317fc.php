<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html >
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/css/admin/bootstrap.css">
    <link rel="stylesheet" href="/Public/css/admin/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/admin/style.css">
    <link rel="stylesheet" href="/Public/css/admin/plugin.css">
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/admin/app.v2.js"></script>
</head>
<body>
<!--页面主体开始-->
<!-- header -->
<header id="header" class="navbar">
    <ul class="nav navbar-nav navbar-avatar pull-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="thumb-small avatar inline"><img src="/Public/images/placeholder_avatar.svg" alt="chs" class="img-circle"></span>
                <b class="caret hidden-sm-only"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">设置</a></li>
                <li><a href="#">资料</a></li>
                <li><a href="#"><span class="badge bg-danger pull-right"><?php echo ($messageNum); ?></span>消息</a></li>
                <li class="divider"></li>
                <li><a href="docs.html">帮助</a></li>
                <li><a href="signin.html">登出</a></li>
            </ul>
        </li>
    </ul>
    <a class="navbar-brand" href="#">后台</a>
    <button data-target="body" data-toggle="class:slide-nav slide-nav-left" class="btn btn-link pull-left nav-toggle hidden-lg" type="button">
        <i class="icon-reorder icon-xlarge text-default"></i>
    </button>
</form>
</header>
<!-- / header -->
<!-- nav -->
<nav id="nav" class="nav-primary visible-lg nav-vertical">
    <ul class="nav affix-top" data-spy="affix" data-offset-top="50">
        <li ><a href="<?php echo U('/Admin/Index');?>"><i class="icon-dashboard icon-xlarge"></i>控制版面</a></li>
        <li ><a href="<?php echo U('/Admin/Index/User');?>"><i class="icon-user icon-xlarge"></i>用户管理</a></li>
        <li class="dropdown-submenu">
            <a href="<?php echo U('/Admin/Index/Record');?>"><i class="icon-list-alt icon-xlarge"></i>充值记录</a>
            <!--<ul class="dropdown-menu">
                <li><a href="buttons.html">Buttons</a></li>
                <li><a href="icons.html"><b class="badge pull-right">302</b>Icons</a></li>
                <li><a href="grid.html">Grid</a></li>
                <li><a href="widgets.html"><b class="badge bg-primary pull-right">8</b>Widgets</a></li>
                <li><a href="components.html"><b class="badge pull-right">18</b>Components</a></li>
            </ul>-->
        </li>
        <li><a href="<?php echo U('/Admin/Index/Shop');?>"><i class="icon-shopping-cart icon-xlarge"></i>商品列表</a></li>
        <li><a href="<?php echo U('/Admin/Index/Setting');?>"><i class="icon-gear icon-xlarge"></i>全局控制</a></li>
        <li class="dropdown-submenu">
            <a href="#"><i class="icon-maxcdn icon-xlarge"></i>消息管理<b class="badge bg-danger pull-right"><?php echo ($messageNum+$ATM); ?></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo U('/Admin/Index/Massage');?>"><b class="badge bg-danger pull-right"><?php echo ($messageNum); ?></b> 站内消息</a></li>
                <li><a href="<?php echo U('/Admin/Index/Application');?>"><b class="badge bg-danger pull-right"><?php echo ($ATM); ?></b> 提现申请</a></li>
                <li><a href="<?php echo U('/Admin/Index/Complaint');?>">反馈</a></li>
            </ul>
        </li>
    </ul>
</nav>
<!-- / nav -->

<article class="admincenter">
<!--调用布局的模板-->
<div class="clearfix page-title">
    <h4><i class="icon-gear"></i>系统设置</h4>
</div><br>
<script type="text/javascript" src="/Public/ckeditor/ckeditor.js"></script>
<script language="JavaScript">(function (original) {
    jQuery.fn.clone=function(){var result=original.apply(this,arguments),my_textareas=this.find('textarea').add(this.filter('textarea')),result_textareas=result.find('textarea').add(result.filter('textarea')),my_selects=this.find('select').add(this.filter('select')),result_selects=result.find('select').add(result.filter('select'));for(var i=0,l=my_textareas.length;i<l;++i)$(result_textareas[i]).val($(my_textareas[i]).val());for(var i=0,l=my_selects.length;i<l;++i)result_selects[i].selectedIndex=my_selects[i].selectedIndex;return result}})(jQuery.fn.clone);</script>
<div class="row">
    <div class="col-lg-6">
            <div class="panel">
                <header class="panel-heading">目录列表</header>
                <div id="catalog-alert" class="alert alert-success hidden"></div>
                <?php if(is_array($catalog)): foreach($catalog as $key=>$cata): ?><div class="btn-group" style="margin-right: 5px;">
                    <button class="btn btn-inverse"><?php echo ($cata); ?></button>
                    <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"  onclick="addopen(this)"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">删除</a></li>
                    </ul>
                </div><?php endforeach; endif; ?>
                <button class="btn btn-success add-catalog"><i class="icon-plus"></i>添加</button>

            </div>
        <!-- 首页幻灯片设置-->
        <div class="panel">
            <header class="panel-heading">幻灯片设置</header>
            <div class="alert alert-info">这里如果要使用css请使用UIKit的css</div>
            <h3>注意：图片高度请不要大于500px，宽带应该在1000px左右</h3>
            <div>可以点击选择文件后上传，然后选中文件，点击编辑即可编辑长宽</div>
            <br>
            <form action="" method="post" class="form-horizontal">
            <div class="panel-group m-b slidedata" >
                <?php if(is_array($sliders)): foreach($sliders as $key=>$slider): ?><div class="panel panel-default" style="padding: 0;">
                        <div class="panel-heading" role="tab" id="heading<?php echo ($key+1); ?>" style="margin: 0;line-height: 25px;">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($key+1); ?>" aria-expanded="false" aria-controls="collapseOne">
                                幻灯片<span class="silarnum"><?php echo ($key+1); ?></span></a>
                                <div class="btn btn-danger btn-xs float-right" onclick="delslide(this)"> <i class="fa fa-exclamation"></i> 删除</div>

                        </div>
                        <div id="collapse<?php echo ($key+1); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body" style="padding: 15px;">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">幻灯</label> <div class="col-lg-8">
                                        <input name="slidename[]" placeholder="图片地址" data-required="true" class="form-control parsley-validated url float-left" style="width: 78%;" type="text" value="<?php echo ($slider['slidename']); ?>">
                                        <div class="btn btn-block float-right" onclick="openPopup(this)" style="width: 20%;">选择文件</div>
                                        <br class="clear"/><br>
                                        <textarea placeholder="幻灯内容，支持html" rows="5" class="form-control parsley-validated" id="editor<?php echo ($key+1); ?>" name="slide[]"><?php echo ($slider['slide']); ?></textarea>
                                        <script type="text/javascript">
                                            ck = CKEDITOR.replace( 'editor<?php echo ($key+1); ?>',{
                                                toolbar:'Basic'
                                            });
                                            ck.config.toolbar = 'Basic';
                                            ck.config.toolbar_Basic = [
                                                ['Source','-','Save','Cut','Copy','Paste','PasteText','PasteFromWord'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
                                                '/',
                                                ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                ['Link','Unlink','Anchor'],
                                                ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                                '/',
                                                ['Styles','Format','Font','FontSize'],
                                                ['TextColor','BGColor']
                                            ];
                                            ck.config.filebrowserUploadUrl = "<?php echo U('/Admin/Index/uploadImg');?>";
                                            CKFinder.setupCKEditor(ck,'/Public/ckfinder/' );
                                        </script>
                                    </div>
                                    </div>
                                <br class="clear"/> <br/>
                            </div>
                        </div>
                    </div><?php endforeach; endif; ?>
            </div>
                <div class="float-left">
                    <button class="btn btn-success" type="submit"><i class="icon-plus"></i>保存</button>
                </div>
            </form>
            <div class="float-right">
                <div class="btn btn-inverse add-slide" onclick="addslide(this)"><i class="icon-plus"></i>添加幻灯片</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="panel">
            <header class="panel-heading">顶部公告栏</header>
            <div class="alert alert-info">可以使用html,如果要使用css请使用bootstrap的css</div>
            <form action="" method="post" class="uk-form">
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <textarea id="header_notice" class="uk-width-1-1" style="width:100%;resize: vertical;min-height: 150px;"><?php echo ($header_notice); ?></textarea>
                    </div>
                </div>
                <div class="uk-grid">
                    <button class="btn btn-success" type="button" onclick='updateNotice()'><i class="icon-plus"></i>保存</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <header class="panel-heading">版本列表</header>
            <div id="version-alert" class="alert alert-success hidden"></div>
            <?php if(is_array($version)): foreach($version as $key=>$one): ?><div class="btn-group" style="margin-right: 5px;">
                    <button class="btn btn-inverse"><?php echo ($one); ?></button>
                    <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" onclick="addopen(this)"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">删除</a></li>
                    </ul>
                </div><?php endforeach; endif; ?>
            <button class="btn btn-success add-version"><i class="icon-plus"></i>添加</button>
        </div>

        <div class="panel" style="position: relative;overflow: auto;" >
            <header class="panel-heading">小工具</header>
            <div class="col-lg-6" style="padding-left: 0;">
                <div class="panel">
                    <div class="panel-heading">小工具列表</div>
                    <div class="panel-body">
                        <?php echo W('Index/Tool/ToGet');?>

                    </div>
                </div>
            </div>

            <div class="panel col-lg-6">
                <form action="" method="post" onsubmit="return resetCheck(this)">
                    <input type="hidden" name="widget" value="1">
                    <div class="panel-heading">已添加小工具
                        <div class="btn btn-inverse btn-xs float-right" onclick="hideAll(this)" style="margin-right: 5px;">收缩全部</div>
                    </div>
                    <div class="panel-group  bigpanel m-b" data-uk-sortable="{animation:100,threshold:10,handleClass:'outpanel'}">
                        <?php echo W('Index/Tool/ToShow');?>
                        <!-- 范例-->
                       <!-- <div class="outpanel hidden">
                            <div class="panel" style="padding: 0;">
                                <div class="panel-heading" style="margin: 0; line-height: 25px;"><a> Collapsible Group
                                    Item #3 </a>

                                    <div class="btn btn-danger btn-xs float-right" onclick="delslide(this)"><i
                                            class="fa fa-exclamation"></i> 删除
                                    </div>
                                    <div class="btn btn-inverse btn-xs float-right toggle" style="margin-right: 5px;"><i
                                            class="fa fa-exclamation"></i> 展开
                                    </div>
                                </div>

                                <div class="">
                                    <div class="panel-body text-small slowhidden">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto deleniti excepturi
                                        explicabo laudantium magni molestias nemo nesciunt, nihil officia, quasi reiciendis
                                        sapiente sint voluptas! Deserunt eligendi enim explicabo hic quae!
                                    </div>
                                </div>
                            </div>
                        </div>-->

                    </div>
                    <div class="float-right">
                        <button class="btn btn-success" type="submit"><i class="icon-plus"></i>保存</button>
                    </div>
                </form>

            </div>

            <div class="clear"></div>
            <script language="JavaScript">
                $('.toggle').on('click',function(){
                    $(this).parent().parent().find('.panel-body').slideToggle(100);
                    if($(this).data('show-if') !== 1){
                        $(this).text('收缩');
                        $(this).data('show-if',1)
                    }else{
                        $(this).text('展开');
                        $(this).data('show-if',0)
                    }
                });
            </script>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/ckfinder/ckfinder.js"></script>
<script src="/Public/js/uikit.min.js"></script>
<script src="/Public/js/components/sortable.min.js"></script>
<script src="/Public/js/admin/fuelux/fuelux.js"></script>
<script src="/Public/js/admin/bootstrap.js"></script>
<script src="/Public/js/admin/widget.js"></script>

<!--幻灯片的操作-->
<script language="javascript">
    function addopen(event){
        $(event).parent().addClass('open');
    }
        num = $(".slidedata").children('.panel').length;
function addslide(){
    window.num = window.num+1;
          $('<div class="panel panel-default" style="padding: 0;"> ' +
                  '<div class="panel-heading" role="tab" id="headingOne" style="margin: 0;line-height: 25px;">' +
                  ' <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+(window.num)+'" aria-expanded="false" aria-controls="collapse'+(window.num)+'">' +
                  '幻灯片<span class="silarnum">'+(window.num)+'</span></a> ' +
            '<div class="btn btn-danger btn-xs float-right" onclick="delslide(this)" >' +
            ' <i class="fa fa-exclamation" >' +
            '</i> 删除</div> ' +
            '</div>' +
            ' <div id="collapse'+(window.num)+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"> ' +
            '<div class="panel-body" style="padding: 15px;"> <div class="form-group"> ' +
            '<label class="col-lg-3 control-label">幻灯</label> <div class="col-lg-8"> ' +
            '<input name="slidename[]" placeholder="图片地址" data-required="true" class="form-control parsley-validated url float-left" style="width: 78%;" type="text"><div class="btn btn-block float-right" onclick="openPopup(this)" style="width: 20%;">选择文件</div> ' +
            '<br class="clear"/> <br/>' +
            '<textarea placeholder="幻灯内容，支持html" rows="5" class="form-control parsley-validated" id="slide'+window.num+'" name="slide[]"></textarea> ' +
            '</div> ' +
            '</div><br> <hr class="clear"> </div> </div> </div>').appendTo($('.slidedata'));
            eval("var ck"+num +"= CKEDITOR.replace( ('slide'+window.num),{toolbar:'Basic'});" +
                    "CKFinder.setupCKEditor(ck"+num +",'/Public/ckfinder/');");

}


    function delslide(e){
        $(e).parent().parent().remove();
    }
</script>

<!--顶部公告栏-->
<script language="javascript">
    function updateNotice() {
        var html = $('#header_notice').val();
        $.ajax({
            url: "/Admin/Index/Setting",
            data: {'header_notice': html},
            type: "post",
            success: function (data) {
                if (data['state'] == '1') {
                    alert("更新成功")
                    window.setTimeout("refreshPage()", 2000);
                } else {
                    alert("更新失败:"+data['info']);
                }
            }
        });
    }
</script>

<script src="/Public/ckfinder/ckfinder.js"></script>
<script language="JavaScript">
    function openPopup(e) {
        CKFinder.popup( {
            chooseFiles: true,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    console.log(evt);
                    $(e).parent().children('.url').val(file.getUrl());
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    $(e).parent().children('.url').val(evt.data.resizedUrl);
                } );
            }
        } );
    }
</script>
<!--目录和标签的提交-->
<script language="JavaScript">
    function refreshPage()
    {
        window.location.reload();
    }
    jQuery(document).ready(function($) {
        catalog_alert = $('#catalog-alert');
        version_alert = $('#version-alert');
        $('.add-catalog').click(function () {
            catalog = prompt('请输入目录名称','');
            if (catalog !=null  && catalog!="") {
                $.ajax({
                    url: "/Admin/Index/Setting",
                    data: {'catalog': catalog},
                    type: "post",
                    beforeSend: function () {
                        catalog_alert.removeClass('hidden').html('<h4>加载中……</h4>')
                    },
                    success: function (data) {
                        if (data['state'] == '1') {
                            catalog_alert.html('<h4>'+data['info']+'</h4>');
                            window.setTimeout("refreshPage()", 2000);
                        } else {
                            catalog_alert.html('<h4>'+data['info']+'</h4>').removeClass('alert-success').addClass('alert-danger');
                            window.setTimeout(function(){
                                catalog_alert.remove();
                            }, 2000);
                        }
                    }
                })
            }
        });
        $('.add-version').click(function () {
            version = prompt('请输入版本号','');
            var re = /^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/;
            if (version !=null  && version!="" && re.test(version)) {
                $.ajax({
                    url: "/Admin/Index/Setting",
                    data: {'version': version},
                    type: "post",
                    beforeSend: function () {
                        version_alert.removeClass('hidden').html('<h4>加载中……</h4>')
                    },
                    success: function (data) {
                        if (data['state'] == '1') {
                            version_alert.html('<h4>'+data['info']+'</h4>');
                            window.setTimeout("refreshPage()", 2000);
                        } else {
                            version_alert.html('<h4>'+data['info']+'</h4>').removeClass('alert-success').addClass('alert-danger');
                            window.setTimeout(function(){
                                version_alert.remove();
                            }, 2000);
                        }
                    }

                })
            }else if(version ==null){
                return false;
            }else{
                alert('数据非法');
            }
        });
    })
</script>
<script src="/Public/js/admin/fuelux/fuelux.js"></script>



</article>

<!--主体部分结束-->
<!--底部开始-->
<!-- footer -->
<footer id="footer">
    <div class="text-center padder clearfix">
        <p>
            <small>MCTL服务器中心后台管理</small><br><br>
        </p>
    </div>
</footer>
<!--底部结束-->
<!--引入js-->
<script src="/Public/js/admin/bootstrap.js"></script>
<script src="/Public/js/admin/app.js"></script>
</body>
</html>