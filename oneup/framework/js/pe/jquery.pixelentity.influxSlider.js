(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.influxSlider = {	
		conf: { 
			api: false,
			delay: 3000,
			fade: false,
			pause: true
		} 
	};
	
	function PeInfluxSlider(target, conf) {
		
		var self = this;
		var jthis = $(this);
		var slides = [];
		var timer;
		var slider;
		var index=0;
		var master;
		var haveLinks = false;
		var locked = true;
		var paused = false;
		var enabled = true;
		var links;
		var nav = "";
		
		function start() {
			target.bind("enable.pixelentity ",enable);
			target.bind("disable.pixelentity ",disable);
			
			target.addClass("peActiveWidget");
			target.children().each(parseSlide);
			if (slides.length > 0) {
				addNavigation();
				init();
				if (conf.pause) {
					target.bind("mouseenter mouseleave",evHandler);
				}
			}
		}
		
		function parseSlide(idx) {
			var link = false,img = false,parent;
			var el = $(this);
				
			nav += '<li><a id="'+idx+'" href="#">btn</a></li>';
				
			if (this.tagName.toLowerCase() == "img") {
				img = el;
			} else {
				if (el.attr("href")) {
					img = el.find("img:eq(0)");
					if (img.length > 0) {
						link = el;
						//link.replaceWith(img);
						link.before(img);
						link.css("position","absolute").css("z-index",100).css("display","block").hide();
						if ($.browser.msie && $.browser.version < 9) {
							link.css("opacity",0).css("background-color","black");
						}
						target.prepend(link);
						haveLinks = true;
					}
				}
			}
			
			if (img.length > 0) {
				slides.push({
					image: img,
					link: link
				});
				if (idx > 0) {
					img.detach();
				}
			}
		}
		
		function addNavigation() {
			nav = '<ul class="sliderNav">'+nav+'</ul>';
			target.before(nav);
			nav = target.parent().find(".sliderNav a");
			nav.click(evHandler);
		}
		
		function evHandler(e) {
			if (enabled) {
				switch (e.type) {
					case "click":
						if (!locked) {
							rotate(parseInt(e.currentTarget.id,10));
							timer.reset();
							//timer.start(conf.delay);
						}
					break;
					case "mouseenter":
					case "mouseleave":
						paused = (e.type == "mouseenter");
						timer[paused ? "pause" : "resume"]();
					break;
					
				}
			}
			return e.type == "click" ? false : true;
		}
		
		// used to disable timer
		function noop() {
		}
		
		function init() {
			links = target.find("a");
			slider = slides[0].image.peTransitionHilight({api:true,boost:1,fallback:conf.fade,disabled:true});
			slider.bind("ready.pixelentity change.pixelentity",next);
			timer = conf.delay > 0 ? new $.pixelentity.Timer(rotate) : {
				start: noop,
				pause: noop,
				resume: noop
			};
		}
		
		function next(e) {
			if (e.type == "ready") {
				if (haveLinks) {
					links.width(slider.width()).height(slider.height());
				}
				setLink();
			}
			timer.start(conf.delay);
			if (paused || !enabled) {
				timer.pause();
			}
			locked = false;
		}
		
		function setLink() {
			if (haveLinks) {
				links.hide();
				if (slides[index].link) {
					slides[index].link.show();
				}
			}
			nav.removeClass("selected").eq(index).addClass("selected").end();
		}
		
		function rotate(idx) {
			locked = true;
			index = idx >=0 ? idx : (index + 1) % slides.length;
			slider.load(slides[index].image);
			setLink(index);
		}
		
		function enable() {
			if (!enabled) {
				enabled = true;
				slider.enable();
				timer.resume();
			}
		}
		
		function disable() {
			if (enabled) {
				enabled = false;
				slider.disable();
				timer.pause();
			}
		}
		
		$.extend(self, {
			bind: function(ev,handler) {
				jthis.bind(ev,handler);
			},
			one: function(ev,handler) {
				jthis.one(ev,handler);
			},
			enable: enable,
			disable: disable,
			destroy: function() {
				if (jthis) {
					jthis.remove();
				}
				jthis = self = undefined;
				target.data("peInfluxSlider", null);
				target = undefined;
				
			}
		});
		
		start();
		
	}
	
	// jQuery plugin implementation
	$.fn.peInfluxSlider = function(conf) {
		// return existing instance
		
		var api = this.data("peInfluxSlider");
		
		if (api) { 
			return api; 
		}

		conf = $.extend(true, {}, $.pixelentity.influxSlider.conf, conf);
		
		// install peScroll for each entry in jQuery object
		this.each(function() {
			api = new PeInfluxSlider($(this), conf);
			$(this).data("peInfluxSlider", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
		
}(jQuery));