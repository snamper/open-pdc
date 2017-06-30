<?php
namespace Index\Controller;
use Org\Tool\Comment;
use Think\Controller;
class DownloadController{
	public function index(){
		$file_name = I('get.fid').'/'.I('get.url');     //�����ļ���  
		$file_dir = ROOT_PATH.'/Public/Developer/Plugin/';        //�����ļ����Ŀ¼  
		//����ļ��Ƿ���� 
		if (!file_exists ($file_dir . $file_name)) {
			echo "�ļ��Ҳ���\r\n".$file_dir.$file_name;
			exit ();
		} else {  
			//���ļ�  
			$file = fopen ( $file_dir . $file_name, "r" );  
			//�����ļ���ǩ   
			Header ( "Content-type: application/octet-stream" );  
			Header ( "Accept-Ranges: bytes" );  
			Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
			$file_name1 = I('get.name');
			Header ( "Content-Disposition: attachment; filename=" . $file_name1 );  
			//����ļ�����   
			//��ȡ�ļ����ݲ�ֱ������������      
			echo fread ( $file, filesize ( $file_dir . $file_name ) );  
			fclose ( $file );
			exit;
		}
	}
}