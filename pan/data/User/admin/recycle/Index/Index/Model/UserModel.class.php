<?php

namespace Index\Model;

 use \Think\Model\AdvModel;

class UserModel extends AdvModel{

// 返回错误信息格式化

     protected $patchValidate = true;

//编辑数据的时候允许更新的字段

     protected $updateFields = 'Action,Lock,PassWord,Money,Email,Data,SCart,HasShop,LastLoginTime,registerdate,Salt';



     protected $_auto = array (

         array('registerdate','NowDateTime',1,'function'),

         array('LastLoginTime','NowDate',3,'function'), // 对update_time字段在更新的时候写入当前时间戳

     );



     protected $_validate = array(

         array('UserName','','帐号名称已经存在！',1,'unique',3), // 在新增的时候验证用户名字段是否唯一

         array('UserName','0,50','帐号长度为50以下！',1,'length',3), // 验证长度

         array('PassWord','require','密码不能为空'), //密码验证

         //array('PassWord','6,30','密码长度为6到30！',1,'length',3), // 验证密码长度

         array('Email','require','邮箱不能为空'), //邮箱验证

         array('Email','','邮箱已经被注册了',1,'unique',3), //邮箱验证

         array('Email','email','邮箱不正确'), //邮箱验证

     );



}

