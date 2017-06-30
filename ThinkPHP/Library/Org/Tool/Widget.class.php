<?php
namespace Org\Tool;
class Widget{
    public $widget;
    public $num;
    public $finishData;

    /**数据写入
     * @param $data
     * @return bool
     */
    public function set($data){
        $this->num = $data['num'];
        $this->check($data);
        $data = CJson($this->finishData);
        return M('Option')->where("Name = 'Widget'")->setField('Value',$data);
    }

    /**检测数据并逐个推入主数据，finishData
     * @param $data
     */
    protected function check($data){
        foreach ($this->num as $one) {
            switch($one){
                case 'text';
                    $this->text($data);
                    break;
                default;
                    break;
            }
        }
    }

    /**获取全部数据
     * @return mixed|string
     */
    public function get(){
        if($data = M('Option')->where("Name = 'Widget'")->getField('Value')){
            $data = CJson($data,true);
            return $data;
        }else{
            M('Option')->add(array('Name'=>'Widget','Value'=>'Null'));
            return '';
        }
    }

    /**小工具数据读取并推入
     * @param $data
     * @return bool
     */
    protected function text(&$data){
        //数据储存
        $textname = &$data['texttitle'];
        $textcontent =&$data['text'];
        $textcheck=&$data['textcheck'];
        //指向第一个数据
        $tmp['textTitle'] = reset($textname);
        $key = key($textname);//获取当前的key
        $tmp['textContent'] = $textcontent[$key];
        /*if($textcheck[$key] !== 'on'){
            $tmp['textCheck'] = '';
        }else{
            $tmp['textCheck'] = 1;
            unset($textcheck[$key]);
        }*/
        foreach ($textcheck as $one) {
            if($one == $key){
                $tmp['textCheck'] = 1;
                break;
            }
        }
        unset($textcontent[$key]);
        unset($textname[$key]);
        $tmp['type'] = 'text';
        //把数据推入主数组
        $this->finishData[] = $tmp;
        unset($tmp);
    }
}
