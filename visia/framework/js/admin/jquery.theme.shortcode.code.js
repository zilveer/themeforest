(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peShortcodeCode = {	
		conf: {
			api: true
		} 
	};
	
	function html_encode(str) {
        var s = "";
        if (str.length === 0) {
			return "";
		}
        s = str.replace(/&/g, "&gt;");
        s = s.replace(/</g, "&lt;");
        s = s.replace(/>/g, "&gt;");
        s = s.replace(/ /g, "&nbsp;");
        s = s.replace(/\t/g, "&nbsp;&nbsp;&nbsp;&nbsp;");
        s = s.replace(/\'/g, "&#39;");
        s = s.replace(/\"/g, "&quot;");
        s = s.replace(/\n/g, "<br>");
        return s;
    }
	
	function PeShortcodeCode(target, conf) {
		
		// init function
		function start() {
		}
		
		function shortcode() {
			var content = html_encode(target.val());
			var opt,cls = "";
			for (var i=0;i<conf.options.length;i++) {
				opt = $(conf.options[i]);
				if (opt.is(":checked")) {
					cls += " "+opt.val();
				}
			}
			
			var sc = '<pre class="prettyprint lang-%1%2">%0</pre>'.format(content,conf.lang.val(),cls);
			return sc;
		}
		
		$.extend(this, {
			// plublic API
			shortcode:shortcode,
			destroy: function() {
				target.data("peShortcodeCode", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peShortcodeCode = function(conf) {
		
		// return existing instance	
		var api = this.data("peShortcodeCode");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peShortcodeCode.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeShortcodeCode(el, conf);
			el.data("peShortcodeCode", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));