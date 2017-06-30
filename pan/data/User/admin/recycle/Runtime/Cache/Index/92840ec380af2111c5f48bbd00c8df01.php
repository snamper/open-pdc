<?php if (!defined('THINK_PATH')) exit();?><div class="outpanel">
    <div class="panel" style="padding: 0;">
        <input type="hidden" name="num[]" value="text" data-type="text">
        <div class="panel-heading" style="margin: 0; line-height: 25px;"><a>文本框</a>
            <div class="btn btn-danger btn-xs float-right" onclick="delslide(this)"><i class="fa fa-exclamation"></i> 删除 </div>

            <div class="btn btn-inverse btn-xs float-right toggle" style="margin-right: 5px;"><i
                    class="fa fa-exclamation"></i> 展开
            </div>
        </div>

        <div class="">
            <div class="panel-body text-small slowhidden">
                <input type="text" name="texttitle[]" class="form-control" placeholder="显示的标题" value="<?php echo ($data['textTitle']); ?>"><br>
                <textarea name="text[]" class="form-control" id="" placeholder="内容，支持html" style="width:100%;resize: vertical;"><?php echo ($data['textContent']); ?></textarea>
                <div class="checkbox float-right ">
                    <input class="textcheck" name="textcheck[]"
                    <?php if(isset($data['textCheck']) and $data['textCheck'] == 1){ echo 'checked=""'; } ?> type="checkbox" value="<?php echo ($k); ?>"> <span style="font-size: 14px;">是否在首页显示标题</span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>