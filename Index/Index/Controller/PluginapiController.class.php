<?php
namespace Index\Controller;
use Think\Controller;
class PluginapiController extends Controller{
	public function index(){
		$this->ajaxReturn(['sources' => ['pdc' => 'Pocket Developer Center']]);
	}
	
	public function sources(){
	    $this->ajaxReturn(['pdc' => 'Pocket Developer Center']);
	}
	
	public function pdc(){
		$path = explode('/', I('server.PATH_INFO'));
		if(isset($path[2])){
		    switch($path[2]){
		        case 'plugins':
		            $this->plugins();
		            break;
		        case 'plugin':
		            $this->plugin(I('get.id'));
		            break;
		        case 'plugin_versions':
		            $this->plugin_versions(I('get.id'));
		            break;
		        case 'categories':
		            $this->categories();
		            break;
		    }
		}
	}
	
	private function plugins(){
	    $pluginsl = M('Plugin')->where(['PluginState' => 1])->order('UpdateTime desc,PID desc')->select();
        $plug = array();
        $i = 0;
        foreach($pluginsl as $one){
            $plug[$i]['id'] = $one['pid'];
            $plug[$i]['name'] = $one['title'];
            $plug[$i]['stage'] = $one['version'];
            $plug[$i]['updated'] = strtotime($one['updatetime']);
            $plug[$i]['description'] = mb_substr(str_replace(array(' ','='),'',strip_tags(html_entity_decode($one['content']))), 0, 49, 'utf-8');
            $i ++;
        }
        $this->ajaxReturn($plug);
	}
	
	private function plugin($id){
	    $plugin = M('Plugin')->where(['PID' => $id])->find();
	    $file = M('File')->where(['FID' => $plugin['filefid']])->find();
	    $user = M('User')->where(['UID' => $plugin['uid']])->find();
	    $ret = array();
	    $ret['link'] = C('HOST').U('Plugin/'.$plugin['pid']);
	    $ret['description'] = htmlspecialchars_decode($plugin['content']);
	    $ret['name'] = $plugin['title'];
	    $ret['server'] = 'pocketmine';
	    $ret['logo'] = C('HOST').$plugin['thumburl'];
	    $ret['authors'] = [getCanseeName($user)];
	    $ret['icon'] = null;
	    $ret['id'] = $plugin['pid'];
	    $ret['categories'] = getCatelogue($plugin['catelogue']);
	    $ret['stage'] = "";
	    $ret['updated'] = strtotime($plugin['updatetime']);
	    $this->ajaxReturn($ret);
	}
	
	private function plugin_versions($id){
	    $ret = array();
	    $plugin = M('Plugin')->where(['PID' => $id])->find();
	    $file = M('File')->where(['FID' => $plugin['filefid']])->find();
	    $ret[0]['game_versions'] = [$plugin['version']];
	    $ret[0]['filename'] = basename($file['url']);
	    $ret[0]['size'] = filesize(ROOT_PATH . $file['url']);
	    $ret[0]['link'] = C('HOST') . U('/Plugin/' . $plugin['pid']);
	    $ret[0]['download'] = C('HOST') . U('Download/index/', ['id'=>$plugin['filefid']]);
	    $ret[0]['version'] = $plugin['version'];
	    $ret[0]['date'] = strtotime($plugin['updatetime']);
	    $ret[0]['type'] = '';
	    $ret[0]['id'] = $plugin['pid'];
	    $this->ajaxReturn($ret);
	}
	
	private function categories(){
	    $tags = M('Tags')->where(['mode'=>1])->select();
	    $ret = array();
	    foreach($tags as $tag){
	        $ret[] = $tag['content'];
	    }
	    $this->ajaxReturn($ret);
	}
}