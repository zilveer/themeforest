(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxLayout = {	
		conf: {
			api: true,
			tag: "video"
		} 
	};
	
	function PeMetaboxLayout(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var fullscreen=target.find("input[id^=%0_fullscreen_]".format(id));
		var content=target.find("input[id^=%0_content_]".format(id));
		var sidebar=target.find("input[id^=%0_sidebar_]".format(id));
		var widgets=target.find("#%0_widgets_".format(id)).closest("div.option");
		var title=target.find("input[id^=%0_title_]".format(id)).closest("div.option");
		var hmargin=target.find("input[id^=%0_headerMargin_]".format(id)).closest("div.option");
		var fmargin=target.find("input[id^=%0_footerMargin_]".format(id)).closest("div.option");
		
		function change(e) {
			if (fullscreen.filter(":checked").val() === "yes") {
				title.hide();
				hmargin.hide();
				content.closest("div.option").hide();
				sidebar.closest("div.option").hide();
				widgets.hide();
				fmargin.hide();
			} else {
				title.show();
				hmargin.show();
				content.closest("div.option").show();
				sidebar.closest("div.option").show();
				widgets.show();
				fmargin.show();
				switch (content.filter(":checked").val()) {
				case "fullwidth":
					widgets.hide();
					sidebar.closest("div.option").hide();
					break;
				default:
					sidebar.closest("div.option").show();
					if (sidebar.filter(":checked").val()) {
						widgets.show();
					} else {
						widgets.hide();
					}

				}
			}
		}
		
		// init function
		function start() {
			content.change(change).triggerHandler("change");
			sidebar.change(change);
			fullscreen.change(change);
		}
		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxLayout", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxLayout = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxLayout");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxLayout.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxLayout(el, conf);
			el.data("peMetaboxLayout", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_layout").peMetaboxLayout();
});

