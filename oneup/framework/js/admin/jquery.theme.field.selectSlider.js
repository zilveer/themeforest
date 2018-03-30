(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldSelectSlider = {	
		conf: {
			api: false
		} 
	};
	
	function PeFieldSelectSlider(target, conf) {
		var fields; 
		
		// init function
		function start() {
			fields = target.closest("div.contents").find("input,select,textarea").filter('[data-name^="slider_"]');
			target.bind("change",change);
			target.triggerHandler("change");
		}
		
		function hideAll() {
			fields.closest("div.option").hide().end();
		}
		
		function change() {
			var type = target.val();
			hideAll();
			fields.filter('[data-name^="slider_%0"]'.format(type)).closest("div.option").show().end();
		}
		
		function show() {
			target.closest("div.option").show();
			target.triggerHandler("change");
		}
		
		function hide() {
			target.closest("div.option").hide();
			hideAll();
		}
		
		$.extend(this, {
			// plublic API
			show: show,
			hide: hide,
			destroy: function() {
				target.data("peFieldSelectSlider", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peFieldSelectSlider = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldSelectSlider");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldSelectSlider.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldSelectSlider(el, conf);
			el.data("peFieldSelectSlider", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));