(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,setInterval,clearInterval,clearTimeout,WebKitCSSMatrix,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	function CSSAnimation(target) {
		var deferred = new $.Deferred();
		target.one($.support.cssanimationEnd,deferred.resolve);
		return deferred.promise();
	}
	
	$.pixelentity.peVista = {	
		conf: {
			api: false,
			duration: 2000,
			speed: 10
		}
	};
	
	
	var mobile = $.pixelentity.browser.mobile;
	var cssT = $.support.csstransitions;
	var cssA = $.support.cssanimation;
	var tEnd = $.support.csstransitionsEnd;
		
	function PeVista(target, conf) {
		var w,h;
		var slides = [];
		var max;
		var wrapper;
		var current = 0;
		var scroller;
		var currentPos = 0;
		var delay = 0;
		var pausedFrom = 0;
		var mouseOver = false;
		var timer;
		var minH = 1;
		var maxH = Number.MAX_VALUE;
		var rH = "auto";
		var inited = false;
		var allSlides;
		var slideWidth;
		var depth = 1;
		var fadeTransition = new $.Deferred();
		var ptarget;
		
		var pzEnabled = typeof window.peDisablePanZoom === "undefined" ? true : false;
		pzEnabled = pzEnabled && $.support.csstransforms;
			
		// init function
		function start() {
			inited = true;
			
			target.addClass("peVolo peNeedResize");
			
			if (mobile) {
				target.addClass("peVoloMobile");
			}
			
			if (target.find("> div.peWrap:eq(0)").length === 0) {
				// no wrapper, add one
				target.wrapInner('<div class="peWrap"></div>');
			}
			
			var tokens = (target.attr("data-height") || "").split(/,| /);
			
			if (tokens[0]) {
				minH = parseInt(tokens[0],10);
			}
			
			if (tokens[1]) {
				rH = $.inArray(tokens[1],["auto","container"]) >= 0 ? tokens[1] : parseFloat(tokens[1],10);
			} 
			
			if (tokens[2]) {
				maxH = parseInt(tokens[2],10);
				maxH = maxH === 0 ? 1024 : maxH;
			}
			
			if (rH === "container") {
				ptarget = target.closest(".pe-full-page");
				ptarget = ptarget.length > 0 ? ptarget : target.parent();
				target.height(ptarget.height());
			} else if (rH === 0) {
				if (minH > 1) {
					target.height(minH);
				}
			} else if (rH === "auto") {
				var firstImg = target.find("img").not(".peCaption img").eq(0);
				if (firstImg.length > 0) {
					var iw = firstImg[0].naturalWidth || firstImg.attr("width") || firstImg.width();
					var ih = firstImg[0].naturalHeight || firstImg.attr("height") || firstImg.height();					
					rH = (iw / ih);
				} else {
					rH = 0;
				}
			}
			
			slideWidth = target.attr("data-slidewidth");
			if (slideWidth) {
				conf.slideWidth = parseInt(slideWidth,10);
			}
			
			conf.duration = (parseInt(target.attr("data-fade"),10) || 2)*1000;
			conf.speed = (parseInt(target.attr("data-speed"),10) || 10);
			pzEnabled = pzEnabled && target.attr("data-transition") != "fade";
			
			
			wrapper = target.find("> div:eq(0)");
			
			allSlides = wrapper.find("> div").each(addSlide);
			var immediateStart = true;
			
			scroller = wrapper[0].style;
			max = slides.length;
			resize();
			wrapper.css("visibility","visible");
			
			allSlides.css("visibility","hidden").show().css("position","absolute").css("z-index",0);
			//allSlides.eq(0).css("visibility","visible").css("z-index",1);
			var firstSlide = allSlides.eq(0);
			
			if (pzEnabled) {
				firstSlide.find("img").not(".peCaption img").eq(0).css("max-width","none").pePanZoomImage({"duration":conf.speed});
			}
			
			firstSlide.css("visibility","visible").css("z-index",1);
			
			if (!target.hasClass("pe-no-resize") && target.closest(".pe-no-resize").length === 0) {
				$(window).bind("resize",windowHandler);
			}
			
			target.bind("resize",windowHandler);
			
			if (mobile) {
				target.bind("swipeleft swiperight",swipeHandler);
			} else if (target.attr("data-autopause") !== "disabled") {
				target.bind("mouseenter mouseleave",mouseHandler);
			}
			
			if (immediateStart) {
				setTimer();
				setTimeout(fireReady,100);
			}
			//target.trigger("resize.pixelentity");
			return true;

		}
		
		function fireReady() {
			target.trigger("ready.pixelentity",{"slides":slides.length,markup:slides});
			target.triggerHandler("change.pixelentity",{"slideIdx":1});
		}

		
		function startTimer() {
			if (!inited || delay === 0) {
				return;
			}
			var pause = pausedFrom > 0 ? $.now() - pausedFrom : 0;
			pausedFrom = 0;
			pause = delay - pause;
			if (pause > 0) {
				stopTimer();
				timer = setTimeout(next,pause);				
			} else {
				next();
			}
		}
		
		function pauseTimer() {
			if (!inited) {
				return;
			}
			pausedFrom = $.now();
			stopTimer();
		}
		
		function stopTimer() {
			clearTimeout(timer);
		}
		
		function addSlide(idx,el) {
			slides.push($(el));
		}
		
		function scale(img,iw,ih,w,newH) {
			var scaler;
			img.css("max-width","none");
			if (true) {
				iw = iw || img[0].naturalWidth || img.attr("width");
				ih = ih || img[0].naturalHeight || img.attr("height");
				scaler = $.pixelentity.Geom.getScaler("fillmax","center","top",w,newH,iw,ih);
				img.transform(scaler.ratio,scaler.offset.w,scaler.offset.h,iw,ih,true);
			} else {
				img.width(w);
			}
		}

		function resize(size) {
			
			if (!inited) {
				return;
			}
			size = typeof size === "undefined" ? target.width() : size;
			
			if (size === w && rH != "container") {
				return;
			}
			
			w = size;
			
			var slide,img,ratio;
			
			var newH = false;
			
			if (rH > 0) {
				newH = (w/rH);
				newH = Math.max(minH,Math.min(maxH,newH));
			}
			
			if (rH === "container") {
				newH = ptarget.height();
				newH = Math.max(minH,Math.min(maxH,newH));
			}
			
			var scaler,iw,ih,i,pzImage;
			
			for (i = 0; i < max; i++) {
				slide = slides[i];
				slide.width(w);
				if (newH) {
					// test this
					slide.height(newH);
				}
				
				img = slide.find("img").not(".peCaption img").eq(0);
				
				if (img.length > 0) {
					if (slide.hasClass("scale") && !pzEnabled) {
						scale(img,0,0,w,newH);
					}
				}
			}
			
			wrapper.width(w);
			
			if (newH) {
				h = newH;
				target.height(newH);
				// test this
				wrapper.height(newH);
			}
			
			if (pzEnabled) {
				img = allSlides.eq(current).find("img").not(".peCaption img").eq(0);
				if ((pzImage = img.data("pePanZoomImage"))) {
					pzImage.resize();
				}
			}
						
			target.trigger("resize.pixelentity");
		}
		
		function next() {
			if (!inited || max <= 1) {
				return;
			}
			
			jumpTo((current + 1) % (max));
		}
		
		function prev() {
			if (!inited || max <= 1) {
				return;
			}
			var idx = (current-1);
			if (idx < 0) {
				idx += (max);
			}
			jumpTo(idx);
		}
		
		function fadeResolve() {
			fadeTransition.resolve();
		}
		
		function jumpTo(idx) {
			if (!inited) {
				return;
			}
			
			var prev = current;
			var prevImg = allSlides.eq(prev).find("img").not(".peCaption img").eq(0);
			var currImg = allSlides.eq(idx).find("img").not(".peCaption img").eq(0);
			current = idx;
			
			if (pzEnabled) {
				var pzImage = prevImg.data("pePanZoomImage");
				
				if (pzImage) { 
					//pzImage.stop();
				}
				
				pzImage = currImg.data("pePanZoomImage"); 
				
				if (pzImage) {
					pzImage.start();
				} else {
					currImg.css("max-width","none").pePanZoomImage({"duration":conf.speed});
				}
			}
			
			var active = allSlides.eq(idx);
			depth++;
			
			var style = active[0].style;
			fadeTransition.reject();
			fadeTransition = new $.Deferred();
			
			if (cssT) {				
				style[cssT] = "opacity "+0+"ms";
			}
			
			active.css("opacity",0).css("visibility","visible").css("z-index",depth);
			
			target.triggerHandler("change.pixelentity",{"slideIdx":idx+1});
			
			if (cssT) {
				style[cssT] = "opacity "+conf.duration+"ms";
				active.css("opacity",1);
				active.one(tEnd,fadeResolve);
			} else {
				active.stop().animate({"opacity":1},conf.duration).promise().done(fadeResolve);
			}
			
			if (currImg.length === 0) {
				allSlides.eq(prev).stop().animate({"opacity":0},100);
			}
			
			$.when(fadeTransition).done(clean);
		}
		
		function clean() {
			allSlides.not(allSlides.eq(current)).css("z-index",0).css("visibility","hidden");
			allSlides.eq(current).css("z-index",1).css("visibility","visible");
			depth = 1;
			setTimer();
		}
		
		function setTimer() {
			var sdelay = parseInt(slides[current].attr("data-delay"),10)*1000;
			if (sdelay > 0) {
				delay  = sdelay;
				if (mouseOver) {
					pauseTimer();
				} else {
					startTimer();					
				}
				
			}
		}

		function swipeHandler(e) {
			if (e.type === "swipeleft") {
				prev();
			} else {
				next();
			}
		}
		
		function mouseHandler(e) {
			if (e.type === "mouseenter") {
				mouseOver = true;
				pauseTimer();
			} else {
				mouseOver = false;
				startTimer();
			}
		}
		
		function windowHandler(e) {
			resize();
		}

		
		function bind() {
			return target.bind.apply(target,arguments);
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
			pause: pauseTimer,
			resume: startTimer,
			resize: resize,
			getSlide: getSlide,
			current: function () {
				return current;
			},
			currentPos: function () {
				return currentPos;
			},
			destroy: function() {
				$(window).unbind("resize",windowHandler);
				
				target
					.unbind("swipeleft swiperight",swipeHandler)
					.unbind("mouseenter mouseleave",mouseHandler)
					//.unbind(prefix.toLowerCase()+"TransitionEnd transitionend",setTimer)
					.data("peVista", null);
				
				target = undefined;
			}
		});
		
		// initialize
		$.pixelentity.preloader.load(target,start);
	}
	
	// jQuery plugin implementation
	$.fn.peVista = function(conf) {
		
		// return existing instance	
		var api = this.data("peVista");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peVista.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeVista(el, conf);
			el.data("peVista", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

(function ($) {

	$.pixelentity = $.pixelentity || {version: '1.0.0'};

	$.pixelentity.pePanZoomImage = {	
		conf: { 
			zoom	: 'random',
			align	: 'random',
			pan		: 'random',
			duration: '10',
			paused	: false
		} 
	};
	
	var valign = ["top","bottom"];
	var halign = ["left","right"];
	
	function PePanZoomImage(t, conf) {

		/* private vars */

		var self = this;
		var target = t;

		var tw,th,w,h,ratioFrom,ratioTo,xFrom,xTo,yFrom,yTo,xPrev,yPrev,counter,duration = 500,normalized,repeat = 0;
		var rw,rh;
		var curR,curX,curY;
		var zoom,pan,align,pzoom = false,palign = false;
		var paused = false;
		var upscale = 1.3;
		
		
		// get a scaler object
		function computeValues() {
			
			var scaler;
			// deal with loop
			if (repeat > 0) {
				// not first run, save last scale ratio
				xFrom = xTo;
				yFrom = yTo;
				ratioFrom = ratioTo;
			} else {
				// get the scaler using conf options
				scaler = $.pixelentity.Geom.getScaler(zoom == "out" ?  "fill" : "none",align.w,align.h,w,h,tw,th);
				xFrom = scaler.offset.w;
				yFrom = scaler.offset.h;
				ratioFrom = scaler.ratio;
			}
			
			scaler = $.pixelentity.Geom.getScaler(zoom == "in" ?  "fill" : "none",pan.w,pan.h,w,h,tw,th);
			xTo = scaler.offset.w;
			yTo = scaler.offset.h;
			ratioTo = scaler.ratio;
			
			xPrev = 0;
			yPrev = 0;
			
			duration = parseFloat(normalized)*33;
			
			// reset counter
			counter = 0;
			
			// update runs count
			repeat++;
			
		}
		
		function randomSpot() {
			return valign[Math.round(Math.random())]+","+halign[Math.round(Math.random())];
		}
		
		function computeSettings() {
			
			if (pzoom) {
				zoom = pzoom;
				pzoom = false;
			} else {
				zoom = conf.zoom == "random" ? (Math.random() > 0.5 ? "out" : "in") : conf.zoom	;
			}
			
			if (palign) {
				align = palign;
				palign = false;
			} else {
				align = $.pixelentity.Geom.splitProps(conf.align == "random" ? randomSpot() : conf.align);
			}
			
			pan = $.pixelentity.Geom.splitProps(conf.pan == "random" ? randomSpot() : conf.pan);
			
			pan.w = align.w === "left" ? "right" : "left";
			pan.h = align.h === "top" ? "bottom" : "top";
			
		}
		
		
		function worker() {
			if (paused) { return; }
			var now = counter/duration;
			curR = ratioFrom+(ratioTo-ratioFrom)*now;
			curX = xFrom+(xTo-xFrom)*now;
			curY = yFrom+(yTo-yFrom)*now;
			
			target.transform(curR*upscale,curX*upscale,curY*upscale,tw,th);
			counter++;
			
			if (counter > duration) {
				self.pause();
			}
		}
		
		function boundaries() {
			var el = t.parent();
			var nh,nw;
			
			while (el && !el.width()) {
				el = el.parent();
			}
			
			nw = el ? el.width() : 800;
			nh = el ? el.height() : 600;
			
			if (rw === nw && rh === nh) {
				return false;
			}
			
			rw = w = nw;
			rh = h = nh;
			
			var power = 0.3;
			
			if (w/tw > h/th) {
				upscale = w/tw*(1+power);
				w = w/upscale;
				h = h/upscale;
				normalized = Math.max(conf.duration,conf.duration*((th-h)/h)/power);				
			} else {
				upscale = h/th*(1+power);
				w = w/upscale;
				h = h/upscale;
				normalized = Math.max(conf.duration,conf.duration*((tw-w)/w)/power);				
			}
			
			return true;
		}

		
		$.extend(self, {
			init: function(e) {
				tw = parseInt(t.attr("width"),10) || t.width() || t[0].width;
				th = parseInt(t.attr("height"),10) || t.height() ||  t[0].height;
				
				target.css("image-rendering","optimizeQuality").css("-ms-interpolation-mode","bicubic");
				self.start();
				//target.bind("resize",self.resize);
			},
			
			
			start: function() {
				
				self.stop();
				repeat = 0;
				
				boundaries();
				
				computeSettings();
				computeValues();
				paused = false; /* check this */
				
				if (conf.paused) {
					worker();
					paused = true;
				} 
				
				
				$.pixelentity.ticker.register(worker);
			},
			
			resize: function() {
				if (boundaries()) {
					pzoom = zoom;
					palign = align.w+","+align.h;
					//console.log(zoom,align);
					self.start();
				}
			},
			
			stop: function() {
				$.pixelentity.ticker.unregister(worker);
			},
			
			reset: function() {
				paused = true;
				repeat = 0;
				computeSettings();
				computeValues();
				paused = false;
			},
			
			getTarget: function() {
				return target;
			},
			
			pause: function() {
				paused = true;
			},
			
			resume: function() {
				paused = false;
			},
			
			destroy: function() {
				self.paused = true;
				self.stop();
				self = undefined;
				target.data("pePanZoomImage", null);
				target = undefined;		
			}
			
		});
		
		if ((!t.width()) && (!t[0].width)) {
			t.one("load",self.init);
		} else {
			self.init();
		}
		
	}
	
	
	// jQuery plugin implementation
	$.fn.pePanZoomImage = function(conf) {
		// return existing instance
		
		var api = this.data("pePanZoomImage");
		
		if (api) { 
			api.start();
			return api; 
		}

		conf = $.extend(true, {}, $.pixelentity.pePanZoomImage.conf, conf);
		
		// install kb for each entry in jQuery object
		this.each(function() {
			api = new PePanZoomImage($(this), conf); 
			$(this).data("pePanZoomImage", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
})(jQuery);
