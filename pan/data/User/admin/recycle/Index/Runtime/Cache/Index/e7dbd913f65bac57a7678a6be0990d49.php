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
    <meta name="toTop" content="true">
    <script src="/Public/js/uikit.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/Public/css/webuploader.css">
	<link rel='stylesheet' id='bootstrap-css'  href='/Public/css/a/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='fontawesome-css'  href='/Public/css/a/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='flexslider-css'  href='/Public/css/a/flexslider.css' type='text/css' media='all' />
	<link rel='stylesheet' id='zan-css'  href='/Public/css/a/zan.css' type='text/css' media='all' />
	<link rel='stylesheet' id='zan-css'  href='/Public/css/message.css' type='text/css' media='all' />
	<link rel='stylesheet' href='/Public/css/fancybox.css' type='text/css' media='all' />
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
				<?php if($UserData['UID'] == '-1'){ echo '<li id="navbar-item-regpage"><a href="'.U('Register/Register').'">注册</a></li>
                    <li id="navbar-item-login"><a href="'.U('/Register').'">登录</a></li>'; } else { echo '<li id="navbar-item-ucenter"><a href="'.U('/User/index').'">用户中心</a></li>
					<li id="navbar-item-logout"><a href="'.U('/Register/Logout').'">注销</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('Action'); if($action>9){ echo '<li id="navbar-item-ucenter"><a href="'.U('/Admin/index').'">管理中心</a></li>'; } $action = M('User')->where("UID = '".$UserData['UID']."'")->getField('UserState'); if($action==2){ echo '<li id="navbar-item-ucenter"><a href="'.U('/Checker/').'">审核中心</a></li>'; } ?>
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
<script src="http://liangzi.mc47.cn/zb_users/plugin/fancybox/fancybox.js"></script>
<script type="text/javascript">$(document).ready(function() {$(".fancybox").fancybox();});</script>
<style type="text/css"><?php echo '.prettyprint,pre.prettyprint{white-space:pre-wrap;word-wrap:break-word;background-color:#444;border:1px solid #272822;overflow:hidden;padding:0;margin:20px 0;font-family:Consolas,"Bitstream Vera Sans Mono","Courier New",Courier,monospace!important;color:#666}.prettyprint.linenums,pre.prettyprint.linenums<?php echo -webkit-box-shadow:inset 40px 0 0 #39382e,inset 41px 0 0 #464741;-moz-box-shadow:inset 40px 0 0 #39382e,inset 41px 0 0 #464741;box-shadow:inset 40px 0 0 #39382e,inset 41px 0 0 #464741;?>.prettyprint.linenums ol,pre.prettyprint.linenums ol{margin:0 0 0 33px;padding:5px 10px}.prettyprint.linenums ol li,pre.prettyprint.linenums ol li{color:#bebec5;line-height:20px;margin-left:0;list-style:decimal}.prettyprint ol.linenums{margin-bottom:0;background-color:#272822}.prettyprint .com{color:#93a1a1}.prettyprint .lit{color:#ae81ff}.prettyprint .clo,.prettyprint .opn,.prettyprint .pun{color:#f8f8f2}.prettyprint .fun{color:#dc322f}.prettyprint .atv,.prettyprint .str{color:#e6db74}.prettyprint .kwd,.prettyprint .tag{color:#f92659}.prettyprint .atn,.prettyprint .dec,.prettyprint .typ,.prettyprint .var{color:#a6e22e}.prettyprint .pln{color:#66d9ef}';?>
</style>
<script type="text/javascript">
$(function(){
	$('img').attr('class','fancybox');
});
</script>
<!--调用布局的模板-->
<!--幻灯部分的主体-->
<div class="uk-grid uk-margin-large-top uk-grid-small">
    <!--定义网格-->
    <!--偏左主体部分-->
    <div class="uk-width-large-7-10 uk-width-medium-1-1 uk-width-small-1-1 uk-margin-bottom" style="position: relative;">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <!--文章开始-->
            <div class="uk-article">
                <h1 class="uk-article-title"><?php echo ($Shop["shopname"]); ?></h1>
                <div class="uk-article-meta">销售量：<?php echo ($Shop["sales"]); ?>&nbsp;|&nbsp;内存:<?php echo ($Shop["memarylimit"]); ?>&nbsp;|&nbsp;人数:<?php echo ($Shop["playersolt"]); ?>&nbsp;|&nbsp;时间:<?php echo ($Shop["datelimit"]); ?>天&nbsp;|&nbsp;版本:<?php echo ($Shop["version"]); ?></div>
                <hr class="uk-article-divider">
                <!--转存块-->
                <textarea id="contentdata" class="uk-hidden" rows="0" cols="0"><?php echo ($Shop["content"]); ?></textarea>
                <script>
                    $(document).ready(function(){
                        var data = $('#contentdata').text();
                        $('#content').html(data);
                    });
                </script>
                <div id="content">
                </div>
                <hr class="uk-article-divider">
                <div>标签：
                    <?php if(is_array($Shop["tags"])): foreach($Shop["tags"] as $key=>$Tag): ?><a href="<?php echo U('/Find/tag',array('search'=>$Tag));?>" target="_blank"><div class="uk-badge uk-badge-success uk-margin-small-right"><?php echo ($Tag); ?></div> </a><?php endforeach; endif; ?>
                </div>
            </div>
            <!--文章end-->
        </div>

        <!-- 评论开始-->
        <?php echo W('Comment/Sendcomment',array($Shop['sid']));?>
        <div class="uk-panel uk-panel-box uk-panel-box-secondary uk-margin uk-panel-header">
            <div class="uk-panel uk-panel-title" style="margin: 0;">用户评论：</div>
            <?php echo W('Comment/Getcomment',array($Shop['sid']));?>
        </div>
        <!-- 评论结束-->
    </div>
    <!--偏右的侧栏部分-->
    <div class="uk-width-large-3-10 ">
        <div class="uk-panel uk-panel-box uk-panel-header uk-panel-box-secondary">
            <div class="uk-panel uk-panel-title">版主</div>
            <div class="uk-vertical-align ">
<?php if($ShopUser['data']['avatar']){ echo '<img class="uk-border-circle uk-float-left uk-margin-right uk-animation-shake uk-animation-hover" src="'.C('HOST').substr($ShopUser['data']['avatar'],1).'/avatar.jpg-avatar_80.jpg" width="80" height="80" alt="">'; }else{ echo '<img class="uk-border-circle uk-float-left uk-margin-right uk-animation-shake uk-animation-hover" src="'.C('HOST').'Public/images/placeholder_avatar.svg" width="80" height="80" alt="">'; } ?>
                <div class="uk-vertical-align-middle">
                    <span class="uk-h3">
                        <?php echo getCanSeeName($ShopUser);?>
                    </span>
                    <span class="uk-hidden" id="shopnumget" data-shop-id="<?php echo ($Shop["sid"]); ?>"></span>
                    <small class="uk-badge uk-badge-success" style="line-height: 22px;font-size: 13px;float: right;margin-left: 20px;">
                        <?php echo GetDeveloperLevel($ShopUser); ?>
                    </small>
                </div>
            </div>
            <p class="uk-margin"><?php echo ($ShopUser['data']['pdata']); ?></p>
            <hr style="clear: both;">
            <h3>联系方式:</h3>
            <p>邮箱：<?php echo ($ShopUser['email']); ?><br>
            QQ：<?php echo ($Shop["findqq"]); ?>
            </p>
        </div>
        <!-- 评价块-->
        <div class="uk-panel uk-panel-box uk-panel-header uk-panel-box-secondary">
            <div class="uk-panel uk-panel-title">用户评级(总票数：<?php echo ($levelnum); ?>票)</div>
            <div>
                <span class="uk-float-left">5星</span>
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: <?php echo ($level['4']/$levelnum)*100;?>%">
					<?php if (($level['5']/$levelnum)*100>10){echo $level['5'];}?>
					</div>
					<?php if (($level['5']/$levelnum)*100<=10){echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$level['5'];}?>
				</div>
            </div><div class="uk-clearfix"></div>
            <div>
                <span class="uk-float-left">4星</span>
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: <?php echo ($level['4']/$levelnum)*100;?>%">
					<?php if (($level['4']/$levelnum)*100>10){echo $level['4'];}?>
					</div>
					<?php if (($level['4']/$levelnum)*100<=10){echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$level['4'];}?>
				</div>
            </div><div class="uk-clearfix"></div>
            <div>
                <span class="uk-float-left">3星</span>
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: <?php echo ($level['3']/$levelnum)*100;?>%">
					<?php if (($level['3']/$levelnum)*100>10){echo $level['3'];}?>
					</div>
					<?php if (($level['3']/$levelnum)*100<=10){echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$level['3'];}?>
				</div>
            </div><div class="uk-clearfix"></div>
            <div>
                <span class="uk-float-left">2星</span>
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: <?php echo ($level['2']/$levelnum)*100;?>%">
					<?php if (($level['2']/$levelnum)*100>10){echo $level['2'];}?>
					</div>
					<?php if (($level['2']/$levelnum)*100<=10){echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$level['2'];}?>
				</div>
            </div><div class="uk-clearfix"></div>
            <div>
                <span class="uk-float-left">1星</span>
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: <?php echo ($level['1']/$levelnum)*100;?>%">
					<?php if (($level['1']/$levelnum)*100>10){echo $level['1'];}?>
					</div>
					<?php if (($level['1']/$levelnum)*100<=10){echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$level['1'];}?>
				</div>
            </div>
        </div>
        <!--价格块-->
        <div class="uk-panel uk-panel-box uk-panel-header uk-panel-box-secondary">
            <div class="uk-h2 uk-text-center">售价：<i class="uk-icon-money"></i> <?php echo ($Shop['price']); ?> G币</div><br>
            <div class="uk-button-group uk-width-1-1">
			<?php if($Shop['isBuy']==false){ ?>
                <div class="uk-button uk-button-primary uk-button-large uk-width-large-1-2 uk-width-medium-1-1 uk-width-small-1-1"  data-uk-modal="{target:'#buy-shop'}">
                    <i class="uk-icon-money"></i> 购买</div>
                <div class="uk-button uk-button-success uk-button-large uk-width-1-2 uk-hidden-medium uk-hidden-small button-cart">
                    <i class="uk-icon-cart-arrow-down"></i> 加入购物车</div><br /><br />
			<?php } else {?>
					<div class="uk-button uk-button-primary uk-button-large uk-width-large-1-2 uk-width-medium-1-1 uk-width-small-1-1"  data-uk-modal="{target:'#buy-shop'}">
                    <i class="uk-icon-money"></i> 再次购买</div>
                <div class="uk-button uk-button-success uk-button-large uk-width-1-2 uk-hidden-medium uk-hidden-small button-cart">
                    <i class="uk-icon-cart-arrow-down"></i> 加入购物车</div><br /><br /><?php } ?>
            </div>
        </div>
    </div>
    <!--右侧主体结束-->
</div>
<!-- 模态对话框 -->
<div id="buy-shop" class="uk-modal">
    <div class="uk-modal-dialog">
        <h1>Wait!</h1>
        <div class="uk-h4 uk-text-center">你确定要购买吗？点击购买直接完成购买，否则请取消。</div>
		购买时长：<input class="form-control" type="text" id="count" placeholder="请输入购买时长" value="1"> × <?php echo($Shop['datelimit']); ?> 天
        <div class="uk-margin-top uk-text-right"><button class="uk-button uk-button-primary check-buy" onclick="Buy()">确定</button>
            <button class="uk-button uk-button-danger check-buy-cancel uk-margin-left">取消</button></div>
    </div>
</div>
<!--购物车的ajax操作-->
<script src="/Public/js/components/notify.min.js"></script>
<script language="JavaScript" >
    var modal;
    jQuery(document).ready(function($){
        var button_cart = $('.button-cart');
        modal = UIkit.modal("#buy-shop");
        $('.check-buy-cancel').click(function(){
            modal.hide();
        });
        var notify;
        var sid = $('#shopnumget').data('shop-id');
        button_cart.click(function(){
            $.ajax({
                url:"<?php echo U('/User/AddCart');?>",
                data: {'sid':sid,num:1},
                type:"get",
                beforeSend:function(){
                    notify = umessage('<i class="uk-icon-refresh uk-icon-spin"></i> 正在加入购物车……<br>（提示）：购物车的东西如果没有去看一下是不会保存的哦~',{ status:'info',timeout:1000});
                },
                success:function(data){
                    if(data['state'] == '1'){
                        notify.close();
                        umessage("<i class='uk-icon-check-circle-o'></i> "+data['info'],{ status:'success',timeout:1000});
                    }else{
                        notify.close();
                        umessage('<i class="uk-icon-close"></i> '+data['info'],{ status:'danger',timeout:1000});
                    }
                }
            });
        });
    });
    function Buy(){
        var sid = $('#shopnumget').data('shop-id');
		var count = $('#count').val();
        console.log(sid);
        $.ajax({
            url:"<?php echo U('User/BuyShop');;?>",
            data:{'sid': sid ,'num':1, count: count},
            type:"post",
            beforeSend:function(){
                notify = umessage('<i class="uk-icon-refresh uk-icon-spin"></i> 正在请求中',{ status:'info',timeout:1000});
            },
            success:function(data){
                if(data['state'] == 1){
                    modal.hide();
                    umessage("<i class='uk-icon-check-circle-o'></i> "+data['info'],{ status:'success',timeout:1000});
					
                }else{
                    modal.hide();
                    umessage('<i class="uk-icon-close"></i> '+data['info'],{ status:'danger',timeout:1000});
                }
            }
        })
    }
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