<?php
function getUserMessageNumber($user){
    $Message = new \Org\Tool\Message($user['uid']);
    $count = $Message->GetAllCountWithState();
    if($count !=='0'){
        return '<div class="uk-badge uk-badge-danger uk-badge-notification">'.$count.'</div>';
    }else{
        return '';
    }
}

function createLinkToCheck(array $data){
    $outData = '';
    $url = C('HOST');
    foreach($data as $one){
        $outData .= "<a style='margin-right: 5px;float: left;color: blue;' target='_blank' href='{$url}{$one[1]}'>{$one[0]}:{$url}{$one[1]}</a><br>";
    }
    return $outData;
}

function getPluginReview($sid){//获取插件审核状态
    return \Org\Tool\PluginAuthorization::getPluginReview($sid);
}

function getServerReview($sid){//获取插件审核状态
    return \Org\Tool\PluginAuthorization::getServerReview($sid);
}

function getPluginComments($id){
	$t = new \Org\Tool\Comment();
	return $t->getCommentCountWithPage($id);
}

function utf8_substr($str, $start=0, $length, $charset="utf-8", $suffix="")
{
    if(function_exists("mb_substr")){
        return mb_substr($str, $start, $length, $charset).$suffix;
    }
    elseif(function_exists('iconv_substr')){
        return iconv_substr($str,$start,$length,$charset).$suffix;
    }
    $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    return $slice.$suffix;
}

function utf8_strlen($string = null) {
// 将字符串分解为单元
    preg_match_all("/./us",$string, $match);
// 返回单元个数
    return count($match[0]);
}

function getCanSeeName($data){
    if(isset($data['data']['nickname']) and !empty($data['data']['nickname'])){
        return $data['data']['nickname'];
    }else{
        return $data['username'];
    }
}

function i_array_column($input, $columnKey, $indexKey=null){
    if(!function_exists('array_column')){
        $columnKeyIsNumber  = (is_numeric($columnKey))?true:false;
        $indexKeyIsNull            = (is_null($indexKey))?true :false;
        $indexKeyIsNumber     = (is_numeric($indexKey))?true:false;
        $result                         = array();
        foreach((array)$input as $key=>$row){
            if($columnKeyIsNumber){
                $tmp= array_slice($row, $columnKey, 1);
                $tmp= (is_array($tmp) && !empty($tmp))?current($tmp):null;
            }else{
                $tmp= isset($row[$columnKey])?$row[$columnKey]:null;
            }
            if(!$indexKeyIsNull){
                if($indexKeyIsNumber){
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && !empty($key))?current($key):null;
                    $key = is_null($key)?0:$key;
                }else{
                    $key = isset($row[$indexKey])?$row[$indexKey]:0;
                }
            }
            $result[$key] = $tmp;
        }
        return $result;
    }else{
        return array_column($input, $columnKey, $indexKey);
    }
}

function readYml($file) {
    vendor('spyc.Spyc');
    return Spyc::YAMLLoad($file);
}

function UrlLike($url,$echo =''){
    $new = __SELF__;
    $newback = substr($new,-5);
    $new = $newback == '.html'?$new:$new.'.html';
    $urlBack = substr($url,-5);
    $url = $urlBack == '.html'?$url:$url.'.html';
    if($echo and $new == $url){
        return $echo;
    }
    return $new == $url?true:false;
}

/**获取头部信息
 * @return string
 */
function getHeader()
{
    $headers = '';
    foreach ($_SERVER as $name => $value)
    {
        if (substr($name, 0, 5) == 'HTTP_')
        {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
}


/**生成GUID
 * @return string
 */
function getGuid() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);
    $uuid = substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12);
    return $uuid;
}

/**检测ip
 * @param $ip，数据
 * @return mixed，
 */
function CheckIP($ip){
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return true;
    }else {
        return false;
    }
}
/**删除一个商品
 * @param $Data，用户数据
 * @param $SIndex，商品的index序号
 * @return bool，是否成功
 */
function DelShop(&$Data,$SIndex){
    $UserData = &$Data;
    if($SIndex and $UserData){
        unset($UserData['hasshop'][$SIndex]);
        $Update = CJson($UserData['hasshop']);
        return M('User')->where("uid = {$UserData['uid']}")->cache(true)->setField('HasShop',$Update);
    }
    return false;
}
function getSuperAdmin(){
    $SuperAdmin = M('User')->where('action = 11')->find();
    if(!$SuperAdmin){
        $Data = array('UID'=>'0','Action' => '11','UserName'=>'Null','PassWord'=>'Null','Money'=>'0','LastLoginTime'=>'0000-00-00');
        $SuperAdmin = M('User')->data($Data)->add();
    }
    return $SuperAdmin;
}

function getSuperAdminId(){
    $SuperAdmin = M('User')->where('action = 11')->find();
    if(!$SuperAdmin){
        $Data = array('UID'=>'0','Action' => '11','UserName'=>'Null','PassWord'=>'Null','Money'=>'0','LastLoginTime'=>'0000-00-00');
        $SuperAdmin = M('User')->data($Data)->add();
    }else{
        $SuperAdmin = $SuperAdmin['uid'];
    }
    return $SuperAdmin;
}

/**返回开发者等级函数
 * @param $Data，数据源
 * @param int $UID，否则用UID
 * @return string，返回开发者等级
 */
function GetDeveloperLevel($Data,$UID = 0){
    if($UID !== 0){
       $Data =  M('User')->where("uid = '{$UID}'")->cache()->find();
    }
    if($Data){
        switch ((int)$Data['action']){
            case 2:
                return '普通用户';
            case 3:
                return '初级用户';
            case 4:
                return '中级用户';
            case 5:
                return '高级用户';
            case 10:
                return '管理员';
            case 11:
                return 'ROOT管理员';
            default:
                return '用户';
        }
    }
    return null;
}
/**
 * @param $Data,数据源
 * @param bool $IsJson，是否为json数据
 * @return mixed|string，返回处理后的数据
 */
function CJson(&$Data,$IsJson = false){
    if($IsJson == true){
        $Data = json_decode($Data,true);
        return $Data;
    }else{
        return json_encode($Data);
    }
}

/**获取SID商品的tags，返回数组
 * @param array|bool $HaveData
 * @param int $SID
 * @return array
 */
function GetTags($HaveData = false,$SID = 0){
    $SID = (int)$SID;
    if($HaveData){
        $Shop = $HaveData;
    }else{
        $Shop = M('Posts')->where("id ={$SID}")->find();
    }
    $Tags = $Shop['tags'];
    $Tags = substr($Tags,1,-1);
    $Tags = explode(',',$Tags);
    return $Tags;
}

/**获取SID商品的catalog，返回数组
 * @param array|bool $HaveData
 * @param int $SID
 * @return array
 */
function GetCatalog($HaveData = false,$SID = 0){
    $SID = (int)$SID;
    if($HaveData){
        $Shop = $HaveData;
    }else{
        $Shop = M('Posts')->where("id ={$SID}")->find();
    }
    $Tags = $Shop['catalog'];
    $Tags = substr($Tags,1,-1);
    $Tags = explode(',',$Tags);
    return $Tags;
}

/**用来获取ueditor第一张图片的函数
 * @param $content
 * @return string
 */
function getPic($content)
{
    if (preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $matches)) {
        $str = $matches[3][0];
        return $str;
    }else{
        return false;
    }
}

function getOtherPic($content)
{
    if (preg_match_all("/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i", str_ireplace("\\","",$content), $matches)) {
        $str = $matches[1];
        return $str;
    }else{
        return false;
    }
}

/**七牛加密函数
 * @param $str
 * @return mixed
 */
function Qiniu_Encode($str) // URLSafeBase64Encode
{
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($str));
}

/**获取私有空间的附件下载地址
 * @param $url
 * @return string
 */
function Qiniu_Sign($url) {//$info里面的url
    $setting = C ( 'UPLOAD_SITTING_QINIU' );
    $duetime = NOW_TIME + 600;//下载凭证有效时间
    $DownloadUrl = $url . '?e=' . $duetime;
    $Sign = hash_hmac ( 'sha1', $DownloadUrl, $setting ["driverConfig"] ["secrectKey"], true );
    $EncodedSign = Qiniu_Encode ( $Sign );
    $Token = $setting ["driverConfig"] ["accessKey"] . ':' . $EncodedSign;
    $RealDownloadUrl = $DownloadUrl . '&token=' . $Token;
    return $RealDownloadUrl;
}

/**设置登录的cookie和session
 * @param $UID ,用户UID
 * @param $Name ,用户名
 * @param int $Time ，保存时间，分钟计算
 * @return bool,是否成功
 */
function SetLogin($UID,$Name,$Time = 60){
        if(empty($UID))
            return false;
        $User = M('User');
        $Lock['IfLock'] = get_client_ip();
        $Lock['LastLoginTime'] = NowDate();
        $User->where("UID = '{$UID}'")->save($Lock);
        session('UserName',$Name);
        session('UID',$UID);
        cookie('UserName',$Name,$Time*60);
        $Data = array('UserName'=>$Name,'UID'=>$UID);
        $Data = json_encode($Data);
        $Data = AuthCode($Data,'ENCODE',$Name,0);
        $tmp['value'] = $Data;
        cookie('Data',$tmp,$Time*60);
        cookie('SaveTime',$Time,$Time*60);
        cookie('cart',null);
        return true;
}

if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
        . ($postname ?: basename($filename))
        . ($mimetype ? ";type=$mimetype" : '');
    }
}

/**
 * @return bool，是否登录了
 */
function IfLogin(){
    if(cookie('UserName') == ''){
        return false;
    }
        $time =  cookie('SaveTime');
        $UserName = cookie('UserName');
        $CheckData = cookie('Data');
        $CheckData = AuthCode($CheckData['value'],'DECODE',$UserName,0);
        $CheckData = json_decode($CheckData,true);
        $User = M('User')->where($CheckData)->find();
        if($User['userstate']=='1'){
            cookie('Data',null);
            cookie('UserName',null);
            session('UserName',null);
            session('UID',null);
            return false;
        }
        if($CheckData['UserName'] == $UserName and $User){
            /*if($User['iflock'] !== get_client_ip()){
                cookie(null);
                session('UserName',null);
                session('UID',null);
                return false;
            }*/
            session('UserName',$CheckData['UserName']);
            session('UID',$CheckData['UID']);
            cookie('UserName',$CheckData['UserName'],$time*60);
            $Data = array('UserName'=>$CheckData['UserName'],'UID'=>$CheckData['UID']);
            $Data = json_encode($Data);
            $Data = AuthCode($Data,'ENCODE',$CheckData['UserName'],0);
            $tmp['value'] = $Data;
            cookie('Data',$tmp,$time*60);
            cookie('SaveTime',$time,$time*60);
            return $CheckData;
        }else{
            cookie('Data',null);
            cookie('UserName',null);
            session('UserName',null);
            session('UID',null);
            return false;
        }
}

/**
 * 来自dz的加密函数
 * @param string $string 要加密的源码
 * @param string $operation 加密还是解密，默认是解密
 * @param string $key 钥匙
 * @param int $expiry 有效期
 * @return string 返回密文
 */
function AuthCode($string, $operation = 'DECODE', $key, $expiry = 0) {
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length):
        substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) :
        sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) &&
            substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}

/**
 * 系统邮件发送函数
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
 /*
function send_mail($to, $name, $subject = '', $body = '', $attachment = null) {
      $url = 'http://sendcloud.sohu.com/webapi/mail.send.json';
      $API_USER = '2300206764';
      $API_KEY = 'dlZbjKkU6KWNqJVk';

      //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
      $param = array(
          'api_user' => $API_USER,
          'api_key' => $API_KEY,
          'from' => 'mcleague@126.com',
          'fromname' => 'MCTL平台',
          'to' => $to,
          'subject' => $subject ,
          'html' => $body,
          'resp_email_id' => 'true');
      
      $data = http_build_query($param);

      $options = array(
          'http' => array(
              'method'  => 'POST',
              'header' => 'Content-Type: application/x-www-form-urlencoded',
              'content' => $data
      ));

      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      return $result;
    }*/
function send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = C('THINK_EMAIL');
    vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
    $mail             = new \Vendor\PHPMailer(); //PHPMailer对象
    vendor('PHPMailer.class#smtp');
    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();  // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
//    $mail->SMTPSecure = 'ssl';                 // 使用安全协议
    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
    $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject    = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}


/**
 * 获取当前日期（当初给记录数据库）
 * @return string
 */
function NowDate(){
    $date = date("Y-m-d");
    return $date;
}

function NowDateTime(){
    $date = date("Y-m-d h:i:sa");
    return $date;
}
//TODO:阿里函数更新就来这
/**阿里的一堆函数
 * @param $code，验证码
 * @param string $id，指定验证码
 * @return bool，是否正确
 */
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function md5Sign($prestr, $key) {
    $prestr = $prestr . $key;
    return md5($prestr);
}

/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * @param $key 私钥
 * return 签名结果
 */
function md5Verify($prestr, $sign, $key) {
    $prestr = $prestr . $key;
    $mysgin = md5($prestr);

    if($mysgin == $sign) {
        return true;
    }
    else {
        return false;
    }
}


/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstring($para) {
    $arg  = "";
    while (list ($key, $val) = each ($para)) {
        $arg.=$key."=".$val."&";
    }
    //去掉最后一个&字符
    $arg = substr($arg,0,count($arg)-2);

    //如果存在转义字符，那么去掉转义
    if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    return $arg;
}
/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstringUrlencode($para) {
    $arg  = "";
    while (list ($key, $val) = each ($para)) {
        $arg.=$key."=".urlencode($val)."&";
    }
    //去掉最后一个&字符
    $arg = substr($arg,0,count($arg)-2);

    //如果存在转义字符，那么去掉转义
    if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    return $arg;
}
/**
 * 除去数组中的空值和签名参数
 * @param $para 签名参数组
 * return 去掉空值与签名参数后的新签名参数组
 */
function paraFilter($para) {
    $para_filter = array();
    while (list ($key, $val) = each ($para)) {
        if($key == "sign" || $key == "sign_type" || $val == "")continue;
        else	$para_filter[$key] = $para[$key];
    }
    return $para_filter;
}
/**
 * 对数组排序
 * @param $para 排序前的数组
 * return 排序后的数组
 */
function argSort($para) {
    ksort($para);
    reset($para);
    return $para;
}
/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function logResult($word='') {
    $fp = fopen("log.txt","a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}

/**
 * 远程获取数据，POST模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
 * @param $url 指定URL完整路径地址
 * @param $cacert_url 指定当前工作目录绝对路径
 * @param $para 请求的数据
 * @param $input_charset 编码格式。默认值：空值
 * return 远程输出的数据
 */
function getHttpResponsePOST($url, $cacert_url, $para, $input_charset = '') {
    if (trim($input_charset) != '') {
        $url = $url."_input_charset=".$input_charset;
    }
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
    curl_setopt($curl, CURLOPT_CAINFO,$cacert_url);//证书地址
    curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    curl_setopt($curl,CURLOPT_POST,true); // post传输数据
    curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
    $responseText = curl_exec($curl);
//    var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}

/**
 * 远程获取数据，GET模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
 * @param $url 指定URL完整路径地址
 * @param $cacert_url 指定当前工作目录绝对路径
 * return 远程输出的数据
 */
function getHttpResponseGET($url,$cacert_url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
    curl_setopt($curl, CURLOPT_CAINFO,$cacert_url);//证书地址
    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}

/**
 * 实现多种字符编码方式
 * @param $input 需要编码的字符串
 * @param $_output_charset 输出的编码格式
 * @param $_input_charset 输入的编码格式
 * return 编码后的字符串
 */
function charsetEncode($input,$_output_charset ,$_input_charset) {
    $output = "";
    if(!isset($_output_charset) )$_output_charset  = $_input_charset;
    if($_input_charset == $_output_charset || $input ==null ) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
    } elseif(function_exists("iconv")) {
        $output = iconv($_input_charset,$_output_charset,$input);
    } else die("sorry, you have no libs support for charset change.");
    return $output;
}
/**
 * 实现多种字符解码方式
 * @param $input 需要解码的字符串
 * @param $_output_charset 输出的解码格式
 * @param $_input_charset 输入的解码格式
 * return 解码后的字符串
 */
function charsetDecode($input,$_input_charset ,$_output_charset) {
    $output = "";
    if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
    if($_input_charset == $_output_charset || $input ==null ) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
    } elseif(function_exists("iconv")) {
        $output = iconv($_input_charset,$_output_charset,$input);
    } else {
		die("sorry, you have no libs support for charset changes.");
	}
    return $output;
}

//TODO:阿里函数结束。


//得到顶部公告
function getHeaderNotice(){
    return \Org\Tool\AdminTool::getHeaderNotice();
}