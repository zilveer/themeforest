(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peShortcodeColumns = {	
		conf: {
			api: true,
			tag: "col"
		} 
	};
	
	function PeShortcodeColumns(target, conf) {
		
		// init function
		function start() {
		}
		
		function shortcode() {
			var values = target.val().split(" ");
			var max = values.length;
			var sc = "";
			for (var i = 0;i < max; i++) {
				sc += '[%3 %2="%0"]%1[/%3]'.format(values[i]," content ", i == (max-1) ? "last" : "size",conf.tag);
			}
			return sc;
		}
		
		$.extend(this, {
			// plublic API
			shortcode:shortcode,
			destroy: function() {
				target.data("peShortcodeColumns", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peShortcodeColumns = function(conf) {
		
		// return existing instance	
		var api = this.data("peShortcodeColumns");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peShortcodeColumns.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeShortcodeColumns(el, conf);
			el.data("peShortcodeColumns", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));