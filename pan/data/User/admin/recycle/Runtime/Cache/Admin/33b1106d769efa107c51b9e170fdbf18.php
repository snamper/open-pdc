<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转中</title>
<style type="text/css">
body{
	background:url('/Public/images/404.png');
	margin:0; padding:0; overflow:hidden; height:100%;
	font-family: "微软雅黑";
}

* { margin:0; padding:0;}
#test{
	width:400px;
	height:400px;
	position:absolute;
	left:50%;
	top:50%;
	margin:-200px 0 0 -200px;
	color: #ffffff;
	font-size: 28px;
}
.text{
	font-size: 25px;
	color: #ffffff;
	text-shadow: #8a8a8a 8px 8px 0;
	line-height:80px;
	text-align:center;
}
#button{
	width: 385px;
	height: 80px;
	background:url('/Public/images/button.png') no-repeat;
	outline: none;
}
#button:active{
	background:url('/Public/images/buttonhover.png') no-repeat;
	outline:none;
}
</style>
	<script type="text/javascript">
		function makeItMiddle() {
			document.getElementById('test').style.marginTop = (document.getElementsByTagName('body')[0].offsetHeight - document.getElementById('test').offsetHeight) / 2 + 'px';
		}
		window.onload = makeItMiddle;
		window.onresize = makeItMiddle;
	</script>
</head>
<body>
<div id="test" style="background-color: #B2B2B2;padding: 10px;border-radius: 5px;>
	<p class="text" ><?php if(isset($message)) {?>
		<h1>成功！</h1>
		<p class="success"><?php echo($message); ?></p>
		<?php }else{?>
		<h1>抱歉。</h1>
		<p class="error"><?php echo($error); ?></p>
		<?php }?></p>
	<p class="jump">
		页面自动会在<b id="wait"><?php echo($waitSecond); ?></b>秒后自动转跳转
	</p><br>
	<a id="href" href="<?php echo($jumpUrl); ?>"><button id="button"></button></a>
</div>
<script type="text/javascript">
	(function(){
		var wait = document.getElementById('wait'),href = document.getElementById('href').href;
		var interval = setInterval(function(){
			var time = --wait.innerHTML;
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
	})();
</script>
</body>
</html>