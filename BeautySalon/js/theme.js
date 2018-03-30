/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

jQuery(function($) {

	var config = $('html').data('config') || {};

	// Social buttons
	$('article[data-permalink]').socialButtons(config);

	// Set content height
	var content = $('.tm-middle');

	$(window).on('resize', (function(){

		fn = function(){

			var navHeight	  = $('.tm-navbar-full').outerHeight(),
				footerSmall   = $('.tm-footer-small').is(':visible') ? $('.tm-footer-small').outerHeight() : 0,
				winHeight 	  = $(window).height();

			setTimeout(function(){

				if(content.height() < winHeight){

					//content.css({'height': winHeight - navHeight - footerSmall});

				}

			}, 200);

		}

		fn();

		return fn;

	})());

});
