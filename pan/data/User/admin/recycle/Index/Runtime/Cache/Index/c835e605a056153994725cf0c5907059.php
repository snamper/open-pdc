<?php if (!defined('THINK_PATH')) exit();?><div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <form class="uk-form uk-width-1-1 uk-form-stacked" id="send-comment" method="post" onsubmit="return Check(this)" action="<?php echo U('/Comment/sendcomment');?>">
        <fieldset>
            <legend>发表评论</legend>
            <div class="uk-form-row">
                <label class="uk-form-label" for="title">标题：</label>
                <div class="uk-form-controls">
                  <input type="text" id="title" name="title" placeholder="标题，不可空"><span class="uk-form-help-inline">请填写5字以上</span>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="star">评价：</label>
                <div class="uk-form-controls">
                    <div id="star"></div>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="content">详细内容：</label>
                <div class="uk-form-controls">
                    <textarea placeholder="详细内容,可空。如果填写请填写20字以上" id="content" name="content" class="uk-width-1-1" rows="5"></textarea>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="find">联系方式：</label>
                <div class="uk-form-controls">
                    <input type="text" id="find" name="find" placeholder="联系方式"><span class="uk-form-help-inline">如需填写手机请在手机号前加上手机二字。联系方式将被隐藏仅限作者查看。可不填。
</span>
                </div>
            </div>
            <input type="hidden" name="sid" value="<?php echo ($Shop["sid"]); ?>">
            <div class="uk-form-row">
                <button class="uk-button uk-float-right uk-button-success uk-button-large">提交评论</button>
            </div>
        </fieldset>

    </form>
</div>
<script src="/Public/js/jquery.raty.min.js"></script>
<script>
    function Check(e){
        if($(e).find('#title').val() == ''){
            $(e).find('#title').addClass('uk-form-danger');
            return false;
        }
        if($(e).find('input[name=levelnum]').val() == ''){
            alert('请评分');
            return false;
        }

    }
    $('#send-comment input').blur(function(){
        if($(this).val() !== ''){
            $(this).removeClass('uk-form-danger');
        }
    });
    $('#star').raty({
        scoreName:'levelnum',
        halfShow: false,
        score: function() {
            return $(this).attr('data-score');
        },
        starOff: '/Public/img/star-off.png',
        starOn : '/Public/img/star-on.png'
    });
</script>