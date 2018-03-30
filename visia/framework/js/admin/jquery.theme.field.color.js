(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldColor = {	
		conf: {
			api: false
		} 
	};
	
	function PeFieldColor(target, conf) {
		
		var hack = false;
		
		function change() {
			if (hack || target.val() !== "") {
				return;
			}
			
			hack = true;
			target.val("#f9f9f9");
			target.triggerHandler("change");
			target.val("");
			hack = false;
		}
		
		function start() {
			var palettes = true;
			
			if (target.attr("data-palette")) {
				palettes = JSON.parse(target.attr("data-palette"));
			}
			
			target.wpColorPicker({
				palettes: palettes
			});
			
			target.on("change",change);
		}

		$.extend(this, {
			// public API
			destroy: function() {
				target.data("peFieldColor", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldColor = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldColor");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldColor.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldColor(el, conf);
			el.data("peFieldColor", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));