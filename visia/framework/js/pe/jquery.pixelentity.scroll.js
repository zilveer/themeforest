(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.scroll = {	
		conf: { 
			scrollLockedTime: 100,
			duration: 450,
			paddingTop: 0,
			paddingRight: 0,
			paddingBottom: 0,
			paddingLeft: 0,
			spacing: 0,
			show: 1,
			size: 200,
			align: "center",
			liquid: true,
			fade: true,
			preload: true,
			disableWhileScrolling: false,
			start: true,
			expand: true,
			forceResize: false,
			api: false,
			customDirection: 0
		} 
	};
	
	function PeScroll(t, conf) {
		
		var self = this;
		var jthis = $(this);
		var doScroll;
		var w, h, rw, rh;
		var target = t;
		var scroller;
		var wrapper;
		var hideLayer;
		var slides = [];
		var axis, prop, otherProp, size, otherSize, margin, slideSize, scrollerSize, spacing;
		
		var startFrom = 0;
		var endOn = 0;
		var first = 0;
		var last = -1;
		var prevFirst = 0;
		var prevLast = 0;
		
		var scrollStart = 0;
		var scrollPos = 0;
		var scrollEnd = 0;
		var duration = conf.duration;
		var lastClean = 0;
		var scrolling = false;
		var direction = 0;
		var prevDirection = 0;
		var prevCustom = 0;
		var needResize = true;
		var locked = false;
		var scrollLocked = false;
		var queue = [];
		var active = [];
		var loaded = 0;
		var items = 0;
		var max = 0;
		var expandFrom = 0;
		var expandTo = 0;
		var added = [];
		var errors = false;
		var use3d = false;
		var isReady = false;
		var resizeToAuto = false;
		var startedAt = 0;
		var iDev = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
		var iDevPhone = navigator.userAgent.toLowerCase().match(/(iphone|ipod)/);
		
		function setValues() {
			
			conf.horiz = conf.type === "horizontal";
			conf.vert = !conf.horiz;
			
			if (conf.vert) {
				conf.expand = false;
			}
			
			if ($.browser.opera || ($.browser.msie && $.browser.msie < 9)) {
				doScroll = (conf.horiz) ? doScrollCompatHoriz : doScrollCompatVert;
			} else {
				doScroll = (conf.horiz) ? doScrollHoriz : doScrollVert;
			}
			
			axis = conf.horiz ? "x" : "y";
			prop = conf.horiz ? "width" : "height";
			otherProp = conf.horiz ?  "height" : "width";
			
			margin = conf.horiz ? "margin-right" : "margin-bottom";
				
		}
		
		function resize() {
			if (scrolling) {
				needResize = true;
			} else {
				doResize();
				if (conf.expand) {
					if (iDev && conf.duration > 0) {
						return;
					}
					expand();
					doExpand(expandTo);
				}

			}
		}
		
		function doResize() {
			var nw = target.width();
			var nh = target.height();
			if (nw !== w || nh !== h) {
			
				w = nw;
				h = nh;
				
				rw = w - conf.paddingLeft - conf.paddingRight;
				rh = h - conf.paddingTop - conf.paddingBottom;
				
				size = conf.horiz ? rw : rh;
				otherSize = conf.horiz ? rh : rw;
				
				size += conf.spacing;
				
				scrollerSize = size;
				
				spacing = conf.spacing;
				
				wrapper.css({
					"margin-top": conf.paddingTop,
					"margin-right": conf.paddingRight,
					"margin-bottom": conf.paddingBottom,
					"margin-left": conf.paddingLeft
				});
						
				var change = 0;
				
				
				// should be reset
				if (items > 0) {
					// compute exact number of slides to be displayed 
					
					if (conf.show) {
						max = Math.min(conf.show, items);
						slideSize = Math.floor(size / max);
					} else {
						
						var oldMax = max;
						
						slideSize = conf.size + conf.spacing;
						max = Math.min(Math.floor((size + conf.spacing) / (slideSize)), items);
						
						if (max > 1) {
							var delta = (size - slideSize * max) / (max - 1);
						
							if (conf.align == "center" && delta > 0) {
								delta = (size - slideSize*max);
								scrollerSize -= delta;
								
								if (conf.horiz) {
									rw -= delta;
									wrapper.css("margin-left", conf.paddingRight + delta >> 1);
								} else {
									rh -= delta;
									wrapper.css("margin-top",conf.paddingTop+delta>>1);
								}
								
							} else {
								slideSize += delta;
								spacing += delta;
							}
							
							scrollerSize = Math.ceil(max*slideSize);							
							slideSize = Math.floor(slideSize);
							spacing = Math.floor(spacing);

						
							/* 
							// old code 
							slideSize += delta;
							spacing += delta;
						
							scrollerSize = Math.ceil(max*slideSize);
							
							slideSize = Math.floor(slideSize);
							spacing = Math.floor(spacing);
							*/
							
							
						} else if (max == 1){
							scrollerSize = slideSize;
							if (conf.horiz) {
								wrapper.css("margin-left",conf.paddingLeft+(rw-slideSize)/2);
								rw = slideSize;
							} else {
								wrapper.css("margin-top",conf.paddingTop+(rh-slideSize)/2);
								rh = slideSize;
							}
						} else {
							max = 1;
							//spacing = 0;
							slideSize = scrollerSize = size;
						}
						
						
						if (oldMax > 0) {
							change = max-oldMax;
						}
															
					}
					
					// compute last thumbnail index
					endOn = startFrom + max - 1;
					
				}
				
				wrapper.width(rw).height(rh);
				
				if (hideLayer) {
					hideLayer.width(rw).height(rh);
				}
				
				scroller[prop](scrollerSize);
				scroller[otherProp](otherSize);
				
				var count = items;
				while (count--) {
					resizeSlide(slides[count]);
				}
				
				if (change > 0) {
					update();
				} else if (change < 0) {
					last = endOn;
					reset();
				}
								
				needResize = false;
			}
		}
		
		function expand() {
			if (active.length === 0) {
				return;
			}
			expandFrom = otherSize;
			expandTo = 0;
			var idx = first;
			for (;idx != last;idx++) {
				expandTo = Math.max(expandTo,slides[normalize(idx)][otherProp]());
			}
			expandTo = Math.max(expandTo,slides[normalize(last)][otherProp]());
			if (expandTo === 0) {
				expandFrom = expandTo;
			}
		}
		
		function doExpand(amount) {
		
			amount = parseInt(amount,10);
			var inner = amount;
			var outher = amount;
			outher += (conf.horiz ? conf.paddingTop+conf.paddingBottom : conf.paddingLeft+conf.paddingRight);
			
			otherSize = amount;
			
			target[otherProp](outher);
			wrapper[otherProp](amount);
			scroller[otherProp](amount);
			if (hideLayer) {
				hideLayer[otherProp](amount);
			}
			
			if (conf.horiz) {
				rh = amount;
				h = amount;
			} else {
				rw = amount;
				w = amount;
			}
			
		}
		
		function set3d(el) {
			el.css("-webkit-transform","translateZ(0px)");
		}
		
		function start() {
			
			scroller = $("<div>");
			scroller.css({
				overflow: "hidden",
				margin: "0px",
				padding: "0px",
				position: "relative",
				// ^^^ CHECK THIS ONE!
				"border-width": "0px"
			});
			 
			use3d = $.support.hw3dTransform;
			
			//target.css("overflow","hidden").show().wrapInner(scroller);
			target.css("overflow","hidden").wrapInner(scroller);
			scroller = target.find("> div");
			
			scroller.wrap("<div>");
			// scroller wrapper
			wrapper = scroller.parent().css("overflow","hidden");
			
			if (conf.disableWhileScrolling) {
				hideLayer = $("<div>").css("position","absolute").css("z-index",1);
			}
			
			setValues();
			
			if (use3d) {
				set3d(scroller);
				set3d(wrapper);
				set3d(target);
			}
			
			build();
		}
		
		function build() {
			scroller.find("> div").each(parseSlide);
			items = slides.length;
			
			resize();
			update();
			
			//ready();
		}
		
		function ready() {
			if (isReady) {
				return;
			}
			isReady = true;
		
			if (conf.expand) {
				doExpand(expandTo);
			}
			
			jthis.triggerHandler("ready.pixelentity",{main:true});
			if (conf.liquid) {
				if (false && conf.show == 1 && conf.type == "horizontal") {
					resizeToAuto = true;
				} else {
					$(window).resize(eventHandler);
				}
			}
		}
		
		function parseSlide(idx,el) {
			var jqEl = $(el);
			
			if (use3d) {
				set3d(jqEl.find("img"));
			}
			
			// here we wrap the original content with a clean container
			var wrap = $("<div>");
			wrap.css({
				margin: "0px",
				padding: "0px",
				position: "relative",
				// ^^^ CHECK THIS ONE!
				"border-width": "0px"
			});
			 
			wrap.data("load",jqEl.attr("data-load"));
			wrap.data("direction",jqEl.attr("data-direction"));
			
			jqEl = jqEl.wrap(wrap).parent();
			
			jqEl.attr("id",idx).data("peScrollID",idx);
			
			if (use3d) {
				set3d(jqEl);
			}
			
			resizeSlide(jqEl);
			
			slides.push(jqEl);
			
			if (expandFrom === 0) {
				expandTo = expandFrom = target[otherProp]();
			}
			
			jqEl.detach();
		}
		
		
		function addSlide(el) {
			parseSlide(items,el);
			items = slides.length;
			first += items;
			last += items;
			return items-1;
		}
		
		
		function resizeSlide(slide) {
			slide.css({
				"overflow":"hidden",
				"float": (conf.horiz) ? "left" : "none"
			})[prop](slideSize-spacing);
			slide.css(margin,spacing);
		}
		
		function eventHandler(e) {
			if (e.type == "resize") {
				resize();
			}
		}
		
		
		
		function scrollUnlock() {
			scrollLocked = false;
		}
		
		// advance (cycle) slides
		function advance(n,absolute) {
			if (scrollLocked) {
				return;
			}
			if (parseInt(conf.scrollLockedTime,10) > 0) {
				setTimeout(scrollUnlock,parseInt(conf.scrollLockedTime,10));
				scrollLocked = true;
			} 
			advanceIndex(n,absolute);
			update();
		}
		
		function advanceIndex(n,absolute) {
			if (absolute) {
				// some math: hard to explain but it works
				var delta = startFrom % items;
				if (delta<0) {
					delta+= items;
				}
				
				delta = n-delta;
				
				// if delta = 0, nothing to do 
				if (delta === 0) {
					jthis.triggerHandler("reset.pixelentity",{main:true});
					return;
				}
				
				
				if (Math.abs(delta) > items/2) {
					delta += items;
				}
				
				startFrom += delta;
			} else {
				startFrom += n;
			}
			
			endOn = startFrom + max - 1;		
			
		}
		
		function update() {
		
			/*
				having this one to work in all situations was a real *PITA*
			
			*/
			
			if (locked) {
				return;
			}
			
			locked = true;
			prevDirection = direction;
			prevFirst = first;
			prevLast = last;
			
			
			//items = slides.length;
			// ^^^ CHECK THIS
			
			var i=0;
			var displayed = active.length;
			
			// if already have displayed thumbnails
			if (displayed > 0) {
			
				// add thumbs to start
				if (first>startFrom) {
					first = Math.min(first,startFrom+max);
					direction = conf.customDirection ? direction : 2;
					for (i = first-1;i>=startFrom;i--) {
						enqueueSlide(i,true);
					}
					
				}
				
			}
			
			// add thumbs to end
			if (endOn>last) {
				direction = conf.customDirection ? direction : 1;
				last = Math.max(last,endOn-max);
				for (i = last+1;i<=endOn;i++) {
					enqueueSlide(i);
				}
			}
			
			
			// update indexes
			first = startFrom;
			last = endOn;
			
			process();
		}
		
		function enqueueSlide(idx,head) {
			var current = slides[normalize(idx)];			
			queue.push(current);	
		}
		
		function process() {
			var n = queue.length;
			if (n === 0) {
				locked = false;
				return;
			}
			
			var preloading = 0;
			for (var i=0;i<n;i++) {
				preloading += preload(queue[i]);
			}
			
			if (preloading === 0) {
				doDelayedProcess();
			}
			
		}
		
		function preload(slide) {
			if (slide.data("load") && !slide.data("loaded")) {
				var resource = slide.data("load");
				jthis.triggerHandler("loading.pixelentity",{idx:parseInt(slide.data("peScrollID"),10)});
				// append to dom so images will be loaded
				
				scroller.append(slide.hide());
				slide.data("loaded",true).load(resource,contentLoaded);
			} else if (conf.preload) {
				if (slide.data("preloaded")) {
					jthis.triggerHandler("loaded.pixelentity",{idx:parseInt(slide.data("peScrollID"),10)});
					return 0;
				}
				// damn opera 11.6 workaround
				if ($.browser.opera && (parseFloat($.browser.version) >= 11.6)) {
					scroller.append(slide.hide());
				}
				$.pixelentity.preloader.load(slide,slideLoaded);
			} else {
				jthis.triggerHandler("loaded.pixelentity",{idx:parseInt(slide.data("peScrollID"),10)});
				return 0;
			}
			return 1;
					
		}
		
		function contentLoaded(data,status) {
			var idx = parseInt(this.id,10);
			if (status == "error") {
				errors = true;
				slides[idx].append("<div class=\"error404\">ERROR LOADING "+slides[idx].data("load").replace(/ \..*/,"")+"</div>");
				doProcess();
			} else {
				jthis.triggerHandler("ready.pixelentity",{idx:idx});
				var orig = slides[idx].children();
				if (orig.attr("data-direction")) {
					slides[idx].data("direction",orig.attr("data-direction"));
				}
				if (use3d) {
					set3d(slides[idx].find("img"));
				}
				// damn opera 11.6 workaround
				if ($.browser.opera && (parseFloat($.browser.version) >= 11.6)) {
					slides[idx].show();
					preload(slides[idx]);
					slides.detach();
				} else {
					// working
					slides[idx].detach().show();
					preload(slides[idx]);					
				}
			}
		}
		
		function slideLoaded(slide) {
			loaded++;
			slide.data("preloaded",true);
			jthis.triggerHandler("loaded.pixelentity",{idx:parseInt(slide.data("peScrollID"),10)});
			if (loaded >= queue.length) {
				doDelayedProcess();
			}
		}
		
		function doDelayedProcess() {
			if (iDevPhone) {
				setTimeout(doProcess,300);
			} else {
				doProcess();
			}
		}
		
		function doProcess() {
		
			if (!isReady) {
				ready();
			}
			
		
		
			if (errors) {
				errors = false;
				locked = false;
				queue = [];
				scrollLocked = false;
				advance(1,true);
				return;
			}
		
			var n = queue.length;
			var pd = direction;
			
			if (scrolling && direction>0 && direction != prevDirection) {
				reset();
				prevDirection = direction;
			}
			
			var i;
			var current;
			var newSlides = 0;
			var oldPos;
			var inList = active.length;
		
			scrollerSize = inList*slideSize;
		
			var old = active.slice(0);
			var skipped = 0;
			
			for (i=0;i<n;i++) {
				current = queue[i];
				// check if the slide is already in display list
				if ((oldPos = jQuery.inArray(current.data("peScrollID"),active)) >= 0) {
					// yes, remove from list since it will be added again later in new position
					active.splice(oldPos,1);
					skipped++;
				} else {
					// nope
					newSlides++;
				}
			}	
			
			scrollerSize += newSlides*slideSize;
			
			scroller[prop](scrollerSize);
			
			scrollStart = scrollPos;
			
			if (inList > 0 && conf.customDirection) {
				direction = conf.customDirection;
				if (current) {
					switch (current.data("direction")) {
						case "left":
							direction = 1;
						break;
						case "right":
						direction = 2;
						break;
						case "opposite":
						case "invert":
							direction = (prevCustom == 1) ? 2 : 1;
						break;
					}
				}
				prevCustom = direction;
			}
			
			if (direction == 2) {
				scrollStart -= slideSize*newSlides;
				scrollPos = scrollStart;
			} else {
				newSlides = Math.min((inList+newSlides)-max,newSlides);
				scrollEnd -= slideSize*newSlides;
			}
			
			
			var noScroll;
			var count = 0;
			
			if (conf.fade) {
				newSlides += skipped;
			} else {
				newSlides = n;
			}
			
			var hidden = [];
			
			
			while((current = queue.shift())) {
				noScroll = (--newSlides < 0);
				if (noScroll) {
					current.fadeTo(0,0);
				} else {
					// CHECK THIS
					current.hide();
					hidden.push(current);
				}
				
				jthis.triggerHandler("beforedom.pixelentity",{idx:parseInt(current.data("peScrollID"),10)});
				scroller[direction == 1 ? "append" : "prepend"](current);
				active[direction == 1 ? "push" : "unshift"](current.data("peScrollID"));
				jthis.triggerHandler("afterdom.pixelentity",{idx:parseInt(current.data("peScrollID"),10)});
				if (noScroll) {
					jthis.triggerHandler("show.pixelentity",{idx:parseInt(current.data("peScrollID"),10)});
				}
				//current.children().triggerHandler("load.pixelentity");
				current.children().each(triggerAllLoad);

				if (noScroll) {
					current.delay((count++)*100).fadeTo(300,1);
				}
			}
			
			if (conf.expand) {
				expand();
			}
			
			startedAt = time();
			if (!scrolling) {
				if (hideLayer) {
					wrapper.prepend(hideLayer);
				}
				duration = conf.duration;
				if (duration > 0) {
					$.pixelentity.ticker.register(worker,0);
				}
			}
			worker();
			
			// CHECK THIS
			while((current = hidden.shift())) {
				current.show();
				jthis.triggerHandler("show.pixelentity",{idx:parseInt(current.data("peScrollID"),10)});
			}
			
			if (duration > 0) {
				scrolling=true;
				//scroller.find(".peActiveWidget").triggerHandler("disable.pixelentity");
				scroller.find(".peActiveWidget").trigger("disable.pixelentity");
			}
			
			locked = false;
		}
		
		function triggerAllLoad() {
			$(this).triggerHandler("load.pixelentity");
		}
		
		function doScrollHoriz(amount) {
			scroller.transform(1,parseInt(amount,10),0,scrollerSize,h);
		}
		
		function doScrollVert(amount) {
			scroller.transform(1,0,parseInt(amount,10),w,scrollerSize);
		}
		
		function doScrollCompatHoriz(amount) {
			scroller.css("margin-left",parseInt(amount,10));
		}
		
		function doScrollCompatVert(amount) {
			scroller.css("margin-top",parseInt(amount,10));
		}
		
		function time() {
			return (new Date()).getTime();
		}
		
		function worker() {
			var elapsed,now;
			
			if (!scrolling) {
				// CHECK THIS OUT
				elapsed = 0;
			} else {
				now = time();
				elapsed = now - startedAt;
			}
			
			//elapsed += 10;
			if (elapsed >= duration) {
				elapsed = duration;
			}
			
			scrollPos = (jQuery.easing.easeOutQuad(0, elapsed, scrollStart, scrollEnd-scrollStart, duration));	
			
			if (expandFrom != expandTo && !iDev) {
				doExpand(jQuery.easing.easeOutQuad(0, elapsed, expandFrom, expandTo-expandFrom, duration));
			} 
			
			if (elapsed == duration) {
				doExpand(expandTo);
				reset();
			} else {
				if (scrollStart != scrollEnd) {
					doScroll(scrollPos);
				}
				if ((now-lastClean) > 100) {
					if (!locked) {
						cleanOffscreen();
						lastClean = now;
					}
				} 
			}
			
		}
		
		
		function cleanOffscreen() {
			var pos = (direction == 1) ? -scrollPos : scrollPos+active.length*slideSize-size;
			if (pos <= slideSize) {
				return;
			}
			var current;
			
			while((pos -= slideSize) > 0) {
				current = active[direction == 1 ? "shift" : "pop"]();
				if (typeof current == "undefined") {
					break;
				}
				current = slides[current];
				current.detach();
				
				if (direction == 1) {
					scrollPos += slideSize;
					scrollStart += slideSize;
					scrollEnd += slideSize;
					doScroll(scrollPos);
				}				
			}
		}
		
		function normalize(idx) {
			idx = idx % items;
			if (idx<0) {
				idx+= items;
			}
			return idx;
		}
		
		function keepSlide(i,search) {
			
			var current = slides[active[i]];
			
			if (current.data("peScrollID") == search) {
				return true;
			}
			active[i] = false;
			current.detach();
			return false;
		}
		
		function reset() {
			
			if (hideLayer) {
				hideLayer.detach();
			}
			$.pixelentity.ticker.unregister(worker);			
			
			var currentState = (queue.length === 0);
			
			var current;
			
			var beforeFirst = normalize(currentState ? first : prevFirst);
			var afterLast = normalize(currentState ? last : prevLast);
			
			var i = 0,al = active.length;
			
			for (;i<al;i++) {
				if (keepSlide(i,beforeFirst)) {
					break;
				}
			}
			
			i = al;
			while (i--) {
				if (keepSlide(i,afterLast)) {
					break;
				}
			}
			
			// clean display list
			i = al;
			while (i--) {
				if (active[i] === false) {
					active.splice(i,1);
				}
			}
			
			// reset scrolling;
			scrolling = false;
			scroller[prop]((scrollerSize = size));
			// ^^ CHECK THIS OUT
			doScroll(scrollPos = scrollStart = scrollEnd = 0);
		
			if (currentState) {
				direction = 0;
			}
			
			if (conf.forceResize || duration === 0) {
				w--;
				needResize = true;
			}
			
			
			if (needResize) {
				resize();				
			} else if (resizeToAuto) {
				wrapper.width("auto").height("auto");
				scroller.width("auto").height("auto");
				slides[normalize(first)].width("auto").height("auto");
				/*
				slides[normalize(first)].width("auto").height("auto");
				*/
			}
			
			//debug();
			
			
			//scroller.find(".peActiveWidget").triggerHandler("enable.pixelentity");
			scroller.find(".peActiveWidget").trigger("enable.pixelentity");	
			jthis.triggerHandler("reset.pixelentity",{main:true});
		}
		
		/*
		function debug() {
			var buffer = [];
			for (var i=0;i< slides.length;i++) {
				var s = slides[i];
				buffer.push("["+i+":"+s.data("peScrollID")+"]");
			}
			console.log(first,last,normalize(first),normalize(last),buffer.join(','));
		}
		*/
		
		$.extend(self, {
			"start": start,
			bind: function(ev,handler) {
				jthis.bind(ev,handler);
			},
			one: function(ev,handler) {
				jthis.one(ev,handler);
			},
			next: function(n) {
				n = parseInt(n,10);
				advance(n > 0 ? n : 1);
			},
			prev: function(n) {
				n = parseInt(n,10);
				advance(n > 0 ? -n : -1);
			},
			show: function(n) {
				n = parseInt(n,10);
				advance(n,true);
			},
			"resize": resize,
			"slides": slides,
			"addSlide": addSlide,
			"expand": function() {
				expand();
				worker();
			},
			"conf":conf,
			first: function() {
				return normalize(first);
			},
			firstSlide: function() {
				return slides[normalize(first)];
			},
			destroy: function() {
				if (conf.liquid) {
					$(window).unbind("resize",eventHandler);
				}
				if (jthis) {
					jthis.remove();
				}
				jthis = self = undefined;
				target.data("peScroll", null);
				target = undefined;
				
			}
		});
		
		if (conf.start) {
			start();
		}
		
		
	}
	
	// jQuery plugin implementation
	$.fn.peScroll = function(conf) {
		// return existing instance
		
		var api = this.data("peScroll");
		
		if (api) { 
			return api; 
		}

		conf = $.extend(true, {}, $.pixelentity.scroll.conf, conf);
		
		// install peScroll for each entry in jQuery object
		this.each(function() {
			api = new PeScroll($(this), conf);
			$(this).data("peScroll", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
		
}(jQuery));