<?php
namespace Index\Controller;
use Think\Controller;
class ToolsController extends Controller {
    public function UploadPhar(){
        $User = IfLogin();
        if($User){
            $MUser = M('User');
            $UserData = $MUser->where($User)->select();
            if($UserData['0']['action'] > 1){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     5*1024*1024 ;// 设置附件上传大小
                $upload->exts      =     array('phar');// 设置附件上传类型
                $upload->rootPath  =     './Public/Developer/Plugin/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                $upload->subName =  $UserData['0']['uid'];
                $upload->saveName = '';
                // 上传文件
                $info   =   $upload->uploadOne($_FILES['file']);//开始判断重复文件
                        //创建file表的模型(数据库部分)
                        $CheckFile = M('File');
                        $Where['UID'] = $UserData['0']['uid'];
                        $Where['FileMd5'] = $info['md5'];
                        $Select = $CheckFile->where($Where)->select();
                        if($Select) {//如果有就删除这个文件（没有留下他的意义！）
                            unlink($upload->rootPath.$info['savepath'].$info['savename']);
                            $FileId = $Select['0']['fid'];
                        }else{//否则就新建一个，并和sg联动
                            $File = D('File');
                            $FileData = array();
                            $fileurl = 'phar://'.$upload->rootPath.$info['savepath'].$info['savename'].'/plugin.yml';
                            $fileyml = readYml($fileurl);
                            $FileData['pluginversion'] =  $fileyml['version'];
                            $FileData['UID'] = $UserData['0']['uid'];
                            $FileData['FileName'] = $info['name'];
                            $FileData['FileMd5'] = $info['md5'];
                            $FileData['Url'] = $info['savename'];
                            if($File->create($FileData)){
                                $FileId = $File->add();
                                //此处联动
                        }
                if(!$info) {// 上传错误提示错误信息
                    $this->ajaxreturn($upload->getError());
                    exit;
                }else{// 上传成功
                    $this->ajaxreturn(['id'=>$FileId]);
                }
            }
        }
    }
	}
    protected function getSGData(){
		/*
        $token = 'hezimilkice233666xD';
        $data = array (
            'hezi'=>$token,
            'file'=>curl_file_create($fileUrl,'application/octet-stream',$filename),
            'username'=>$username['UserName'],
            'md5'=>$filemd5
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        curl_setopt( $ch , CURLOPT_TIMEOUT, 20 );
        $return = curl_exec ( $ch );
        curl_close ( $ch );
        if(!$return){
            M('File')->delete($FileId);
            $this->ajaxreturn('error','超时或sg网站无法访问，请重试');//返回错误信息
            exit;
        }
        $returnArray = json_decode($return,true);
        if(empty($returnArray) or $returnArray == false){
            echo('error:'.$return);//返回错误信息
            exit;
        }
        if($returnArray['status'] != 1){
            M('File')->delete($FileId);
            $this->ajaxreturn('error',$returnArray['message']);//返回错误信息
            exit;
        }
        //开始下载文件并且保存
        $sgPluign = file_get_contents(stripslashes($returnArray['link']));
        $size = file_put_contents(realpath($fileUrl),$sgPluign);
        $returnData['md5']=md5_file($fileUrl);
        if($returnData['md5']!=$returnArray['md5']){
            M('File')->delete($FileId);
            $this->ajaxreturn('error','文件损坏，请重试');//返回错误信息
            exit;
        }
        if($size==0){
            M('File')->delete($FileId);
            $this->ajaxreturn('error','写入失败，请重试');//返回错误信息
            exit;
        }
        return true;
    */
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
}