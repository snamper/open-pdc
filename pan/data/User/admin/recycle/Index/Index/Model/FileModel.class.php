<?php
namespace Index\Model;
 use \Think\Model;
class FileModel extends Model{
// 返回错误信息格式化
 protected $patchValidate = true;

  protected $_auto = array (
     array('FileDate','time',1,'function') ,
 );
 protected $_validate = array(
     array('UID','require','UID必须'),
     array('FileName','require','名字必须'),
     array('FileMd5','require','md5必须'),
     array('Url','require','Url必须'),
 );
}
