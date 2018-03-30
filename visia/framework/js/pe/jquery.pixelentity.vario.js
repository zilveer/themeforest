(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,setInterval,clearInterval,clearTimeout,WebKitCSSMatrix,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	function CSSAnimation(target) {
		var deferred = new $.Deferred();
		target.one($.support.cssanimationEnd,deferred.resolve);
		return deferred.promise();
	}
	
	function videoIsSupported() {
		return ($.browser.msie && $.browser.version < 10) ? false : !!document.createElement('video').canPlayType;
	}
	
	function Transition() {}
	
	Transition.prototype = {
		w:0,
		h:0,
		rows:0,
		cols:0,
		block: null,
		
		init: function(w,h) {
			this.w = w;
			this.h = h;
			this.rows = this.getRows();
			this.cols = this.getCols();
			this.block = {
				"delay": 0,
				"duration": 0.5,
				"transition": "fadeOut"
			};
			return this;
		},
		
		getCols: function() {
			return Math.floor(this.w/128);
		},
		
		getRows: function() {
			return Math.floor(this.h/96);
		},
		
		compute: function(i,j) {
			return this;
		}
	};
	
	var transitions = {};
	
	$.pixelentity.peVario = {	
		conf: {
			api: false,
			duration: 500
		},
		addTransition: function (name,methods) {
			transitions[name] = function() {};
			transitions._list = transitions._list || [];
			transitions._list.push(name);
			$.extend(transitions[name].prototype,Transition.prototype,methods);
		}
		
	};
	
	
	var mobile = $.pixelentity.browser.mobile;
	var cssT = $.support.csstransitions;
	var cssA = $.support.cssanimation;
	var tEnd = $.support.csstransitionsEnd;
	
	
	function PeVario(target, conf) {
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
		var grid = $('<div class="pe-grid-container visible"></div>');
		var gridTransition = new $.Deferred();
		var fadeTransition = new $.Deferred();
		var video,videoFallback;
		var ptarget;
		
		gridTransition.resolve();
		
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
			
			wrapper = target.find("> div:eq(0)");
			grid.css({
				"position": "absolute",
				"overflow": "visible",
				"background-color": "transparent",
				"z-index": 1
			});
			
			allSlides = wrapper.find("> div").each(addSlide);
			var immediateStart = true;
			
			if (target.attr("data-video-source")) {
				if (!mobile && videoIsSupported()) {
					var videoInfo = $.pixelentity.videoplayer.getInfo(target.attr("data-video-source"),target.attr("data-video-formats"));
					if (videoInfo.video) {
						immediateStart = false;
						video = $('<video preload="auto" autoplay="true"></video>');
						var i,sources = videoInfo.video;
						for (i in sources) {
							if (typeof i === "string") {
								video.append('<source src="'+sources[i]+'" type="'+$.pixelentity.video.getType(sources[i])+'">');
							}
						}
						if (target.attr("data-video-loop") == "loop" || target.attr("data-video-loop") == "enabled") {
							video.attr("loop","loop");
						}
						video.bind("loadedmetadata", function() {
							resize();
							setTimer();
							setTimeout(function () {
								fireReady();
							},100);
						});
						wrapper.prepend(video);
					}
				} else if (target.attr("data-video-fallback")) {
					var fbimg = $("<img />");
					immediateStart = false;
					$.pixelentity.preloader.load(fbimg,function () {
						videoFallback = fbimg;
						fbimg.show();
						resize();
						setTimer();
						setTimeout(function () {
							fireReady();
							resize();
						},100);
					});
					wrapper.prepend(fbimg);
					fbimg.attr("src",target.attr("data-video-fallback"));
				}
			}
			
			
			scroller = wrapper[0].style;
			max = slides.length;
			resize();
			wrapper.css("visibility","visible");
			
			allSlides.css("visibility","hidden").show().css("position","absolute").css("z-index",0);
			allSlides.eq(0).css("visibility","visible").css("z-index",1);
			
			$(window).bind("resize",windowHandler);
			
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
			
			if (size === w && rH != "container" && !video && !videoFallback) {
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
			
			var scaler,iw,ih,i;
			
			for (i = 0; i < max; i++) {
				slide = slides[i];
				slide.width(w);
				if (newH) {
					// test this
					slide.height(newH);
				}
				if (slide.hasClass("scale")) {
					img = slide.find("img").not(".peCaption img").eq(0);
					if (img.length > 0) {
						scale(img,0,0,w,newH);
						/*
						img.css("max-width","none");
						if (true) {
							iw = img[0].naturalWidth || img.attr("width");
							ih = img[0].naturalHeight || img.attr("height");
							scaler = $.pixelentity.Geom.getScaler("fillmax","center","top",w,newH,iw,ih);
							img.transform(scaler.ratio,scaler.offset.w,scaler.offset.h,iw,ih,true);
						} else {
							img.width(w);
						}
						*/
					}
				}
			}
			
			if (video) {
				if (video[0].videoWidth) {
					scale(video,video[0].videoWidth,video[0].videoHeight,w,newH);
				}
			} else if (videoFallback) {
				scale(videoFallback,0,0,w,newH);
			}
			
			wrapper.width(w);
			
			if (newH) {
				h = newH;
				target.height(newH);
				// test this
				wrapper.height(newH);
			}
			
			resizeGrid();
			
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
		
		function resizeGrid() {
			if (!grid) {
				return;
			}
			
			var iw = grid.data("grid-w");
			var ih = grid.data("grid-h");
			if (iw && ih) {
				var scaler = $.pixelentity.Geom.getScaler("fillmax","center","top",w,h,iw,ih);
				grid.transform(scaler.ratio,scaler.offset.w,scaler.offset.h,iw,ih,true);
			}			
		}

		
		function prepareGrid(img) {
			
			if (gridTransition.state() === "pending") {
				grid.css("z-index",depth+1);
				return;
			}
			
			var type = allSlides.eq(current).attr("data-transition") || "random";
			if (type === "random") {
				type = transitions._list[Math.round(Math.random()*(transitions._list.length-1))];
			}
			
			type = transitions[type] ? type : "fade";
			
			if (type === "fade") {
				return;
			}
			
			var iw = img[0].naturalWidth || img.attr("width") || img.width();
			var ih = img[0].naturalHeight || img.attr("height") || img.height();
			
			grid.data("grid-w",iw).width(iw);
			grid.data("grid-h",ih).height(ih);
			
			grid.detach().empty();
			gridTransition = new $.Deferred();
			resizeGrid();
			
			var speed = 1;
			
			var transition = (new transitions[type]()).init(iw,ih);
			
			var cols = transition.cols;
			var rows = transition.rows;
			
			/*
			if (cols > 1) {
				cols = transition.cols = Math.round(cols*Math.max(1,1920/w));
				console.log(cols);
			}
			
			if (rows > 1) {
				rows = transition.rows = Math.round(rows*Math.max(1,1920/w));
				console.log(rows);
			}
			*/
			
			// ios fix
			if (mobile && cols === 1 && iw > 1280) {
				cols = 2;
			}
			
			var cw = Math.floor(iw/cols);
			var ch = Math.floor(ih/rows);
			var x,y,i,j,div,src;
			var p = [];
			
			
			grid.empty().detach();
			
			var divs = [];
			
			for (i = 0;i < cols;i++) {
				for (j = 0;j < rows;j++) {
					x = i*cw;
					y = j*ch;
					src = img.attr("src");
					//src = "img/content/stest/1-1024x768.jpg";
					div = $("<div></div>");
					div.css({
						"position" : "absolute",
						"top" : y,
						"left": x,
						"background-color": "transparent",
						"background-image": "url('"+src+"')",
						"background-position": (-x)+"px "+(-y)+"px",
						"background-size": iw+"px "+ih+"px",
						"width" : i == (cols-1) ? iw - cw*(cols-1) : cw,
						"height": j == (rows-1) ? ih - ch*(rows-1) : ch,
						"opacity":1,
						"border-width": 0,
						"padding" : 0,
						"margin" : 0
					});
					grid.append(div);
					transition.compute(i,j);
					div.data("pe-transition",{
						transition: transition.block.transition,
						delay: transition.block.delay*speed,
						duration: transition.block.duration*speed
					});
					divs.push(div);
				}
			}
			
			grid.css({
				"visibility": "visible",
				"z-index" : depth+1
			}).show();
			
			wrapper.prepend(grid);
			
			var data;
			
			while ((div = divs.shift())) {
				data = div.data("pe-transition");
				div.addClass(data.transition).addClass("animated");
				div[0].style[cssA+"Delay"] = data.delay+"s";
				div[0].style[cssA+"Duration"] = data.duration+"s";
				p.push(new CSSAnimation(div));
			}
			
			$.when.apply(null,p).done(removeGrid);
			
		}
		
		function removeGrid() {
			grid.detach().empty();
			gridTransition.resolve();
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
			var active = allSlides.eq(idx);
			depth++;
			
			if (cssA && prevImg.length > 0) {
				prepareGrid(prevImg);
			}
			
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
			
			$.when(gridTransition,fadeTransition).done(clean);
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
					.data("peVario", null);
				
				target = undefined;
			}
		});
		
		// initialize
		$.pixelentity.preloader.load(target,start);
	}
	
	// jQuery plugin implementation
	$.fn.peVario = function(conf) {
		
		// return existing instance	
		var api = this.data("peVario");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peVario.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeVario(el, conf);
			el.data("peVario", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

(function ($) {
	
	if (!$.support.cssanimation) {
		return;
	}
	
	var add = $.pixelentity.peVario.addTransition;
	var mobile = $.pixelentity.browser.mobile;
	
	function l_r(i,j,rows,cols) {
		return (i+j)/(rows+cols);
	}
	
	add("blockfade",{
		compute: function(i,j) {
			this.block.delay = l_r(i,j,this.rows,this.cols);
			this.block.transition = "fadeOut";
			return this;
		}
	});
	
	add("fall",{
		compute: function(i,j) {
			this.block.delay = l_r(i,j,this.rows,this.cols);
			this.block.transition = "rotateOutDownLeft";
			return this;
		}
	});
	
	add("domino",{
		getRows: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.delay = l_r(i,j,this.rows,this.cols);
			this.block.transition = "rotateOutDownLeft";
			return this;
		}
	});
	
	add("flip",{
		getRows: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.delay = l_r(i,j,this.rows,this.cols);
			this.block.duration = 1.5-this.block.delay;
			this.block.transition = "rollOut";
			return this;
		}
	});
	
	add("revealR",{
		getRows: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.delay = (i)/(this.cols);
			this.block.transition = "fadeOutLeft";
			return this;
		}
	});
	
	if (!mobile ) {
		add("revealL",{
			getRows: function () {
				return 1;
			},
			compute: function(i,j) {
				this.block.delay = (this.cols-i)/(this.cols);
				this.block.transition = "fadeOutRight";
				return this;
			}
		});	
	}
	
	
	add("revealB",{
		getCols: function () {
			return 1;
		},
		getRows: function() {
			return Math.floor(this.h/48);
		},
		compute: function(i,j) {
			this.block.delay = j/this.rows;
			this.block.transition = "fadeOutUp";
			return this;
		}
	});
	
	if (!mobile ) {
		add("revealT",{
			getCols: function () {
				return 1;
			},
			getRows: function() {
				return Math.floor(this.h/48);
			},
			compute: function(i,j) {
				this.block.delay = (this.rows-j)/(this.rows);
				this.block.transition = "fadeOutDown";
				return this;
			}
		});
	}
	
	add("saw",{
		getRows: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.duration = 1;
			this.block.transition = i % 2 ? "fadeOutUpMed" : "fadeOutDownMed";
			return this;
		}
	});
	
	add("scale",{
		compute: function(i,j) {
			this.block.delay = l_r(i,j,this.rows,this.cols);
			this.block.transition = "fadeOutScale";
			return this;
		}
	});
	
	add("bars",{
		getRows: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.delay = (i < this.cols/2 ? i : this.cols-i)/this.cols;
			this.block.transition = "fadeOutZoom";
			return this;
		}
	});
	
	add("zoom",{
		getRows: function () {
			return 1;
		},
		getCols: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.transition = "fadeOutZoom";
			return this;
		}
	});
	
	add("fade",{
		getRows: function () {
			return 1;
		},
		getCols: function () {
			return 1;
		},
		compute: function(i,j) {
			this.block.transition = "fadeOut";
			return this;
		}
	});
	
	add("drop",{
		getCols: function () {
			return 4;
		},
		getRows: function() {
			return Math.floor(this.h/24);
		},
		compute: function(i,j) {
			this.block.delay = 0.5*(j/this.rows);
			this.block.transition = "fadeOutZoom";
			return this;
		}
	});

}(jQuery));
