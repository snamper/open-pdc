<?php
namespace Org\Tool;
class Shop {
    public $Shop;

    public function __construct(){
        $this->Shop = M('Server');
    }

    /**获取版本号数据
     * @return mixed|string
     */
    public function getVersion(){
        if(M('Option')->where("name = 'Version'")->find()){
            $Tags = M('Option')->where("name = 'Version'")->getField('Value');
            return $Tags = CJson($Tags,true);
        }else{
            M('Option')->add(array('Name'=>'Version'));
            return array(0=>'1.4');
        }
    }

    /**添加版本号
     * @param $name
     * @return bool
     */
    public function addVersion($name){
        $tmp = $this->getVersion();
        if(!in_array($name,$tmp)) {
            $tmp[] = $name;
            $tmp = CJson($tmp);
            return M('Option')->where("name = 'Version'")->setField('Value', $tmp);
        }
        return true;
    }

    /**获取所有目录
     * @return array
     */
    public function getCatalog(){
        return '';
    }

    /**添加目录
     * @param $name
     * @return bool
     */
    public function addCatalog($name){
        return false;
    }

    /**获取插件数量
     * @return mixed
     */
    public function getCount(){
        return $this->Shop->count();
    }

    public function getShopById($id){

    }

    public function getShopWithUserById($id){

    }

    /**获取商品连带分页和用户数据
     * @param $Page
     * @param $Num
     * @return mixed
     */
    public function getShopWithUserByPage($Page,$Num){
        $Data = $this->Shop->page($Page,$Num)
            ->alias('s')
            ->join('__USER__ ON s.UID = __USER__.UID')
            ->field('UserName,ShopName,FindQQ,Version,Price,UpdateTime,Data,Sales,SID,Thumburl,Action,PlayerSolt,CPlayerSolt,MemaryLimit,DateLimit,Num,ApiUserName,ApiKey')
            ->select();
        foreach($Data as &$One){
            unset($One['data']);
            unset($One['hasshop']);
            unset($One['scart']);
        }
        return $Data;
    }


    public static function getShopOwn($sid){
        return M('Shop')->where("SID = '{$sid}'")->getField('UID');
    }

}
