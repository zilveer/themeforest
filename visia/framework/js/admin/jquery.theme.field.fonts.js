(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldFonts = {
		conf: {
			api: false
		} 
	};
	
	var fonts = [];
	var loading = 0;
	var loader;
	
	function PeFieldFonts(target, conf) {
		
		var preview;
		
		function check(idx,el) {
			el = $(el);
			el.text(el.text() + " b,i");
		}

		
		// init function
		function start() {
			preview = $('<div class="pe_font_preview" ><span class="pe_font"></span></div>');
			target.parent().parent().append(preview);
			target.bind("change",change).triggerHandler("change");
		}
		
		function reloadFonts() {
			if (!loader) {
				loader = $('<link rel="stylesheet" type="text/css" />');
				$("head").append(loader);
			}
			loader.attr("href",'http://fonts.googleapis.com/css?family=%0'.format(fonts.join("|").replace(/ /,"+")));
			loading = 0;
		}

		
		function change() {
			var val = target.val();
			if (val && val != "0") {
				if ($.inArray(val,fonts) === -1) {
					fonts.push(val);
					if (!loading) {
						loading = setTimeout(reloadFonts,100);
					}
				}
				preview[0].className = "pe_font_preview "+target.find("option:selected")[0].className;
				preview
					.find("span.pe_font")
					.css("font-family",val)
					.html(val)
					.end()
					.show();
				
			} else {
				preview.hide();				
			}
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldFonts", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldFonts = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldFonts");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldFonts.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldFonts(el, conf);
			el.data("peFieldFonts", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));