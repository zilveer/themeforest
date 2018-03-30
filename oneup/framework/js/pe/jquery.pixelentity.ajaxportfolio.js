(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,window */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peAjaxPortfolio = {	
		conf: {
			api: false
		} 
	};
	
	var jwin = $(window);
	var jhtml = $("html");
	
	function PeAjaxPortfolio(target, conf) {
		var peIsotope;
		var scroller;
		var projects = [];
		var navigation,spinner;
		var current = 0;
		var locked = false;
		var widgets;
		var page;
		var active = [];
		var loading = false;
		var oldHash = false;
		var ready = false;
		var needFilter = false;
		var ignoreEvent = false;
		
		function top() {
			var hh = jhtml.data('header-height') || 0;
			page.animate({scrollTop: target.offset().top-hh-20},300);
		}

		function thumbnailHandler(e) {
			e.stopImmediatePropagation();
			e.preventDefault();
			if (loading) {
				return;
			}
			var link = target.find(e.currentTarget);
			var i = parseInt(link.attr("data-slide"),10);
			
			if (needFilter) {
				filter();
				needFilter = false;
			}
			
			scroller.show(i);
			top();
			current = $.inArray(i,active);
		}
		
		function filter() {
			var items = peIsotope.find(".peIsotopeItem:not(.isotope-hidden) .scalable a[data-slide]");
			active = [0];
			items.each(function (i) {
				active.push(parseInt(items.eq(i).attr("data-slide"),10));
			});
		}
		
		function navigationHandler(e) {
			e.stopImmediatePropagation();
			e.preventDefault();
			
			if (loading) {
				return false;
			}
			
			var action = navigation.find(e.currentTarget).attr("data-action");
			
			switch (action) {
			case "prev":
				current--;
				current += current < 0 ? active.length : 0;
				if (current === 0 && active.length > 2) {
					current = active.length-1;
				}
				scroller.show(active[current]);
				scroller.prev();
				break;
			case "next":
				current = (current + 1) % active.length;
				if (current === 0 && active.length > 2) {
					current = 1;
				}
				scroller.show(active[current]);
				break;
			default:
				scroller.show(0);
			}
			top();
			return false;
		}
		
		function nav(show,callback) {
			if (show) {
				navigation.stop().css("visibility","visible").fadeTo(300,1);
			} else {
				if (navigation.css("visibility") === 'hidden') {
					if (callback) {
						callback();
					}
				} else {
					navigation.stop().fadeTo(callback ? 100 : 300,0,function () {
						navigation.css("visibility","hidden");
						if (callback) {
							callback();
						}
					});					
				}
			}
		}
		
		function hidespinner() {
			spinner.css("visibility","visible").fadeTo(100,1);
		}

		
		function showspinner() {
			if (loading) {
				nav(false,hidespinner);
			}
		}

		
		function scrollerHandler(e,data) {
			switch (e.type) {
			case "loading":
				loading = true;
				setTimeout(showspinner,500);
				break;
			case "loaded":
				scroller.slides[data.idx].find("img[data-original]:not(img.pe-lazyload-inited)").addClass("pe-lazyloading-forceload").peLazyLoading();
				break;
			case "ready":
				break;
			case "reset":
				locked = false;
				if (!ready) {
					target.trigger("ajaxloaded.pixelentity");
				}
				/*
				if (window.FB && window.FB.XFBML && window.FB.XFBML.parse) {
					FB.XFBML.parse();
				}
				*/
				break;
			case "show":
				
				target.parent()[data.idx === 0 ? "removeClass" : "addClass"]("pe-hide-pager");
				
				if (data.idx !== 0 && widgets(scroller.slides[data.idx],scroller)) {
					scroller.expand();
				}
				
				if (data.idx !== 0) {
					var slug = projects[data.idx-1].attr("data-slug");
					if (slug) {
						oldHash = window.location.hash;
						window.location.hash = "!/" + slug;
					}
				} else {
					if (window.location.hash && oldHash) {
						window.location.hash = "!";
					}
				}
				
				if (loading) {
					loading = false;
					spinner.fadeTo(300,0,function () {
						spinner.css("visibility","hidden");
						nav(data.idx > 0);
					});
				} else {
					nav(data.idx > 0);
				}
				
				break;
			}
		}
		
		function insert(e,data) {
			if (data) {
				var el,last = projects.length;
				if (data.items) {
					data.items.each(function (idx) {
						data.items.eq(idx).find("a[data-slide]").attr("data-slide",last+idx+1);
					});
				}
				if (data.extra) {
					data.extra.each(function (idx) {
						el = data.extra.eq(idx);
						scroller.addSlide(el);
						el.attr("data-slide",last+idx+1);
						projects.push(el);
					});
				}
				
				
			}
			
			//scroller.show(0);
			needFilter = true;
		}

		
		function init() {
			
			page = $("html,body");
			navigation = target.find(".pe-ajax-portfolio-navigation");
			spinner = target.find(".pe-ajax-portfolio-spinner");
			
			scroller = target.find(".pe-scroller:first");			
			var slides = target.find(".pe-project-item");
			
			slides.each(function (idx) {
				projects[idx] = slides.eq(idx);
				scroller.append(this);				
			});
			
			filter();
			
			scroller = scroller.peScroll({
				type: "horizontal",
				show: 1,
				liquid: true,
				preload: true,
				fade: false,
				//forceResize: true,
				disableWhileScrolling:true,
				api: true,
				start:false,
				duration: 500
			});
			
			scroller.bind("ready.pixelentity reset.pixelentity loading.pixelentity loaded.pixelentity show.pixelentity",scrollerHandler);
			scroller.start();
			target.on("click",".peIsotopeItem a",thumbnailHandler);
			peIsotope.on("filter.pixelentity",filter);
			peIsotope.on("insert.pixelentity",insert);
			navigation.on("click","a",navigationHandler);
		}
		
		// init function
		function start() {
			peIsotope = target.find(".peIsotope");
			
			widgets = typeof pixelentity.controller.widgets === 'function' ? pixelentity.controller.widgets : $.pixelentity.widgets.build;
			
			if (peIsotope.hasClass("pe-isotope-ready")) {
				init();
			} else {
				peIsotope.one("loaded",init);
			}
		}
		
		$.extend(this, {
			// public API
			destroy: function() {
				target.data("peAjaxPortfolio", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peAjaxPortfolio = function(conf) {
		
		// return existing instance	
		var api = this.data("peAjaxPortfolio");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peAjaxPortfolio.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeAjaxPortfolio(el, conf);
			el.data("peAjaxPortfolio", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));