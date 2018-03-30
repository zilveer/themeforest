(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxVideo = {	
		conf: {
			api: true,
			tag: "video"
		} 
	};
	
	function PeMetaboxVideo(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var type=target.find("#%0_type_".format(id));
		var formats=target.find("#%0_formats__buttonset".format(id)).parents("div.option");
		var upload=target.find("#upload_%0_url_".format(id));
		var poster=target.find("#%0_poster_".format(id)).closest("div.option");
		
		function change() {
			switch (type.val()) {
			case "local":
				upload.show();
				formats.show().find("input").data("ignore",false);
				poster.show().find("input").data("ignore",false);
				break;
			default:
				upload.hide();
				formats.hide().find("input").data("ignore",true);
				poster.hide().find("input").data("ignore",true);
				break;
			}
		}
				
		// init function
		function start() {
			type.change(change).triggerHandler("change");
		}
		
		function shortcode() {
			return '[%0 type]'.format(conf.tag);
		}

		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxVideo", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxVideo = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxVideo");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxVideo.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxVideo(el, conf);
			el.data("peMetaboxVideo", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_video").peMetaboxVideo();
});

