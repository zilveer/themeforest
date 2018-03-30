(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,window */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMenu = {	
		conf: {
			api: false
		} 
	};
	
	var jwin = $(window);
	var mobile = $.pixelentity.browser.mobile;
	var mlayout = false;
	var wasmlayout = false;
	
	function PeMenu(target, conf) {
		
		var w,h,toggle,menu,dropdowns,mega;
		var main;
		var active = [];
		var pos = 0;
		
		function menuAlign(idx) {
			var item = menu.eq(idx);
			var sitem,submenu = item.find("ul.sub-menu").removeClass("rightAlign");
			var i,endPos = item.width()+item.parent().offset().left;
			if (endPos >= w) {
				item.addClass("rightAlign");
			} else {
				for (i=0;i<submenu.length;i++) {
					sitem = submenu.eq(i);
					if (endPos+sitem.width() > w) {
						sitem.addClass("rightAlign");
					}
				}
			}
		}
		
		function mobileNavigation() {
			
			var li = dropdowns.filter(this).parent();
			
			if (!mlayout) {
				if (li.hasClass("dropdown-on")) {
					li.removeClass("dropdown-on").find(".dropdown-on").removeClass("dropdown-on");
				} else {
					li.addClass("dropdown-on");
				}
				li.siblings(".dropdown-on").removeClass("dropdown-on").find(".dropdown-on").removeClass("dropdown-on");
			}
			
			if (mlayout) {
				pos++;
				if (active[pos]) {
					active[pos].removeClass("pe-menu-mobile-on");
				}
				active[pos] = li.find("ul").show();
				active[pos].addClass("pe-menu-mobile-on");
				//main.transform(1,-pos+"00%","0%");
				main.css("left",-pos+"00%");
			}
			
			return false;
		}
		
		function resize() {
			w = jwin.width();
			h = window.innerHeight ? window.innerHeight: jwin.height();
			
			main.removeAttr("style");
			pos = 0;
			target.find(".pe-menu:first").removeClass("pe-menu-mobile-active");
			dropdowns.parent().removeClass("dropdown-on");
			
			mlayout = w < 1024;
			
			//var left = target.offset().left;
			var pw = $(".pe-menu-sticky").width();
			
			var left = Math.round(Math.max(0,(pw - 940)/2));
			
			mega.each(function (idx) {
				mega.eq(idx).find(" > li.new-row").css("margin-left",left);
			});
			
			//target.find(".pe-menu-mega .dropdown-menu > li:first").css("margin-left",left);
			menu.removeClass("rightAlign").each(menuAlign);
			
			
			if (wasmlayout && !mlayout) {
				wasmlayout = false;
				resize();
				
			}
			wasmlayout = mlayout;
		}
		
		
		function toggleMobileMenu(e) {
			var first = target.find(".pe-menu:first");
			
			var visible = first.hasClass("pe-menu-mobile-active");
			
			if (visible) {
				first.removeClass("pe-menu-mobile-active");
			} else {
				first.addClass("pe-menu-mobile-active");
			}
			
			e.preventDefault();
			e.stopImmediatePropagation();
		}
		
		function back(e) {
			if (mlayout) {
				pos--;
				main.css("left",-pos+"00%");
				//main.transform(1,-pos+"00%","0%");
			}
			e.preventDefault();
			e.stopImmediatePropagation();
		}
		
		// init function
		function start() {
			main = target.find("> ul");
			toggle = $('<a href="#" class="menu-toggle"><b class="icon-menu"></b></a>');
			target.prepend(toggle);
			menu = target.find("ul.pe-menu > li:not(.pe-menu-mega) > ul");
			mega = target.find(".pe-menu-mega > .dropdown-menu");
			dropdowns = target.find("li.dropdown > a");
			
			
			var subs = target.find(".dropdown-menu");
			var text = target.attr("data-mobile-back") || "BACK";

			subs.each(function (idx) {
				var ul = subs.eq(idx);
				ul.prepend('<li><a href="" class="pe-menu-back">'+text+'</a></li>');
			});
			
			if (mobile) {
				dropdowns.on("tap click",mobileNavigation);
				//dropdowns.on("click",mobileNavigation);
			} else {
				dropdowns.on("click",mobileNavigation);
			}
			
			resize();
			jwin.on("debouncedresize",resize);
			toggle.on("tap click",toggleMobileMenu);
			target.on("tap click",".pe-menu-back",back);
			
			/*
			jwin.on('orientationchange',function () {
				//dropdowns.parent().removeClass("dropdown-on");
				main.removeAttr("style");
			});
			*/
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peMenu", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peMenu = function(conf) {
		
		// return existing instance	
		var api = this.data("peMenu");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMenu.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMenu(el, conf);
			el.data("peMenu", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));