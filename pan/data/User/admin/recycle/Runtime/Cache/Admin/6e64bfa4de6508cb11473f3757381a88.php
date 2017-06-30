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
                <span class="thumb-small avatar inline"><img src="Public/images/placeholder_avatar.svg" alt="chs" class="img-circle"></span>
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
    <h4><i class="icon-gear"></i>支付页面</h4>
</div><br>
<div class="row container "  style="margin: 0 auto;">
    <div class="col-lg-12 ">
        <section class="panel">
            <header class="panel-heading">
                信息:<?php echo ($alipay['note']); ?>
            </header>
        <form class="form-horizontal" accept-charset="GBK" target="_blank" method="POST" action="https://shenghuo.alipay.com/send/payment/fill.htm">
            <input value="PmPlugin提款[MID:<?php echo ($alipay['mid']); ?>]" name="title" type="hidden">
            <input value="PmPlugin提款-申请时间[<?php echo ($alipay['date']); ?>]|申请人UID:[<?php echo ($alipay['useruid']); ?>]" name="memo" type="hidden">
            <input value="转账" name="pay" type="hidden">
            <div class="form-group">
                <label class="col-lg-3 control-label">支付宝账户或邮箱地址：</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="邮箱或地址" name="optEmail">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">金额：</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="金额" maxlength="5" value="<?php echo ($alipay['number']); ?>" name="payAmount">
                </div>
            </div>
                <button class="btn btn-success float-right clear btn-lg col-lg-12" type="submit" >确定</button>
        </form>
            <br><br><br>

        <a href="<?php echo ($url); ?>"><button class="btn btn-inverse" >确认支付完成</button></a>
        </section>
    </div>
</div>
<script src="/Public/js/admin/bootstrap.js"></script>

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