(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peThumbList = {	
		conf: {
			api: false
		} 
	};
	
	function PeThumbList(target, conf) {
		
		var w,tw = 0,th = 0,tm = 0;
		var thumbs = [];
		var first = 0,max = 0;
		var selected = -1;
		var locked = false;
		var jthis = $(this);
		var jumpAfterID = -1;
		var prevClicked = false;
		
		// init function
		function start() {
			target.children().each(addThumb);
			if (thumbs.length === 0) {
				return;
			}
			target.delegate("a","click",evHandler);
			resize(true);
		}
		
		function resize(fade) {
			w = target.width();
			max = Math.floor((w)/(tw+tm+2));
			var shown = thumbs.length - first;
			if (shown < max) {
				first = Math.max(0,first-(max-shown));
			}
			show(fade);
		}
		
		function addThumb() {
			var thumb = $(this).attr("id",thumbs.length);
			thumbs.push(thumb);
			if (tw === 0) {
				tw = thumb.width();
				th = thumb.height();
				tm = parseInt(thumb.css("margin-left").replace("px",""),10);
			}
		}
		
		function jumpAfterPage() {
			if (jumpAfterID >= 0) {
				select(jumpAfterID);
				jumpAfterID = -1;
			}
		}
		
		function show(fade) {
			var last = first+max,thumb,count=0;
			for (var i = 0;i<thumbs.length;i++) {
				thumb = thumbs[i];
				if (i < first || i >= last ) {
					thumb.hide();
				} else {
					if (thumb.data("loaded")) {
						if (fade) {
							thumb.stop().fadeTo(0,0).show().delay(count*50).fadeTo(300,1);
							count++;
						} else {
							thumb.stop().fadeTo(0,1).show();
						}
					} else {
						preload(i);
						thumb.show();	
					}
				}
			}
		}
		
		function evHandler(e) {
			if (!locked) {
				return select(parseInt(e.currentTarget.id,10));				
			}
			return false;
		}

		function select(id) {
			if (id == selected) {
				return false;
			}
			if (max > 0 && (id >= first+max || id < first)) {
				advance(id);
				jumpAfterID = id;
				setTimeout(jumpAfterPage,500);
				return false;
			}
			
			if (selected >= 0) {
				thumbs[selected].removeClass("selected");
			}
			
			selected = id;
			
			if (thumbs[id].attr("data-ignore") === "enabled") {
				if (prevClicked) {
					prevThumb();
				} else {
					nextThumb();					
				}
				return true;
			}
			
			prevClicked = false;
			
			thumbs[selected].addClass("selected");
			jthis.triggerHandler("selected.pixelentity",[thumbs[selected]]);
			return false;
		}

		function preload(idx) {
			var thumb = thumbs[idx];
			if (thumb.hasClass("loaded") || thumb.data("loading")) {
				return true;
			} 
			thumb.data("loading",true);
			thumb.find("img").fadeTo(0,0);
			$.pixelentity.preloader.load(thumb,loaded,true);
			return false;
		}
		
		function loaded(target) {
			target.addClass("loaded");
			target.data("loaded",true);
			var img = target.find("img");
			img.css("margin-top",Math.floor(th-img.height())/2);
			img.stop().fadeTo(0,0).fadeTo(300,1);
		}
		
		function advance(to) {
			if (to != first) {
				first = to;
				show(true);
			}
		}
		
		function lastPage() {
			return first+max >= thumbs.length; 
		}
		
		function firstPage() {
			return first === 0; 
		}
		
		function canScroll() {
			return max < thumbs.length; 
		}
		
		function prev() {
			advance(Math.max(0,first - max));
		}
		
		function next() {
			advance(Math.min(Math.max(0,thumbs.length-max),first + max));
		}
		
		function nextThumb() {
			select((selected + 1) % thumbs.length);
		}
		
		function prevThumb() {
			prevClicked = true;
			select((selected > 0 ? selected : thumbs.length) - 1);
		}
		
		function bind() {
			jthis.bind.apply(jthis,arguments);
		}
		
		function lock() {
			locked = true;
		}
		
		function unlock() {
			locked = false;
		}
		
		function getThumb(idx) {
			return thumbs[idx];
		}
		
		$.extend(this, {
			// plublic API
			"next": next,
			"prev": prev,
			"resize": resize,
			"select": select,
			"lastPage": lastPage,
			"firstPage": firstPage,
			"canScroll": canScroll,
			"thumbs":thumbs,
			"bind":bind,
			"lock":lock,
			"unlock":unlock,
			"nextThumb":nextThumb,
			"prevThumb":prevThumb,
			"thumb": getThumb,
			destroy: function() {
				target.data("peThumbList", null);
				target.undelegate("a","click",evHandler);
				target = undefined;
				jthis = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peThumbList = function(conf) {
		
		// return existing instance	
		var api = this.data("peThumbList");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peThumbList.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeThumbList(el, conf);
			el.data("peThumbList", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));