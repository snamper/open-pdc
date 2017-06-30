<?php if (!defined('THINK_PATH')) exit(); if(empty($commentData)){ echo '想说点啥不？来句吐槽吧！'; } ?>
<?php if(is_array($commentData)): foreach($commentData as $key=>$one): ?><ul class="uk-comment" style="padding-left: 0;margin: 0;">
        <li style="list-style: none;">
            <article class="uk-comment" style="padding-left: 0;margin: 0;" data-comment-id="<?php echo ($one["comid"]); ?>" id="comment-<?php echo ($one["comid"]); ?>">
                <header class="uk-comment-header" style="border: none;background-color: white;margin: 0;">
                    <div class="uk-comment-meta">
                        <span style="vertical-align: middle;">
                            <span class="username" data-uid="<?php echo ($one["useruid"]); ?>"><?php echo ($one['username']); ?>
                            </span>
                            <?php echo ($one['commentdate']); ?>
                        </span>
                    </div>
                    <div class="uk-comment-body uk-margin-small-top">
                        <textarea class="content-block" style="display: none;"><?php echo ($one["content"]); ?></textarea>
                        <div class="content"></div>
                    </div>
                </header>
            </article>
        </li>
    </ul>
    <hr class="uk-panel-divider" style="margin: 0;"><?php endforeach; endif; ?>
<script language="javascript">
$('.uk-comment-body').each(function(){
    $(this).find('.content')[0].innerHTML = $(this).find('.content-block').val();
});
</script>