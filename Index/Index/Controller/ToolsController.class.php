<?php
namespace Index\Controller;

use Think\Controller;
use Phar;
use ZipArchive;
use SQLite3;
use CURLFile;

class Files extends SQLite3{
	public function __construct($file){
		$this->open($file);
	}
}

class ToolsController extends Controller {
    public function UploadPhar(){
        $User = IfLogin();
        if($User){
            $MUser = M('User');
            $UserData = $MUser->where($User)->find();
			$file = $_FILES['file'];
			$subname = $this->getSubname($file['name']);
			if($subname != ''){
				$path = 'Public/Developer/Plugin/'.$UserData['uid'];
				if(!file_exists($path) || !is_dir($path)){
					@mkdir($path, 0777, true);
				}
				$path .= '/';
				$filebasename = ROOT_PATH . '/' . $path . md5($file['name']);
				$fileurl = $path . md5($file['name']);
				switch(I('post.mode')){
					case 'default':
						$mode = 3;
						break;
					default:
						$mode = 4;
				}
				
				$Data = [
					'Mode' => $mode,
					'UID' => $UserData['uid'],
					'FileMd5' => md5_file($file['tmp_name']),
				];
				
				$find = M('File')->where($Data)->find();
				if($find){ //文件存在的话就直接选择
					$FileId = $find['fid'];
					$this->ajaxreturn(['id'=>$FileId]);
				} else { //上传文件的处理
					copy($file['tmp_name'], $filebasename . '.' . $subname);
					if($mode == 4){ //如果不是原文件模式的处理
						switch($subname){
							case 'phar':
								$this->toZip($filebasename . '.' . $subname);
								break;
							case 'zip':
								$this->toPhar($filebasename . '.' . $subname);
								break;
							default:
								return false;
						}
						$filename = preg_replace('/\.[a-zA-Z0-9]{3,10}$/', '', $file['name']);
					} else {
						$fileurl .= '.' . $subname;
						$filename = $file['name'];
					}
					//插入数据表
					$File = M('File');
					$FileData = [
						'UID' => $UserData['uid'],
						'Mode' => $mode,
						'FileName' => $filename,
						'FileMd5' => md5_file($file['tmp_name']),
						'Url' => $fileurl,
					];
					
					if($File->create($FileData)){
						$FileId = $File->add();
						$this->ajaxreturn(['id'=>$FileId]);
					}
				}
			}
		}
	}
	
	public function toPhar($file){
		$api = C('PHAR_API').'?mode=upload&wait';
		$savename = str_replace('.zip', '.phar', $file);
		if(file_exists($savename)){
			@unlink($savename);
		}
		$fp = fopen($savename, 'w');
		$ch = curl_init();
		$data = [
			'file' => new CURLFile($file),
		];
		$option = [
			CURLOPT_URL => $api,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (PHP 5.6; PDC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'
		];
		curl_setopt_array($ch, $option);
		$ret = curl_exec($ch);
		$ret = json_decode($ret, true);
		$option = [
			CURLOPT_URL => C('PHAR_API') . str_replace('api.php', '', $ret['url']),
			CURLOPT_RETURNTRANSFER => false,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (PHP 5.6; PDC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36',
			CURLOPT_FILE => $fp,
		];
		curl_setopt_array($ch, $option);
		$ret = curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		return $ret;
	}
	
	public function toZip($file){
		$phar = new Phar($file);
		$phar->convertToData(Phar::ZIP);
		return true;
	}
	
	public function getSubname($path){
		$path = basename($path);
		if(preg_match('/\./', $path)){
			return end(explode('.', $path));
		} else {
			return '';
		}
	}

    public function upImg(){
        $User = IfLogin();
        if($User) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Public/ckfinder/userfiles/images'; // 设置附件上传根目录
            $upload->subName = $User['UID'].'/'.I('post.sid').'/'; // 设置附件上传（子）目录
            // 上传文件
            $info = $upload->upload();
            if (!$info) {// 上传错误提示错误信息
                $this->ajaxreturn($upload->getError());
            } else {// 上传成功
                echo "<script type=\"text/javascript\">";
				echo 'window.parent.CKEDITOR.tools.callFunction('.$_GET['CKEditorFuncNum'].',"/Public/ckfinder/userfiles/images'.$info['upload']['savepath'].$info['upload']['savename'].'","")';
				echo '</script>';
            }
        }
    }
	
	public function js(){
		header('Content-Type: application/javascript');
		$this->display('Tool/js');
	}

	public function keyword(){
		$wd = I('get.wd');
		$map['_string'] = "concat (content) like '%".$wd."%'";
		$data = M('Tags')->where($map)->order('tid desc')->page(0,6)->select();
		$ret = array();
		foreach($data as $one){
			$ret[] = $one['content'];
		}
		$this->ajaxReturn($ret);
	}
}