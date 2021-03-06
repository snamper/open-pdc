<?php if (!defined('THINK_PATH')) exit();?><div class="uk-width-large-2-10 uk-margin-bottom">
    <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <div class="uk-container-center" style="width: 100px;overflow: hidden;">
            <img class="img-rounded"
                 src="<?php if($UserSystemData['data']['avatar']){ echo C('HOST').'/'.substr($UserSystemData['data']['avatar'],2).'/avatar.jpg-avatar_100.jpg'; }else{ echo C('HOST').'/Public/images/placeholder_avatar.svg'; } ?>"
             width="100" height="100" alt="">
            <div class="uk-float-right uk-vertical-align-bottom uk-text-center" style="line-height: 23px;width: 100%;">
                <h3 class=" uk-margin-small-top"><?php echo getCanSeeName($UserSystemData);?></h3>
                <a href="<?php echo U('/User/torecharge');?>" target="_blank"><button class="btn btn-primary" type="button">积分:<?php echo ($UserSystemData["money"]); ?></button></a>
            </div>
        </div>
        <!--上面是用户的一些信息-->
        <hr class="uk-article-divider">
        <!--下面是导航-->
        <div >
            <ul class="uk-nav uk-nav-side uk-nav-parent-icon uk-container-center uk-text-center">
				<li class="<?php echo UrlLike(U('User/downloads'),'uk-active');?>" >
                    <a href="<?php echo U('User/downloads');?>"><i class="uk-icon-check"></i> 下载记录</a>
                </li>
                <!--积分交易（未完成）-->
                <!--<li class="<?php echo UrlLike(U('User/recharge'),'uk-active');?>">
                    <a href="<?php echo U('User/recharge');?>"><i class="uk-icon-barcode"></i> 交易记录</a>
                </li>-->
                <li class="<?php echo UrlLike(U('User/edit'),'uk-active');?>">
                    <a href="<?php echo U('User/edit');?>"><i class="uk-icon-edit"></i> 编辑资料</a>
                </li>
                <!--主要用邮箱，这里放一些不常用的记录-->
                <li class="<?php echo UrlLike(U('User/message'),'uk-active');?> uk-position-relative">
                    <a href="<?php echo U('User/message');?>"><i class="uk-icon-lightbulb-o"></i> 消息中心 <?php echo getUserMessageNumber($UserSystemData);?></a>
                </li>
                <?php  ?>
				<li class="<?php echo UrlLike(U('Developer/NewPlugin'),'uk-active');?>">
                    <a href="<?php echo U('Developer/NewPlugin');?>"><i class="fa fa-code"></i> 发布插件</a>
                </li>
				<li class="<?php echo UrlLike(U('Developer/MyPlugin'),'uk-active');?>">
                    <a href="<?php echo U('Developer/MyPlugin');?>"><i class="fa fa-file-code-o"></i> 我的插件</a>
                </li>
                <li class="<?php echo UrlLike(U('Developer/SellRecord'),'uk-active');?>">
                    <a href="<?php echo U('Developer/SellRecord');?>"><i class="fa fa-star"></i> 积分统计</a>
                </li>
                <?php  ?>
            </ul>
        </div>
        <hr class="uk-text-center">
        <div class="uk-text-center"> <a href="<?php echo U('/User');?>">进入用户中心</a></div>
    </div>
</div>