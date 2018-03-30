(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peVoloSimpleSkin = {	
		conf: {
			api: false
		} 
	};
	
	var ieOld = $.browser.msie && $.browser.version < 9;
	
	function PeVoloSimpleSkin(target, conf) {
		var slider;
		var slides;
		var prevC,nextC,bulletsC;
		var w,h;
		
		function resizeControls() {
			if (!w || !h || w<20 || h<20) {
				setTimeout(resize,100);
				return;
			}
			var offset = 0;
			if (nextC) {
				switch (target.attr("data-controls-arrows")) {
				case "edges":
					nextC.css({top: (h-nextC.height())/2,left: w-nextC.width()-6}).show();
					prevC.css({top: (h-prevC.height())/2,left: 6}).show();
					break;
				case "edges-full":
					nextC.css({top: 0,left: w-nextC.width()}).show();
					prevC.css({top: 0,left: 0}).show();
					nextC.height(h);
					prevC.height(h);
					// ie8
					if (ieOld) {
						prevC.find("a").height(h);
						nextC.find("a").height(h);
					}
					break;
				case "edges-buttons":
					var cw = nextC.width();
					var ch = nextC.height();
					nextC.addClass("pe-edges-buttons").css("top",(h-ch) >> 1).show();
					prevC.addClass("pe-edges-buttons").css("top",(h-ch) >> 1).show();
					
					// ie8
					if (ieOld) {
						//prevC.find("a").height(ch).width(cw);
						//nextC.find("a").height(ch).width(cw);
					}
					break;
				default:
					offset = w-nextC.width()-12;
					nextC.css({top: h-nextC.height()-8,left: offset}).show();
					offset -= (prevC.width()-2);
					prevC.css({top: h-prevC.height()-8,left: offset}).show();					
				}
				
			}
			
			if (bulletsC) {
				bulletsC.css({top: h-bulletsC.height()-12,left: 9}).show();
			}
		}
		
		function prev() {
			slider.prev();
			return false;
		}
		
		function next() {
			slider.next();
			return false;
		}
		
		function jump(el) {
			var idx = el.currentTarget.getAttribute("data-idx");
			slider.show(parseInt(idx,10)+1);
			return false;
		}
		
		function select(idx) {
			if (bulletsC) {
				bulletsC.find("a").removeClass("selected").eq(idx).addClass("selected");
			}			
		}

		
		function change(e,data) {
			select(data.slideIdx-1);
		}


		
		function buildUI() {
			if (target.attr("data-controls-arrows") != "disabled") {
				prevC = $(
					'<div class="peVoloPrev"><a href="#">%0</a></div>'
						.format(target.attr("data-icon-font")  == "enabled" ? '<i class="icon-left-open"></i>' : '')
				).find("a").click(prev).end().hide();
				
				nextC = $(
					'<div class="peVoloNext"><a href="#">%0</a></div>'
						.format(target.attr("data-icon-font") == "enabled" ? '<i class="icon-right-open"></i>' : '')
				).find("a").click(next).end().hide();
			}
			
			if (target.attr("data-controls-bullets") != "disabled") {
				bulletsC = $('<div class="peVoloBullets"></div>').hide();
				for (var i=0;i<slides;i++) {
					bulletsC.append('<a href="#" data-idx="'+i+'"></a>');
				}
				bulletsC.delegate("a","click",jump);
				select(0);	
			}
			
			if (prevC) target.prepend(prevC).prepend(nextC);
			if (bulletsC) target.prepend(bulletsC);
			resizeControls();
		}

		
		function ready(e,data) {
			slides = data.slides;
			if (slides > 1) {
				buildUI();
			}
		}
		
		function doResize() {
			w = target.width();
			h = target.height();
			resizeControls();
		}

		
		function resize() {
			doResize();
			// sometimes it's needed
			setTimeout(doResize,50);
		}

		
		
		// init function
		function start() {
			slider = target[target.attr("data-plugin") || "peVolo"]({api:true});
			
			var captions = target.peVoloCaptions({
					api:true,
					slider:slider,
					origH:parseInt(target.attr("data-orig-height"),10),
					origW:parseInt(target.attr("data-orig-width"),10),
					orig:target.attr("data-orig") 
				});
			
			slider.bind("ready.pixelentity",ready);
			slider.bind("resize.pixelentity",resize);
			slider.bind("change.pixelentity",change);
		}
		
		function getSlider() {
			if (slider) {
				return slider;
			}
			return false;
		}

		
		$.extend(this, {
			// plublic API
			getSlider: getSlider,
			destroy: function() {
				target.data("peVoloSimpleSkin", null);
				target = undefined;
			}
		});
		
		// initial0ize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peVoloSimpleSkin = function(conf) {
		
		// return existing instance	
		var api = this.data("peVoloSimpleSkin");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peVoloSimpleSkin.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeVoloSimpleSkin(el, conf);
			el.data("peVoloSimpleSkin", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));