
<?php
//查询订单$orderid是否已经成功如果成功，如果成功则：

$showstr = '订单成功！';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--刷新代码-->
<meta http-equiv="refresh" content="300">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <title>充值中心</title>   
       <script src="//libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>

       <style type="text/css">
<!--
.STYLE1 {
	color: #CC6600;
	font-weight: bold;
	font-size: 24px;
}
.STYLE2 {color: #FF0000}
.STYLE3 {
	color: #CC6600;

	font-size: 18px;
}
-->
       </style>
</head>
<body>

				
				<span class="STYLE3">订单状态：<?php echo $showstr; ?></span><br><br>
				<span class="STYLE3">提示：页面每5分钟刷新一次，也可以<a href="javascript:window.location.reload();">手动刷新</a>。如一直处于“处理中”状态，请联系客服。</span>

	
	

</body>
</html>
