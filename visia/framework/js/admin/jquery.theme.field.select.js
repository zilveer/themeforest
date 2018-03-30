(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldSelect = {	
		conf: {
			api: false
		} 
	};
	
	function PeFieldSelect(target, conf) {
		var edit,base;
		
		// init function
		function start() {
			if (target.attr("data-edit")) {
				base = target.attr("data-edit");
				target.bind("change",change);
				target.triggerHandler("change");
			}
		}
		
		function change() {
			if (!edit) {
				edit = $('<a class="pe-edit"></a>');
				target.after(edit);
			}
			edit.attr("href",base.format(target.val()));
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldSelect", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldSelect = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldSelect");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldSelect.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldSelect(el, conf);
			el.data("peFieldSelect", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));