(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	var links,menu;
	var jwin = $(window),sc;
	var jhtml = $("html");
	var body;
	var dropdowns;
	var container;
	var containerH = 0,h = 0;
	var scroller;
	var filterable = false,isotope = false;
	var layoutSwitcher = false;
	var cells;
	var overs;
	var containerHeightTimer = 0;
	var footer,header,arrows,mobile,background;
	var fullpage;
	
	window.peGmapStyle = [
        {
            stylers: [
                { saturation: -100 }
            ]
        },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
                { lightness: 100 },
                { visibility: "simplified" }
            ]
        },{
            featureType: "road",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        }
    ];
	
	function imgfilter() {
		return this.href.match(/\.(jpg|jpeg|png|gif)$/i);
	}
	
	pixelentity.classes.Controller = function() {
		
		var w,h;
		var active;
		var nav;
		
		function autoFlare(idx,el) {
			el = $(el);
			el.attr("data-target","flare");
		}
		
		function mobileNavigation() {
			var li = dropdowns.filter(this).parent();
			if (li.hasClass("dropdown-on")) {
				li.removeClass("dropdown-on").find(".dropdown-on").removeClass("dropdown-on");
			} else {
				li.addClass("dropdown-on");
			}
			li.siblings(".dropdown-on").removeClass("dropdown-on").find(".dropdown-on").removeClass("dropdown-on");
			return false;
		}
		
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
		
		function fullPageResize() {
			fullpage.find(".peNeedResize").triggerHandler("resize");
		}

		
		function resize() {
			w = jwin.width();
			h = window.innerHeight ? window.innerHeight: jwin.height();
			
			if (fullpage.length > 0) {
				fullpage.height(Math.max(300,h-header.outerHeight()-footer.outerHeight()));
				fullPageResize();
				setTimeout(fullPageResize,500);
				if ($.browser.msie && $.browser.version < 10) {
					setTimeout(fullPageResize,1500);
					setTimeout(fullPageResize,2000);
					setTimeout(fullPageResize,2000);
				}
			}
			
			menu.removeClass("rightAlign").each(menuAlign);
		}
		
		function makeAnimated(e) {
			cells.filter(e.currentTarget).find("div.scalable img").addClass("animated");			
		}
		
		function addIcons(idx) {
			var cell = cells.eq(idx);
			var link,title = cell.find("span.cell-title");
			var gotone = false;
			link = title.find("> a"); 
			if (link.length > 0) {
				gotone = true;
				title.html('<span>'+link.html()+"</span>");
				link.addClass("pe-over-icon pe-over-icon-link").html('<i class="icon-info"></i>');
				title.addClass("has-icons").append(link);
			}
			
			link = cell.find(".scalable > a[data-target=flare]");
			
			if (link.length > 0) {
				link = link.clone(true);
				link.addClass("pe-over-icon pe-over-icon-lb").html('<i class="icon-plus"></i>');
				if (!gotone) {
					title.wrapInner("<span></span>");
					gotone = true;
				}
				title.addClass("has-icons").append(link);
			}
			
			if (gotone) {
				title.wrapInner('<span></span>');
			}
		}
		
		function addHover(idx) {
			var a = overs.eq(idx);
			
			a.prepend('<span class="cell-title"><span><i class="icon-%0"></i></span></span>'.format(a.attr("data-target") == "flare" ? "plus" : "info"));
			
		}
		
		function overEffect(e) {
			var a = overs.filter(e.currentTarget);
			var img = a.find("img");
			img.addClass("animated");
			a[e.type === "mouseenter" ? "addClass" : "removeClass"]("pe-status-over");
			//console.log(e.currentTarget);
		}
		
		function sticky(e) {
			if (jwin.scrollTop() > 45) {
				body.addClass("sticky-header");
			} else {
				body.removeClass("sticky-header");				
			}
		}

		
		function start() {
			
			body = $("body");
			mobile = $.pixelentity.browser.mobile;
			
			if (mobile) {
				$("a[data-rel='tooltip']").removeAttr("data-rel");
				jhtml.removeClass("desktop").addClass("mobile");
				if ($.pixelentity.browser.android) {
					jhtml.addClass("android");
				}
			} else {
				jhtml.addClass("desktop").removeClass("mobile");
			}
			
			header = $(".site-wrapper > .sticky-bar");
			footer = $(".site-wrapper > .footer");
			fullpage = $(".site-wrapper > .site-body > .pe-full-page");
			menu = header.find("ul.nav > li > ul");
			var topLevel = header.find("ul:eq(0) > li > a ");
			/*
			topLevel.each(function (idx) {
				var tl = topLevel.eq(idx);
				var icon = tl.find("b.icon-down-open-mini").detach();
				
				var text = tl.text().split("|");
				tl.html($.trim(text[0]));
				
				if (icon.length > 0 ) {
					tl.prepend(icon);
				}
				
				tl.append('<span class="subtitle">'+($.trim(text[1]) || '&nbsp;')+'</span>');
				
			});
			*/
			
			links = $('a[data-target!="flare"]').not('a[data-toggle]');
			links.filter(imgfilter).each(autoFlare);
			
			if (!mobile) {
				overs = $('a.over-effect');
				overs.each(addHover);
				overs.on("mouseenter mouseleave",overEffect);
			}
			
			dropdowns = header.find("li.dropdown > a");
			
			if (mobile) {
				dropdowns.on("touchstart",mobileNavigation);
			}
			
			
			$('a.peVideo').attr({
				"data-autoplay": "disabled"
			});
			
			//$.pixelentity.widgets.build($("body"),{});
			
			var cellTitles = $("span.cell-title");
			cellTitles.each(function () {
				var el = cellTitles.filter(this);
				if (el.next().find("> a").length > 0) {
					el.addClass("show-on-top");
				}
			});
			
			$("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();

			
			if (mobile) {
				setTimeout(function () {
					//alert("ok");
					jwin.triggerHandler("pe-lazyloading-refresh");
				},100);
			} else {
				// $(".bw-images img").peBlackAndWhite();
				cells = $(".peIsotopeGrid .peIsotopeItem");
				cells.each(addIcons).one("mouseenter",makeAnimated);
			}
			
			jwin.resize(resize);
			jwin.on("load",resize);
			//jwin.on("scroll",sticky);
			resize();
			
		}
		
		start();
	};
	
}(jQuery));
