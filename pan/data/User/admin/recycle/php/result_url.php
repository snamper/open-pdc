<?php 
include_once("config.php");
$orderid	=	$_REQUEST['orderid'];
$restate	=	$_REQUEST['restate'];
$ovalue	=	$_REQUEST['ovalue'];
$sign	=	$_REQUEST['sign'];	

$resultstr	=	'orderid='.$orderid;
$resultstr	.=	'&restate='.$restate;
$resultstr	.=	'&ovalue='.$ovalue.$usersign;

$keystr	=	md5($resultstr);
if($keystr	==	$sign){
	if($opstate==0){	
		echo 'ok';
		//成功返回，给用户加入金额
	}else{
		echo '-2';
}
}
?>