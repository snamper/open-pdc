<?php
namespace Index\Controller;
use Think\Controller;
class ApiController extends Controller{
    public function checkupdata()
    {
        header("Content-type:text/html;charset=utf-8");
        $info = C('PluginUpdata');
        echo CJson($info);
    }
	
	public function test(){
        $file = M('File');
        $filelist = $file->where("`mode`=2")->select();
        print_r($filelist);
		foreach($filelist as $one){
			$path = ROOT_PATH . '/Public/Developer/Plugin/' . $one['uid'] . '/';
			$path .= str_replace('.pmc', '', $one['filename']);
			if(file_exists($path . '.zip')){
				echo $path . '.zip'.'<br>';
			} elseif(file_exists($path . '.phar')){
				echo $path . '.phar'.'<br>';
			}
		}
    }

    public function index(){
        global $_SERVER;
        $Agent = $_SERVER['HTTP_USER_AGENT'];
        header("Content-type:text/html;charset=utf-8");
        if(I('get.mode') =='api'){//
            $user = I('get.username');
            $passwd = md5(I('get.password'));//已经经过md5
            $ip = $_SERVER["REMOTE_ADDR"];
            $port = I('get.port');
            $pluginList = M('User')->where("UserName = '{$user}' AND PassWord = '{$passwd}'")->getField('HasShop');
            /*$havingPlugin = array(array('sid'=>65,'version'=>'1.0.0'),array('sid'=>66,'version'=>'1.0.0'));
        $ip = '0.0.0.0';
        $port = '19132';
        $pluginList = M('User')->where("UserName = 'admin' AND PassWord = 'adfe29e40080e2d2751db8f219c0601d'")->getField('HasShop');*/
            if($pluginList === false){
                $this->ajaxreturn(array('state'=>0,'error'=>'找不到该用户'));
                exit;
            }elseif (empty($pluginList)) {
            	$this->ajaxreturn(array('state'=>1,'error' =>'没有任何服务器，请购买。' ));
                     exit;
            }
			$a="0";
			$plist="";
            $pluginList = CJson($pluginList,true);
			while(empty($pluginList[$a])!=true){
				if($pluginList[$a][$stop]!=1){
					if($pluginList[$a]['ip']==$ip and $pluginList[$a]['port']==$port){
						$plist[$a]=$pluginList[$a];
					}
				}
				$a=strval(intval($a)+1);
			}
            $this->ajaxreturn(array('state'=>2,'plist'=>$plist));
            }
        }
    public function getMyIP()
    {
        echo $_SERVER["REMOTE_ADDR"];
    }
    protected function encryptionAndGzip($Tmpdata){
        $key = substr(md5(time()),0,10);
        header('X-Form-Machine:'.$key);
        $meta = AuthCode(CJson($Tmpdata),'ENCODE',$key);
        return gzcompress($meta,6);
    }

    protected function assoc_unique($arr, $key){
               $tmp_arr = array();
               foreach($arr as $k => $v)
              {
                 if(in_array($v[$key], $tmp_arr))//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
                {
                   unset($arr[$k]);
                }
              else {
                  $tmp_arr[] = $v[$key];
                }
              }
            sort($arr); //sort函数对数组进行排序
            return $arr;
            }
            
    protected function findAndSend($ip,$port,$havingPlugin,$pluginList){
        $returnData = array();
        //获取数据
        if($pluginList !==''){
            foreach($pluginList as $one){
                if($one['ip'] === $ip and $one['port'] === $port and $one['stop']!=='1'){
                    unset($one['date'],$one['shopname']);
                    array_push($returnData,$one);
                }else{
                    unset($one);
                }
            }
        }
        $returnData = $this->assoc_unique($returnData,'sid');
        //获取sid
        $sid = array();
        //删除重复数据,提取重复数据
        foreach($returnData as $one){
            array_push($sid,(int)$one['sid']);
        }
        if (count($sid)>1) {
            array_push($sid,'or');//制作thinkphp查询数据
        }
        if(empty($sid)){
            return false;//无插件时返回false
        }
        unset($returnData);//删除无用数据
        $data['SID'] = $sid;
        $shopD = M('Shop')->field('FileFID')->where($data)->select();
        unset($data);
        $data['FID']=array();
        foreach($shopD as &$one){
            array_push($data['FID'],(int)$one['filefid']);
        }
        array_push($data['FID'],'or');
        unset($shopD);
        $fileData = M('File')->field('pluginversion,Url,UID,CheckUse')->where($data)->select();
        foreach ($fileData as $k=>&$one) {
            $one['sid'] =  $one['checkuse'];
            foreach($havingPlugin as $have){
                if($one['sid'] == $have['sid'] and $one['pluginversion'] == $have['version'] ){
                    unset($fileData[$k]);
                }
            }
            unset($one['checkuse']);
        }
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