(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peGallerySlider = {	
		conf: {
			api: false
		} 
	};
	
	function PeGallerySlider(target, conf) {
		
		var thumbnails,slider,starget,timer,loaded = false;
		
		function jump(el) {
			slider.show(thumbnails.find(el.currentTarget).data("slide"));
			return false;
		}

		
		function init() {
			loaded = true;
			resize();
			thumbnails.on("click","a",jump);
		}
		
		function resize(e) {
			if (!loaded) {
				return;
			}
			var cell = thumbnails.find("a:eq(0)");
			var m = parseInt(cell.css("margin-bottom"),10);
			var grid = parseInt(cell.outerHeight(),10)+m;
			var h;
			if (grid > 20) {
				starget.parent().height("auto");
				h = parseInt(starget.height(),10)+m;
				h = Math.floor(h / grid)*grid-m;				
			} else {
				h = "auto";
			}
			starget.parent().height(h);

		}
		
		function addID(idx) {
			thumbnails.find(this).data("slide",idx+1);
		}

		
		// init function
		function start() {
			thumbnails = target.find(".image-browser");
			thumbnails.find("a").each(addID);
			
			starget = target.find(".peSlider");
			slider = starget.data("peVoloSimpleSkin").getSlider();
			slider.bind("resize.pixelentity",resize);
			$.pixelentity.preloader.load(thumbnails,init);
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peGallerySlider", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peGallerySlider = function(conf) {
		
		// return existing instance	
		var api = this.data("peGallerySlider");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peGallerySlider.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeGallerySlider(el, conf);
			el.data("peGallerySlider", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));