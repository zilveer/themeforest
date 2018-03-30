(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxLink = {	
		conf: {
			api: true,
			tag: "video"
		} 
	};
	
	function PeMetaboxLink(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var type=target.find("input[id^=%0_type_]".format(id));
		var fixed=target.find("#%0_fixed_".format(id)).closest("div.option");
		
		function change(e) {
			
			switch (type.filter(":checked").val()) {
			case "fixed":
				fixed.show();
				break;
			default:
				fixed.hide();
			}
		}
		
		// init function
		function start() {
			type.change(change).triggerHandler("change");
		}
		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxLink", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxLink = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxLink");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxLink.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxLink(el, conf);
			el.data("peMetaboxLink", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_link").peMetaboxLink();
});

