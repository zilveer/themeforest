jQuery(document).ready(function($) {
	"use strict";
	
	// Import button loading
	$('.mnky_import_demo').click(function () {
		$(this).addClass('importing_demo');
		$('.mnky_import_demo span').delay(400).fadeOut(function() {
			$(this).text('Please Wait!').fadeIn(400);
		});	
	});

	
});