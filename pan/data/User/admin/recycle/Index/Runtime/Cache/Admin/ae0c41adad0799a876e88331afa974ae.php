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
    <h4><i class="icon-shopping-cart"></i>商品列表</h4>
</div>
<hr>
<section class="panel bg bg-black">
    <header class="panel-heading bg bg-primary text-center">
        <!--<a class="btn btn-link pull-right nav"><i class="icon-search icon-light icon-xlarge"></i></a>-->
        <i class="icon-shopping-cart"></i>商品列表
    </header>
    <ul class="panel-content list-group list-group-flush m-t-n">
        <?php if(is_array($list)): foreach($list as $key=>$Shop): ?><li class="list-group-item bg-inverse" data-toggle="class:active" data-target="#badge-4">
                <div class="media">
                  <span class="pull-left thumb-small m-t-mini">
                    <i class="icon-user icon-xlarge text-primary"></i>
                  </span>
                    <div id="badge-4" class="pull-right text-primary m-t-small">
                        <span class="badge bg-success"><?php echo ($Shop['sales']); ?></span>
                    </div>
                    <div class="media-body float-left">
                        <div><a href="<?php echo U('/Shop/'.$Shop['sid']);;?>" class="h5" target="_blank"><?php echo ($Shop['shopname']); ?></a></div>
                        <?php switch($Shop['action']): case "1": ?><small class=" badge bg-info"><?php echo GetDeveloperLevel($Shop);;?></small><?php break;?>
                            <?php case "2": ?><small class=" badge bg-warning"><?php echo GetDeveloperLevel($Shop);;?></small><?php break;?>
                            <?php case "3": ?>member<?php break;?>
                            <?php default: ?><small class=" badge bg-primary"><?php echo GetDeveloperLevel($Shop);;?></small><?php endswitch;?>
                        <!--<small class="label bg-primary">233333333</small>-->
                    </div>
                    <div class="text-center text-default" >
                        <span>目录：<?php echo substr($Shop['catalog'],1,-1);;?></span><br>
                        <span>标签：<?php echo substr($Shop['tags'],1,-1);;?></span>
                    </div>
                </div>
            </li><?php endforeach; endif; ?>

        <!--<li class="list-group-item bg-inverse" data-toggle="class:active" data-target="#todo-2">
            <div class="media">
                  <span class="pull-left thumb-small m-t-mini">
                    <i class="icon-user icon-xlarge text-warning"></i>
                  </span>
                <div id="todo-2" class="pull-right text-primary m-t-small">
                    <span class="badge bg-primary">15</span>
                </div>
                <div class="media-body float-left">
                    <div><a href="#" class="h5">XX喳喳</a></div>
                    <small class=" badge bg-warning">初级版主</small> <small class="label bg-warning">233333333</small>
                </div>
                <div class="text-center text-default" >
                    这里可以写商品的简述，我没想好。后面那个是销量
                </div>
            </div>
        </li>
        <li class="list-group-item" data-toggle="class:active" data-target="#todo-3">
            <div class="media">
                  <span class="pull-left thumb-small m-t-mini">
                    <i class="icon-user icon-xlarge text-danger"></i>
                  </span>
                <div id="todo-3" class="pull-right text-primary m-t-small">
                    <span class="badge bg-warning">15</span>
                </div>
                <div class="media-body float-left">
                    <div><a href="#" class="h5">XX喳喳插件</a></div>
                    <small class=" badge bg-danger">中级开发者</small> <small class="label bg-danger">233333333</small>
                </div>
                <div class="text-center text-default" >
                    这里可以写商品的简述，我没想好。
                    <br>
                    测试换行
                </div>
            </div>
        </li>
        -->
        <li style="padding-top: 8px;" class="bg-info"><div class="text-center">
            <?php echo ($page); ?>
        </div>
        </li>
    </ul>
</section>

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