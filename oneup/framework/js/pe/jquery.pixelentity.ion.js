(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,setInterval,clearInterval,clearTimeout,WebKitCSSMatrix,pixelentity,buzz */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peIon = {	
		conf: {
			api: false,
			count: 1,
			transition: 500
		} 
	};
	
	$.extend($.easing,{
		easeOutQuad: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});
	
	var jwin = $(window);
	var ua = navigator.userAgent.toLowerCase();
	var iDev = ua.match(/(iphone|ipod|ipad)/) !== null;
	var android = !iDev && ua.match(/android ([^;]+)/);
	if (android) {
		android = android[1].split(/\./);
		android = parseFloat(android.shift() + "." + android.join(""));
	} else {
		android = false;
	}
	var mobile = (iDev || android || ua.match(/(android|blackberry|webOS|opera mobi)/) !== null);
	
	var style = document.createElement("div").style;
	var counter = 0,lingrad;
	var prefix,prefixes = ["O","ms","Webkit","Moz"];
	var test,
	 i,
	 transform = false,
	 transitionDuration = false,
	 use3d = false;
	
	for (i=0; i<prefixes.length;i++) {
		test = prefixes[i]+"Transform";
		if (test in style) {
			transform = test;
			prefix = prefixes[i];
			continue;
		}
	}
	
	if (transform) {
		use3d = ('WebKitCSSMatrix' in window && 'm11' in new WebKitCSSMatrix());
		test = prefix+"Transition";
		transitionDuration = (test in style) ? test : false;
	}
	
	function PeIon(target, conf) {
		var w,h;
		var slides = [];
		var max;
		var wrapper;
		var current = 0;
		var delay = 0;
		var pausedFrom = 0;
		var mouseOver = false;
		var timer;
		var minH = 1;
		var maxH = Number.MAX_VALUE;
		var rH = "auto";
		var inited = false;
		var slideWidth;
		var isAndroid = $.pixelentity.browser.android;
		var nw = isAndroid ? 256 : 512;
		var nh = isAndroid ? 128 : 256;
		var fullscreen = false;
		var canvas,real,back;
		var angleFrom = 0;
		var angleTo = 0;
		var angleStart = 0;
		var angleStop = 0;
		var speedFrom = 3;
		var speedTo = 3;
		var shiftXFrom = 0;
		var shiftXTo = 0;
		var shiftYFrom = 0;
		var shiftYTo = 0;
		var soundtrack = false;
		var dep;
		
		// init function
		function start() {
			inited = true;
			
			target.addClass("peVolo");
			
			if (mobile) {
				target.addClass("peVoloMobile");
			}
			
			if (target.find("> div.peWrap:eq(0)").length === 0) {
				// no wrapper, add one
				target.wrapInner('<div class="peWrap"></div>');
			}
			
			fullscreen = target.attr("data-fullscreen") === "enabled";
			
			if (!fullscreen) {
				var tokens = (target.attr("data-height") || "").split(/,| /);
				
				if (tokens[0]) {
					minH = parseInt(tokens[0],10);
				}
				
				if (tokens[1]) {
					rH = tokens[1] === "auto" ? "auto" : parseFloat(tokens[1],10);
				} 
				
				if (tokens[2]) {
					maxH = parseInt(tokens[2],10);
				}
				
				if (rH === 0) {
					if (minH > 1) {
						target.height(minH);
					}
				} else if (rH === "auto") {
					var firstImg = target.find("img").not(".peCaption img").eq(0);
					if (firstImg.length > 0) {
						rH = (firstImg[0].naturalWidth / firstImg[0].naturalHeight);
					} else {
						rH = 0;
					}
				}
				
			}
			
			slideWidth = target.attr("data-slidewidth");
			if (slideWidth) {
				conf.slideWidth = parseInt(slideWidth,10);
			}
			
			wrapper = target.find("> div:eq(0)");
			
			if (canvas.length > 0) {
				canvas.show();
				wrapper.prepend(canvas);
				if (real) {
					$.pixelentity.ticker.register(loop);
				}
			}
						
			var allSlides = wrapper.find("> div").each(addSlide);
			max = slides.length;
			
			resize();
			target.fadeTo(0,1);
			wrapper.css("visibility","visible");
			allSlides.css("visibility","visible").show();
			$(window).bind("resize",windowHandler);
			if (target.parent().hasClass("scalable")) {
				target.parent().bind("resize",windowHandler);
			}
			if (target.attr("data-autopause") !== "disabled") {
				target.bind("mouseenter mouseleave",mouseHandler);
			}
			
			setTimer();
			setTimeout(fireReady,100);
			//target.trigger("resize.pixelentity");
			return true;

		}
		
		function boot() {
			
			
			target.find("> div").wrapInner('<div class="peCaption"></div>');
			target.find("div.peCaption > div").addClass("peCaptionLayer");
			target.find(".peCaptionLayer.burst").attr("data-command","burst").removeClass("burst");
			
			var layer, layers = target.find(".peCaptionLayer");
			
			layers.each(function (idx) {
				layer = layers.eq(idx);
				layer.attr("data-transition",layer.attr("data-transition") ? layer.attr("data-transition") : "peZoom"); 
				layer.attr("data-duration",layer.attr("data-duration") ? layer.attr("data-duration") : "3.8"); 
			});
			
			// initialize			
			if (target.attr("data-onwindowload") === "enabled") {
				jwin.one("load",loaded);
			} else {
				$.pixelentity.preloader.load(target,loaded);
			}			
		}

		function checkdeps() {
			if (--dep <= 0) {
				if (soundtrack) {
					soundtrack.play();
				}
				
				if (canvas.length === 0 && target.attr("data-fallback")) {
					target.css("background","#000000 url('"+target.attr("data-fallback")+"') no-repeat center center");
				}
				
				start();
			}
		}
		
		function loaded() {
			dep = 2;
			
			canvas = $('<canvas width="'+nw+'" height="'+nh+'">');
			
			if (canvas.length === 0) {
				// no canvas supported
				dep--;
				if (target.attr("data-fallback")) {
					dep++;
					
					var img = $("<img/>");
					img.one("load",checkdeps);
					img.attr("src",target.attr("data-fallback"));
					
				}
			} else {
				real = canvas[0].getContext('2d');
				
				back = new $.pixelentity.backgrounds.Nebula(nw,nh,"framework/js/pe.nebula/themes/nebula/img/object.png",40,true);
				$(back).one("ready.pixelentity",function () {
					checkdeps();
					//setTimeout(checkdeps,1000);
				});
				back.init();	
			}
			
			if (!iDev && target.attr("data-soundtrack") && buzz.isSupported()) {
				soundtrack = new buzz.sound(target.attr("data-soundtrack"), {
					formats: ["mp3", "ogg"],
					preload: true,
					autoplay: false,
					loop: false
				});
				
				soundtrack.bind("canplay",checkdeps);
			} else {
				dep--;
			}
			
			if (dep === 0) {
				checkdeps();
			}
			
			//alert(buzz.isSupported());
			//checkdeps();
			
			//start();
		}
		
		function fireReady() {
			target.trigger("ready.pixelentity",{"slides":slides.length,markup:slides});
			target.triggerHandler("change.pixelentity",{"slideIdx":1});
		}
		
		function loop() {
			//try {
			
			real.save();			
			real.globalCompositeOperation = "source-over";
			real.globalAlpha = 0.5;
			real.fillStyle = "rgba(0,0,0,.05)";
			real.fillRect(0, 0, nw, nh);
			
			var elapsed = $.now() - angleStart;
						
			if (angleStart === 0 || elapsed > angleStop) {
				angleStart = $.now();
				angleStop = 4000;
				angleFrom = angleTo;
				angleTo = Math.random()*0.4-0.2;
				speedFrom = speedTo;
				speedTo = Math.random()*3+2;
				shiftXFrom = shiftXTo;
				shiftXTo = Math.random()*4-2;
				shiftYFrom = shiftYTo;
				shiftYTo = Math.random()*0.625-0.25;
				elapsed = 0;				
			}
			
			var angle = jQuery.easing.easeInOutQuad(0, elapsed, angleFrom, angleTo-angleFrom, angleStop);
			var speed = jQuery.easing.easeInOutQuad(0, elapsed, speedFrom, speedTo-speedFrom, angleStop);
			var shiftX = jQuery.easing.easeInOutQuad(0, elapsed, shiftXFrom, shiftXTo-shiftXFrom, angleStop);
			var shiftY = jQuery.easing.easeInOutQuad(0, elapsed, shiftYFrom, shiftYTo-shiftYFrom, angleStop);
			var scale = 1+(Math.abs(angle)/0.2)*0.3;
			
			angle = isAndroid ? 0 : angle;
			
			back.speed(speed);
			back.shiftX(shiftX);
			back.shiftY(shiftY);
			back.render();
			
			real.translate(nw >> 1, nh >> 1);
			real.scale(scale,scale);
			real.rotate(angle);
			real.translate(-(nw >> 1), -(nh >> 1));
			
			real.drawImage(back.layer(), 0,0);
			
			real.restore();
			
			if (counter > 0) {
				real.globalCompositeOperation = "lighter";
				real.globalAlpha = 1;
				real.drawImage(back.layer(), 0,0);
			}
			
			
			if (counter > 0) {
				lingrad = real.createLinearGradient(0,0,0,nh);
								
				lingrad.addColorStop(0, 'rgba(0,0,0,0)');
				lingrad.addColorStop(0.35, 'rgba(0,0,0,0)');
				
				lingrad.addColorStop(0.45, 'rgba(218,90,50,.5)');
				//lingrad.addColorStop(0.45, 'rgba(65,165,255,.5)');
				lingrad.addColorStop(0.5, 'rgba(255,255,255,1)');
				lingrad.addColorStop(0.55, 'rgba(218,90,50,.5)');
				//lingrad.addColorStop(0.55, 'rgba(65,165,255,.5)');
				
				lingrad.addColorStop(0.65, 'rgba(0,0,0,0)');
				lingrad.addColorStop(1, 'rgba(0,0,0,0)');
				
				real.globalCompositeOperation = "lighter";
				real.fillStyle = lingrad;
				
				real.globalAlpha = 0.5+0.5*counter;
				//real.globalAlpha = counter >= 0.1 ? counter : 0.1;
				real.fillRect(0, 0, nw, nh);
				counter -= 0.1;
			}
			
			real.restore();
			
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

		function resize(size) {
			if (!inited) {
				return;
			}
			
			if (fullscreen) {
				size = jwin.width();
			} else {
				size = typeof size === "undefined" ? target.width() : size;
			}
						
			if (!fullscreen && size === w) {
				return;
			}
			
			w = size;
			
			var slide,img,ratio;
			var newH = false;
			
			if (fullscreen) {
				newH = $.pixelentity.browser.iDev && window.innerHeight ? window.innerHeight: jwin.height();
			} else if (rH > 0) {
				newH = (w/rH);
				newH = Math.max(minH,Math.min(maxH,newH));
			}
			
			h = newH;
			
			//alert(window.innerHeight+" - "+jwin.height());
			
			var scaler,iw,ih;
			
			scaler = $.pixelentity.Geom.getScaler("fillmax","center","center",w,newH,nw,nh);
			canvas.transform(scaler.ratio,scaler.offset.w,scaler.offset.h,nw,nh,true);
			
			wrapper.width(w);
			
			if (newH) {
				target.height(newH);
				wrapper.height(newH);
			}
						
			target.trigger("resize.pixelentity");
		}
		
		function next() {
			if (!inited || max <= 1) {
				return;
			}
			current = (current + 1) % (max);

			jumpTo(current);
		}
		
		function prev() {
			if (!inited || max <= 1) {
				return;
			}
			current--;
			if (current < 0) {
				current += (max);
			}
			jumpTo(current);
		}

		
		function jumpTo(idx) {
			if (!inited) {
				return;
			}
			
			target.triggerHandler("change.pixelentity",{"slideIdx":idx+1});
			setTimer();
			
		}
		
		
		function setTimer() {
			var sdelay = parseFloat(slides[current].attr("data-delay"),10)*1000;
			if (sdelay > 0) {
				delay  = sdelay;
				if (mouseOver) {
					pauseTimer();
				} else {
					startTimer();					
				}
				
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
		
		function burst() {
			if (!target.hasClass("disabled")) {
				counter = 1;
			}
		}
		
		function hide() {
			target.addClass("disabled");
			$.pixelentity.ticker.unregister(loop);
			target.hide();
			if (soundtrack) {
				soundtrack.pause();
			}
		}

		$.extend(this, {
			// plublic API
			bind: bind,
			show: function (idx) {
				jumpTo(idx-1);
			},
			burst: burst,
			next: next,
			prev: prev,
			hide: hide,
			pause: pauseTimer,
			resume: startTimer,
			resize: resize,
			getSlide: getSlide,
			current: function () {
				return current;
			},
			destroy: function() {
				$(window).unbind("resize",windowHandler);
				
				target
					.unbind("mouseenter mouseleave",mouseHandler)
					.unbind(prefix.toLowerCase()+"TransitionEnd transitionend",setTimer)
					.data("peIon", null);
				
				target = undefined;
			}
		});
		
		boot();
	}
	
	// jQuery plugin implementation
	$.fn.peIon = function(conf) {
		
		// return existing instance	
		var api = this.data("peIon");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peIon.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeIon(el, conf);
			el.data("peIon", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));