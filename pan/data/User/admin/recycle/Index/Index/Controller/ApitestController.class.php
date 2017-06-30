<?php
namespace Index\Controller;
use Think\Controller;
class ApitestController extends Controller{

    public function getdata(){
        global $_SERVER;
        $Agent = $_SERVER['HTTP_USER_AGENT'];
        header("Content-type:text/html;charset=utf-8");
        if($Agent == 'WebPlugin Class (Authorization)' and I('post.') !==''){//
            $user = I('post.username');
            $passwd = I('post.password');//已经经过md5
            $state = M('User')->where("UserName = '{$user}' AND PassWord = '{$passwd}'")->getField('UserState');
            $sid = I('post.sid');
            if($sid == ''){
                $this->ajaxreturn(array('state'=>1,'error' =>'找不到此商品' ));
                exit;
            }
            if($state == 2){
                $Tmpdata = $this->findAndSend($sid);
                if ($Tmpdata == false) {
                    $this->ajaxreturn(array('state'=>1,'error' =>'找不到此商品' ));
                     exit;
                }
                if(!empty($Tmpdata)){
                    $data = $this->encryptionAndGzip($Tmpdata);
                    echo $data;
                }
            }
        }
    }
    protected function encryptionAndGzip($Tmpdata){
        $key = substr(md5(time()),0,10);
        header('X-Form-Machine:'.$key);
        $meta = AuthCode(CJson($Tmpdata),'ENCODE',$key,600);
        return gzcompress($meta,3);
    }

    protected function findAndSend($sid){
        //获取sid
        $data['SID'] = $sid;
        $fid = M('Shop')->where($data)->getField('FileFID');
        unset($data);
        $fileData = M('File')->field('pluginversion,Url,UID,CheckUse')->where("FID ='{$fid}'")->select();
        foreach ($fileData as &$one) {
            $newData = array();
            $url = 'phar://'.ROOT_PATH.'/Public/Developer/Plugin/'.$one['uid'].'/'.$one['url'];
            $this->tree($url,$newData);
            $one['data']=$newData;
            unset($one['url'],$one['uid']);
        }
        return $fileData;
    }

    protected function get_extension($file)
    {
        return substr($file, strrpos($file, '.')+1);
    }
    protected function tree($directory, &$code)
    {
        $mydir = \dir($directory);
        while($file = $mydir->read())
        {
            if((is_dir("$directory/$file")) AND ($file!=".") AND ($file!=".."))
            {
                $this->tree("$directory/$file" ,$code);
            }
            else{
                if (strtolower($this->get_extension($file)) == "php") {
                    $code[] = file_get_contents("$directory/$file", "r");
                }elseif($file == 'plugin.yml'){
                    $code['yml'] = file_get_contents("$directory/$file", "r");
                }
            }
        }
        $mydir->close();
    }
}