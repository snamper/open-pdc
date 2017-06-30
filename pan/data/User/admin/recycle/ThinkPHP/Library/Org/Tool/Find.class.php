<?php
namespace Org\Tool;
class Find{
    /**获取所有数据并带分页
     * @param $data
     * @param $page
     * @param $num
     * @return mixed
     */
    public static function findAllWithPage($data,$page,$num){
        $shop = M('Shop');
        $map['_string'] = "concat (ShopName,TAGS) like '%".$data."%'";
        return $shop->where($map)->order('UpdateTime desc')->page($page,$num)->select();
    }

    /**获取数据数量
     * @param $data
     * @return mixed
     */
    public static function findAllCount($data){
        $shop = M('Shop');
        $map['_string'] = "concat (ShopName,TAGS) like '%".$data."%'";
        return $shop->where($map)->count();
    }


    public static function findTagsWithAllData($data,$page,$num){
        $shop = M('Shop');
        $tmp['TAGS'] = array('like',"%,{$data},%");
        $returnData['data']=$shop->where($tmp)->order('UpdateTime desc')->page($page,$num)->select();
        $returnData['count']=$shop->where($tmp)->count();
        return $returnData;
    }
}