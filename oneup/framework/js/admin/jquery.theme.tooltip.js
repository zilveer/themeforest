(function($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint,ajaxurl */
	
	var def = {
			tooltipClass: 'pe-theme-admin-tooltip',
			items: 'span.help[title]',
			show: { effect: "fadeIn", delay: 200, duration: 200 },
			hide: { effect: "fadeOut", duration: 0 },
			content: function () { return $(this).attr("title"); },
			position: {
				my: "left-166 bottom-20",
				at: "left top",
				collision: "none",
				using: function( position, feedback ) {
					$(this).css(position);
					$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this );
				}
			}
		};
	
	$.pixelentity = $.pixelentity || {};
	$.pixelentity.tooltip = function (target,conf) {
		if (conf && conf.position) {
			conf.position = $.extend(true,{},def.position,conf.position);
		}
		target.tooltip($.extend(true,{},def,conf));
	};
	
}(jQuery));
