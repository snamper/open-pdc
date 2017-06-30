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
    <h4><i class="icon-list-alt"></i>用户插件管理</h4>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                用户[<?php echo ($userData["username"]); ?>]
            </header>
            <div class="pull-out m-t-small">
                <table class="table table-striped b-t text-small">
                    <thead>
                    <tr>
                        <th width="10">Index</th>
                        <th width="100px">SID</th>
                        <th width="200px">名称</th>
                        <th>ip</th>
                        <th>端口</th>
                        <th width="200">重置ip更新权利</th>
                    </tr>
                    </thead>
                    <tbody >
                    <?php if(is_array($userPlugin)): foreach($userPlugin as $key=>$one): ?><tr>
                            <td style="vertical-align:middle"><?php echo ($key); ?></td>
                            <td style="vertical-align:middle"><?php echo ($one["sid"]); ?></td>
                            <td style="vertical-align:middle"><a href="javascript:void(0);" class="btn btn-success btn-small"><?php echo ($one["shopname"]); ?></a></td>
                            <td style="vertical-align:middle"><?php echo ($one["ip"]); ?></td>
                            <td style="vertical-align:middle"><a href="javascript:void(0)" class="btn btn-danger btn-small"><?php echo ($one["port"]); ?></a></td>
                            <td>
                                <a target="_blank" href="<?php echo U('/Admin/Index/Userchanceip',array('index'=>$key,'uid'=>$userData['uid']));?>" onclick="return ifchance()"><button class="btn btn-white btn-small" >重置</button></a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <script language="JavaScript">
                        function ifchance(){
                            check = confirm('你确定要重置此插件的更改ip权限吗');
                            return check;
                        }
                    </script>
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-lg-4 hidden-sm">
                    </div>
                    <div class="col-lg-4 text-center">
                        <small class="text-muted inline m-t-small m-b-small">共有<?php echo ($count); ?>条记录</small>
                    </div>
                    <div class="col-lg-4 text-right text-center-sm">
                        <?php echo ($page); ?>
                    </div>
                </div>
            </footer>
        </section>
    </div>
</div>


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