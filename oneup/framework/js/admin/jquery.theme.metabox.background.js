(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxBackground = {	
		conf: {
			api: true
		} 
	};
	
	function PeMetaboxBackground(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var type=target.find('input[id^="%0_type_"]'.format(id));
		var image=target.find("#%0_image_".format(id)).closest("div.option");
		var mobile=target.find("#%0_mobile_".format(id)).closest("div.option");
		var gallery=target.find("#%0_gallery_".format(id)).closest("div.option");
		var resource=target.find('input[id^="%0_resource_"]'.format(id));
		var overlay=target.find('input[id^="%0_overlay_"]'.format(id));
		var pattern=target.find("#%0_overlayImage_".format(id)).closest("div.option");
		
		function change() {
			//console.log(type.filter(":checked").val());
			var res = resource.filter(":checked").val();
			var ov = overlay.filter(":checked").val();
			switch (type.filter(":checked").val()) {
			case "color":
			case "bw":
				if (res == "image") {
					image.show();
					gallery.hide();
				} else {
					image.hide();
					gallery[res == "gallery" ? "show" : "hide"]();
				}
				mobile.show();
				resource.closest("div.option").show();
				overlay.closest("div.option").show();
				pattern[ov == "yes" ? "show" : "hide"]();	
				break;
			default:
				image.hide();
				mobile.hide();
				resource.closest("div.option").hide();
				overlay.closest("div.option").hide();
				pattern.hide();
				gallery.hide();
				break;
			}
		}
				
		// init function
		function start() {
			type.change(change).triggerHandler("change");
			resource.change(change);
			overlay.change(change);
		}
		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxBackground", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxBackground = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxBackground");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxBackground.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxBackground(el, conf);
			el.data("peMetaboxBackground", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_background").peMetaboxBackground();
});

