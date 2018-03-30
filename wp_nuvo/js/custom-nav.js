(function($) { "use strict";
jQuery(document).ready(function($) {
	$('.header-wrapper').onePageNav({
		currentClass:'current_page_item',
		easing: one_page.easing,
		scrollSpeed: parseInt(one_page.scrollSpeed),
		scrollOffset: parseInt(one_page.scrollOffset),
		changeHash: false
	});
});
})(jQuery);
