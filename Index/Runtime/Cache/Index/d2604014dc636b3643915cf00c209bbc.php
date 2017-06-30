<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title><?php echo ($Data['title']); ?></title>
		<style>
		.center{
		    position: absolute;
		    top: 0;
		    width: 100%;
		    text-align: center;
		    color: #fff;
		}
.jumbotron {
	  height: 100%;
	  position: relative;
	  padding: 40px 0;
	  color: #fff;
	  text-align: center;
	  text-shadow: 0 1px 3px rgba(0,0,0,.4),0 0 30px rgba(0,0,0,.075);
	  background: #020031;
	  background: -moz-linear-gradient(45deg,#020031 0,#6d3353 100%);
	  background: -webkit-gradient(linear,left bottom,right top,color-stop(0%,#020031),color-stop(100%,#6d3353));
	  background: -webkit-linear-gradient(45deg,#020031 0,#6d3353 100%);
	  background: -o-linear-gradient(45deg,#020031 0,#6d3353 100%);
	  background: -ms-linear-gradient(45deg,#020031 0,#6d3353 100%);
	  background: linear-gradient(45deg,#020031 0,#6d3353 100%);
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#020031', endColorstr='#6d3353', GradientType=1);
	  -webkit-box-shadow: inset 0 3px 7px rgba(0,0,0,.2),inset 0 -3px 7px rgba(0,0,0,.2);
	  -moz-box-shadow: inset 0 3px 7px rgba(0,0,0,.2),inset 0 -3px 7px rgba(0,0,0,.2);
	  box-shadow: inset 0 3px 7px rgba(0,0,0,.2),inset 0 -3px 7px rgba(0,0,0,.2);
	}
.jumbotron:after {
  content: '';
  display: block;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: url('/Public/images/bs-docs-masthead-pattern.png') repeat center center;
  opacity: .4;
}
html{
	  font: 100% 微软雅黑,"Helvetica Neue",Helvetica,Arial,sans-serif;
}
body{
	margin: 0;
	height: 100%;
}
.btn-lg.btn-shadow {
  padding: 13px 35px 17px;
}
.btn-danger.btn-shadow {
  -webkit-box-shadow: inset 0 -4px 0 #962A2A;
  box-shadow: inset 0 -4px 0 #962A2A;
  border: 0;
  color: #fff;
}
.btn-primary.btn-shadow {
  -webkit-box-shadow: inset 0 -4px 0 #2a6496;
  box-shadow: inset 0 -4px 0 #2a6496;
  border: 0;
  color: #fff;
}
.jumbotron a {
  color: #fff;
  color: rgba(255,255,255,.5);
  -webkit-transition: all .2s ease-in-out;
  -moz-transition: all .2s ease-in-out;
  transition: all .2s ease-in-out;
}
.btn-group-lg>.btn, .btn-lg {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
  border-radius: 6px;
}
.btn-danger {
  color: #fff;
  background-color: #d9534f;
  border-color: #d43f3a;
}
.btn-primary {
  color: #fff;
  background-color: #337ab7;
  border-color: #2e6da4;
}
.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 30px;
  font-weight: 400;
  line-height:2;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}
[role=button] {
  cursor: pointer;
}
a {
  color: #337ab7;
  text-decoration: none;
}
a {
  background-color: transparent;
}
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.btn {
  color: #fff;
  color: rgba(255,255,255,.5);
  -webkit-transition: all .2s ease-in-out;
  -moz-transition: all .2s ease-in-out;
  transition: all .2s ease-in-out;
}
.btn-danger.active, .btn-danger.focus, .btn-danger:active, .btn-danger:focus, .btn-danger:hover, .open>.dropdown-toggle.btn-danger {
  color: #fff;
  background-color: #c9302c;
  border-color: #ac2925;
}
.btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open>.dropdown-toggle.btn-primary {
  color: #fff;
  background-color: #286090;
  border-color: #204d74;
}
.btn.focus, .btn:focus, .btn:hover {
  text-decoration: none;
}
a:focus, a:hover {
  color: #23527c;
  text-decoration: underline;
}
a:active, a:hover {
  outline: 0;
}
.left{
	float: left;
	  width: 50%;
}
.right{
	float: right;
	  width: 50%;
}
.cent{
		text-align: center;
		max-width: 1024px;
		margin: 0 auto;
}
</style>
	</head>
	<body>
		<div class="jumbotron"></div>
		<div class="center"><h1 style="font-size: 150px;font-weight: 100;"><?php echo ($Data['title']); ?></h1>
		<div class="cent">
			<div class="left"><a class="btn btn-lg btn-primary btn-shadow" href="/index/login/logout/check/yes" role="button"><?php echo ($Data['button']['yes']); ?></a></div>
			<div class="right"><a class="btn btn-lg btn-danger btn-shadow" href="/index/login/logout/check/no" role="button"><?php echo ($Data['button']['no']); ?></a></div>
			</div>
		</div>
	</body>
</html>