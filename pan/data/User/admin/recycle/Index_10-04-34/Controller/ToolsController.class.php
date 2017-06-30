<?php
namespace Index\Controller;

use Think\Controller;
use Phar;
use ZipArchive;
use SQLite3;

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
            $UserData = $MUser->where($User)->select();
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     5*1024*1024 ;// 设置附件上传大小
            $upload->exts      =     array('phar', 'zip');// 设置附件上传类型
            $upload->rootPath  =     './Public/Developer/Plugin/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->subName   =     $UserData['0']['uid'];
            $upload->saveName  =     '';
			$upload->replace   =     true;
            // 上传文件
            $info = $upload->uploadOne($_FILES['file']);//开始判断重复文件
			$CheckFile = M('File');
            $Where['UID'] = $UserData['0']['uid'];
            $Where['FileMd5'] = $info['md5'];
			if(I('post.mode') == 'opensource'){
				$Where['Mode'] = 1;
			} elseif(I('post.mode') == 'closesource') {
				$Where['Mode'] = 2;
			}
            $Select = M('File')->where($Where)->select();
            if($Select) { //如果有就直接选择
                $FileId = $Select['0']['fid'];
				$this->ajaxreturn(['id'=>$FileId]);
            }else{ //如果没有就新建
				chdir(ROOT_PATH . '/Public/Developer/Plugin/'.$UserData['0']['uid']);
				$File = D('File');
                $FileData = array();
                $FileData['UID'] = $UserData['0']['uid'];
				$filename = ROOT_PATH . '/Public/Developer/Plugin/'.$FileData['UID'].'/'.$info['savename'];
				if(I('post.mode') == 'opensource'){
					$filename2 = '/Public/Developer/Plugin/'.$FileData['UID'].'/'.$this->compressToZip($filename);
					$FileData['Mode'] = 1;
				} elseif(I('post.mode') == 'closesource') {
					$filename2 = '/Public/Developer/Plugin/'.$FileData['UID'].'/'.$this->compressToPmc($filename);
					$FileData['Mode'] = 2;
				}
                
                $FileData['FileName'] = basename($filename2);
                $FileData['FileMd5'] = $info['md5'];
				$FileData['Url'] = $filename2;
				
                if($File->create($FileData)){
					$FileId = $File->add();
				}
				
				if(!$info) {// 上传错误提示错误信息
					$this->ajaxreturn($upload->getError());
				}else{// 上传成功
					$this->ajaxreturn(['id'=>$FileId]);
				}
			}
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
		$this->display('Tool/js');
	}
	
	private function compressToZip($file){
		if(preg_match('/\.phar$/', basename($file))){ //转换成zip
			$zipfile = preg_replace('/\.phar$/', '.zip', $file);
			$rand = md5(time().rand(0,100));
			@copy(basename($file), $rand.'.phar');
			$phar = new Phar($rand.'.phar');
			$phar->convertToData(Phar::ZIP);
			if(file_exists($rand.'.zip')){
				rename($rand.'.zip', $zipfile);
				@unlink($file);
				$ret = basename($zipfile);
			} else {
				$ret = basename($file);
			}
			@unlink($rand.'.phar');
			return $ret;
			print_r(error_get_last());
		} else { //无操作
			return basename($file);
		}
	}
	
	private function compressToPmc($sfilename){//加密插件部分
		$id = md5(time().rand(0,100));
		@mkdir($id);
		if(preg_match('/\.phar$/', basename($sfilename))){
			$phar = new Phar($sfilename);
			$phar->extractTo($id);
		} elseif(preg_match('/\.zip$/', basename($sfilename))){
			$zip = new ZipArchive();
			$zip->open($sfilename);
			$zip->extractTo($id);
		}
		
		$folderPath = $id;

		$filename = $folderPath . '.pmc';
		copy(ROOT_PATH.'/Public/files.db', $filename);
		$db = new Files($filename);

		foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath)) as $file){
			$path = rtrim(str_replace(["\\", $folderPath], ["/", ""], $file), "/");
			if($path{0} === "." or strpos($path, "/.") !== false){
				continue;
			}
			//addfile($file, $path);
			$stat = addslashes(json_encode(stat($file)));
			$file = file_get_contents($file);
			$length = strlen($file);
			$file = bin2hex(gzcompress(~$file));
			$sql = "INSERT INTO `files` (`path`, `file`, `length`, `stat`) VALUES ('{$path}', X'{$file}', {$length}, '{$stat}');";
			$db->exec($sql);
		}
		
		$sql = "INSERT INTO `files` (`path`, `file`, `length`, `stat`) VALUES ('version', '1.0.0', '5', '\{\}');";
		$db->exec($sql);
		
		$db->close();
		
		$filename2 = preg_replace('/(\.zip|\.phar)$/', '.pmc', basename($sfilename));
		rename($filename, dirname($sfilename).'/'.$filename2);
		return $filename2;
	}
}