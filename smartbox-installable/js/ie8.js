
	if ($('.thepostcont').length){
		var totalHeight = $('.thepostcont').width();
		$('.thepostcont').css('width',totalHeight-75+'px');
	}

	$('.breadcrumbs-container').appendTo($('#white_content'));
	
jQuery(document).ready(function(){
	
	if (jQuery('.special_tabs').length){
		jQuery('.special_tabs').each(function(){
			jQuery(this).find('.tab-container').css('height','100%').children().addClass("twelve columns");
		});
	}
	
	
	if (jQuery('.rounded').length){
		jQuery('.rounded').each(function(){
			DD_roundies.addRule(jQuery(this),'5px');
		});
	}
	
	if (jQuery('.button').length){
		jQuery('.button').each(function(e){
			if (!jQuery(this).parents('#slider_container').length){
				jQuery(this).addClass('ierounder-'+e);
				jQuery(this).css('filter','none');
				var ierounder = ".ierounder-"+e;
				DD_roundies.addRule(ierounder, '3px');
			}
		});
	}
	
	if (('iframe').length){
		jQuery('iframe').attr('wmode','transparent');
	}
	
	
	
	if (jQuery('ul.ch-grid li a').length){
		jQuery('ul.ch-grid li a').each(function(){
			jQuery(this).unbind('mouseenter mouseleave');
			jQuery(this).hover(function(){
				jQuery(this).find('h3').stop().animate({'opacity':1},200);
			}, function(){
				jQuery(this).find('h3').stop().animate({'opacity':0},200);
			})
		});
	}
	
});