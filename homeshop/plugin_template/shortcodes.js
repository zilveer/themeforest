jQuery(function() {
	
	/* Accordion */
	jQuery('.flash_sale-shortcode-toggle-active').each(function() {
		jQuery(this).find('.flash_sale-shortcode-toggle-content').show();
	});
	jQuery('.flash_sale-shortcode-toggle .flash_sale-shortcode-toggle-heading').click(function() {
		var toggle = jQuery(this).parent('.flash_sale-shortcode-toggle');
		if(jQuery(this).parent('.flash_sale-shortcode-toggle').parent('div').hasClass('flash_sale-shortcode-accordion')) {
			toggle.parent('div').find('.flash_sale-shortcode-toggle').find('.flash_sale-shortcode-toggle-content:visible').slideUp();
			toggle.parent('div').find('.flash_sale-shortcode-toggle-active').removeClass('flash_sale-shortcode-toggle-active');
			toggle.toggleClass('flash_sale-shortcode-toggle-active');
			toggle.find('.flash_sale-shortcode-toggle-content').slideToggle(500);
		} else {
			toggle.toggleClass('flash_sale-shortcode-toggle-active');
			toggle.find('.flash_sale-shortcode-toggle-content').slideToggle(500);
		}
	});
	
	
	/* Tabs */
	jQuery('.flash_sale-shortcode-tabs').each(function() {
		
		jQuery(this).prepend('<div class="flash_sale-shortcode-tab-buttons"></div>');
		jQuery(this).find('.flash_sale-shortcode-tabpane').each(function() {
			
			jQuery(this).parent('.flash_sale-shortcode-tabs').find('.flash_sale-shortcode-tab-buttons').append('<a href="#">'+jQuery(this).find('.flash_sale-shortcode-tab-label').text()+'</a>');
			jQuery(this).find('.flash_sale-shortcode-tab-label').remove();
			
		});
		
		jQuery(this).find('.flash_sale-shortcode-tab-buttons').find('a:first').addClass('active');
		jQuery(this).find('.flash_sale-shortcode-tabpane').hide();
		jQuery(this).find('.flash_sale-shortcode-tabpane:first').show();
		
	});
	
	var tab_to_show = 0;
	jQuery(document).on('click', '.flash_sale-shortcode-tab-buttons a', function() {
		tab_to_show = jQuery(this).parent('.flash_sale-shortcode-tab-buttons').find('a').index(jQuery(this));
		jQuery(this).parent('.flash_sale-shortcode-tab-buttons').parent('.flash_sale-shortcode-tabs').find('.flash_sale-shortcode-tabpane').hide();
		jQuery(this).parent('.flash_sale-shortcode-tab-buttons').parent('.flash_sale-shortcode-tabs').find('.flash_sale-shortcode-tabpane').eq(tab_to_show).show();
		jQuery(this).parent('.flash_sale-shortcode-tab-buttons').find('a').removeClass('active');
		jQuery(this).parent('.flash_sale-shortcode-tab-buttons').find('a').eq(tab_to_show).addClass('active');
		return false;
	});
	
});