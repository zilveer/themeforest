(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldSelectColumns = {	
		conf: {
			api: false,
			size: 343,
			classes: ["peOdd","peEven"]
		} 
	};
	
	
	function PeFieldSelectColumns(target, conf) {
		
		// init function
		function start() {
			target.change(change).triggerHandler("change");
		}
		
		function change() {
			var values = target.val().split(" ");
			var max = values.length;
			var cols = [];
			var coldef;
			var i;
			var size;
			var table = "<table class=\"peColumnsPreview\"><tr>";
			
			for (i = 0;i < max; i++) {
				coldef = values[i].split("/");
				size = parseInt(conf.size*parseInt(coldef[0],10)/parseInt(coldef[1],10),10);
				table += '<td style="width: %0px;" class="%1">%2</td>'.format(size,conf.classes[i % 2],values[i]);
			}
			
			table += "</tr></table>";
			
			target.parent().parent().find("table").remove().end().append(table);
			
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldSelectColumns", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldSelectColumns = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldSelectColumns");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldSelectColumns.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldSelectColumns(el, conf);
			el.data("peFieldSelectColumns", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));