jQuery(function () {
	jQuery('.carousel-loader').hide();
});

jQuery(window).bind("load", function() {
	jQuery('.c-element-preload').fadeOut(0);
	jQuery('.carousel-loader:hidden').fadeIn(500);
});

