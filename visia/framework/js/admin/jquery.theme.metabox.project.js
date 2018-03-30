(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxProject = {	
		conf: {
			api: true
		} 
	};
	
	function PeMetaboxProject(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var layout=target.find("#%0_layout_".format(id));
		var sidebar = $("#pe_theme_meta_sidebar");
		
		function change() {
			switch (layout.val()) {
			case "full":
				sidebar.show();
				break;
			default:
				sidebar.hide();
				break;
			}
		}
				
		// init function
		function start() {
			layout.change(change).triggerHandler("change");
			//setTimeout(triggerHandler,200);
		}
		
		function triggerHandler() {
			layout.triggerHandler("change");			
		}

		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxProject", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxProject = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxProject");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxProject.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxProject(el, conf);
			el.data("peMetaboxProject", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_project").peMetaboxProject();
});

