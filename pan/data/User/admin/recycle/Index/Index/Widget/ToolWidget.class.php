<?php
namespace Index\Widget;
use Think\Controller;
use Org\Tool\Widget;
class ToolWidget extends BaseController{
    public function getText($data = '',$k){
        if (!empty($data)) {
            $this->assign('data', $data);
            $this->assign('k',$k);
        }
        $this->template('Index@Tool:gettext');//tp默认显示出问题，使用其他方法
    }

    public function text(){
        $this->template('Index@Tool:text');//tp默认显示出问题，使用其他方法
    }


    public function toGet(){
        //todo:获取所有小工具
        $this->text();
    }

    /**
     *获取全部的数据，分类设置模板
     */
    public function toShow(){
        $widget = new Widget();
        $data = $widget->get();
        unset($widget);
        //TODO:判断小工具类型，循环模板
        foreach ($data as $key => $one) {
            switch($one['type']){
                case 'text';
                    $this->getText($one,$key);
                    break;
                default;
                    break;
            }
        }
    }
	
	public function indexShow(){
		$widget = new Widget();
        $data = $widget->get();
		$html = '';
		foreach ($data as $one) {
			$html = '<aside id="zan_posts_category-2">
		<div class="panel panel-zan hidden-xs">
			<div class="panel-heading">'.$one['textTitle'].'</div>
			<div style="margin-left: 20px;margin-top: 10px;margin-right: 20px;padding-bottom: 20px;">
			'.$one['textContent'].'</div>
		</div>
	</aside>';
		echo $html;
        }
	}
}