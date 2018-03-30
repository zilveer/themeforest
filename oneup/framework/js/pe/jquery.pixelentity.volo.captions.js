(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,setInterval,clearInterval,clearTimeout,WebKitCSSMatrix,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peVoloCaptions = {	
		conf: {
			slider: false,
			origW: false,
			origH: false,
			orig: "default",
			api: false
		} 
	};
	
	
	// 0-480, 481-767, 768-980, 980 - anything
	var cssT = $.support.csstransitions;
	var cssA = $.support.cssanimation;
	var ieOld = $.browser.msie && $.browser.version < 9;
	var jwin = $(window);
		
	var properties = "";
	
	if (cssT) {
		//properties = "opacity, %0transform".format($.support.csstransitionsPrefix);
		properties = "opacity";
	}
		
	function PeVoloCaptions(target, conf) {
		var w,h,cw,ch;
		var slider;
		var slides;
		var active = {};
		var current = -1;
		var scaled = false;
		//var captionsLayer;
		
		function resizeCaption(c) {
			if (!w || !h || w<20 || h<20) {
				setTimeout(resize,100);
				return;
			}
			c = $(c);
			
			var scaler;
			
			if (c.find(".peCaptionLayer").length > 0) {
				c.css({
					"margin": 0,
					"padding": 0,
					"background": "none"
				});
				var r = 1,x = 0, y = 0;
				
				cw = parseInt(c.attr("data-orig-width"),10) || conf.origW;
				ch = parseInt(c.attr("data-orig-height"),10) || conf.origH;
				
				if (cw && ch) {
					scaler = $.pixelentity.Geom.getScaler("fit","center","center",w,h,cw,ch);
					r = scaler.ratio;
					x = scaler.offset.w;
					y = scaler.offset.h;
				} else {
					r = h/conf.origH;
				}
				
				if (r != 1 || x !== 0 || y !== 0 || scaled) {
					c.transform(r,x,y,null,null,true);
					scaled = true;
				}
				
			} else {
				var align = (c.attr("data-align") || "bottom,left").split(",");
				scaler = $.pixelentity.Geom.getScaler("none",align[1],align[0],w,h,c.outerWidth(),c.outerHeight());
				var co = (c.attr("data-offset") || "-20,40").split(",");
				c.css({
					"margin-top": scaler.offset.h+parseInt(co[0],10),
					"margin-left": scaler.offset.w+parseInt(co[1],10)
				});	
			}			
		}

		
		function resizeCaptions() {
			var i,j;
			for (i in active) {
				if (typeof i == "string" && active[i]) {
					for (j = 0; j<active[i].length;j++) {
						resizeCaption(active[i][j]);
					}
				}
			}
		}
		
		function removeAnimationClasses() {
			var layer = $(this);
			layer.removeClass(layer.data("transition-classes"));
		}
		
		function resize() {
			w = target.width();
			h = target.height();
			resizeCaptions();
		}
		
		/*
		function remove(el,idx) {
			slides[idx].append(active[idx]);
			delete active[idx];
		}
		*/
		
		function fadeIn(el) {
			var jel = $(el);
			
			var duration = parseFloat(jel.attr("data-duration") || 0.5);
			var delay = parseFloat(jel.attr("data-delay") || 0);
			var layers = jel.find(".peCaptionLayer");
			var i,layer,x,y,tClass,cmd;
			
			if (layers.length > 0) {
				
				jel.addClass("pe-has-layers");
								
				for (i=0;i<layers.length;i++) {
					layer = layers.eq(i);
					
					duration = parseFloat(layer.attr("data-duration"),10) || 1;
					delay = parseFloat(layer.attr("data-delay"),10) || 0;
					
					
					if ((cmd = layer.attr("data-command"))) {
						if (typeof slider[cmd] === "function") {
							if (delay) {
								setTimeout(function () {
									slider[cmd]();
								},delay*1000);
							} else {
								slider[cmd]();
							}
						}
						//continue;
					}
										
					x = parseInt(layer.attr("data-x"),10) || 0;
					y = parseInt(layer.attr("data-y"),10) || 0;
					
					//conf.orig = "center";
					
					if (conf.orig === "center" || layer.attr("data-origin") === "center") {
						
						if (h <= 400 && y < 0) {
							//alert("here");
							//y = 0;
						}
						
						x += (cw - layer.width()) >> 1; 
						y += (ch - layer.height()) >> 1;
					}
					
					layer.css({
						"left": x+"px",
						"top": y+"px"
					});
					
					if (cssA) {
						layer[0].style[cssA+"Delay"] = delay + "s";
						layer[0].style[cssA+"Duration"] = duration + "s";
						tClass = "animated ";
						tClass += layer.attr("data-transition") || "peZoom";
						// workaround for some chrome version which reach 100% cpu usage in a background tab
						// disabled for now, in case they fix
						//layer.one("webkitAnimationEnd",removeAnimationClasses);
						layer.addClass(tClass).data("transition-classes",tClass);
					} else {
						//layer.stop().css("opacity",0).delay(delay*1000).animate({opacity:ieOld ? 1 : 1},Math.min(duration,1)*1000);
						layer.stop().css("opacity",0).delay(delay*1000).animate({opacity:1},ieOld ? 0 : Math.min(duration,1)*1000);
					}
					
				}
				
				jel.css("opacity",1);
				
			} else {
				if (cssT) {
					el.style[cssT+"Property"] = properties;
					el.style[cssT+"Duration"] = duration + "s";
					el.style[cssT+"Delay"] = delay + "s";
					jel.css("opacity",1);
					jel.transform(1,0,0,w,h);
				} else {
					jel.stop().delay(delay*1000).animate({opacity:1,left:0,top:0},Math.min(duration,1)*1000);
				}
			}
			jel.find("img").addClass("pe-lazyloading-forceload");
			jwin.triggerHandler("pe-lazyloading-refresh");
		}
		
		function fadeOut(el) {
			var jel = $(el);
			if (cssT) {
				el.style[cssT+"Property"] = "opacity";
				el.style[cssT+"Delay"] = "0s";
				el.style[cssT+"Duration"] = "0.5s";	
				jel.css("opacity",0);	
			} else {
				jel.stop().animate({opacity:0},500);
			}
			//console.log(el);
		}
		
		function killCaption(i) {
			if (active[i].hasClass('pe-caption-persistent')) {
				return;
			}
			var j, layers;
			if (cssT) {
				layers = active[i].find("> div.peCaptionLayer");
				for (j=0;j<layers.length;j++) {
					layers.eq(j).removeClass(layers.eq(j).data("transition-classes"));
				}		
			}
			slides[i].append(active[i]);
			active[i] = false;
		}
		
		function clean(force) {
			var i,j,layers;
			for (i in active) {
				if (typeof i == "string" && i != current && active[i]) {
					killCaption(i);
				}
			}
		}
		
		function setTransition(el) {
			el = $(el);
			el.fadeTo(0,0);
			var left = 0, top = 0;
			switch (el.attr("data-transition")) {
			case "flyRight":
				left = 100;
				break;
			case "flyLeft":
				left = -100;
				break;
			case "flyTop":
				top = -100;
				break;
			case "flyBottom":
				top = 100;
				break;
			}
			if (cssT) {
				el.transform(1,left,top,w,h);
			} else {
				el.css({left:left,top:top});
			}

		}

		
		function change(e,data) {
			var i,j,idx = data.slideIdx-1;
			
			if (idx === current) {
				return;
			}
			
			// detect overlap: current slide was being remove when made active again (caused by fast prev/next)
			if (active[idx]) {
				current = -1;
				// destroy anything with no mercy
				clean(true);
			} 
			
			var c = slides[idx].find(".peCaption");
			
			for (i = 0; i<c.length;i++) {
				setTransition(c[i]);
			}
			
			c.fadeTo(0,0);
			target.prepend(c);
						
			current = idx;
			var persistent = false;
			
			if (!(active[idx] && active[idx].hasClass('pe-caption-persistent'))) {
				active[idx] = c;
			} else {
				persistent = true;
			}
			
			resize();
			
			for (i in active) {
				if (typeof i == "string" && i != idx && active[i]) {
					if (active[i].hasClass('pe-caption-persistent')) {
						continue;
					}
					for (j = 0; j<active[i].length;j++) {
						fadeOut(active[i][j]);
					}
				}
			}
			
			setTimeout(clean,500);
			
			for (i = 0; i<c.length;i++) {
				fadeIn(c[i]);
			}	
			
			if (!persistent) {
				active[idx] = c;
			}
		}
		
		function ready(e,data) {
			slides = data.markup;
		}
		
		// init function
		function start() {
			if (conf.slider) {
				link(conf.slider);
			}
		}
		
		function link(s) {
			slider = s;
			slider.bind("ready.pixelentity",ready);
			slider.bind("resize.pixelentity",resize);
			slider.bind("change.pixelentity",change);
		}
		
		$.extend(this, {
			// plublic API
			link: link,
			destroy: function() {
				target.data("peVoloCaptions", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peVoloCaptions = function(conf) {
		
		// return existing instance	
		var api = this.data("peVoloCaptions");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peVoloCaptions.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeVoloCaptions(el, conf);
			el.data("peVoloCaptions", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));
