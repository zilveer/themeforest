jQuery(document).ready(function($) {
	"use strict";

	var unfoldClassString = ".unfold-3d-to-left, .unfold-3d-to-right, .unfold-3d-to-top, .unfold-3d-to-bottom, .unfold-3d-horizontal, .unfold-3d-vertical";
	var unfoldClasses = unfoldClassString.replace( /[.,]/g, '' );

	$(unfoldClassString).each(function() {
		$(this).find('.unfolder-content').width($(this).width());
	});

	$(window).resize(function() {
		var unfoldClassString = ".unfold-3d-to-left, .unfold-3d-to-right, .unfold-3d-to-top, .unfold-3d-to-bottom, .unfold-3d-horizontal, .unfold-3d-vertical";
		var unfoldClasses = unfoldClassString.replace( /[.,]/g, '' );

		$(unfoldClassString).each(function() {
			$(this).find('.unfolder-content').width($(this).width());
		});
	});
});