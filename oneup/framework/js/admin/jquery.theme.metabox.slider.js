(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxSlider = {	
		conf: {
			api: true,
			tag: "video"
		} 
	};
	
	function PeMetaboxSlider(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var transition = target.find("select[id^=%0_transition_]".format(id));
		var layout=target.find("input[id^=%0_layout_]".format(id));
		var speed=target.find("input[id^=%0_speed_]".format(id)).closest("div.option");
		var bg=target.find("input[id^=%0_bg_]".format(id));
		var delay=target.find("#%0_delay_".format(id));		
		var max=target.find("#%0_max_".format(id)).closest("div.option");
		var autopause=target.find("input[id^=%0_autopause_]:first".format(id)).closest("div.option");
		var min=target.find("#%0_min_".format(id)).closest("div.option");
		var video=target.find("#%0_video_".format(id)).closest("div.option");
		var loop=target.find("input[id^=%0_loop_]:first".format(id)).closest("div.option");
		var fallback=target.find("#%0_fallback_".format(id)).closest("div.option");
		
		function change(e) {
			switch (layout.filter(":checked").val()) {
			case "fullwidth":
				max.show();
				min.show();
				break;
			default:
				max.hide();
				min.hide();
			}
			if (delay.val() > 0) {
				autopause.show();
			} else {
				autopause.hide();
			}
			if (bg.filter(":checked").val() === "video") {
				video.show();
				loop.show();
				fallback.show();
			} else {
				video.hide();
				loop.hide();
				fallback.hide();
			}
			if (transition.length && speed.length) {
				if (transition.val() === "fade") {
					speed.hide();
				} else {
					speed.show();
				}
			}
		}
		
		// init function
		function start() {
			layout.change(change).triggerHandler("change");
			delay.change(change);
			bg.change(change);
			if (transition.length && speed.length) {
				transition.change(change);
			}
		}
		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxSlider", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxSlider = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxSlider");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxSlider.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxSlider(el, conf);
			el.data("peMetaboxSlider", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_slider").peMetaboxSlider();
});

