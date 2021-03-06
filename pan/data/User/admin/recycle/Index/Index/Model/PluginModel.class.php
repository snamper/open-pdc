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
     array('Catalog','GetCatalog',3,'callback') ,
      array('TAGS','GetTAGS',3,'callback') ,
      array('UpdateTime','GetDate',3,'callback') ,
 );
 protected $_validate = array(
     array('ShopName','','插件已经存在！',1,'unique',1), // 插件名字验证
     array('ShopName','5,100','插件名称长度为5到100！',1,'length',3), // 验证长度
     array('ShopName','require','插件名称不能为空'), //版本验证
     array('Version','require','版本不能为空'), //版本验证
     array('Price','require','价格不能为空'), //价格验证
     array('Price','number','价格只能为数字'), //邮箱验证
     array('Content','require','描述内容不能为空'), //
     array('Content','1,45000','描述内容为1到5000字符',1,'length',3), // 验证内容长度
 );
     function GetCatalog(){
         $Catalog = I('post.Catalog');
         $Catalogs = 'NULL';
         foreach($Catalog as $value){
             if($Catalogs == 'NULL') $Catalogs = ',';
             $Catalogs .= $value.',';
         }
         return $Catalogs;
     }
     function GetTAGS(){
         $Catalog = I('post.TAGS');
         $Catalogs = ','.$Catalog.',';
         return $Catalogs;
     }
     function GetDate(){
         return date("Y-m-d");
     }
 }
