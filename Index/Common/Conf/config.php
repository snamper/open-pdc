<?php
return array(
    'URL_DENY_SUFFIX' => 'phar',
    'ERROR_PAGE'=>'/Public/html/404.html',
    'APPNAME'=>'Pocket Developer Center',
    'HOST'=>'http://'.$_SERVER["HTTP_HOST"].'',//主机链接
    'DEFAULT_MODULE'     => 'Index', //默认模块
    'MODULE_ALLOW_LIST' => array('Index','Admin'),
    'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
//    'SHOW_PAGE_TRACE'  => true,
    'DEFAULT_MODULE' => 'Index',//设置默认模块Index
    'URL_CASE_INSENSITIVE' =>true,//表示不用遵守大小写
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型

    'DB_HOST'   => '10.248.133.135', // 服务器地址
    'DB_NAME'   => 'mysql36630595_db', // 数据库名
    'DB_USER'   => 'mysql36630595', // 用户名
    'DB_PWD'    => 'Mcleague2333#', // 密码

    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'pdc_', // 数据库表前缀
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
    
    'PHAR_API' => 'http://mc.mctpa.net:8080/tools/phar/api.php',
);