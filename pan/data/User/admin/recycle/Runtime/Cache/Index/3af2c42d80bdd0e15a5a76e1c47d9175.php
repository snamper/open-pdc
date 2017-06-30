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
<div class="uk-grid uk-margin-top uk-grid-small uk-margin-bottom">
    <!--用户中心左侧菜单-->
    <?php echo W('Menu/User');?>
    <!--菜单结束-->
    <!--中心模块开始-->
    <div class="uk-width-large-8-10 ">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <form action="" method="post" class="uk-form shop-cart-form">
            <h3 class="uk-article-title"><?php echo ($ActionTitle); ?></h3>
            <hr class="uk-article-divider">
                <div class="uk-alert "><span class="uk-h2">只有进入这个页面购物车才会保存哦~</span></div>
                <div class="uk-overflow-container" style="padding: 10px;background-color: #e5e5e5;">
                    <div class="uk-float-left"><h3 style="line-height: 30px;margin: 0;"><i class="uk-icon-cart-arrow-down"></i> 购物车商品 (单页)<small>(本地，退出后自动保存)</small></h3></div>
                    <div class="uk-float-right uk-clearfix "><div class="uk-float-left uk-margin-right uk-text-bold" style="line-height: 30px;color: #f40">总计：￥ <span class="AllPrice">0</span></div>
                        <button type="button" class="uk-button  uk-button-primary uk-float-right shop-cart-over" >结算</button></div><br>
                </div>
            <table class="uk-table uk-table-striped uk-table-hover cart-table" style="margin-bottom: 0;">
                <thead>
                <tr>
                    <th>全选   <input class="AllCheck" name="AllCheck" type="checkbox" /> </th>
                    <th>插件名称</th>
                    <th class="uk-text-right">加入时间</th>
                    <th class="uk-text-right">单价（加入时）</th>
                    <th class="uk-text-right" style="width: 20%;">操作</th>
                </tr>
                </thead>
                <tbody style="background-color: #fff;" class="cart-body">
                <?php if(is_array($list)): foreach($list as $key=>$Shop): ?><tr class="shopOne">
                        <td style="line-height: 32px;"><input name="SID" type="checkbox" class="SID" value="<?php echo ($Shop["sid"]); ?>" />
                            <input hidden="hidden" name="SCart" value="<?php echo ($key); ?>"/> </td>
                        <td style="line-height: 32px;"><?php echo ($Shop["sname"]); ?></td>
                        <td class="uk-text-right " style="position: relative;top: 6px;"><div class="uk-badge"><?php echo ($Shop["date"]); ?></div></td>
                        <td class="uk-text-right uk-text-bold add-money" style="line-height: 32px;color: #f40" ><?php echo ($Shop["price"]); ?></td>
                        <td class="uk-text-right">
                            <label for="buynumber" style="position: relative;top: 2px;">数量:</label>
                            <input type="number" id="buynumber" min="1" value="<?php echo ($Shop["num"]); ?>" name="BuyNumber"
                                   style="line-height: 1px;" class="uk-form-width-mini uk-form-small uk-margin-right buynumber">
                            <a class="uk-button uk-button-danger button-del" href="javascript:void(0);" onclick="DelCartOnce(<?php echo ($key); ?>)">删除</a>
                            <!--TODO：上面数量记得绝对值-->
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
                <!--循环完成-->
                <!--头部部分-->
            </table>
                <div class="uk-overflow-container" style="padding: 10px;background-color: #e5e5e5;">
                    <div class="uk-float-left" style="line-height: 30px">全选   <input class="AllCheck" name="AllCheck" type="checkbox" /> <a class="uk-button uk-button-danger uk-margin-left" href="javascript:void(0);">删除</a></div>
                    <div class="uk-float-right uk-clearfix "><div class="uk-float-left uk-margin-right uk-text-bold" style="line-height: 30px;color: #f40">总计：￥ <span class="AllPrice tmpprice">0</span></div>
                        <button type="button" class="uk-button  uk-button-primary uk-float-right shop-cart-over"><i class="uk-icon-shopping-cart"></i>  结算</button>
                    </div>
                </div>
            </form>
            <?php echo ($page); ?>
        </div>
    </div>
    <!--分页用数据-->
<!--    <script language='JavaScript'>
        $('[data-uk-pagination]').on('select.uk.pagination', function(e, pageIndex){
            alert('You have selected page: ' + (pageIndex+1));
        });
    </script>-->
    <!--关闭时提交数据-->
    <script src="/Public/js/components/notify.min.js"></script>
    <script type="text/javascript">
        window.onbeforeunload = function(){
            var cookie = getCookie('cart');
            $.post("/User/AddCart",{'cart':cookie});
        };</script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var money = 0;
            if($('.shopOne').length == 0){
                $('.shop-cart-over').remove();
                $('.cart-table').html('<p>还没有东西欧~快去看看吧</p>')
            }
            $('.shopOne').each(function(){
                var num = parseInt($(this).find('.buynumber').val());
                var OneMoney = parseInt($(this).find('.add-money').text());
                money+=(num*OneMoney);
            });
            $('.AllPrice').text(money);
            var AllShop;
            var modal = UIkit.modal("#buy-over");
            $('.check-buy-cancel').click(function(){
                modal.hide();
            });
//            计算价格
            $('input').click(function(event){
                var money = 0;
                $('.shopOne').each(function(){
                    var num = parseInt($(this).find('.buynumber').val());
                    var OneMoney = parseInt($(this).find('.add-money').text());
                    money+=(num*OneMoney);
                });
                $('.AllPrice').text(money);
                event.stopPropagation();
            });
            var shop_cart_over = jQuery('.shop-cart-over');
            shop_cart_over.click(function(event){
                if(confirm("是否购买？一旦确认直接购买！")){
                    var user_money = parseInt($('.user-money').text());
                    var allprice = parseInt($('.tmpprice').text());
                    if(user_money<allprice){
                        UIkit.notify('<i class=" uk-icon-close"></i> 余额不足',{ status:'danger',timeout:1000});
                        return true;
                    }
                AllShop = $('.shop-cart-form').find('.shopOne');
                var ShopData = new Array();
                var notify;
                    $('.shopOne').each(function(index){
                        ShopData[index] = new Array();
                        ShopData[index][0] =  $(this).find('.SID').val();
                        ShopData[index][1] = $(this).find('.buynumber').val();
                    });
                    $.ajax({
                        url:"<?php echo U('User/BuyCart');;?>",
                        data:{'data':ShopData},
                        type:"post",
                        beforeSend:function(){
                            notify = UIkit.notify('<i class="uk-icon-refresh uk-icon-spin"></i> 正在请求中',{ status:'info',timeout:1000});
                        },
                        success:function(data){
                            if(data['state'] == 1){
                                notify.close();
                                modal.hide();
                                UIkit.notify("<i class='uk-icon-check-circle-o'></i> "+data['info'],{ status:'success',timeout:1000});
                                $('.shopOne').remove(); $('.shop-cart-over').remove();
                                $('.cart-table').html('<p>还没有东西欧~快去看看吧</p>');
                                $('.AllPrice').text('0');
                            }else{
                                notify.close();
                                modal.hide();
                                UIkit.notify('<i class="uk-icon-close"></i> '+data['info'],{ status:'danger',timeout:1000});
                            }
                        }
                    });
                event.stopPropagation();
                }
            });

            $('.button-del').click(function(event){
                $(this).parent().parent().remove();
                var money = 0;
                $('.shopOne').each(function(){
                    var num = parseInt($(this).find('.buynumber').val());
                    var OneMoney = parseInt($(this).find('.add-money').text());
                    money+=(num*OneMoney);
                });
                $('.AllPrice').text(money);
                if($('.shopOne').length == 0){

                    shop_cart_over.remove();
                    $('.cart-table').html('<p>还没有东西欧~快去看看吧</p>')
                }
                event.stopPropagation();
            });
            $('.AllCheck').click(function (){
                if($(this).hasClass('beCheck')){
                    $('.AllCheck').removeClass('beCheck').prop("checked",false);
                    $('.cart-table').find('input').prop("checked",false);
                }else{
                    $('.cart-table').find('input').prop("checked",true);
                    $('.AllCheck').addClass('beCheck').prop("checked",true);
                }
            })
        })
    </script>
    <!--中心模块结束-->
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