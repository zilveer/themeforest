jQuery(document).ready(function(){
	
	if (jQuery('#colorpicker').length) {
	jQuery('#colorpicker').hide();
	jQuery('#colorpicker').farbtastic('#color');

	jQuery('#color').click(function() {
		jQuery('#colorpicker').fadeIn();
	});

    jQuery(document).mousedown(function() {
		jQuery('#colorpicker').each(function() {
			var display = jQuery(this).css('display');
			if ( display == 'block' )
			jQuery(this).fadeOut();
		});
	});	
	
	}
	
	jQuery('.on_off').click(function() {
		jQuery(this).toggleClass('offswitch');
		if (jQuery(this).hasClass('offswitch')){
			jQuery(this).parents('.lefterinner').find('#onoffswitch').val('off');
		} else {
			jQuery(this).parents('.lefterinner').find('#onoffswitch').val('');
		}
	});	
	
	jQuery('.valup').click(function() {
		var valholder = jQuery(this).parents('.valswitch').find('.valname'),
			valinput = jQuery(this).parents('.lefterinner').find('#updownswitch'),
			theval = valholder.html();		
		theval++;		
		valholder.html(theval);
		valinput.val(theval);		
	});
	
	jQuery('.valdown').click(function() {
		var valholder	= jQuery(this).parents('.valswitch').find('.valname'),
			valmin 		= jQuery(this).parents('.valswitch').attr('rel'),
			valinput 	= jQuery(this).parents('.lefterinner').find('#updownswitch'),
			theval 		= valholder.html();		
		theval--;	
		if (theval < valmin) {
			theval = valmin;
		}	
		valholder.html(theval);
		valinput.val(theval);		
	});
	
	jQuery('.socprim').click(function() {
		jQuery(this).toggleClass('socselected');
		if (jQuery(this).hasClass('socselected')){
			jQuery(this).parents('.soctop').find('#setinputvaluesec').val('on');
		} else {
			jQuery(this).parents('.soctop').find('#setinputvaluesec').val('');
		}
				
	});
	
	jQuery('.socsec').click(function() {
		jQuery(this).toggleClass('socselected');
		if (jQuery(this).hasClass('socselected')){
			jQuery(this).parents('.soctop').find('#setinputvaluesec').val('on');
		} else {
			jQuery(this).parents('.soctop').find('#setinputvaluesec').val('');
		}
				
	});				
	
	if (jQuery('.nav-tabs').length >= 1)	{
		var pa = 0;		
		jQuery('.nav-tabs').children('.nav-tab').each(function() {
				pa = pa + 37 + jQuery(this).width();
			});
		jQuery('.nav-tabs').css('width', pa + 'px')
		var p = jQuery('.nav-tabs').width();
		if (p > 720){
			var a = 0;
			jQuery('.nav-tabs-arrow-right').show();
			jQuery('.nav-tabs').children('.nav-tab').each(function() {
				a = a + 37 + jQuery(this).width();
			});
			jQuery('.nav-tabs').css('width',a + 'px');
		} else {
			var a = 0;
			jQuery('.nav-tabs').children('.nav-tab').each(function() {
				a = a + 38 + jQuery(this).width();
			});
			jQuery('.nav-tabs').css('width',a + 'px');
		}		
	}
	
	var tabposition = 0;
	var leftab = 0
	
	jQuery('.nav-tabs-arrow-right').click(function() {
		var leftposition = jQuery('.nav-tabs .nav-tab:eq(' + tabposition + ')').width() + 36;
		jQuery('.nav-tabs ').animate({marginLeft: '-=' + leftposition}, 500);
		tabposition++;
		leftab = leftab + leftposition;
		var leftover = jQuery('.nav-tabs').width() - leftab;
		if (leftover < 720 ) {
			jQuery('.nav-tabs-arrow-right').hide();
		}
		jQuery('.nav-tabs-arrow-left').show();
		return false;
	});
	
	jQuery('.nav-tabs-arrow-left').click(function() {
		hiddentab = tabposition - 1;
		var leftposition = jQuery('.nav-tabs .nav-tab:eq(' + hiddentab + ')').width() + 36;
		jQuery('.nav-tabs ').animate({marginLeft: '+=' + leftposition}, 500);
		tabposition--;
		leftab = leftab - leftposition;
		if (leftab == 0 ) {
			jQuery('.nav-tabs-arrow-left').hide();
		}
		jQuery('.nav-tabs-arrow-right').show();
		return false;
	});
});			
	