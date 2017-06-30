<?php
//header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
//header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
date_default_timezone_set("Asia/chongqing");
error_reporting(E_ERROR);
header("Content-Type: text/html; charset=utf-8");

$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
$action = $_GET['action'];

switch ($action) {
    case 'config':
        $result =  json_encode($CONFIG);
        break;

    /* 上传图片 */
    case 'uploadimage':
    /* 上传涂鸦 */
    case 'uploadscrawl':
    /* 上传视频 */
    case 'uploadvideo':
    /* 上传文件 */
    case 'uploadfile':
        $result = include("action_upload.php");
        break;

    /* 列出图片 */
    case 'listimage':
        $result = include("action_list.php");
        break;
    /* 列出文件 */
    case 'listfile':
        $result = include("action_list.php");
        break;

    /* 抓取远程文件 */
    case 'catchimage':
        $result = include("action_crawler.php");
        break;

    default:
        $result = json_encode(array(
            'state'=> '请求地址出错'
        ));
        break;
}

if ($action == "del") {
    $fileName = $_POST['fileName'];
    foreach($paths as $path) {
        $str1 = delfiles($fileName, $path);
        break;
    }
}

function delfiles($fileName, $path, &$files = array()) {
    if (!is_dir($path)) return null;
    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path2 = $path.'/'.$file;
            if (is_dir($path2)) {
                delfiles($fileName, $path2, $files);
            } else {
                if (preg_match("/\.(gif|jpeg|jpg|png|bmp)$/i", $file)) {
                    $path3 = str_replace('../../', '/static/', $path2);
                    $fileImg = basename($path3);
                    if ($fileImg == $fileName) {
                        $is_del = unlink($path2);
                    }
                }
            }
        }
    }
}

/* 输出结果 */
if (isset($_GET["callback"])) {
    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
        echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
    } else {
        echo json_encode(array(
            'state'=> 'callback参数不合法'
        ));
    }
} else {
    echo $result;
}