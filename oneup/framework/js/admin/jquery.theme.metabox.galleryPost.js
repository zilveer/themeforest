(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxGalleryPost = {	
		conf: {
			api: true,
			tag: "video"
		} 
	};
	
	function PeMetaboxGalleryPost(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var type=target.find("#%0_type_".format(id));
		var scale=target.find("#%0_scale_".format(id)).closest("div.option");
		var bw=target.find("#%0_bw__0".format(id)).closest("div.option");
		
		function change() {
			switch (type.val()) {
			case "shutter":
				bw.show();
				scale.hide();
				break;
			default:
				bw.hide();
				scale.show();
				break;
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
				target.data("peMetaboxGalleryPost", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxGalleryPost = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxGalleryPost");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxGalleryPost.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxGalleryPost(el, conf);
			el.data("peMetaboxGalleryPost", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_galleryPost").peMetaboxGalleryPost();
});

