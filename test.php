<?php
set_time_limit(300);
ignore_user_abort();
$url = 'http://dev.xcraft.org/uccr.php';
//初始化
    $curl = curl_init();
    //设置抓取的url
    //curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 1);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //设置post方式提交
    $i = 0;
    while(true){
    //curl_setopt($curl, CURLOPT_POST, 1);
    //设置post数据
    $post_data = array(
        'yzn' =>  '123456',
        "un" =>  $i.time().rand(0,100),
        "up" => md5($i.time()),
        'yz' => '123456',
        );
    //curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl, CURLOPT_URL, $url.'?'.http_build_query($post_data));
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
     $i ++;
    //break;
    }
    curl_close($curl);
    //显示获得的数据
    print_r($data);