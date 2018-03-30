jQuery(document).ready(function($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl */
	
	var menu = $("#menu-to-edit");
	
	function last() {
		$.pixelentity.tooltip(menu.find("li.menu-item:last"));
	}
	
	function addTooltip(e, xhr, settings) {		
		setInterval(last,500);
	}
	
	jQuery(document).ajaxSuccess(addTooltip);
	
	jQuery(function () {
		$.pixelentity.tooltip(menu);
	});

});

