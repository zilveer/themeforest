(function($) {
    'use strict';
    $('body').on('click','.wbc_vc_icon_list span', function(e){
        e.preventDefault();

        $(this).parent('.wbc_vc_icon_list').find('span').removeClass('current');
        $(this).addClass('current');

        var icon = $(this).find('i').attr('class');

        $(this).parent('.wbc_vc_icon_list').parent().find('input.wbc_icons_field').val(icon);

    });

    $('body').on('keyup','#filter-icons', function(){
        var filter = $(this).val();
        if(!filter){
            $(".wbc_vc_icon_list span").show();
            return;
        }

        var iconSearch = new RegExp(filter, "i");

        $(".wbc_vc_icon_list span").each(function(){
            if ($(this).find('i').attr('class').search(iconSearch) < 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    $('body').on('click','.wbc_vc_cats .term-list input', function(e){
        var values ='';

        var listArray = new Array();

        $(this).parents('.wbc_vc_cats').find('.term-list input').each(function(){

        	if($(this).is(':checked') && $(this).val()){
        		listArray.push($(this).val());
        		
        	}

        });

        if(listArray.length > 0){
        	values = listArray.join();
        }

        $(this).parents('.wbc_vc_cats').parent().find('input.wbc_categories_field').attr('value',values);

    });
})(window.jQuery);
