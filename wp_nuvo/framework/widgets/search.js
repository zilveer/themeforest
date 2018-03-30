jQuery(document).ready(function ($) {
	"use strict";
	$(document).on('click', '.search-slider a',function() {
		"use strict";
		show_search();
	});
	$(window).scroll(function () {
		$('#search-slider').removeClass('active').addClass('hide');
	});
	function show_search() {
		var content = $('#search-slider');
		if(content.hasClass('hide')){
			content.removeClass('hide').addClass('active');
		} else {
			content.removeClass('active').addClass('hide');
		}
	}
});