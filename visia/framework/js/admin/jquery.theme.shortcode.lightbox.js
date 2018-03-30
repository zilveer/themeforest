(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peShortcodeLightbox = {	
		conf: {
			api: true,
			tag: "video"
		} 
	};
	
	function PeShortcodeLightbox(target, conf) {
		
		var id = target.attr("id");
		var type=target.find("#%0_type_".format(id));
		var formats=target.find("#%0_formats__buttonset".format(id)).closest("div.option");
		var upload=target.find("#upload_%0_video_".format(id));
		var video=target.find("#%0_video_".format(id)).closest("div.option");
		var poster=target.find("#%0_poster_".format(id)).closest("div.option");
		var image=target.find("#%0_image_".format(id)).closest("div.option");
		var size=target.find("#%0_size_".format(id)).closest("div.option");
		
		function hide() {
			for(var i = 0; i < arguments.length; i++ ) {
				 arguments[i].hide().find("input").data("ignore",true);
			}
		}
		
		function show(el) {
			for(var i = 0; i < arguments.length; i++ ) {
				arguments[i].show().find("input").data("ignore",false);
			}
		}
		
		function change() {
			switch (type.val()) {
			case "image":
				show(image);
				hide(formats,video,size);
				break;
			case "local":
				upload.show();
				show(video,formats,size);
				hide(image);
				break;
			default:
				upload.hide();
				show(video,size);
				hide(formats,image);
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
				target.data("peShortcodeLightbox", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peShortcodeLightbox = function(conf) {
		
		// return existing instance	
		var api = this.data("peShortcodeLightbox");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peShortcodeLightbox.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeShortcodeLightbox(el, conf);
			el.data("peShortcodeLightbox", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));