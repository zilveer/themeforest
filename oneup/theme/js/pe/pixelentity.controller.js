(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	var jwin = $(window),sc;
	var jhtml = $("html");
	var body;
	var container;
	var containerH = 0,h = 0;
	var scroller;
	var filterable = false,isotope = false;
	var layoutSwitcher = false;
	var cells;
	var overs;
	var containerHeightTimer = 0;
	var header,arrows,mobile,background;
	var fullpage;
	var headerY = 0,stickyH = 0;
	var isSticky = false;
	var headlines;
	var sections;
	var sliderBG;
	var stickyMode = "sticky";
	var scrolling = false;
	var changedActive = false;
	var staff;
	var footer,sitebody;
	var openProject = false;
	var stickyFooter = false;
	var overlay;
	var ie8 = ($.browser.msie && $.browser.version < 9);
	var cssA = $.support.cssanimation;
	var topt;
	
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
		
		var w,h,nw,nh;
		var active;
		var nav;
		var useAnimations = false;
		
		function fullPageResize() {
			fullpage.find(".peNeedResize").triggerHandler("resize");
		}

		function resize() {
			nw = jwin.width();
			nh = window.innerHeight ? window.innerHeight: jwin.height();
			
			if (nw === w && nh === h) {
				return;
			}
			
			w = nw;
			h = nh;
			
			// test this
			if (mobile && jwin.scrollTop() > 0) {
				return;
			}
			
			if (fullpage.length > 0) {
				var fh = Math.max(300,h-body.find("section.pe-main-section:first").offset().top);
				var mh = parseInt(fullpage.attr("data-maxheight"),10);
				if (mh > 0) {
					fh = Math.min(fh,mh);
				}
				
				mh = parseInt(fullpage.attr("data-minheight"),10);
				
				if (mh > 0) {
					fh = Math.max(fh,mh);
				}
				
				fullpage.height(fh);
				fullPageResize();
				setTimeout(fullPageResize,500);
				if ($.browser.msie && $.browser.version < 10) {
					setTimeout(fullPageResize,1500);
					setTimeout(fullPageResize,2000);
					setTimeout(fullPageResize,2000);
				}
			}
			
		}
		
		function makeAnimated(e) {
			cells.filter(e.currentTarget).find("div.scalable img").addClass("animated");			
		}
		
		function sticky(e) {
			var wsp = jwin.scrollTop();
			if (sliderBG && !mobile && $.support.csstransforms) {
				sliderBG.transform(1,0,-wsp >> 1);
			}
			body[wsp > 30 ? "addClass" : "removeClass"]("pe-header-scrolled");
			if (stickyFooter && wsp > Math.max(h,1000)) {
				if (!body.hasClass("pe-sticky")) {
					sitebody.css("margin-bottom",footer.outerHeight());
					body.addClass("pe-sticky");
				}
			} else {
				if (body.hasClass('pe-sticky')) {
					//if (wsp < h-footer.outerHeight()) {
						sitebody.css("margin-bottom",0);
						body.removeClass("pe-sticky");
					//}
				}
			}
		}
		
		function widgets(el,controller) {
			el = el || body;
			
			if (el.hasClass("pe-controller-widgets")) {
				return;
			}
			
			el.addClass("pe-controller-widgets");
			
			el.find('.peSlider.peVolo').attr({
				"data-controls-arrows": "edges-buttons",
				"data-controls-bullets": "enabled",
				"data-icon-font": "enabled"
			});
			
			el.find('.carouselBox').attr({
				"data-height": "0,0"
			});
			
			el.find('a.peVideo').attr({
				"data-autoplay": "disabled"
			});
			
			el.find('.peBackground').attr({
				"data-mobile": mobile ? "true" : ""
			});
			
			el.find('.peSlider[data-height]').not('.peGallerySlider').find('> div').addClass("scale");
			
			if (useAnimations) {
				el.find('.pe-animation-maybe').removeClass('pe-animation-maybe').addClass('pe-animation-wants');
			}
			
			if (el === body) {
				resize();
			}
			
			var parallax = $('.pe-main-section.pe-parallax');
			
			if (ie8) {
				el.find('div:last-child').addClass('pe-last-child');
			}
			
			parallax.each(function (idx) {
				var ps = parallax.eq(idx);
				var xpos = "50%";
				if (ps.hasClass("pe-bg-left")) {
					xpos = '0%';
				} else if (ps.hasClass("pe-bg-right")) {
					xpos = '100%';
				}
				if (!mobile && !ie8) {
					ps.parallax(xpos,0.5);
				}
			});
			
			el.find(".post-pagination.pe-load-more").peLoadMore();
			
			$.pixelentity.widgets.build(el,controller);
			
			if (el !== body) {
				var sec = el.closest("section.pe-main-section");
				if (sec.length > 0) {
					sec.data("processed",false);
					animate(sec);
				}
			}
			
		}
		
		function fixHeaderHeight() {
			var logo = header.find("img:first");
			var lh = logo.height() || parseInt(logo.attr("height"),10);
			header.find("header").height(lh).find("> div").height(lh);
			header.find(".pe-menu-main").css("padding-top",lh-37);
			if (!body.hasClass("pe-header-transparent")) {
				body.css("padding-top",header.css("position") === "relative" ? 0 : lh);
			} 
			stickyH = header.height();
			jhtml.data('header-height',stickyH);
			setTimeout(function () {
				stickyH = header.height();
				jhtml.data('header-height',stickyH);
			},100);
		}
		
		function noop(e) {
			e.preventDefault();
			return false;
		}

		
		function makeActive(hash) {
			var url = window.location.href.replace(/#.*/,'') + (hash ? '#'+hash : '');
			var active = header.find("a[href='%0']".format(url));
			
			if (active.length > 0) {
				changedActive = true;
			}
			
			if (changedActive > 0) {
				header.find("li.active").removeClass("active");
				active.parent().addClass("active");
			}	
		}
			
		function sectionHandler(direction) {
			
			if (scrolling) {
				return;
			}
			
			var hash = this.id === 'section-0' ? '' : this.id.replace(/section\-/,'');
			
			/*
			if (!$.browser.msie) {
				window.location.hash = hash;
			}
			*/
			
			makeActive(hash);
		}
		
		function cleanAnimation() {
			var jthis = $(this);
			var cl = jthis.data("removeclass") || "";
			cl += " pe-animation-has pe-animation-wants pe-animation-maybe";
			jthis.removeClass(cl);
			//jthis.removeClass(cl).addClass('pe-animation-maybe pe-animation-wants');
		}

		
		function animate(sec) {
			/*
			if (sec.data("processed")) {
				return;
			}
			*/
			var items = sec.find('.pe-animation-wants').not('.pe-animation-has');
			var delay = 0;
			var incr = 0.3;
			if (items.length > 0) {
				var i,item,cl;
				incr = items.length <= 4 ? 0.3 : 0.1;
				sec.css("overflow","hidden");
				//items.addClass('animated pe-animation-has');
				var clean = [];
				for (i=0;i<items.length;i++) {
					item = items.eq(i);
					if (item.hasClass('pe-animation-has')) {
						continue;
					}
					cl = "animated pe-animation-has "+item.attr('data-animation') || 'fadeIn';
					item.data("removeclass",cl);
					item.one($.support.cssanimationEnd,cleanAnimation);
					item[0].style[cssA+"Delay"] = delay +"s";
					item.addClass(cl);
					delay += incr;
				}

				//items.removeClass('pe-animation-wants');
			}
			sec.data("processed",true);
		}

		
		function animationHandler(direction) {
			var sec = sections.filter(this);
			animate(sec);
		}
		
		function scrollEnd() {
			scrolling = false;
		}

		function hashHandler(e) {
			
			var url = (e && e.currentTarget) ? e.currentTarget.href : window.location.href;
			var hash = url.split(/#/)[1];

			if (hash) {
				var section = sections.filter('[id="section-%0"]'.format(hash));
				if (section.length > 0) {
					makeActive(hash);
					scrolling = true;
					sticky();
					var fixed = header.css("position") == 'fixed';
					scroller.animate({scrollTop: section.offset().top-(fixed ? stickyH : 0)+4},500,scrollEnd);
				}
			}
		}
		
		function staffHandler(e) {
			var member = staff.filter(e.currentTarget);
			
			if (member.data("locked")) {
				return;
			}
			
			var info = member.find(".info-wrap");
			var details = member.find(".details");
			
			
			if (e.type === "mouseenter") {
				member.data("over",true);
				member.css("overflow","hidden").height("auto");
				member.height(member.height());
				info.show();
				details.css("margin-top",-details.height()+41);
				//console.log(-details.height()+24);
			} else {
				if (!member.data("over")) {
					return;
				}
				member.data("locked",true);
				member.data("over",false);
				details.css("margin-top",-20);
				setTimeout(function () {
					info.hide();
					member.height("auto");
					member.data("locked",false);
				},300);
			}
		}
		
		function portfolioLoaded() {
			var project = window.location.hash.match(/\/(.+)/);
			if (project && project[1]) {
				//setTimeout(function () {
					jQuery("a[data-slug='"+project[1]+"']:first").trigger("click");
				//},10);
			} 
		}
		
		function carouselNavigation(e) {
			var carousel = $(e.currentTarget);
			var navigation = carousel.attr("data-show-navigation") != "no";
			try {
				carousel.next()[navigation ? "removeClass" : "addClass"]("pe-block-hidden");
			} catch (x) {
			}
		}
		
		function wrefresh() {
			$.waypoints('refresh');
		}

		
		function start() {
			
			body = $("body");
			scroller = $("html,body");
			mobile = $.pixelentity.browser.mobile;
			
			topt = window.peThemeOptions || {};
			useAnimations = (!mobile && $.support.cssanimation);
			useAnimations = useAnimations && topt.animations == "yes";
			useAnimations = useAnimations && window.peAnimations !== false;
			
			if (!mobile && !($.browser.msie && $.browser.version < 9) && body.is(".pe-sticky-footer.page-template-page_builder-php.pe-page-fullwidth")) {
				footer = body.find("> .site-wrapper > div.footer");
				sitebody = body.find("> div > div.site-body");
				stickyFooter = true;
			}
			
			if (mobile) {
				jhtml.addClass("mobile").removeClass("desktop");
				if ($.pixelentity.browser.android) {
					jhtml.addClass("android");
				} else if ($.pixelentity.browser.iDev) {
					jhtml.addClass("ios");
				}
			} else {
				jhtml.addClass("desktop").removeClass("mobile");
			}
			
			header = $(".site-wrapper .pe-menu-sticky");
			
			fixHeaderHeight();
			
			fullpage = $(".site-wrapper > .site-body > .pe-full-page");
			
			if (!mobile) {
				header.on('click','a[href=#]',noop);
			}
			
			$(".pe-menu-main").each(function () {
				$(this).peMenu();
			});
			
			// pe menu
			/*
			jQuery(function() {
				$(".pe-menu-main").each(function () {
					$(this).peMenu();
				});
				setTimeout(function () {
					$(".project-filter").peMenu();
				},1000);
			});
			*/
			
			$(".pe-full-page .peSlider[data-height]").attr("data-height","300,container,1440");
			$('.header header .sm-icon-wrap a[data-position]').attr("data-position","bottom");
			
			var escapelist = $(".pe-container .pe-escape-container");
			
			escapelist.each(function(idx) {
				var el = escapelist.eq(idx);
				el.closest(".pe-container").before(el);
			});
			
			var splash = $("section.pe-splash-section");

			if (splash.length > 0) {
				sliderBG = splash.find(".peWrap");
				//sliderBG.parent().one("ready.pixelentity",function () {
					var caption = splash.find(" > div.peCaption");
					
					if (caption.length > 0) {
						
						headlines = caption.find(".pe-headlines > div");
						if (headlines.length > 0) {
							var mh = 0,mw = 0;
							headlines.each(function (idx) {
								mw = Math.max(headlines.eq(idx).width(),mw);
								mh = Math.max(headlines.eq(idx).height(),mh);
							});
							caption.find(".pe-headlines").width(mw).height(mh);
						}
						
						var slider = splash.find(".peVolo");
						if (mobile && slider.attr("data-transition") === 'pz' && !window.peForcePanZoom) {
							slider.attr("data-transition","fade");
						}
						slider.find(".peCaption").remove();
						slider.find(".peWrap > div:first").prepend(caption);
						
						var ah = 0;
						setInterval(function () {
							ah = (ah + 1) % headlines.length;
							headlines.removeClass("pe-active").eq(ah).addClass("pe-active");
							
						},4000);
					}
				//}); 
			}
			
			if (!mobile) {
				staff = $(".pe-view-layout-class-staff .staff-item");
				staff.on("mouseenter mouseleave",staffHandler);
				
			}
			
			var bgyt = $("#pe-bg-video");
			
			if (bgyt.length > 0) {
				if (!$.fn.mb_YTPlayer || mobile || ie8 || window.peBgVideo === false) {
					if (bgyt.attr("data-fallback")) {
						bgyt.css({
							"background-image" : 'url(%0)'.format(bgyt.attr("data-fallback"))
						}).addClass("pe-active");
					}
				} else {
					var def;
					try {
						def = eval('({%0})'.format(bgyt.attr("data-settings")));
					} catch (x) {
						console.log("error parsing video data-settings");
						def = {containment:'body',autoPlay:true, mute:true, startAt:0, opacity:1, showControls:0};
					}
					var videos = [];
					var i = 0,video;
					while ((video = bgyt.attr('data-video%0'.format(i++)))) {
						videos.push(jQuery.extend({videoURL:video},def));
					}
					bgyt.YTPlaylist(videos, false);

					if ( def.autoPlay ) {

						jwin.on( 'load', function() {
							setTimeout( function() { bgyt.YTPPlay(); }, 1000 );
							setTimeout( function() { bgyt.YTPPlay(); }, 3000 );
							setTimeout( function() { bgyt.YTPPlay(); }, 5000 );
							setTimeout( function() { bgyt.YTPPlay(); }, 10000 );
						});

					}
				}
				$("#pe-bg-video-overlay").addClass("pe-active");
			}
			
			$(".pe-ajax-portfolio:last").one("ajaxloaded.pixelentity",portfolioLoaded);
			$(body).on("pe-carousel-navigation",".carouselBox",carouselNavigation);
			
			widgets(body,{});
			
			$("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();
			
			if (mobile) {
				setTimeout(function () {
					//alert("ok");
					jwin.triggerHandler("pe-lazyloading-refresh");
				},100);
			} else {
				cells = $(".peIsotopeGrid .peIsotopeItem");
				cells.one("mouseenter",makeAnimated);
			}
			
			jwin.resize(resize);
			jwin.on("load",resize);
			jwin.on("scroll",sticky);
			
			sections = $('section.pe-main-section');
			var refresh = false;
			
			if (sections.length > 1) {
				refresh = true;
				sections.filter(".pe-splash-section").waypoint({handler: sectionHandler,offset: -100});
				sections.not(".pe-splash-section").waypoint({handler: sectionHandler,offset: 100});
			}
			
			if (useAnimations && sections.length > 0) {
				refresh = true;
				var wh = window.innerHeight ? window.innerHeight: jwin.height();
				sections.not(".pe-splash-section").waypoint({handler: animationHandler,offset: wh-(window.peAnimationOffset ? window.peAnimationOffset : 200 )});
			}
			
			if (refresh) {
				setTimeout(wrefresh,500);
				setInterval(wrefresh,1000);
			}
			
			//jwin.on("hashchange",hashHandler);
			
			body.on("click","a[href]",hashHandler);
			hashHandler();
			//makeActive();
			resize();
			overlay = body.find("> .site-loader");
			if (overlay.length > 0) {
				//jwin.one("load",function () {
				setTimeout(function() {
					overlay.addClass("pe-disabled");
					setTimeout(function () {
						overlay.css("visibility","hidden");
					},500);
					jwin.on("beforeunload",function (e) {
						overlay.css("visibility","visible").removeClass("pe-disabled");
					});
				},500);	
				//});
			}
			
			
			
		}
		
		$.extend(this, {
			// public API
			widgets: widgets,
			start: start
		});
		
	};
	
}(jQuery));
