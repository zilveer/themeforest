jQuery.noConflict();
jQuery(document).ready(function() {
	
	//jQuery(".thumbnail").preloader();
	jQuery(".shadow").preloader();
	jQuery(".show-code").click(function(){ jQuery(this).toggleClass("open");})
	
    jQuery(".button, input[type=submit]").hover(function () {
			    jQuery(this).animate({
				    opacity: 0.8
			    }, "fast");
		    },
		    function () {
		    	jQuery(this).animate({
		    		opacity: 1
		    	}, "fast");
		    });
		    
	jQuery(".v1").tooltip();
	jQuery(".v2").tooltip();
	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({theme: 'facebook'});
	
	/*PORTFOLIO FILTER*/
	jQuery('ul.skills a').click(function() {
		jQuery(this).css('outline','none');
		jQuery('ol.skills .current').removeClass('current');
		jQuery(this).parent().addClass('current');
		
		var filterVal = jQuery(this).attr('rel');	
		if(filterVal == 'all') {
			jQuery('ul#portfolio_list li.hidden').fadeIn('slow').removeClass('hidden');
		} else {
			
			jQuery('ul#portfolio_list li').each(function() {
				if(!jQuery(this).hasClass(filterVal)) {
					jQuery(this).fadeOut('normal').addClass('hidden');
				} else {
					jQuery(this).fadeIn('slow').removeClass('hidden');
				}
			});
		}
		
		return false;
	});
});