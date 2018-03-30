(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,window,JSON */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peLoadMore = {	
		conf: {
			api: false
		} 
	};
	
	var jwin = $(window);
	
	function PeLoadMore(target, conf) {
		var pages = [];
		var active = 0;
		var container,last;
		var buffer;
		var parent;
		var widgets;
		var loading=0;
		
		function loaded(data) {
			
			var pos = target.offset().top;
			if (container.is(parent)) {
				target.detach();
			}
			
			var items = [];
			var isotope = container.closest(".isotope");
			isotope = isotope.length > 0 ? isotope : false;
			var frag = isotope ? false : document.createDocumentFragment();
			
			buffer.find(".pe-load-more-item").each(function () {
				if (frag) {
					frag.appendChild(this);
				}
				items.push(this);
			}); 
			
			items = $(items);
			
			if (isotope) {
				var isoitems = items.filter(".peIsotopeItem");
				isotope.isotope('insert',isoitems).trigger("insert.pixelentity",{items: isoitems,extra:items.not(".peIsotopeItem")});
				setTimeout(function () {
					// just to be safe
					isotope.isotope("resize");
				},100);
			} else {
				container.append(frag);
			}
			
			widgets(items,{});
			
			items.find("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();
			
			if (active >= (pages.length-1)) {
				target.hide();
			} else if (container.is(parent)) {
				parent.append(target);
			}
			
			clearTimeout(loading);
			loading = 0;
			hideSpinner();
			target.removeClass('pe-load-more-loading');
		}
		
		function showSpinner() {
			target.addClass('pe-load-more-loading');
		}
		
		function hideSpinner() {
			target.removeClass('pe-load-more-loading');
		}

		function load(e) {
			e.stopImmediatePropagation();
			e.preventDefault();
			if (loading) {
				return false;
			}
			active++;
			var id = container.attr("id");
			var sel = id ? "#"+id : ".pe-load-more-item";
			buffer.load(pages[active]+" %0".format(sel),loaded);
			loading = setTimeout(showSpinner,300);
			return false;
		}

		
		function start() {
			var i,li = target.find("ul > li.pe-is-page");
			
			if (li.length > 1) {
				for (i = 0; i< li.length;i++) {
					var current = li.eq(i);
					if (i === 0 && !current.hasClass("active")) {
						break;
					}
					var href = current.find("a").attr("href");
					if (href) {
						pages.push(href);
					}
				}
				
				if (pages.length > 0) {
					
					if (target.attr("data-all")) {
						var all;
						try {
							all = JSON.parse(target.attr("data-all"));
						} catch (x) {}
						if (all && all.length > pages.length) {
							pages = all;
						}
					}
					
					parent = target.parent();
					var first = parent.find(".pe-load-more-item:first");
					if (first.length === 0) {
						// no items found, bail out
						return;
					}
					last = first.parent().find("> .pe-load-more-item:last");
					container = first.parent();
					
					widgets = typeof pixelentity.controller.widgets === 'function' ? pixelentity.controller.widgets : $.pixelentity.widgets.build;
					buffer = $("<div></div>");
					
					var more = $('<a class="pe-load-more-button" href="#">%0</a>'.format(target.attr('data-msg')));
					more.on("click",load);
					target.addClass('pe-load-more-active').find("ul").replaceWith(more);
					target.prepend('<div class="pe-ajax-portfolio-spinner"><div class="pe-spinner"></div></div>');
				}
			}			
		}

		
		$.extend(this, {
			// public API
			destroy: function() {
				target.data("peLoadMore", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peLoadMore = function(conf) {
		
		// return existing instance	
		var api = this.data("peLoadMore");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peLoadMore.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeLoadMore(el, conf);
			el.data("peLoadMore", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));