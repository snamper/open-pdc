<?php
namespace Index\Model;
 use \Think\Model;
class PluginModel extends Model{
	// 返回错误信息格式化
	protected $patchValidate = true;
	protected $_map = array(
		'FID' =>'FileFID',
	);
	//更新表单的检测
	protected $_auto = array (
		array('TAGS','GetTAGS',3,'callback'),
		array('UpdateTime','GetDate',3,'callback') ,
	);
	
	protected $_validate = array(
		array('Title','require','插件名称不能为空'), //版本验证
		array('Version','require','版本不能为空'), //版本验证
		array('Content','require','描述内容不能为空'),
	);
	
	function GetTAGS(){
		$Catalog = I('post.tags');
		$Catalog = str_replace('，', ',', $Catalog);
		return $Catalog;
	}
	
	function GetDate(){
		return date("Y-m-d");
	}
}