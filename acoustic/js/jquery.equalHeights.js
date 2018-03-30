jQuery.fn.equalHeights = function(px) {
	jQuery(this).each(function(){
		var currentTallest = 0;
		jQuery(this).children().each(function(i){
			if (jQuery(this).outerHeight() > currentTallest) { currentTallest = jQuery(this).outerHeight(); }
		});
		jQuery(this).find('.widget-content').css({'min-height': currentTallest+1});
		jQuery(this).find('.product-item').css({'min-height': currentTallest+1});
	});
	return this;
};