(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.hilight = {	
		conf: {
			width: 0,
			height: 0,
			transition: "vertbars",
			duration:1500,
			elements:30,
			maxSize:250,
			minSize:50,
			slideshow: false,
			images: [],
			links: [],
			linkTarget: false,
			delay: 3000,
			boost: 0,
			over:false,
			fallback: false
		} 
	};
	
	var cloneStyles = ["float","display","margin-top","margin-right","margin-bottom","margin-left","position","top","left"];
	var transitionTypes=["vertbars","circles","horizbars","squares"];
	
	function PeTransitionHilight(target, conf) {
		
		var self = this;
		var jthis = $(this);
		var inited = false;
		var parent;
		var w,h;
		var from,to;
		var output,buffer,buffer2,toBuffer,fromBuffer;
		var items,n;
		var offset,transition,duration,compositingDuration,started = 0,elapsed = 0;
		var fallback = false;
		var command = false;
		var loading = true;
		var images,slideshowTimer = 0, slideshowIndex = 1;
		var over;
		var mouseOver = false, active = false, firstRun = true;
		var transitionIdx=0;
		var enabled = true;
		var disabledAt = 0;
		
		function start() {
			w = conf.width;
			h = conf.height;
			loading = true;
			images = conf.images;
			conf.boost = Math.min(1,parseFloat(conf.boost));
			$.pixelentity.preloader.load(target,targetLoaded);
			
		}
		
		function targetLoaded() {
			w = w || target.width() || target[0].width;
			h = h || target.height() || target[0].height;
			
			if (target[0].tagName.toLowerCase() == "img") {
				from = target;
			} else {
				from = target.find("img:eq(0)");
			}
			
			parent = $("<div>").width(w).height(h).css("display","block").css("position","relative");
			
			var i=cloneStyles.length;
			while (i--) {
				parent.css(cloneStyles[i],target.css(cloneStyles[i]));
			}
			
			target.css({
				"position": "relative",
				"float": "none",
				"margin": 0,
				"top": 0,
				"left": 0
			});
			
			
			target.wrap(parent);
			parent = target.parent();
			
			if (conf.slideshow) {
				if (images.length === 0 && target.attr("data-destination")) {
					images =  target.attr("data-destination").split("|");
				}
				if (images.length > 0) {
					if (!conf.over) {
						slideshowTimer = setInterval(slideshow,Math.max(conf.duration+200,conf.delay));
					}
				} else {
					conf.slideshow = false;
				}
			}
			
			var destination = false;
			if (!(conf.slideshow || conf.over)) {
				destination = getDestination();
			}
			
			loading = false;
			
			if (destination) {
				loadTo(destination);
			} else {
				setTimeout(ready,50);
				if (command) {
					command();
				}
				if (conf.over) {
					parent.bind("mouseenter mouseleave",evHandler);
				}
				
			}
		}
		
		function getDestination() {
			return conf.destination || target.attr("data-destination");
		}
		
		function ready() {
			jthis.triggerHandler("ready.pixelentity");
		}
		
		function loadTo(destination) {
			if (!destination || from == to) {
				return;
			}
			
			loading = true;
			
			if (typeof destination == "string") {
				to = $("<img>").attr("src",destination);
			} else {
				to = destination;
			}
			$.pixelentity.preloader.load(to,destinationLoaded);
		}
		
		function destinationLoaded(destination) {
			loading = false;
			to = destination[0];
			init();
			run();
		}
		
		function init() {
			if (inited) {
				if (fallback) {
					initFallback();
				}
				return;
			}
			inited = true;
			
			// firefox 3.X has bugs with canvas
			if (conf.fallback || ($.browser.mozilla && $.browser.version.substr(0, 1) == '0')) {
				initFallback();
			} else {
				// detect canvas support
				output = document.createElement("canvas");
			
				if (output.getContext) {
					initCanvas();
				} else {
					initFallback();
				}
			}
		}
		
		function initCanvas() {
			
			initOutput();
			buffer = document.createElement("canvas");
			buffer.width = w;
			buffer.height = h;
			
			buffer2 = document.createElement("canvas");
			buffer2.width = w;
			buffer2.height = h;
			
			toBuffer = document.createElement("canvas");
			toBuffer.width = w;
			toBuffer.height = h;
			
			fromBuffer = document.createElement("canvas");
			fromBuffer.width = w;
			fromBuffer.height = h;
			
			output = output.getContext("2d");
			buffer = buffer.getContext("2d");
			toBuffer = toBuffer.getContext("2d");
			fromBuffer = fromBuffer.getContext("2d");
			
			items = [];
			
			n = parseInt(conf.elements,10);
			
			var min = parseInt(conf.minSize,10);
			var max = parseInt(conf.maxSize,10)-min;
			
			for (var i=0;i<n;i++) {
				items.push({
					x: Math.round(Math.random()*w),
					y: Math.round(Math.random()*h),
					d: Math.round(Math.random()*duration),
					r: Math.round(Math.random()*max+min)
				});
			}
			
		}
		
		function initFallback() {
			fallback = true;
			output = to;
			initOutput();
		}
		
		function initOutput() {
			output.width = w;
			output.height = h;
			
			offset = offset || target.offset();
			parent.prepend(output);
			
			$(output)
				.attr("style","")
				.css("position","absolute")
				.css("z-index",(parseInt(target.css("z-index"),10) || 0)+1)
				//.offset(offset)
				.show();
		
			duration = parseInt(conf.duration,10);
			compositingDuration = Math.round(1*duration/3);
		}
		
		function run() {
			started = $.now();
			elapsed = 0;
			disabledAt = 0;
			$.pixelentity.ticker.unregister(worker);
			if (enabled) {
				$.pixelentity.ticker.register(worker);
			}
			transition = conf.transition;
			
			if (transition == "random") {
				transition = transitionTypes[Math.round(Math.random()*transitionTypes.length)];
			} else if (transition == "all") {
				transition = transitionTypes[transitionIdx++ % transitionTypes.length];
			}
			
			if (from instanceof jQuery) {
				if (!fallback) {
					from.hide();
				}
				from = from[0];
			} 
			
			if (!fallback) {
				fromBuffer.drawImage(from,0,0);
				toBuffer.drawImage(to,0,0);
			}

			
			worker();
	
		}
		
		function canvasWorker() {
			var ratio = 0;
			
			output.globalCompositeOperation = buffer.globalCompositeOperation = "source-over";
			
			buffer.clearRect(0,0,w,h);
			buffer.fillStyle = "rgb(255,255,255)";
			buffer.lineWidth = 1;
			
			// HERE
			if (elapsed > compositingDuration) {
				ratio = jQuery.easing.easeOutQuad(0, elapsed-compositingDuration, 0, 1, duration-compositingDuration);
				buffer.fillStyle = "rgba(255,255,255,"+ratio+")";
				buffer.fillRect(0,0,w,h);						
				output.clearRect(0,0,w,h);
				output.globalAlpha = 1-ratio;
				output.drawImage(fromBuffer.canvas,0,0);
			} else {
				output.globalAlpha = 1;
				output.drawImage(fromBuffer.canvas,0,0);
			}
			
			var x,y,r,size;
			var PI2 = Math.PI*2;
			var item;
			
							
			for (var i=0;i<n;i++) {
				item = items[i];
				
				if (elapsed > item.d) {
					//ratio = (elapsed-item.d)/(duration-item.d);
					
					ratio =  jQuery.easing.easeOutQuad(0, elapsed-item.d, 0, 1, duration-item.d);
					
					if (ratio >= 1) {
						continue;
					}
					
					
					buffer.fillStyle = "rgba(255,255,255,"+ratio/2+")";
					buffer.strokeStyle = "rgba(255,255,255,"+ratio+")";
					
					switch (transition) {
						case "circles":
							buffer.beginPath();
							buffer.arc(item.x,item.y,Math.round(item.r*ratio),0,PI2,false);
							buffer.fill();
							buffer.stroke();
						break;
						case "squares":
							r = Math.round(item.r*ratio);
							x = item.x-r;
							y = item.y-r;
							size = r << 1;
							buffer.fillRect(x,y,size,size);
							buffer.strokeRect(x-0.5,y-0.5,size,size);
						break;
						case "vertbars":
							r = Math.round(item.r*ratio);
							x = item.x-r;
							size = r << 1;
							buffer.fillRect(x,0,size,h);
							buffer.beginPath();
							buffer.moveTo(x+0.5,0);
							buffer.lineTo(x+0.5,h);
							buffer.moveTo(x+size+0.5,0);
							buffer.lineTo(x+size+0.5,h);
							buffer.stroke();
						break;
						case "horizbars":
							r = Math.round(item.r*ratio);
							y = item.x-r;
							size = r << 1;
							buffer.fillRect(0,y,w,size);
							buffer.beginPath();
							buffer.moveTo(0,y+0.5);
							buffer.lineTo(w,y+0.5);
							buffer.moveTo(0,y+size+0.5);
							buffer.lineTo(w,y+size+0.5);
							buffer.stroke();
						break;
					}
			
					
					
				}
			}
			
			if (conf.boost > 0) {
				ratio =  jQuery.easing.easeOutQuad(0, elapsed-compositingDuration, 0, 1, duration-compositingDuration);
				output.globalCompositeOperation = "lighter";
				output.globalAlpha = conf.boost*(1-ratio);
				output.drawImage(buffer.canvas,0,0);
			}
			
			buffer.globalCompositeOperation = "source-atop";
			buffer.globalAlpha = 1;
			buffer.drawImage(toBuffer.canvas,0,0);
			
			output.globalCompositeOperation = "lighter";
			output.globalAlpha = 1;
			output.drawImage(buffer.canvas,0,0);
			
		}
		
		function fallbackWorker() {
			var ratio = jQuery.easing.easeOutQuad(0, elapsed, 0, 1, duration);
			$(output).css("opacity",ratio);
		}
		
		function worker() {
			var item;
			
			elapsed = $.now()-started-disabledAt;
			
			if (elapsed > duration) {
				elapsed = duration;
			} 
			
			if (fallback) {
				fallbackWorker();
			} else {
				canvasWorker();
			}
			
			if (elapsed == duration) {
				$.pixelentity.ticker.unregister(worker);				
				reset();
				
				if (conf.slideshow) {
					var idx = (slideshowIndex-1) % images.length;
					var evParams = {"idx":idx};
					target.triggerHandler("change.pixelentity",evParams);
					jthis.triggerHandler("change.pixelentity",evParams);
					if (conf.links && conf.linkTarget) {
						conf.linkTarget.attr("href",conf.links[idx]);
					}
				} else {
					target.triggerHandler("change.pixelentity");
					jthis.triggerHandler("change.pixelentity");
				}
			}
		}
		
		function reset() {
			var tmp;
			
			if (fallback) {
				tmp = $(from).attr("style");
				$(to).attr("style",tmp).show();
				$(from).replaceWith(to[0]);
			} 
			tmp = from;
			from = to;
			to = tmp;
			started = 0;
			if (command) {
				command();
				command = false;
			}
		}
		
		function swap() {
			active = !active;
			loadTo(to);
		}
		
		function execute(cb) {
			if (loading || started !== 0) {
				command = cb;
			} else {
				cb();
			}
		}
		
		function slideshow() {
			execute(function() {
				loadTo(images[slideshowIndex++ % images.length]);
			});
		}
		
		function evHandler(e) {
			if (conf.slideshow) {
				if (e.type == "mouseenter") {
					if (!slideshowTimer) {
						slideshow();
						slideshowTimer = setInterval(slideshow,Math.max(conf.duration+200,conf.delay));
					}
				} else {
					clearInterval(slideshowTimer);
					slideshowTimer = 0;
					slideshowIndex = 0;
					slideshow();
				}
			} else if (!firstRun) {
				mouseOver = e.type == "mouseenter";
				if (mouseOver != active) {
					execute(swap);
				}
				
			} else {
				mouseOver = true;
				firstRun = false;
				active = true;
				loadTo(getDestination());
			}
		}
		
		function enable() {
			if (!enabled) {
				enabled = true;
				if (disabledAt > 0) {
					disabledAt = $.now()-disabledAt;
				}
				$.pixelentity.ticker.resume(worker);
				if (slideshowTimer) {
					slideshowTimer.resume();
				}
			}
		}
		
		function disable() {
			if (enabled) {
				enabled = false;
				disabledAt = $.now();
				$.pixelentity.ticker.pause(worker);
				if (slideshowTimer) {
					slideshowTimer.pause();
				}
			}
		}
		
		$.extend(self, {
			bind: function(ev,handler) {
				jthis.bind(ev,handler);
			},
			load: function(destination) {
				execute(function () {
					loadTo(destination);
				});
			},
			reverse: function() {
				execute(swap);
			},
			width: function() {
				return w;
			},
			height: function() {
				return h;
			},
			enable:enable,
			disable:disable,
			destroy: function() {
				clearInterval(slideshowTimer);
				$.pixelentity.ticker.unregister(worker);
				if (conf.over) {
					parent.unbind("mouseenter mouseleave",evHandler);
				}
				if (jthis) {
					jthis.remove();
				}
				if (output) {
					$(output).remove();
				}
				jthis = self = undefined;
				target.data("peTransitionHilight", null);
				target = undefined;
			}
		});
				
		start();
		
		
	}
	
	// jQuery plugin implementation
	$.fn.peTransitionHilight = function(conf) {
		// return existing instance
		
		var api = this.data("peTransitionHilight");
		
		if (api) { 
			return api; 
		}

		conf = $.extend(true, {}, $.pixelentity.hilight.conf, conf);
		
		// install peScrollThumb for each entry in jQuery object
		this.each(function() {
			api = new PeTransitionHilight($(this), conf);
			$(this).data("peTransitionHilight", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
		
}(jQuery));