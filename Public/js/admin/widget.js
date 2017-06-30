$('.widget-add').on('click',function() {
    $widgetNum = $('.bigpanel').find('[data-type="text"]').length;
    $newbox = $('<div class="outpanel"></div>').appendTo($(".bigpanel"));
    $add = $(this).parent().parent().clone(true, true).appendTo($newbox);
    $add.find('.widget-add').replaceWith('<div class="btn btn-danger btn-xs float-right" onclick="delslide(this)">' +
        '<i class="fa fa-exclamation"></i> 删除 </div>').first().prop("outerHTML");
    $add.find('.textcheck').attr('name','textcheck['+$widgetNum+']');
});

function resetCheck(parent){
    $(parent).find('.textcheck').each(function(i,v){
        $(this).val(i);
    });
    return true;
}

function hideAll(e){
    $(e).parent().parent().find('.panel-body').each(function(i,n){
        if(!$(n).is(":hidden")){
            $(n).slideToggle();
            $(n).parent().parent().find('.toggle').text('展开')
        }
    });
}