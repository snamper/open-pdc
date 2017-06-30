<?php
namespace Org\Tool;
class AdminTool {
    public $systemId;
    public $year;
    public $mouth;
    public $day;
    public $firstTime;
    public $lastTime;

    public function __construct(){
        if(empty($this->systemId)){
            $this->systemId = M('User')->where("action = '11'")->getField('UID');
        }
        $this->year = date('Y');
        $this->mouth = date("m");
        $this->day = date('d');
        if($this->day !== 1){
            $this->firstTime = $this->year.'-'.$this->mouth.'-1 00:00:00';
            $this->lastTime = $this->year.'-'.($this->mouth+1).'-1 00:00:00';
        }else{
            $this->firstTime = $this->year.'-'.$this->mouth.'-1 00:00:00';
            $this->lastTime = $this->year.'-'.$this->mouth.'-2 00:00:00';
        }
    }

    /**获取当月的营业额
     * @return mixed 当月营业额
     */
    public function getMouthIncome(){
        if($tmp = S('Admin_getMouthIncome')){
            return $tmp;
        }else{
            $data['Date'] = array('between',array($this->firstTime,$this->lastTime));
            $data['UserUID'] = $this->systemId;
            $Money = M('Costrecord')->where($data)->sum('Number');
            S('Admin_getMouthIncome',$Money,60*60);
            return $Money?$Money:0;
        }
    }

    /**获取当月开发者的提款
     * @return int 当月的提款
     */
    public function getDeveloperOutcome(){
        if($tmp = S('Admin_getDeveloperOutcome')){
            return $tmp;
        }else{
            $data['Type'] = 2;
            $data['Date'] = array('between',array($this->firstTime,$this->lastTime));
            $data['State'] = 1;
            $Money = M('Costrecord')->where($data)->sum('Number');
            S('Admin_getDeveloperOutcome',$Money,60*60);
            return $Money?$Money:0;
        }
    }

    /**获取新用户
     * @return int|mixed
     */
    public function getNewUser(){
        if($tmp = S('Admin_getNewUser')){
            return $tmp;
        }else{
            $data['Action'] = array('gt',1);
            $data['registerdate'] = array('between',array($this->firstTime,$this->lastTime));
            $count = M('User')->where($data)->count();
            S('Admin_getNewUser',$count,60*60);
            return $count?$count:0;
        }
    }

    public function getNewComplain(){
        if($tmp = S('Admin_getNewComplain')){
            return $tmp;
        }else{
            $data['receiveuid'] = $this->systemId;
            $data['state'] = 0;
            $data['date'] = array('between',array($this->firstTime,$this->lastTime));
            $count = M('Message')->where($data)->count();
            S('Admin_getNewComplain',$count,60*60);
            return $count?$count:0;
        }
    }

    /**设置幻灯数据
     * @param $data
     * @return bool
     */
    public static function setSlideData($data){
        foreach($data['slidename'] as $key=>$one){
            if($one == ''){
                continue;
            }
            $tmp[$key]= array('slidename'=>$one,'slide'=>$data['slide'][$key]);
        }
        $data = CJson($tmp);
        return M('Option')->where("Name = 'Slide'")->setField('Value',$data);
    }

    /**获取幻灯数据
     * @return mixed|string
     */
    public static function getSlideData(){
        $data = M('Option')->where("Name = 'Slide'")->getField('Value');
        if($data===false){
            M('Option')->add(array('Name'=>'Slide','Value'=>''));
            return '';
        }
        return CJson($data,true);
    }

    public static function getUnReadNews(){

    }

    public static function getHeaderNotice(){
        return htmlspecialchars_decode(M('Option')->where("Name = 'header_notice'")->getField('Value'));
    }

    public static function setHeaderNotice($data){
        return M('Option')->where("Name = 'header_notice'")->setField('Value', $data);
    }
}