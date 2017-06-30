<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>管理员后台</title>

    <!-- Bootstrap Core CSS -->
    <link href="/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/Public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link rel='stylesheet' id='msg-css'  href='/Public/css/message.css' type='text/css' media='all' />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo U('/Index/Index');?>">控制后台</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>测试信息</strong>
                                    <span class="pull-right text-muted">
                                        <em>刚刚</em>
                                    </span>
                                </div>
                                <div>空</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>读取所有信息</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>计划1</strong>
                                        <span class="pull-right text-muted">40% 已完成</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% 已完成 (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>查看所有计划</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> 新的评论
                                    <span class="pull-right text-muted small">4分钟前</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>查看所有提示</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> 设置</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> 注销</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="搜索...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo U('/Admin/Index');?>"><i class="fa fa-dashboard fa-fw"></i> 控制台</a>
                        </li>
						<li>
                            <a href="<?php echo U('/Admin/Index/Comment');?>"><i class="fa fa-comments fa-fw"></i> 评论管理</a>
                        </li>
						<li>
                            <a href="<?php echo U('/Admin/Index/User');?>"><i class="fa fa-user fa-fw"></i> 用户管理</a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-file-code-o fa-fw"></i> 插件管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('/Admin/Index/Plugin');?>"><i class="fa fa-file-code-o fa-fw"></i> 所有插件</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('/Admin/Index/PluginCheck');?>"><i class="fa fa-file-code-o fa-fw"></i> 插件审核</a>
                                </li>
                            </ul>
                        </li>
						<li>
                            <a href="<?php echo U('/Admin/Index/Setting');?>"><i class="fa fa-dashboard fa-fw"></i> 网站设置</a>
                        </li>
						<!--
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->
                        <li></li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		
		<div id="page-wrapper">
<article class="admincenter">
<!--调用布局的模板-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">插件列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            所有插件信息
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>标题</th>
                                        <th>发布用户</th>
										<th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Plug): $mod = ($i % 2 );++$i;?><tr class="odd gradeX" id="pl-<?php echo ($Plug["pid"]); ?>">
                                        <td><?php echo ($Plug["pid"]); ?></td>
                                        <td><?php echo ($Plug["title"]); ?></td>
										<td><?php echo getCanSeeName($Plug);?></td>
										<td>
											<div class="btn-group-vertical" role="group">
												<a class="btn btn-primary" href="<?php echo U('/Developer/EditPlugin/', array('pid'=>$Plug['pid']));?>">编辑</a>
												<a class="btn btn-danger" onclick="delplug('<?php echo ($Plug["pid"]); ?>')">删除</a>
											</div>
										</td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
							<script language="javascript">
							function delplug(id){
								if(confirm('你确定要删除当前插件？本操作不能被恢复！')){
									$.ajax({
										url: '<?php echo U('/Developer/DelPlugin');?>',
										async: true,
										type: 'POST',
										dataType: 'json',
										data: {id:id},
										error: function(e){
											message('error','错误',"未知原因失败");
											console.log(e);
										},
										success: function(data){
											if(data.status == '0'){
												message('success', '成功', '插件删除成功');
												$('#pl-'+id).css("background-color", "rgb(243, 190, 190)");
												$('#pl-'+id).fadeOut(300);
											} else if(data.status == '1'){
												message('error', '错误', data.message);
											} else {
												message('error', '错误', '未知原因失败');
											}
										},
									});
								}
							}
							</script>
							<?php echo ($page); ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
</article>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/Public/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/Public/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/Public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/Public/vendor/raphael/raphael.min.js"></script>
    <script src="/Public/vendor/morrisjs/morris.min.js"></script>
    <script src="/Public/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/Public/dist/js/sb-admin-2.js"></script>
	
	
	<script src="/Public/js/message.js" ></script>
	<script src="<?php echo U('/Tools/js');?>" language="JavaScript" type="text/javascript"></script>

</body>

</html>