<?php
include_once("config.php");

$parter			=	$_REQUEST["userId"];
$cardid			=	$_REQUEST["cardId"];
$cardpass		=	$_REQUEST["cardPass"];
$value			=	$_REQUEST["faceValue"];
$type			=	$_REQUEST["channelId"];
$callbackurl	=	$result_url;

$orderid	=	getOrderId();
$keystr	=	"parter=".$parter;
$keystr	.=	"&cardtype=".$type;
$keystr	.=	"&cardno=".$cardid;
$keystr	.=	"&cardpwd=".$cardpass;
$keystr	.=	"&orderid=".$orderid;
$keystr	.=	"&callbackurl=".$callbackurl;
$keystr	.=	"&restrict=0";
$keystr	.=	"&price=".$value;
$keystr1	=$keystr.$usersign;
$sign	=	md5($keystr1);	

var_dump($usersign);
//下面这句是提交到API
$reqURL_onLine	= $gateWary.'?'.$keystr.'&sign='.$sign;
var_dump($reqURL_onLine);
$result =	file_get_contents($reqURL_onLine); //提交
var_dump($result);

if ($result	==	'0'){	
	//提交成功处理，跳转到查询页
	header("location: $query_url?orderid=$orderid");
}else if($result	==	'-1'){  
	echo '卡号密码错误';
	
}else if($result	==	'-2'){
	echo '卡实际面值和提交时面值不符';
	
}else if($result	==	'-3'){
	echo '成功状态，但卡实际面值和提交时面值不符';
	
}else if($result	==	'-4'){
	echo '卡已经使用';
	
}else{
	echo '其它原因';
}


function getOrderId()
{
	return rand(100000,999999)."".date("YmdHis");
}
?>