<?php if (!defined('THINK_PATH')) exit();?><div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <form class="uk-form uk-width-1-1 uk-form-stacked" id="send-comment" method="post" onsubmit="return Check(this)" action="<?php echo U('/Comment/sendcomment');?>">
        <fieldset>
            <legend>发表评论</legend>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <textarea id="editor" name="content" class="uk-width-1-1" rows="5"></textarea>
                </div>
            </div>
            <input type="hidden" name="pid" value="<?php echo ($Plug["pid"]); ?>">
			<br />
            <div class="uk-form-row">
                <button class="btn btn-zan-solid-pi btn-block" id="scomment">提交评论</button>
            </div>
        </fieldset>

    </form>
</div>
<script src="/Public/js/jquery.raty.min.js"></script>
<script>
	CKEDITOR.config.height=400;
	CKEDITOR.replace('editor', {height: '240px'});
	$('#scomment').click(function(e){
		$('#editor').val(CKEDITOR.instances.editor.getData());
		//e.preventDefault();
		
	});
</script>