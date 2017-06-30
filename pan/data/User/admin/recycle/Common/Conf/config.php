<?php
return array(
    'KaPay'=>array(
        'userId'=>"qxka_ID", //点卡id
        'userSign'=>"qxka_Sign", //点卡Sign
        'gateWary'=>'http://gwback.qxka.com/interface/CardReceive.aspx',
        'result_url'=>"http://".$_SERVER["HTTP_HOST"]."/orderka/notify/"
    ),
    'PluginUpdata' => array(
        'version' => '1.0.2', 
        'info'=>'修改很多模块'
        ),
    'URL_DENY_SUFFIX' => 'phar',
    'ERROR_PAGE'=>'/Public/html/404.html',
    'APPNAME'=>'MCTL',
    'HOST'=>'http://'.$_SERVER["HTTP_HOST"].'/',//主机链接
    'DEFAULT_MODULE'     => 'Index', //默认模块
    'MODULE_ALLOW_LIST' => array('Index','Admin'),
    'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
//    'SHOW_PAGE_TRACE'  => true,
    'DEFAULT_MODULE' => 'Index',//设置默认模块Index
    'URL_CASE_INSENSITIVE' =>true,//表示不用遵守大小写
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型



    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'mchub', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码

    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'mcs_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    //邮件配置
    'THINK_EMAIL' => array(
        'SMTP_HOST'   => 'smtp.126.com', //SMTP服务器
        'SMTP_PORT'   => '25', //SMTP服务器端口
        'SMTP_USER'   => 'mcleague@126.com', //SMTP服务器用户名
        'SMTP_PASS'   => 'mcleague2333', //SMTP服务器密码
        'FROM_EMAIL'  => 'mcleague@126.com', //发件人EMAIL
        'FROM_NAME'   => 'MC技术联盟', //发件人名称
        'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
        'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
    ),
//    数据缓存方式
    'DATA_CACHE_TYPE' =>'File',
    'DATA_CACHE_PREFIX'=>'cache',
    'DATA_CACHE_KEY'=>'MCSSomeCache233',
    //极客验证
    'CAPTCHA_ID'=>'d9e603ff1682d5706ccdd14685912d01',
    'PRIVATE_KEY'=>'9f29406201c90983faeaa7e73731fdd3',
    'KF5CONFIG'=>array(
        'yourDomain'=>'mctl',
        'email' => 'mcleague@126.com',//这里为发起人的邮箱
        'token'=>'TOKEN',
        'password' => 'mcleague2333',
    )
);