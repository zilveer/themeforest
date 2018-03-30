jQuery(document).ready(function(){ 
	"use strict";
	jQuery('#middle .wrapper_p .wc-tab img, #sidebar_r img, #sidebar_l img, .product_short_desc img').each(function(){
		var imw=jQuery(this).attr('width');
		var imh=jQuery(this).attr('height');
		var styl=jQuery(this).attr('style');
		if(styl=='undefined'||typeof styl == 'undefined')styl='';
		if(imw!=''&&imh!='') jQuery(this).attr('style',styl+'width:'+imw+'px!important;height:'+imh+'px!important');
	});
	jQuery('.normal li').prepend('<i class="icon-double-angle-right"></i>');
	jQuery('h1').append('<div class="widrig_left"></div>');
	jQuery('h2').append('<div class="widrig_left"></div>');
	jQuery('h3').append('<div class="widrig_left"></div>');
	jQuery('h4').append('<div class="widrig_left"></div>');
	jQuery('h5').append('<div class="widrig_left"></div>');
	jQuery('h6').append('<div class="widrig_left"></div>');
	jQuery('.box').append('<i class="icon-remove"></i>');
	jQuery('.box .icon-remove').click(function(){
		jQuery(this).parents('.box').fadeOut('slow');
	});
	jQuery('form.mailchimpform').submit(function(e) {
		e.preventDefault(); 
        var data = jQuery(this).serialize();
        var ajaxurl = ajax_script.ajaxurl;
        var form = jQuery(this);
        jQuery.post(ajaxurl, data, function(response) {
            if(response.success==true){
                form.fadeOut('fast');
                form.parent().find('.message').removeClass('error').addClass('ok').html(response.message).delay('550').fadeIn();
            }else{
                form.parent().find('.message').removeClass('ok').addClass('error').html(response.message).delay('550').fadeIn();
            }

        }, 'json');
        return false;

    });
	jQuery(".toph_l .menu li a").append(' <span class="slash">/</span> ');
	jQuery(".toph_l .menu li").last().find('.slash').remove();
	jQuery(".nextpostslink").html('<i class="icon-caret-right"></i>');
	jQuery(".previouspostslink").html('<i class="icon-caret-left"></i>');
	jQuery('.list1 li').prepend('<i class="icon-angle-right"></i>');
	jQuery('.list2 li').prepend('<i class="icon-remove"></i>');
	jQuery('.list3 li').prepend('<i class="icon-heart"></i>');
	jQuery('.list4 li').prepend('<i class="icon-pencil"></i>');
	jQuery('.list5 li').prepend('<i class="icon-wrench"></i>');
	jQuery('.searchform').append('<i class="icon-search"></i>');
	jQuery('.yith-wcwl-add-button.show').prepend('+ ');
	jQuery('.widget_product_categories > h3').remove();
	jQuery('.product-categories > li > a').prepend('<i class="icon-caret-down caretos transi"></i>');
	jQuery('.product-categories li > ul > li > a').prepend('- ');
	jQuery('.product-categories li > ul > li').last().addClass('pb00');
	jQuery('#cb-menu ul li a').prepend('<i class="icon-caret-right caretos transi"></i>');
	jQuery('#sidebar_l li > h3').prepend('<i class="icon-caret-down caretos_brown transi"></i>');
	jQuery('#sidebar_r li > h3').prepend('<i class="icon-caret-down caretos_brown transi"></i>');
	jQuery('.widget_categories li a').prepend('<i class="icon-chevron-right"></i>');
	jQuery('.footer .menu li').prepend('<i class="icon-angle-right"></i>');
	jQuery('#breadcrumbs a:first').addClass('first');
	jQuery('.wpcf7-submit').addClass('bttn_big');
	jQuery('#sidebar_l li').last().addClass('mb00');
	jQuery('#sidebar_r li').last().addClass('mb00');
	var pgnavi_html=jQuery('.wp-pagenavi').html(); if(pgnavi_html=='')jQuery('.wp-pagenavi').addClass('n_hide');
	var bready=jQuery('#breadcrumbs').html();
	if(bready!=''&&bready!=undefined&&bready!='undefined'){
	jQuery('#breadcrumbs').html(bready); } 
	jQuery('.searchform i').click(function(){
		jQuery(this).parent().submit();
		
	});
});
