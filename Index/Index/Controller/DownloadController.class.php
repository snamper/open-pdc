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
		$file = M('File')->where(array('FID' => $fid))->find();
		if($file['mode'] == 2){
			if(preg_match('/\.pmc$/', $file['filename'])){
				$path = ROOT_PATH . '/Public/Developer/Plugin/' . $file['uid'] . '/';
				$path .= str_replace('.pmc', '', $file['filename']);
				
				if(file_exists($path . '.zip')){
					$filename = $path . '.zip';
					$outname = basename($filename);
				} elseif(file_exists($path . '.phar')){
					$filename = $path . '.phar';
					$outname = basename($filename);
				}
			}
		} elseif($file['mode'] == 3){
			$filename = ROOT_PATH . '/' .  $file['url'];
			$outname = $file["filename"];
		} elseif($file['mode'] == 4){
			if(I('get.choose') == 'zip'){
				$filename = ROOT_PATH . '/' .  $file['url'] . '.zip';
				$outname = $file['filename'] . '.zip';
			} else {
				$filename = ROOT_PATH . '/' .  $file['url'] . '.phar';
				$outname = $file['filename'] . '.phar';
			}
		} else {
			$filename = ROOT_PATH . '/' . $file['url'];
			$outname = $file['filename'];
		}
		//����ļ��Ƿ���� 
		if (!file_exists ($filename)) {
			echo "文件不存在<br />\r\n".$filename;
		} else {   
			//�����ļ���ǩ   
			header("Content-type: application/octet-stream");  
			header("Accept-Ranges: bytes");  
			header("Accept-Length: " . filesize($filename));  
			header("Content-Disposition: attachment; filename=" . $outname);  
			//����ļ�����   
			//��ȡ�ļ����ݲ�ֱ����������      
			readfile($filename);
		}
	}
	
	public function getZipLoader(){
		$filename = ROOT_PATH . '/Public/Resources/PmCZipLoader_v1.2.1.phar';
		header("Content-type: application/octet-stream");  
		header("Accept-Ranges: bytes");  
		header("Accept-Length: " . filesize($filename));  
		header("Content-Disposition: attachment; filename=" . basename($filename));  
		//����ļ�����   
		//��ȡ�ļ����ݲ�ֱ����������      
		readfile($filename);
	}
	
	public function getPmcLoader(){
		$filename = ROOT_PATH . '/Public/Resources/PmCPluginLoader.phar';
		header("Content-type: application/octet-stream");  
		header("Accept-Ranges: bytes");  
		header("Accept-Length: " . filesize($filename));  
		header("Content-Disposition: attachment; filename=" . basename($filename));  
		//����ļ�����   
		//��ȡ�ļ����ݲ�ֱ����������      
		readfile($filename);
	}
}