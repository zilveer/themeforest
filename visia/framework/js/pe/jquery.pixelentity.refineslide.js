(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,RS */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peRefineSlide = {	
		conf: {
			api: false
		} 
	};
	
	/*
	RS.prototype.init = function() {
		console.log("here");
	};
	*/
	
	function customize() {
		this.slider.$slides = this.slider.$slider.find('> div');
	}
	
	
	function PeRefineSlide(target, conf) {
		var rs,slides = [];
		
		function addSlide(idx,el) {
			slides.push($(el));
		}
		
		function resize() {
			target.trigger("resize.pixelentity");
		}
		
		function fireReady() {
			target.trigger("ready.pixelentity",{"slides":slides.length,markup:slides});
			target.triggerHandler("change.pixelentity",{"slideIdx":1});
			$(window).bind("resize",resize);
			resize();
		}
		
		function onChange() {
			target.triggerHandler("change.pixelentity",{"slideIdx":rs.currentPlace+1});
		}
		
		function onInit() {
			// idiotic workaround required by IE. 
			if ($.browser.msie && target.height() > (target.find("> div:eq(0)").height()+10)) {
				setTimeout(onInit,100);
			} else {
				fireReady();
			}
		}

		
		// init function
		function start() {
			target.bind("init.pixelentity",onInit);
			target.find("> div").each(addSlide);
			target.wrapInner('<div class="rs-slider"/>');
			var orig = target;
			target = target.find("img").show().end().find("div.rs-slider");
			var delay = parseInt(orig.attr("data-delay") || 100000000,10)*1000;
			delay = delay || 100000000;
			target.refineSlide({
				transition         : orig.attr("data-transition") || 'random',
				transitionDuration : 700,
				autoPlay           : true,
				keyNav             : false,
				"delay"              : delay,
				controls           : null,
				onInit: customize,
				onChange: onChange
			});
			rs = target.data("refineSlide");
			//setTimeout(fireReady,100);
		}
		
		function bind() {
			return target.bind.apply(target,arguments);
		}
		
		function next() {			
			rs.next();
		}
		
		function prev() {
			rs.prev();
		}
		
		function jumpTo(idx) {
			rs.currentPlace = idx-1;
			next();
		}
		
		function getSlide(idx) {
			return slides[idx];
		}
		
		$.extend(this, {
			// plublic API
			bind: bind,
			show: function (idx) {
				jumpTo(idx-1);
			},
			next: next,
			prev: prev,
			getSlide: getSlide,
			/*pause: pauseTimer,
			resume: startTimer,
			resize: resize,
			getSlide: getSlide,
			current: function () {
				return current;
			},
			currentPos: function () {
				return currentPos;
			},*/
			destroy: function() {
				target.data("peRefineSlide", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
		//setTimeout(start,50);
	}
	
	// jQuery plugin implementation
	$.fn.peRefineSlide = function(conf) {
		
		// return existing instance	
		var api = this.data("peRefineSlide");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peRefineSlide.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeRefineSlide(el, conf);
			el.data("peRefineSlide", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));