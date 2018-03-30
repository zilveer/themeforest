(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peShortcodeProperties = {	
		conf: {
			api: true,
			tag: "prop"
		} 
	};
	
	function PeShortcodeProperties(target, conf) {
		
		// init function
		function start() {
		}
		
		function shortcode() {
			var max = parseInt(target.val(),10);
			var sc = "";
			for (var i = 0;i < max; i++) {
				sc += '[%3 %2="%0"]%1[/%3]'.format("name"," content ", i === 0 ? "first" : (i == (max-1) ? "last" : "name"),conf.tag);
			}
			return sc;
		}
		
		$.extend(this, {
			// plublic API
			shortcode:shortcode,
			destroy: function() {
				target.data("peShortcodeProperties", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peShortcodeProperties = function(conf) {
		
		// return existing instance	
		var api = this.data("peShortcodeProperties");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peShortcodeProperties.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeShortcodeProperties(el, conf);
			el.data("peShortcodeProperties", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));