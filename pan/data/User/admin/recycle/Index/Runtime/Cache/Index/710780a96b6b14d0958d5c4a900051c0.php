<?php if (!defined('THINK_PATH')) exit(); if(empty($commentData)){ echo '空空如也，来评论吧'; } ?>
<?php if(is_array($commentData)): foreach($commentData as $key=>$one): ?><ul class="uk-comment" style="padding-left: 0;margin: 0;">
        <li style="list-style: none;">
            <article class="uk-comment" style="padding-left: 0;margin: 0;" data-comment-id="<?php echo ($one["comid"]); ?>" id="comment-<?php echo ($one["comid"]); ?>">
                <header class="uk-comment-header" style="border: none;background-color: white;margin: 0;">
                    <h4 class="uk-comment-title uk-float-left" style="margin: 0;"><?php echo ($one['content']['title']); ?></h4>
                    <div class="uk-float-right">
                        <a href="javascript:void (0)" onclick="useful(this,'up')" id="up" style="text-decoration: none;color: #999;">
                            <div class="uk-display-inline-block up">
                                <i class="uk-icon uk-icon-thumbs-o-up"></i>
                                <span class="ifuseful up-num"><?php echo ($one['ifuseful']['up']>0?$one['ifuseful']['up']:0); ?></span>
                            </div>
                        </a>
                        <a href="javascript:void (0)" onclick="useful(this,'down')" id="down" style="text-decoration: none;color: #999;">
                            <div class="uk-display-inline-block uk-margin-small-left down">
                                <i class="uk-icon uk-icon-thumbs-o-down"></i>
                                <span class="ifuseful down-num"><?php echo ($one['ifuseful']['down']>0?$one['ifuseful']['down']:0); ?></span>
                            </div>
                        </a>
                    </div>
                    <br>
                    <div class="uk-comment-meta"><div class="star-read" data-score="<?php echo ($one['level']); ?>" style="display: inline-block;"></div>
                        <span style="vertical-align: middle;">
                            <span class="username" data-uid="<?php echo ($one["useruid"]); ?>"><?php echo ($one['username']); ?>
                                <?php if($UserSystemData['uid'] == M('Shop')->where("sid = '<?php echo ($shopid); ?>'")->getField('UID') and $one['content']['find']!==''){ echo ':联系方式QQ:'.$one['content']['find']; } ?>
                            </span><?php echo ($one['commentdate']); ?></span>
                    </div>
                    <div class="uk-comment-body uk-margin-small-top">
                        <p><?php echo ($one['content']['content']); ?></p>
                    </div>
                </header>
            </article>
        </li>
    </ul>
    <hr class="uk-panel-divider" style="margin: 0;"><?php endforeach; endif; ?>

<script src="/Public/js/jquery.raty.min.js"></script>
<script language="JavaScript">
    jQuery(document).ready(function($){
        $('.uk-comment').each(function(i){
            id = $(this).data('comment-id');
            cookie = getCookie('comment-'+id);
            if(cookie != ''){
                if(cookie == 'up'){
                    $(this).find('#up').css('color','#db4f1f');
                }else{
                    $(this).find('#up').css('color','#7daad5');
                }
                $(this).find('a').addClass('a-disable');
            }
        })
    });
    $('.star-read').raty({
        halfShow: false,
        score: function() {
            return $(this).attr('data-score');
        },
        readOnly: true,
        starOff: '/Public/img/star-off.png',
        starOn : '/Public/img/star-on.png'
    });
</script>
<script language="JavaScript">
    function useful(e,type){
        thecommid = $(e).parent().parent().parent().data('comment-id');
        if(type != 'up'){
            $.post("<?php echo U('/Comment/setUseful');?>",{comid:thecommid,type:'down'},function(data){
                if(data==false){
                    alert('你已经提交过了')
                }else{
                    $(e).find('.ifuseful').text(parseInt($(e).find('.ifuseful').text(),10)+1);
                }
            });
            $(e).css('color','#7daad5');
        }else{
            $.post("<?php echo U('/Comment/setUseful');?>",{comid:thecommid,type:'up'},function(data){
                if(data==false){
                    alert('你已经提交过了')
                }else{
                    $(e).find('.ifuseful').text(parseInt($(e).find('.ifuseful').text(),10)+1);
                }
            });
            $(e).css('color','#db4f1f');
        }
        $(e).parent().find('a').addClass('a-disable');
    }
</script>