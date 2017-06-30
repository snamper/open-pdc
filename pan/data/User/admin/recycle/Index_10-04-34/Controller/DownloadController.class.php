<?php
namespace Index\Controller;
use Org\Tool\Comment;
use Think\Controller;

class DownloadController{
	public function index(){
		$pid = I('get.id');
		$plug = M('Plugin')->where(array('PID' => $pid))->select();
		M('Plugin')->where(array('PID' => $pid))->setInc('Downloads',1);
		$fid = $plug[0]['filefid'];
		$file = M('File')->where(array('FID' => $fid))->select();
		//����ļ��Ƿ���� 
		$filename = ROOT_PATH . $file[0]['url'];
		if (!file_exists ($filename)) {
			echo "�ļ��Ҳ���<br />\r\n".$filename;
		} else {   
			//�����ļ���ǩ   
			header("Content-type: application/x-phar");  
			header("Accept-Ranges: bytes");  
			header("Accept-Length: " . filesize($filename));  
			header("Content-Disposition: attachment; filename=" . basename($filename));  
			//����ļ�����   
			//��ȡ�ļ����ݲ�ֱ������������      
			readfile($filename);
		}
	}
	
	public function getZipLoader(){
		$filename = ROOT_PATH . '/Public/Resources/PmCZipLoader_v1.2.1.phar';
		header("Content-type: application/x-phar");  
		header("Accept-Ranges: bytes");  
		header("Accept-Length: " . filesize($filename));  
		header("Content-Disposition: attachment; filename=" . basename($filename));  
		//����ļ�����   
		//��ȡ�ļ����ݲ�ֱ������������      
		readfile($filename);
	}
	
	public function getPmcLoader(){
		$filename = ROOT_PATH . '/Public/Resources/PmCPluginLoader_v1.2.1.phar';
		header("Content-type: application/x-phar");  
		header("Accept-Ranges: bytes");  
		header("Accept-Length: " . filesize($filename));  
		header("Content-Disposition: attachment; filename=" . basename($filename));  
		//����ļ�����   
		//��ȡ�ļ����ݲ�ֱ������������      
		readfile($filename);
	}
}