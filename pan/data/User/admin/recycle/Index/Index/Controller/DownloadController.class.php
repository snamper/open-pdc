<?php
namespace Index\Controller;
use Org\Tool\Comment;
use Think\Controller;
class DownloadController{
	public function index(){
		$file_name = I('get.fid').'/'.I('get.url');     //下载文件名  
		$file_dir = ROOT_PATH.'/Public/Developer/Plugin/';        //下载文件存放目录  
		//检查文件是否存在 
		if (!file_exists ($file_dir . $file_name)) {
			echo "文件找不到\r\n".$file_dir.$file_name;
			exit ();
		} else {  
			//打开文件  
			$file = fopen ( $file_dir . $file_name, "r" );  
			//输入文件标签   
			Header ( "Content-type: application/octet-stream" );  
			Header ( "Accept-Ranges: bytes" );  
			Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
			$file_name1 = I('get.name');
			Header ( "Content-Disposition: attachment; filename=" . $file_name1 );  
			//输出文件内容   
			//读取文件内容并直接输出到浏览器      
			echo fread ( $file, filesize ( $file_dir . $file_name ) );  
			fclose ( $file );
			exit;
		}
	}
}