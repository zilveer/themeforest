(function($){

"use strict";

$.expr[':'].notparents = function(a,i,m){
    return $(a).parents(m[3]).length < 1;
};

$.expr[':'].parents = function(a,i,m){
    return $(a).parents(m[3]).length == 1;
};

var getScript = $.getScript;
$.getScript = function(url, fn) {
	if(!$.isArray(url)) {//juggle type
		url = [url];
	}

	$.when.apply(null, $.map(url, getScript)).done(function() {
		fn && fn();
	});
};


var GEODE = window.GEODE || {};

GEODE.smoothScroll = function() {
	var $body = $('body'),
		$html = $('html');
    $('a.pixscroll[href^="#"], .pixscroll a[href^="#"]').on('click',function(e) {
		e.preventDefault();
		var $el = $(this),
		runFunc = function(){
			$el.each(function(){
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash),
						start = parseFloat($(window).scrollTop());
					target = target.length && target || $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						var targetOffset = target.offset().top - 150,
							time = Math.abs(targetOffset-start) < 100 ? 100 : Math.abs(targetOffset-start);
						time = time > 1000 ? 1000 : time;
						$body.animate({scrollTop: targetOffset}, time, 'easeOutQuad');
						$html.animate({scrollTop: targetOffset}, time, 'easeOutQuad');
					}
				}
			});

		};
		if ( $el.attr('href').slice(-1)!='#' ) {
			if ( $el.hasClass('woocommerce-review-link') ) {
				$('a[href="#tab-reviews"]').click();
			}
			var set = setTimeout(runFunc, 10);
		}
    });

    $('a[href="#"]').on('click',function(e) {
		e.preventDefault();
    });
};

GEODE.fitVideos = function(){
	var $page = $('#page');
	$page.fitVids({
		customSelector: 'iframe[src*="dailymotion.com"], iframe[src*="wordpress.tv"]'
	});
};

GEODE.resizeTitles = function() {
	var $main = $('#main'),
		$primary = $('primary');
	$('h1,h2,.h1,.h2', $main).not('.sc-layout .sc-title').filter(':notparents(.pix_slideshine)').each(function(){
		var title = $(this),
			fontSize = parseFloat(title.css('font-size'));
		title.fitText(1.2, { minFontSize: (fontSize/1.5), maxFontSize: (fontSize) });
	});
	$('[style*="font-size"]', $main).filter(':notparents(.pix_slideshine)').each(function(){
		var $el = $(this),
			fontSize = parseFloat($el.css('font-size'));
		$el.fitText(1.2, { minFontSize: (fontSize/1.2), maxFontSize: (fontSize) });
	});
	$('h3,h4,h5,h6,.h3,.h4,.h5,.h6,.h1_font,.h2_font,.h3_font,.h4_font,.h5_font,.h6_font,.very_big,.fit_text', $main).not('.letmebe').not('.sc-layout .sc-title').filter(':notparents(.pix_slideshine)').each(function(){
		var title = $(this),
			fontSize = parseFloat(title.css('font-size'));
		title.fitText(1.2, { minFontSize: (fontSize/1.5), maxFontSize: (fontSize) });
	});
	$('.sc-layout .sc-title', $primary).each(function(){
		var title = $(this),
			fontSize = parseFloat(title.css('font-size'));
		title.fitText(1.2, { minFontSize: (fontSize/1.5), maxFontSize: (fontSize*1.1) });
	});
};

GEODE.slideshineArchive = function() {
    $('body .pix_slideshine').each(function(){
		var $slide = $(this),
			$article = $slide.parents('article.post').eq(0),
			href;
		$article.off('click', 'a.sc-enlarge.sc-iconaction');
		$article.on('click', 'a.sc-enlarge.sc-iconaction', function(e){
			e.preventDefault();
			$('.slideshine_current a.slideshine_100_link', $slide).click();
		});
		$article.off('click', 'a.slideshine_100_link');
		$article.on('click', 'a.slideshine_100_link', function(e){
			e.preventDefault();
			href = $(this).attr('href');
			$('a.slideshine_hidden_links[href="'+href+'"]', $article).click();
		});
	});
};

GEODE.fullscreenRow = function(){
	var $window = $(window),
		$page = $('#page'),
		setFullScreenTimeout;

	if ( !$page.length )
		return false;

	var fullscreenRowInit = function(){
		var pageOff = $page.offset(),
			windowWidth = $window.width(),
			pageTop = pageOff.top,
			hTop = parseFloat(pageTop),
			$el,
			wPage = $page.width(),
			w = parseFloat(wPage),
			winHeight = $window.height(),
			winH = parseFloat(winHeight),
			h = winH-hTop,
			elH;
		$('.wide-template [data-extra="fullscreen"][data-cols="1"] .row-inside .column', $page).not('.product').each(function(){
			$el = $(this);
			$el.css({width:w, height: h});
			elH = $el.outerHeight();
			$window.trigger('shortcodelic_ev');
		});

		$('.wide-template [data-extra="fullwidth"][data-cols="1"] .row-inside .column', $page).not('.product').each(function(){
			$el = $(this);
			$el.css({width:w});
			$window.trigger('shortcodelic_ev');
		});

		$el = $('.entry-content > [data-extra="fullscreen"].first-slideshow:first-child').has('.pix_slideshine');
		if ( windowWidth > 1024 )
			$el.next('.row').eq(0).css({marginTop: elH});
		else
			$el.next('.row').eq(0).css({marginTop: 0});

		$('.entry-content > [data-extra="fullwidth"].first-slideshow:first-child').has('.pix_slideshine').each(function(){
			var $elf = $(this),
				elfH = $('.column:first-child',$elf).outerHeight();
			if ( windowWidth > 1024 )
				$elf.next('.row').eq(0).css({marginTop: elfH});
			else
				$elf.next('.row').eq(0).css({marginTop: 0});
		});
	};
	var setFullScreen = function(){
		clearTimeout(setFullScreenTimeout);
		setFullScreenTimeout = setTimeout( fullscreenRowInit, 1250 );
	};
	$window.on('resize', fullscreenRowInit);
	$window.on('resize load', setFullScreen);
	fullscreenRowInit();
};

GEODE.scrollUpDown = function(){
	var $window = $(window),
		$body = $('body'),
		$html = $('html'),
		$above_header = $('#above_header'),
		$wrap_header = $('#wrap_header'),
		$down = $('#scroll-down'),
		$up = $('#scroll-up'),
	scrollUpDownCall = function(){
		var hToParse = $window.height(),
			h = parseFloat(hToParse),
			aboveH = $above_header.outerHeight(),
			hAbove = parseFloat(aboveH),
			hWrap = $wrap_header.outerHeight(),
			hHead = parseFloat(hWrap),
			fromTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop,
			downWards;

		//downWards = fromTop+(h-(hHead+hAbove));

		$down.on('click', function(e){
			e.preventDefault();
			$html.stop(true,false).animate({scrollTop: h}, 750, 'easeOutQuad');
			$body.stop(true,false).animate({scrollTop: h}, 750, 'easeOutQuad');
		});
		$up.on('click', function(e){
			e.preventDefault();
			$html.stop(true,false).animate({scrollTop: 0}, 750, 'easeOutQuad');
			$body.stop(true,false).animate({scrollTop: 0}, 750, 'easeOutQuad');
		});
	};
	scrollUpDownCall();

	$window.on('resize', scrollUpDownCall);

	var windowWidth = $window.width(),
		scrolled = false,
		scrollTop,
	scrollSet = function(){
		scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
		if ( scrollTop > 200 ) {
			if ( !scrolled ) {
				scrolled = true;
				$down.addClass("hidden_scroll");
				$up.addClass("visible_scroll");
			}
		} else {
			if ( scrolled ) {
				scrolled = false;
				$down.removeClass("hidden_scroll");
				$up.removeClass("visible_scroll");
			}
		}
	};
	//if ( windowWidth > 1023 ) {
		if (window.addEventListener) {
			window.addEventListener('scroll', scrollSet, false);
		} else if (window.attachEvent) {
			window.attachEvent('onscroll', scrollSet);
		}
		$window.on('resize', scrollSet);
	//}

};

GEODE.initColorbox = function(){

    if($.isFunction($.fn.colorbox) && typeof(pix_style_enable_colorbox)!='undefined' && pix_style_enable_colorbox===true) {

		var $window = $(window),
			$content = $('#content'),
			notIn = ':not(.noColorBox,.nocolorbox,.letmebe)',
			elems,
			videos = "a.colorbox-video:not(.noColorBox,.nocolorbox,.letmebe,[href^='#video_'])",
			inlinevideos = 'a.colorbox-video[href^="#video_"]'+notIn,
			$elems,
			$videos = $(videos),
			$inlinevideos = $(inlinevideos);

		var initColorboxCall = function(){
			elems = "a[href$='.jpg']"+notIn+", a[href*='.jpg?']"+notIn+", a[href$='.jpeg']"+notIn+", a[href*='.jpeg?']"+notIn+", a[href$='.gif']"+notIn+", a[href*='.gif?']"+notIn+", a[href$='.png']"+notIn+", a[href*='.png?']"+notIn;
			$elems = $(elems);
	        $elems.each(function(){
	            var $el = $(this),
					dataRel = $el.data('rel'),
					dataTitle = $el.data('title'),
					href = $el.attr('href');
	            $el.colorbox({
					maxWidth: "85%",
					maxHeight: "85%",
					rel: dataRel,
					title: dataTitle,
					fixed: true,
					returnFocus: false,
					onComplete: function(){
						$('html').addClass('noOverflow');
						$('#cboxLoadedContent').prepend('<div class="cboxPrevent" />');
						$.data(document.body, 'pix-check-colorbox-opened',true);
					},
					onClosed: function(){
						$('html').removeClass('noOverflow');
						$.removeData(document.body, 'pix-check-colorbox-opened');
						$('.cboxPrevent').remove();
					}
	            });
	            var setResizeOpen,
	            	resizeCBox = function(){
						$el.colorbox({
							open:true,
							maxWidth: "85%",
							maxHeight: "85%"
						});
	            	};
				$window.on('resize', function(){
					if ( typeof $.data(document.body, 'pix-check-colorbox-opened') !== 'undefined' && $.data(document.body, 'pix-check-colorbox-opened') === true ) {
						clearTimeout(setResizeOpen);
						setResizeOpen = setTimeout( resizeCBox, 250 );
					}
				});
	        });

	        $videos.each(function(){
	            var $el = $(this),
					dataRel = $el.data('rel'),
					dataTitle = $el.data('title'),
					href = $el.attr('href');
	            $(this).colorbox({
					iframe: true,
					innerWidth: "85%",
					innerHeight: "85%",
					rel: dataRel,
					title: dataTitle,
					fixed: true,
					returnFocus: false,
					onComplete: function(){
						$('html').addClass('noOverflow');
						$.data(document.body, 'pix-check-colorbox-opened',true);
					},
					onClosed: function(){
						$('html').removeClass('noOverflow');
						$.removeData(document.body, 'pix-check-colorbox-opened');
						$('.cboxPrevent').remove();
					}
	            });
	            var setResizeOpen,
	            	resizeCBox = function(){
						$el.colorbox({
							open:true,
							maxWidth: "85%",
							maxHeight: "85%"
						});
	            	};
				$(window).on('resize', function(){
					if ( typeof $.data(document.body, 'pix-check-colorbox-opened') !== 'undefined' && $.data(document.body, 'pix-check-colorbox-opened') === true ) {
						clearTimeout(setResizeOpen);
						setResizeOpen = setTimeout( resizeCBox, 250 );
					}
				});
	        });

	        $inlinevideos.each(function(){
	            var $el = $(this),
					dataRel = $el.data('rel'),
					dataTitle = $el.data('title'),
					href = $el.attr('href');
	            $el.colorbox({
					inline: true,
					innerWidth: "85%",
					innerHeight: "85%",
					rel: dataRel,
					title: dataTitle,
					fixed: true,
					returnFocus: false,
					onComplete: function(){
						$('html').addClass('noOverflow');
						$.data(document.body, 'pix-check-colorbox-opened',true);
					},
					onClosed: function(){
						$('html').removeClass('noOverflow');
						$.removeData(document.body, 'pix-check-colorbox-opened');
						$('.cboxPrevent').remove();
					}
	            });
	            var setResizeOpen,
	            	resizeCBox = function(){
						$el.colorbox({
							open:true,
							maxWidth: "85%",
							maxHeight: "85%"
						});
	            	};
				$window.on('resize', function(){
					if ( typeof $.data(document.body, 'pix-check-colorbox-opened') !== 'undefined' && $.data(document.body, 'pix-check-colorbox-opened') === true ) {
						clearTimeout(setResizeOpen);
						setResizeOpen = setTimeout( resizeCBox, 250 );
					}
				});
	        });
	    };
	    initColorboxCall();

        $('.hentry.type-portfolio.format-gallery', $content).has('.gallery-slideshine').each(function(){
			var fullSize = $('a.sc-enlarge.sc-iconaction',this),
				href;
			$('.gallery-slideshine', this).on('slideReady',function(){
				href = $('.slideshine_current', this).find('[data-link]').attr('data-link');
				fullSize.attr('href',href);
				initColorboxCall();
			});
        });
    }

};

GEODE.portfolioSlideshineWA = function(){
	var $window = $(window),
		$content = $('#content');
	$('.hentry.type-portfolio.format-gallery .sc-position-fancy .gallery-slideshine', $content).each(function(){
		var $slide = $(this),
			$next = $('.slideshine_next', $slide),
			$prev = $('.slideshine_prev', $slide);
		$slide.after($next.add($prev));
	});
};

GEODE.geodeCheckAffix = function(){
	var $body = $('body'),
		$header = $('#header_affix'),
		dataSticky = $header.attr('data-sticky');

	if ( Modernizr.touch && $(window).width()<=1024 )
	return;

	if ( $body.hasClass('sticky-header') ) {
		if ( !$('#header_affix-sticky-wrapper').length ) {
			dataSticky = parseFloat(dataSticky)*-1;
			$header.sticky({
				topSpacing: dataSticky
			});
		}
	} else {
		$header.unstick();
	}
};

GEODE.headerTransparent = function() {

	var $window = $(window),
		$body = $('body'),
		winW;

	if ( typeof geode_break_menu == 'undefined' || !$body.hasClass('transparent-header') )
		return;

	var headerTransparentCall = function(){
		winW = $window.width();
		if ( winW <= geode_break_menu ) {
			$body.removeClass('transparent-header');
		} else {
			$body.addClass('transparent-header');
		}
	};
	headerTransparentCall();
	$window.on('resize', headerTransparentCall);

};

GEODE.headerHover = function() {

	var setOut,
		setIn,
		$body = $('body'),
		$html = $('html'),
		$wrap_header = $('#wrap_header'),
		$above_header = $('#above_header'),
		body_hover = function(){ $body.addClass('headerHover'); },
		body_out = function(){ $body.removeClass('headerHover'); };

	if(!$body.hasClass('headerNotHover') && (!$html.hasClass('touch') || $(window).width()>1024) ) {
		$wrap_header.add($above_header).hover(function(){
			$body.addClass('headerQuickHover');
			clearTimeout(setIn);
			setOut = setTimeout( body_hover, 175 );
		},function(){
			$body.removeClass('headerQuickHover');
			clearTimeout(setOut);
			setIn = setTimeout( body_out, 175 );
		});
	}
};

GEODE.geodeMenu = function(){
	var $window = $(window),
		$html = $('html'),
		$body = $('body'),
		$page = $('#page'),
		$mob_nav = $('#mobile-navigation'),
		$header = $('header#masthead'),
		winW = $(window).width(),
		newW,
		$widgets = $('.pix_widget','#navbar'),
		$first_level = $('> div > div[role="list"] div[role="listitem"]:has(>div[role="list"]), > div > div[role="list"] > div[role="listitem"]:has(>div)','#navbar nav#site-navigation').not('#expand-mobile-cart'),
		$ghost = $('#ghost-layout'),
		$exp_menu = $('#expand-menu'),
		$above_drop_down = $('#above_header_drop_down'),
		$overlay = $('#geode-social-overlay'),
		$overlay_inner = $('.social-wrap > div', $overlay);


	$window.on('load', function(event) {
		$mob_nav.slideUp(0, function(){
			$mob_nav.css({top:0,position:'relative',visibility:'visible'});
			$(window).trigger('scroll');
		});
	});

	var newWidth = function() {
		newW = $window.width();
		if ( newW != winW ) {
			$mob_nav.filter(':visible').slideUp(0, function(){
				$body.removeClass('mobHeaderHover');
			});
			winW = newW;
		}
	};

	$window.on('resize', newWidth);

	$widgets.each(function(){
		$(this)
			.removeClass('pix-fadeIn')
			.removeClass('pix-fadeDown')
			.removeClass('pix-fadeUp')
			.removeClass('pix-fadeLeft')
			.removeClass('pix-fadeRight')
			.removeClass('pix-zoomIn')
			.removeClass('pix-zoomOut')
			.removeClass('pix-rotateIn')
			.removeClass('pix-rotateOut')
			.removeClass('pix-flipClock')
			.removeClass('pix-swing')
			.removeClass('pix-turnBackward')
			.removeClass('pix-turnForward');
	});

	$first_level.each(function(){
		var $el = $(this).addClass('has-ul'),
			$child = $el.find('> div[role="list"], > div:not(.mega_clear)'),
			h,
			setOut,
			setIn,
			off,
			offLayout,
			child_pos,
			childOff,
			ghostOff,
			elHover,
			elOut;

		$el.addClass('has-ul');
		var resizeMegeMenu = function(){
			if ( $el.hasClass('pix_megamenu')) {
				var wDiv = 0, wTemp = 0;
				$el.find('> div').each(function(){
					$('> div > div[role="list"], > div.mega_clear', this).each(function(){
						if ($(this).hasClass('mega_clear')) {
							if ( wTemp < wDiv ) {
								wTemp = wDiv;
							}
							wDiv = 0;
						} else {
							var wDivEach = $(this).actual('outerWidth');
							wDiv = wDiv + wDivEach;
						}
					});
				});
				if ( wTemp < wDiv ) {
					wTemp = wDiv;
				}
				$el.find('> div').width(wTemp);
			}
		};
		$(window).on('pix_megamenu resize', resizeMegeMenu).triggerHandler('pix_megamenu');

		if (Modernizr.touch && $(window).width()<=1024 ) {
			$el.off('touchstart');
			$el.on('touchstart',function(e){
				$first_level.removeClass('hover').removeClass('topped');
				e.stopPropagation();
				if ( !$el.hasClass('hover') ) {
					childOff = $child.offset();
					off = childOff.left;
					ghostOff = $ghost.offset();
					offLayout = ghostOff.left;
					child_pos = (offLayout-off)*-1;
					if( off < offLayout ){
						$child.css({marginRight:child_pos});
					}
					e.preventDefault();
					$el.addClass('hover');
					h = $el.find('> div[role="list"]').actual('height');
					$el.find('> div[role="list"]').css({height:0,overflow:'hidden'});
					$el.off("transitionend webkitTransitionEnd mozTransitionEnd oTransitionEnd");
					$el.addClass('hover').addClass('topped');
					$el.find('> div[role="list"]').animate({height:h},150,function(){
						$(this).css({overflow:'visible'});
					});
				}
			});
			$html.on('touchstart', function() {
				$el.removeClass('hover').removeClass('topped');
			});
		} else {
			$el.hover(function(e){
				childOff = $child.offset();
				off = childOff.left;
				ghostOff = $ghost.offset();
				offLayout = ghostOff.left;
				child_pos = (offLayout-off)*-1;
				if( off < offLayout ){
					$child.css({marginRight:child_pos});
				}
				h = $child.not('.visible').actual('height');
				$child.not('.visible').css({height:0,overflow:'hidden'});
				elHover = function(){
					$el.addClass('hover').addClass('topped');
					$child.not('.visible').addClass('visible').animate({height:h},150,function(){
						$(this).css({overflow:'visible',height:'auto'});
					});
				};
				clearTimeout(setIn);
				setOut = setTimeout( elHover, 275 );
			},function(e){
				elOut = function(){
					$child.css({overflow:'hidden'}).animate({height:0},150,function(){
						$(this).css({overflow:'visible',height:'auto'}).removeClass('visible');
							$el.removeClass('topped').removeClass('hover');
					});
					$el.removeClass('hover');
				};
				clearTimeout(setOut);
				setIn = setTimeout( elOut, 175 );
			});
		}
	});

	var expMenuCall = function(){
		$exp_menu.off('click');
		$exp_menu.on('click',function(e) {
			e.preventDefault();
			var exp = $(this).toggleClass('open');
			$mob_nav.slideToggle(function(){
				if ( !exp.hasClass('open') ) {
					$('body').removeClass('headerHover').removeClass('headerQuickHover').removeClass('mobHeaderHover');
				}
			});
			if ( !exp.hasClass('open') ) {
				$('body').removeClass('mobHeaderHover');
			} else {
				$('body').addClass('mobHeaderHover');
			}
			$('#mobile-navigation div[role="list"] div[role="list"]').slideUp();
			$('#mobile-navigation .after.open').click();
			$('#mobile-navigation div[role="listitem"] div[role="list"]:visible').slideUp();
		});

		$('div[role="list"] div[role="listitem"]:has("div[role]")', $mob_nav).each(function(){
			var $li = $(this),
				others = $li.siblings(),
				parent = $li.parents('div[role="listitem"]').eq(0).find('> a');
			$li.addClass('hasUl');
			if ( !$li.find('> a .after').length )
				$li.find('> a').append('<span class="after" />');

			$li.off('click', '> a > .after');
			$li.on('click', '> a > .after', function(e) {
				e.preventDefault();
				others.slideToggle();
				parent.slideToggle();
				$li.toggleClass('open');
				$(this).toggleClass('open');
				$('> div[role="list"]', $li).slideToggle(function(){
					$window.trigger('resize');
				});
			});
		});

		$('#expand-mobile-cart').each(function(){
			var $el = $(this),
				$els = $el.find('> a'),
				$child = $('.children', $el),
				h,
				setOut,
				setIn,
				off,
				offLayout,
				child_pos,
				childOff,
				ghostOff;
			$el.add($els).off('click');
			$el.add($els).on('click',function(e){
				e.preventDefault();
				e.stopPropagation();
				if ( !$el.hasClass('hover') ) {
					$('body').addClass('mobHeaderHover');
					childOff = $child.offset();
					off = childOff.left;
					ghostOff = $ghost.offset();
					offLayout = ghostOff.left;
					child_pos = (offLayout-off)*-1;
					if(off<offLayout){
						$child.css({marginRight:child_pos});
					}
					h = $child.not('.visible').actual('height');
					$child.not('.visible').css({height:0,overflow:'hidden'});
					$el.addClass('hover').addClass('topped');
					$child.not('.visible').addClass('visible').animate({height:h},150,function(){
						$(this).css({overflow:'visible',height:'auto'});
					});
				} else {
					$body.removeClass('mobHeaderHover');
					$child.css({overflow:'hidden'}).animate({height:0},550,function(){
						$child.css({overflow:'visible',height:'auto'}).removeClass('visible');
							$el.removeClass('topped').removeClass('hover');
					});
					$el.removeClass('hover');
				}
			});
			$child.on('click', function(e) {
				e.stopPropagation();
			});
		});
	};

	$(window).on('load move-cart-mobile', function(){
		expMenuCall();
	});

	$('.top_bar', $above_drop_down).each(function(){
		$(this).appendTo($overlay_inner);
	});

	$('.top_bar.top_bar_drop_down').on('click', function(){
		$overlay.show().animate({opacity:1},350);
		$page.addClass('blurred');
		$('.top_bar', $overlay).each(function(){
			var $el = $(this),
				ind = $('#geode-social-overlay .top_bar').index($el),
				time = 100*ind,
				setFunc = function(){ $el.addClass('shown'); },
				set = setTimeout( setFunc, time );
		});
	});
	$('.close-geode-overlay', $overlay).click(function(){
		$page.removeClass('blurred');
		$('.top_bar', $overlay).removeClass('shown');
		$overlay.transition({opacity:0},250, function(){
			$(this).hide();
		});
	});
};

GEODE.topBarWidget = function(){
	var $html = $('html'),
		$above_header = $('#above_header'),
		$lang_sel = $('.lang_switcher'),
		$ghost = $('#ghost-layout');


	$('> div > ul > li', $lang_sel).has('ul').each(function(){
		var $li = $(this),
			$el = $li.find('> a'),
			$child = $('ul li', $li),
			h,
			setOut,
			setIn,
			off,
			offLayout,
			child_pos,
			childOff,
			ghostOff,
			elHover,
			elOut;

		if (Modernizr.touch && $(window).width()<=1024) {
			$el.click(function(e){
				e.preventDefault();
				e.stopPropagation();
				$li.toggleClass('hover');
				if ( $li.hasClass('hover') ) {
					var off = $child.offset().left,
						offLayout = $('#ghost-layout').offset().left;
					if(off<offLayout){
						$child.css({marginRight:'-'+(offLayout-off)+'px'});
					}
					h = $child.not('.visible').actual('height');
					$child.not('.visible').css({height:0,overflow:'hidden'});
					$li.addClass('hover').addClass('topped');
					$child.not('.visible').addClass('visible').animate({height:h},150,function(){
						$(this).css({overflow:'visible',height:'auto'});
					});
				}
			});
			/*$('html').on('touchstart', function() {
				$li.find('> div[role="list"]').css({overflow:'hidden'}).animate({height:0},150,function(){
					$(this).css({overflow:'visible',height:'auto'});
				});
				$li.removeClass('hover');
				if (Modernizr.csstransitions) {
					$li.off("transitionend webkitTransitionEnd mozTransitionEnd oTransitionEnd");
					$li.on("transitionend webkitTransitionEnd mozTransitionEnd oTransitionEnd", function(){
						$li.removeClass('topped').removeClass('hover');
					});
				} else {
					$li.removeClass('topped').removeClass('hover');
				}
			});*/
		} else {
			$li.hover(function(e){
				childOff = $child.offset();
				off = childOff.left;
				ghostOff = $ghost.offset();
				offLayout = ghostOff.left;
				child_pos = (offLayout-off)*-1;
				if(off<offLayout){
					$child.css({marginRight:child_pos});
				}
				elHover = function(){
					h = $child.not('.visible').actual('height');
					$child.not('.visible').css({height:0,overflow:'hidden'});
					$li.addClass('hover').addClass('topped');
					$child.not('.visible').addClass('visible').animate({height:h},150,function(){
						$(this).css({overflow:'visible',height:'auto'});
					});
				};
				clearTimeout(setIn);
				setOut = setTimeout( elHover ,175);
			},function(e){
				elOut = function(){
					$child.css({overflow:'hidden'}).animate({height:0},150,function(){
						$(this).css({overflow:'visible',height:'auto'}).removeClass('visible');
							$li.removeClass('topped').removeClass('hover');
					});
					$li.removeClass('hover');
				};
				clearTimeout(setOut);
				setIn = setTimeout( elOut, 175 );
			});
		}
	});

	$('.top_bar', $above_header).has('.above_header_inside').each(function(){
		var $el = $(this),
            $body = $('body'),
			$els = $('> i, > span, > a', $el),
			$child = $('.above_header_inside', $el),
			h,
			setOut,
			setIn,
			off,
			offLayout,
			child_pos,
			childOff,
			ghostOff,
			elHover,
			elOut;

		if (Modernizr.touch && $(window).width()<=1024) {
			$el.add($els).on('touchend',function(e){
				if ( !$el.hasClass('hover') ) {
					e.preventDefault();
					e.stopPropagation();
					$body.addClass('mobHeaderHover');
					childOff = $child.offset();
					off = childOff.left;
					ghostOff = $ghost.offset();
					offLayout = ghostOff.left;
					child_pos = (offLayout-off)*-1;
					if(off<offLayout){
						$child.css({marginRight:child_pos});
					}
					h = $child.not('.visible').actual('height');
					$child.not('.visible').css({height:0,overflow:'hidden'});
					$el.addClass('hover').addClass('topped');
					$child.not('.visible').addClass('visible').animate({height:h},150,function(){
						$(this).css({overflow:'visible',height:'auto'});
					});
				}
			});
			$('.above_header_inside', $el).on('touchend', function(e) {
				e.stopPropagation();
			});
			$html.on('touchend', function() {
				if ( $el.hasClass('hover') ) {
					$body.removeClass('mobHeaderHover');
					$child.css({overflow:'hidden'}).animate({height:0},550,function(){
						$child.css({overflow:'visible',height:'auto'}).removeClass('visible');
							$el.removeClass('topped').removeClass('hover');
					});
					$el.removeClass('hover');
				}
			});
		} else {
			$el.hover(function(e){
				childOff = $child.offset();
				off = childOff.left;
				ghostOff = $ghost.offset();
				offLayout = ghostOff.left;
				child_pos = (offLayout-off)*-1;
				if(off<offLayout){
					$child.css({marginRight:child_pos});
				}
				elHover = function(){
					h = $child.not('.visible').actual('height');
					$child.not('.visible').css({height:0,overflow:'hidden'});
					$el.addClass('hover').addClass('topped');
					$child.not('.visible').addClass('visible').animate({height:h},150,function(){
						$(this).css({overflow:'visible',height:'auto'});
					});
				};
				clearTimeout(setIn);
				setOut = setTimeout( elHover, 175 );
			},function(e){
				elOut = function(){
					$child.css({overflow:'hidden'}).animate({height:0},550,function(){
						$(this).css({overflow:'visible',height:'auto'}).removeClass('visible');
							$el.removeClass('topped').removeClass('hover');
					});
					$el.removeClass('hover');
				};
				clearTimeout(setOut);
				setIn = setTimeout( elOut, 175 );
			});
		}
	});
};

GEODE.spansToButtons = function(){
	var $page = $('#page'),
	spansToButtonsCall = function(){
		$('.pix_button, button', $page).each(function(){
			var $el = $(this);
			if ($el.data('spanned')!==true && !$el.find('span').length) {
				$el.data('spanned',true).wrapInner('<span />').append('<span />');
			}
		});
	};
	spansToButtonsCall();
    $(document).on('ajaxSuccess ajaxComplete', function() {
		spansToButtonsCall();
	});
};

GEODE.setAmountProducts = function(){
	var setAmountProductsCall = function(){
		$('.top_bar').has('.widget_shopping_cart').each(function(){
			var t = $(this),
				hrefAttr = t.find('.wc-forward').eq(0).attr('href');

			if ( typeof hrefAttr != 'undefined' && hrefAttr !== '' ) {
				t.find('i[class*="scicon"]').css({
					cursor: 'pointer',
					margin: '0 -1em',
					padding: '0 1em'
				}).on('click', function(){
					window.location.href = hrefAttr;
				});
			}

			$('.above_header_inside',t).addClass('with-cart');
			if ( !$('.amount_appended',t).length ) {
				if ( $('.top_bar_link',t).length ) {
					$('.top_bar_link',t).append('<span class="amount_appended"><span></span></span>');
				} else {
					t.append('<span class="amount_appended"><span></span></span>');
				}
			}
			$('.widget_shopping_cart',t).each(function(){
				var quant = 0;
				$('.quantity',this).each(function(){
					quant = quant + parseFloat($(this).text());
				});
				$('.amount_appended > span',t).text(quant);
			});
		});

		$('#navbar .menu-item, #expand-mobile-cart').has('.widget_shopping_cart').each(function(){
			var t = $(this);
			if ( !$('.amount_appended',t).length ) {
				t.append('<span class="amount_appended"><span></span></span>');
			}
			$('.widget_shopping_cart',t).each(function(){
				var quant = 0;
				$('.quantity',this).each(function(){
					quant = quant + parseFloat($(this).text());
				});
				$('.amount_appended > span',t).text(quant);
			});
		});
	};
	setAmountProductsCall();

	$('body').on('added_to_cart wc_fragments_loaded wc_fragments_refreshed', function() {
		setAmountProductsCall();
    });

    $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
    $( 'div.quantity, td.quantity' ).each(function(){
        var $quant = $(this),
            $numb = $('input[type="number"]', $quant),
            $plus = $('.plus', $quant),
            $minus = $('.minus', $quant),
            val;

        $plus.on('click', function(){
            val = parseFloat($numb.val());
            val = val + 1;
            $numb.val(val);
        });

        $minus.on('click', function(){
            val = parseFloat($numb.val()) > 1 ? parseFloat($numb.val()) : 2;
            $numb.val(val-1);
        });
    });

};

GEODE.moveMobileCart = function(){
	var $window = $(window),
		$mob_nav = $('#mobile-navigation'),
		$burger = $('#expand-menu');

	$('.menu-item', $mob_nav).has('.widget_shopping_cart').each(function(){
		var $el = $(this);
		$el.attr('id','expand-mobile-cart');
		$burger.before($el);
		$window.trigger('move-cart-mobile');
	});
};

GEODE.initIsotope = function(){

	var $window = $(window),
		$body = $('body'),
		$page = $('#page'),
		$content = $('#primary'),
		$isoSel = $('div.products, .sc-layout #primary .sc-grid, .sc-gallery, .thumbnails, .grid-blog .blog-isotope-grid')
			.not('.related')
			.not('.upsells')
			.filter(':notparents(.upsells.products)')
			.filter(':notparents(.related.products)')
			.filter(':notparents(.pix_woocarousels)'),
		$images,
		term;

		//console.log('ok');

	//$images.css({opacity:0});

	$isoSel.addClass('isotoped').each(function(){
		var $iso = $(this),
			$images = $iso.find('img'),
			$el = $('> *', $iso).not('style'),
			$grid = typeof $iso.data('grid') != 'undefined' ? $iso.data('grid') : 'fitRows',
			$row = $iso.parents('.sc-filter-wrap', $content).eq(0),
			$isoOptions,
			$setOptions,
			originLeft = $('html').attr('dir')!='rtl';

		$images.each(function(){ //load background images for imagesLoaded
			var $el = $(this),
				image = $el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
			if(image)
				$images = $images.add($('<img>').attr('src', image.pop()));
		});
		$images.imagesLoaded(function(){
			$el.removeClass('pix-letmebe');
			if ( $iso.hasClass('blog-isotope-grid') ) {
				$isoOptions = {
					layoutMode : $grid,
					transitionDuration: 0,
					masonry: {
						columnWidth: 1
					},
					isOriginLeft: originLeft
				};
			} else {
				$isoOptions = {
					layoutMode : $grid,
					transitionDuration: 0,
					isOriginLeft: originLeft
				};
			}
			$iso.isotope($isoOptions);

			$row.on( 'click', 'a[data-filter-cat], a[data-filter-tag]', function( e ) {
				e.preventDefault();
				var $target = $iso.find('> *'),
					$a = $(this);
				if ( typeof $a.attr('data-filter-tag') !== 'undefined' ) {
					term = 'tag';
					if ( filterValue!='all' ) {
						$('a[data-filter-cat].selected', $row).removeClass('selected');
						$('a[data-filter-cat="all"]', $row).addClass('selected');
					}
				} else {
					term = 'cat';
					if ( filterValue!='all' ) {
						$('a[data-filter-tag].selected', $row).removeClass('selected');
						$('a[data-filter-tag="all"]', $row).addClass('selected');
					}
				}
				var filterValue = $a.attr('data-filter-'+term),
					$selector = $iso.find('[data-sort-'+term+'*="'+filterValue+' "]');
				$('a[data-filter-'+term+'].selected', $row).removeClass('selected');
				$a.addClass('selected');
				if ( filterValue!='all' ) {
					$target.addClass('pix-transended')
						.removeClass('pix-loaded')
						.removeClass('pix-fadeIn')
						.removeClass('pix-fadeDown')
						.removeClass('pix-fadeUp')
						.removeClass('pix-fadeLeft')
						.removeClass('pix-fadeRight')
						.removeClass('pix-zoomIn')
						.removeClass('pix-zoomOut')
						.removeClass('pix-rotateIn')
						.removeClass('pix-rotateOut')
						.removeClass('pix-flipClock')
						.removeClass('pix-swing')
						.removeClass('pix-turnBackward')
						.removeClass('pix-turnForward');
				}
				clearInterval($setOptions);
				$isoOptions.filter = $selector;
				$isoOptions.transitionDuration = '350ms';
				$iso.isotope($isoOptions);
				$setOptions = setInterval(function(){
					$isoOptions.transitionDuration = 0;
					$iso.isotope($isoOptions);
				},500);
			});
			$window.on('reisotope',function(){
				$iso.isotope('layout');
			});
			var setIsotope,
				showAllIso = function(){
				if ( $row.find( 'a[data-filter-cat], a[data-filter-tag]').length && !(Modernizr.touch && $(window).width()<=1024)) {
					$('a[data-filter-cat!="all"], a[data-filter-tag!="all"]', $row).removeClass('selected');
					$('a[data-filter-cat="all"], a[data-filter-tag="all"]', $row).addClass('selected');
					var $selector = $iso.find('[data-sort-cat*="all"], [data-sort-tag*="all"]');
					$isoOptions.filter = $selector;
					$isoOptions.transitionDuration = 0;
					$iso.isotope($isoOptions);
				}
			};

			$(window).on('resize', showAllIso);

			$('body.archive .pix_slideshine, .isotoped .pix_slideshine').on('slideReady', function(){
				$iso.isotope('layout');
			});

			var $pag = !$iso.nextAll('.geode_pagination').length ? $iso.parents('div').eq(0).nextAll('.geode_pagination') : $iso.nextAll('.geode_pagination');

			$pag.find('.more_infinite_button').eq(0).each(function(){
				var $more = $(this),
					url = $more.attr('href'),
					wrapClass = $more.parents('.sc-filter-wrap').eq(0).length ? 'sc-filter-wrap' : 'archive-list',
					geode_pagination = $more.parents('.geode_pagination').eq(0),
					appendClass = wrapClass=='sc-filter-wrap' ? 'sc-grid' : 'blog-isotope-grid',
					wrap = $more.parents('.'+wrapClass).eq(0),
					loadContentInd = wrap.index('body .'+wrapClass),
					loadedWrap,
					loadedContent,
					newUrl;
				/*$.ajax({
					url: url,
					success: function(loadedDataNew){
						var loadedContentNew = $("<div/>").append(loadedDataNew.replace(/<script(.|\s)*?\/script>/g, "")).find('.'+wrapClass+':eq('+loadContentInd+')');
					}
				});*/
				$more.on('click', function(e){
					e.preventDefault();
					var more_exist = true;
					url = $more.attr('href');

					geode_pagination.prepend('<div class="spinloaderwrap outside"><div class="spinloader" /></div>');
					geode_pagination.find('.spinloaderwrap').addClass('started');

					$body.addClass('infinite-loading');
					$.ajax({
						url: url,
						success: function(loadedData){
							geode_pagination.find('.spinloaderwrap').removeClass('started');
							loadedWrap = $("<div/>").append(loadedData.replace(/<script(.|\s)*?\/script>/g, "")).find('.'+wrapClass+':eq('+loadContentInd+')');
							loadedContent = $(loadedWrap).find('.'+appendClass);
							if ( $(loadedWrap).find('.more_infinite_button').length ) {
								newUrl = $(loadedWrap).find('.more_infinite_button').attr('href');
								$more.attr('href',newUrl);
								if ( wrapClass=='sc-filter-wrap' ) {
									$(loadedWrap).find('.sc-portfolio-filter.sc-filter-tags a[data-filter-tag]').each(function(){
										var filterTag = $(this).attr('data-filter-tag');
										if ( !wrap.find('.sc-portfolio-filter.sc-filter-tags a[data-filter-tag="'+filterTag+'"]').length ) {
											wrap.find('.sc-portfolio-filter.sc-filter-tags').append('<span class="sc-filter-separator">&bull;</span>').append($(this));
										}
									});
									$(loadedWrap).find('.sc-portfolio-filter.sc-filter-categories a[data-filter-cat]').each(function(){
										var filterTag = $(this).attr('data-filter-cat');
										if ( !wrap.find('.sc-portfolio-filter.sc-filter-categories a[data-filter-cat="'+filterTag+'"]').length ) {
											wrap.find('.sc-portfolio-filter.sc-filter-categories').append('<span class="sc-filter-separator">&bull;</span>').append($(this));
										}
									});
								}
								$.ajax({
									url: newUrl,
									success: function(loadedDataNew){
										var loadedContentNew = $("<div/>").append(loadedDataNew.replace(/<script(.|\s)*?\/script>/g, "")).find('.'+wrapClass+':eq('+loadContentInd+')');
									}
								});
							} else {
								more_exist = false;
							}
						}, complete: function(){
							var $newItems = loadedContent.find('article');
							var $newImages = $newItems.find('img');
							$newImages.each(function(){ //load background images for imagesLoaded
								var $el = $(this),
									image = $el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
								if(image)
									$newImages = $newImages.add($('<img>').attr('src', image.pop()));
							});
							$newImages.imagesLoaded(function(){
								$('iframe', $newItems).each(function(){
									var srcAtt = $(this).attr('data-ce-src');
									$(this).attr('src', srcAtt);
								});
								$iso.append($newItems);
								$more.parents('.sc-filter-wrap').find('a[data-filter-cat="all"], a[data-filter-tag="all"]').click();
								$iso.isotope('appended', $newItems);
								geode_pagination.find('.spinloaderwrap').remove();
								$('#geode_site_loader').addClass('ajaxloaded');
								$('body').removeClass('infinite-loading');
								$('#geode_site_loader').removeClass('ajaxloading').removeClass('ajaxloaded');
								showAllIso();
								GEODE.initME();
								GEODE.resizeTitles();
								GEODE.fitVideos();
								GEODE.initColorbox();
								$('.pix_slideshine', $newItems).slideshine();
								GEODE.portfolioSlideshineWA();
								if ( $.fn.slideshine ) $('.pix_slideshine').not('.slideshine_wrap').slideshine();
								GEODE.slideshineArchive();
								$('.pix_slideshine', $newItems).on('slideReady', function(){
									$iso.isotope('layout');
								});
								$newItems.show();
								$iso.isotope('layout');
								$(window).trigger('pixgridder');
								$(window).trigger('resize');
								if ( $.isFunction(window.buttonelicInit) ) buttonelicInit();
								if ( more_exist === false ) $more.slideUp(250, function(){ $(this).remove(); });
							});
						}
					});
				});
			});
		});
	});
};

GEODE.geodeQuickView = function(){
	var $window = $(window),
		$content = $('#primary'),
		$cboxLoadedContent = $('#cboxLoadedContent');

	$content.on('click', '.pix-woo-quickview-product', function(e){
        e.preventDefault();
		var $el = $(this),
			$view = $el.parents('.column').eq(0).find('.pix-quick-view'),
			href = $el.attr('href');
		href = href + ' .pix-quick-view';
		$.colorbox({
			href: function(){ return href; },
			maxWidth: "85%",
			width: 960,
			maxHeight: "85%",
			height: 'auto',
			rel: 'color-ajax',
			className: 'cBox-quick-view woocommerce product',
			onComplete: function(){
				$.data(document.body, 'pix-quick-cbox',true);
				$(document).trigger('buttonelic');
				$('.cBox-quick-view .woocommerce-main-image').css({
					cursor: 'default'
				}).on('click', function(e){
					e.preventDefault();
				});
			},
			onClosed: function(){
				$.removeData(document.body, 'pix-quick-cbox');
			}
		});

		var pixQuickCbox = function(){
			if ( typeof $.data(document.body, 'pix-quick-cbox') !== 'undefined' && $.data(document.body, 'pix-quick-cbox') === true ) {
				var w = $window.width(),
					h = $window.height(),
					inW = $cboxLoadedContent.outerHeight(),
					newW = (w < 960) ? (w*0.9) : 960,
					newH = (inW > h*0.9) ? (h*0.9) : inW;
				$.colorbox.resize({
					innerHeight: newH,
					innerWidth: newW
				});
			}
		};
		$window.on('resize', pixQuickCbox);
	});
};

GEODE.productCarousels = function(){
	$('.pix-woo-gallery a > div').has('.cycle-lazy-images').each(function(){
		var t = $(this),
			id = t.data('id'),
			autoHeight = $('.cycle-lazy-images',t).data('autoheight'),
			slidesAmout = $('.cycle-lazy-images',t).data('total-slides'),
			imgH;
		if ( !$('.pix-woo-gallery-navig',t).length ) {
			t.append('<span class="pix-woo-gallery-navig" />')
			.find('.pix-woo-gallery-navig')
			.append('<span class="pix-woo-gallery-prev" />')
			.append('<span class="pix-woo-gallery-next" />');
			t.append('<div class="spinloaderwrap"><div class="spinloader" /></div>');
		}
		var prev = t.find('.pix-woo-gallery-prev'),
			next = t.find('.pix-woo-gallery-next');
		t.cycle({
			fx: 'fade',
			autoHeight: autoHeight,
			easing: 'easeInOutQuad',
			loader: 'wait',
			progressive: '#cycle-lazy-images-'+id,
			next: next,
			paused: true,
			prev: prev,
			slides: $('img.attachment-shop_catalog',t),
			speed: 350,
			swipe: true
		}).on('cycle-initialized', t, function(e){
			GEODE.initIsotope();
		}).on('cycle-after', t, function(e){
			$(window).trigger('reisotope');
		}).on('cycle-before',t, function(e, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag){
			if ($(incomingSlideEl).data('loaded')!==true) {
				$(incomingSlideEl).data('loaded',true);
				var imgSrc = $(incomingSlideEl).attr('data-blank');
				$(incomingSlideEl).attr('src',imgSrc);
			}
		});
	});
};

GEODE.dynTooltips = function(){
	$('.woocommerce').find('a.compare, a.pix-woo-quickview-product, .yith-wcwl-add-to-wishlist > div > a').each(function(){
		var t = $(this),
			txt = t.text();
		t.attr('data-tooltip',txt)
		.attr('data-ttopts','{"speed":"150"}');
	});
	$(window).triggerHandler('sc_tooltipster');
};

GEODE.resetVariations = function(){
	var set;
	$('form.variations_form').each(function(){
		var t = $(this);
		t.on('change','select',function(){
			$(this).next('.customSelect').eq(0).find('.customSelectInner').text($('option:selected',this).text());
			GEODE.zoomDestroy();
			setTimeout(function(){
				GEODE.zoomImage();
			},1);
		});
		clearTimeout(set);
		$('.single_variation_wrap', t).on('show_variation', function(){
			clearTimeout(set);
			set = setTimeout(function(){
				var w = $(window).width(),
					h = $(window).height(),
					inW = $('#cboxLoadedContent .pix-quick-view:first-child').outerHeight(),
					newW = (w < 960) ? (w*0.9) : 960,
					newH = (inW > h*0.9) ? (h*0.9) : inW;
				$.colorbox.resize({
					innerHeight: newH,
					innerWidth: newW
				});
			}, 300);
		});
		t.on('click','.reset_variations',function(){
			t.find('.customSelect').trigger('change').trigger('update');
		});
	})
	.on('update_variation_values', function(){
		var w = $(window).width(),
			h = $(window).height(),
			inW = $('#cboxLoadedContent .pix-quick-view:first-child').outerHeight(),
			newW = (w < 960) ? (w*0.9) : 960,
			newH = (inW > h*0.9) ? (h*0.9) : inW;
		$.colorbox.resize({
			innerHeight: newH,
			innerWidth: newW
		});
	});
};

GEODE.zoomImage = function(){
	var $body = $('body'),
		$el = $('a.woocommerce-main-image');
	if ( $body.hasClass('no-zoom') )
		return;
	$el.each(function(){
		var t = $(this),
			url = t.attr('href');
		t.zoom({
			url: url
		});
	});
};

GEODE.zoomDestroy = function(){
	$('a.woocommerce-main-image .zoomImg').trigger('zoom.destroy');
	$('a.woocommerce-main-image .zoomImg').remove();
};

GEODE.zoomColorbox = function(){
	$('form.variations_form').find( '.single_variation_wrap' ).on('show_variation',function(){
		var $quick = $(this).parents('.pix-quick-view').eq(0),
			actSrc = $('.images a.woocommerce-main-image', $quick).last().attr('data-o_src');
		if ( typeof actSrc !== 'undefined' ) {
			$('.thumbnails a', $quick).removeClass('selected');
			$('.thumbnails a[data-href="'+actSrc+'"]', $quick).addClass('selected');
		}
	});
	$('a.woocommerce-main-image').each(function(){
		if ( !$('.spinloaderwrap',this).length )
			$(this).append('<div class="spinloaderwrap"><div class="spinloader" /></div>');
	});

    if ( $('.woocommerce .thumbnails').length ) {
		$('.woocommerce #woocommerce-main-image-wrapper').off('click','.woocommerce-main-image.nocolorbox');
		$('.woocommerce #woocommerce-main-image-wrapper').on('click','.woocommerce-main-image.nocolorbox', function(e){
			e.preventDefault();
			$('.woocommerce .thumbnails a.selected').parents('span').eq(0).find('.hidden a').click();
		});
	}

    $('.woocommerce .thumbnails > span').off('click','> a');
    $('.woocommerce .thumbnails > span').on('click','> a',function(e){
		e.preventDefault();
		if ( $(this).hasClass('selected') )
			return;
		$('a.woocommerce-main-image').addClass('loading');
		var t = $(this),
			href = t.attr('href'),
			imgSingle = $('a.woocommerce-main-image .wp-post-image'),
			newSrc = t.data('href'),
			par = t.parents('.thumbnails').eq(0);
		$('<img />').one('load',function(){
			$('a.woocommerce-main-image').removeClass('loading').attr('href',href);
			imgSingle.attr('src',newSrc).removeAttr('srcset');
			par.find('a').removeClass('selected');
			t.addClass('selected');
			GEODE.zoomDestroy();
			setTimeout(function(){
				if ( $('#cboxLoadedContent .pix-quick-view').length ) {
					$(window).trigger('resize');
				}
				GEODE.zoomImage();
			},50);
		}).attr('src', newSrc).each(function() {
			if(this.complete) {
				$(this).load();
			}
		});
	});

    var set;

    $('form.variations_form select').on('change',function(e){
        clearTimeout(set);
        set = setTimeout(function(){
            var href = $('a[itemprop="image"]').attr('href');
            $('.thumbnails a.selected').removeClass('selected');
            $('.thumbnails a[href="'+href+'"]').addClass('selected');
        },50);
    });
    $('form.variations_form').on('reset_image',function(){
        clearTimeout(set);
        set = setTimeout(function(){
            var href = $('a[itemprop="image"]').attr('href');
            $('.thumbnails a.selected').removeClass('selected');
            $('.thumbnails a[href="'+href+'"]').addClass('selected');
        },50);
    });
};

GEODE.colorboxFilter = function() {

	$(document).bind('cbox_open', function(){
		$('html').addClass('noOverflow');
		if ( !$('#geode_cboxClose').length ) {
			var cboxClose = $('<div id="geode_cboxClose" />');
			$('#cboxOverlay').append(cboxClose);
		}
		$('#geode_cboxClose, #cboxOverlay').off('click');
		$('#geode_cboxClose, #cboxOverlay').on('click', function(){
			$.colorbox.close();
			$(document).trigger('cbox_close');
		});
		$('#cboxContent').append('<div class="spinloaderwrap outside"><div class="spinloader" /></div>');
		$('#cboxContent .spinloaderwrap').addClass('started');
		$.colorbox.element().colorbox({overlayClose:false});
		$('#cboxOverlay').append($('#cboxTitle'));
	});
	$(document).bind('cbox_complete', function(){
		if ( !$('#geode_cboxNext').length && $('#cboxNext').is(':visible') ) {
			var cboxNext = $('<div id="geode_cboxNext" />');
			$('#cboxOverlay').append(cboxNext);
		}
		if ( !$('#geode_cboxPrevious').length && $('#cboxPrevious').is(':visible') ) {
			var cboxPrevious = $('<div id="geode_cboxPrevious" />');
			$('#cboxOverlay').append(cboxPrevious);
		}
		$('#cboxLoadedContent select').trigger('update');
		if ( $('#cboxLoadedContent .pix-quick-view').length ) {
			$(document).off( 'click', '.plus, .minus' );
			$.getScript(pix_woo_scripts, function(data, textStatus) {
				GEODE.resetVariations();
				GEODE.zoomColorbox();
				GEODE.fileSelImg();
				GEODE.zoomImage();
				GEODE.initIsotope();
				GEODE.fileSelImg();
				GEODE.dynTooltips();
				$(window).triggerHandler('sc_tooltipster resize');
				$( '.variations_form', '#cboxLoadedContent' ).wc_variation_form();
				$( '.variations_form .variations select', '#cboxLoadedContent' ).change();
				$('#cboxLoadedContent .pix-quick-view').addClass('showme');
			});
		}
		$('#cboxContent .spinloaderwrap').removeClass('started');
		if ( $('#cboxLoadedContent .pix-quick-view').length ) {
			var images = $('#cboxLoadedContent .pix-quick-view').find('img');
			$('#cboxLoadedContent .pix-quick-view').find('img').each(function(){
				var el = $(this),
					image = el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
				if(image)
					images = images.add($('<img>').attr('src', image.pop()));
			});
			/*images.imagesLoaded(function(){
				$(window).triggerHandler('resize');
			});*/
		}
		//$.colorbox({overlayClose:false});
	});
	$(document).bind('cbox_close', function(){
		$('html').removeClass('noOverflow');
		$('#cboxContent .spinloaderwrap, #geode_cboxClose').remove();
	});
};

GEODE.geode_show_reply = function(){
	var $body = $('body');
	$('#cancel-comment-reply-link').on('click', function(){
		var elem = $body.data('replybutton');
		$(elem).removeClass('hidden');
	});
};

GEODE.slidingToggle = function(){
	$(document).on('click', '#top_sliding_toggle', function(e){
		e.preventDefault();
		var h = $('#top_sliding_bar').find('> div > div').actual('outerHeight');
		if ( !$('#top_sliding_bar').hasClass('open') ) {
			$('#top_sliding_bar > div').animate({height:h}, 300, 'easeInOutQuad', function(){
				$(this).css({height:'auto'});
			});
		} else {
			$('#top_sliding_bar > div')
			.css({height:h}).animate({height:0}, 300, 'easeInOutQuad');
		}
		$('#top_sliding_bar').toggleClass('open');
	});
};

GEODE.geode_init_datepickers = function() {
	if($.isFunction($.fn.datepicker)) {
		$('.wpcf7-date').each(function(){
			var min = typeof $(this).attr('min') !== 'undefined' ? $(this).attr('min') : null,
				max = typeof $(this).attr('max') !== 'undefined' ? $(this).attr('max') : null;
			$(this).datepicker({
				dateFormat: "yy-mm-dd",
				showOn: "both",
				minDate: min,
				maxDate: max
			}).after('<i class="scicon-awesome-calendar geode-date-picker-icon"></i>');
		});
	}
};

GEODE.geode_init_sliders = function() {
	if($.isFunction($.fn.slider)) {
		$('.slider_div').each(function(){
			var t = $(this),
				value = $('input',t).val(),
				mi = typeof t.find('input').attr('min') !== 'undefined' ? parseFloat(t.find('input').attr('min')) : 0,
				m = typeof t.find('input').attr('max') !== 'undefined' ? parseFloat(t.find('input').attr('max')) : 100,
				s = typeof t.find('input').attr('step') !== 'undefined' ? parseFloat(t.find('input').attr('step')) : 1;
			$('.slider_cursor',t).slider({
				range: 'min',
				value: value,
				min: mi,
				max: m,
				step: s,
				slide: function( event, ui ) {
					$('input',t).val( ui.value );
				},
				stop: function( event, ui ) {
					t.trigger('slided');
				}
			});
			$('a',t).mousedown(function(event){
				t.addClass('active');
			});
			$(document).mouseup(function(){
				t.removeClass('active');
			});
			$('input',t).keyup(function(){
				var v = $('input',t).val();
				$('.slider_cursor',t).slider({
					range: 'min',
					value: v,
					min: mi,
					max: m,
					step: s,
					slide: function( event, ui ) {
						$('input',t).val( ui.value );
					}
				});
				t.trigger('slided');
			});
			$('.slider_cursor',t).each(function(){
				if ( $('.ui-slider-range-min',this).length > 1 ) {
					$('.ui-slider-range-min',this).not(':last').remove();
				}
			});
		});
	}
};

GEODE.geode_wpcf7_custom = function() {
	var geode_wpcf7_custom_call = function(){
		$('.wpcf7 form').each(function(){
			$('img.ajax-loader',this).remove();
			if ( !$('.spinloaderwrap',this).length ) {
				$('input[type="submit"]',this).after('<span class="spinloaderwrap"><span class="spinloader" /></span>');
			}
			if ( $('input[type="submit"]',this).css('float') == 'right' ) {
				$('.spinloaderwrap',this).addClass('alignright');
			}
			$(this).removeClass('loading')
			.on('submit', function(){
				$(this).addClass('loading');
			});
			/*.on('mailsent.wpcf7', function(){
				alert('ok');
			})
			.on('mailfailed.wpcf7', function(){
				alert('no');
			});*/
		});
	};
	geode_wpcf7_custom_call();
    $(document).bind('ajaxSuccess ajaxComplete', function() {
		geode_wpcf7_custom_call();
		$('.bootstrap-filestyle input').removeClass('wpcf7-not-valid');
		$('.wpcf7-not-valid').parents('span').eq(0).find('input').addClass('wpcf7-not-valid');
    });
};

GEODE.hookComparePrdcts = function() {
    $('body').bind('yith_woocompare_render_table', function(){
		spansToButtons();
		$('table.compare-list').each(function(){
			var length = $('tr.remove td',this).length,
				wdth = length * 250;
			$(this).css('width',wdth);
		});
    });
};

GEODE.responsiveSidebar = function() {
    $(window).on('resize responsivesidebar', function(){
		var winW = $(window).width(),
			viewport = $("meta[name=viewport]").attr('content');
		if ( winW <= 800 && viewport.match(/device-width*/) ) {
			$('aside[role="complementary"]').each(function(){
				var t = $(this),
					//tH = t.actual('outerHeight'),
					tW = parseFloat(t.actual('outerWidth')) + 20; //20 is the box-shadow width
				/*if ( minH < tH ) {
					minH = tH;
					$('#main .site-content').css({
						minHeight: minH
					});
				}*/

				if ( !t.next('.toggle_aside').length ) {
					var toggle = $('<a href="#" class="toggle_aside" />');
					t.after(toggle.data('aside',t));
				}

				if ( !t.hasClass('open') ) {
					if ( t.hasClass('alignleft') ) {
						t.css({
							'-webkit-transform': 'translateX(-'+tW+'px)',
							'-moz-transform': 'translateX(-'+tW+'px)',
							'-ms-transform': 'translateX(-'+tW+'px)',
							'-o-transform': 'translateX(-'+tW+'px)',
							'transform': 'translateX(-'+tW+'px)',
						});
					} else {
						t.css({
							'-webkit-transform': 'translateX('+tW+'px)',
							'-moz-transform': 'translateX('+tW+'px)',
							'-ms-transform': 'translateX('+tW+'px)',
							'-o-transform': 'translateX('+tW+'px)',
							'transform': 'translateX('+tW+'px)',
						});
					}
				}

				$(document).off('click', 'a.toggle_aside');
				$(document).on('click', 'a.toggle_aside', function(e){
					e.preventDefault();
					var aside = $(this).data('aside');
					aside.toggleClass('open');
				});
			});
		}
    }).trigger('responsivesidebar');
};

GEODE.carouselInit = function(){
	$('.pix_carousels, .pix_postcarousels, .pix_woocarousels .products').each(function(){
		var t = $(this),
			parent = t.parents('[data-opts]').eq(0),
			div = t.parents('div').eq(0),
			opts = typeof t.data('opts')!='undefined' ? t.data('opts') : parent.data('opts'),
			pager = opts.bullets == 'true' ? true : false,
			controls = opts.prev_next == 'true' ? true : false,
			autocontrols = opts.play_pause == 'true' ? true : false,
			autostart = opts.autoplay == 'true' ? true : false,
			hover = opts.hover == 'true' ? true : false;
		var images = t.find('img');
		t.find('img').each(function(){
			var el = $(this),
				image = el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
			if(image)
				images = images.add($('<img>').attr('src', image.pop()));
		});

		t.find('.pix-letmebe').removeClass('pix-letmebe');

		var revealBxSlides = function(slider){
			t.find("[data-src]").each(function(){
				var $lazy = $(this),
					$load = $lazy.attr("data-src");
				$lazy.parents('div').eq(0).css({opacity:0});
				//if ( $lazy.visible() || $lazy.parents('.bx-clone').length ) {
					$('<img />').one('load',function(){
						$lazy.removeAttr("data-src");
						if ( $lazy.is('img') ) {
							$lazy.attr("src",$load);
						} else {
							$lazy.css("background-image","url("+$load+")");
						}
						if ( typeof slider != 'undefined' )
							slider.redrawSlider();
						$lazy.parents('div').eq(0).animate({opacity:1});
						}).attr('src', $load).each(function() {
						if(this.complete) {
							$(this).load();
						}
					});
				//}
			});
		};

		if ( opts.maxslides > t.find(' > *').length )
			return false;

		var slider = t.bxSlider({
			slideWidth: '400000',
			useCSS: false,
			minSlides: div.width() > 600 ? opts.minslides : ( div.width() > 320 ? 2 : 1 ),
			maxSlides: div.width() > 600 ? opts.maxslides : ( div.width() > 320 ? 2 : 1 ),
			slideMargin: parseFloat(opts.slidemargin),
			mode: opts.mode,
			speed: parseFloat(opts.speed),
			infiniteLoop: true,
			hideControlOnEnd: true,
			adaptiveHeight: true,
			adaptiveHeightSpeed: parseFloat(opts.speed)/2,
			pager: pager,
			controls: controls,
			auto: true,
			autoControls: autocontrols,
			pause: parseFloat(opts.timeout),
			autoStart: autostart,
			autoHover: hover,
			onSliderLoad: function(){
				GEODE.productCarousels();
				revealBxSlides(slider);
			}/*,
			onSlideBefore: function($slideElement, oldIndex, newIndex){
				var vp_W = t.parents('.bx-viewport').eq(0).width(),
					wp_H = t.parents('.bx-viewport').eq(0).height(),
					sl_W = $slideElement.width(),
					sl_H = $slideElement.height(),
					amount = vp_W/sl_W;
				console.log(amount);
			},
			onSlideAfter: function(){
				countSlide = 0;
				revealBxSlides(slider);
			}*/
		});
		revealBxSlides(slider);
		if (window.addEventListener) {
			window.addEventListener('scroll', function(){revealBxSlides(slider);}, false);
		} else if (window.attachEvent) {
			window.attachEvent('onscroll', function(){revealBxSlides(slider);});
		}
		$(window).on('load resize', function(){
			revealBxSlides(slider);
		});
		var set, w = div.width();
		div.resize(function(){
			clearTimeout(set);
			set = setTimeout( function(){
				if ( w != div.width() ) {
					slider.reloadSlider({
						slideWidth: '400000',
						useCSS: false,
						minSlides: div.width() > 600 ? opts.minslides : ( div.width() > 320 ? 2 : 1 ),
						maxSlides: div.width() > 600 ? opts.maxslides : ( div.width() > 320 ? 2 : 1 ),
						slideMargin: parseFloat(opts.slidemargin),
						mode: opts.mode,
						speed: parseFloat(opts.speed),
						infiniteLoop: true,
						hideControlOnEnd: true,
						adaptiveHeight: false,
						adaptiveHeightSpeed: parseFloat(opts.speed)/2,
						pager: pager,
						controls: controls,
						auto: true,
						autoControls: autocontrols,
						pause: parseFloat(opts.timeout),
						autoStart: autostart,
						autoHover: hover/*,
						onSliderLoad: function(){
							$(window).trigger('resize');
						},
						onSlideBefore: function(){
							$(window).trigger('resize');
						}*/
					});
					w = div.width();
				}
			},1000);
		});

	});
};

GEODE.owlInit = function(){
	$('.geode-carousel').each(function(){
		var t = $(this),
			parent = t.parents('[data-opts]').eq(0),
			div = t.parents('div').eq(0),
			opts = typeof t.data('opts')!='undefined' ? t.data('opts') : parent.data('opts'),
			margins = parseFloat(opts.slidemargin),
			max = parseFloat(opts.maxslides);
		var images = t.find('img');
		t.find('img').each(function(){
			var el = $(this),
				image = el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
			if(image)
				images = images.add($('<img>').attr('src', image.pop()));
		});

		t.find('.pix-letmebe').removeClass('pix-letmebe');

		if ( opts.maxslides > t.find(' > *').length )
			return false;


		var slider = t.owl2Carousel({
		    loop:true,
		    margin: margins,
		    nav: true,
		    responsiveClass:true,
		    responsive:{
		        0:{
		            items: 1
		        },
		        800:{
		            items: 2
		        },
		        1000:{
		            items: max
		        }
		    }
		});

	});
};

GEODE.sectionArrows = function(){
	$('.row.arrowed-bottom, .row.arrowed-top').each(function(){
		var row = $(this),
			appended = '<div class="pseudo-arrow" />';
		if ( !row.find('.pseudo-arrow').length ) {
			if ( row.hasClass('arrowed-bottom') ) {
				row.append(appended);
				row.after($(appended).addClass('arrowed-bottom'));
			} else {
				row.prepend(appended);
				row.before($(appended).addClass('arrowed-top'));
			}
		}
	});
};

GEODE.sectionTextBox = function(){
	$('.row[data-extra="text-box"]').each(function(){
		var row = $(this),
			wrap = '<div class="row-text-box cf" />';
		if ( !row.find('.row-text-box').length ) {
			row.find('.row-inside').wrapInner(wrap);
		}
	});
};

GEODE.initME = function() {
	var $window = $(window),
		$page = $('#page');
	var resizeVideo = function(video) {
		var $section = video.parents('.pix_slideshine').eq(0),
			h = video.attr('data-height'),
			w = video.attr('data-width');
		$section = !$section.length ? video.parents('.row').eq(0) : $section;
		$section = !$section.length ? $window : $section;
		video.data('height',h);
		$window.on('resize resizevideo',function(){
			var secW = $section.outerWidth(),
				secH = $section.outerHeight(),
				rap = w/h,
				rap2 = h/w,
				newW = secH*rap,
				newH = secW*rap2,
				marginTop = newH-secH,
				marginLeft = newW-secW;

			secW = parseFloat(secW);
			secW = secW+2;
			secH = parseFloat(secH);
			newW = Math.floor(newW);
			newH = Math.floor(newH);
			marginTop = marginTop*-0.5;
			marginLeft = marginLeft*-0.5;

			var secRap = secW/secH;

			if(rap<secRap) {
				video.css({
					width: 'auto',
					height: newH,
					marginTop: marginTop,
					marginLeft: 0
				});
			} else {
				video.css({
					width: newW,
					height: 'auto',
					marginLeft: marginLeft,
					marginTop: 0
				});
			}
		}).triggerHandler('resizevideo');
	};

	$('video.pix_section_video').filter(':notparents(.pix_slideshine)').each(function(){
		var video = $(this),
			$section = video.parents('.row').eq(0);
		if ( $section.length ) {
			$section.prepend(video);
		}
	});

	$('video.pix_video').not('.init').each(function(){
		var video = $(this).addClass('init'),
			loop = typeof video.attr('data-loop')!='undefined' ? (video.attr('data-loop')=='true') : false,
			volume = typeof video.attr('data-volume')!='undefined' ? parseFloat(video.attr('data-volume')) : 1.0;
		video.bind("loadedmetadata", function () {
			var vidW = this.videoWidth;
			var vidH = this.videoHeight;
			video.attr('data-height',vidH).attr('data-width',vidW);
			//console.log(vidW,vidH);
		});
		if ( video.parents('.slideshine_current').length && video.parents('.slideshine_current').data('video') != 'init' && (!Modernizr.touch && $(window).width()>1024) ) {
			video.parents('.pix_slideshine').data('loading',true);
			video.parents('.slideshine_current').data('video','init');
		}
		var mediaInit = function(){
			if ( video.parents('.pix_slideshine').length && (Modernizr.touch && $(window).width()<=1024) ) {
				video.hide();
				return;
			}
			video.mediaelementplayer({
				pauseOtherPlayers: false,
				loop: loop,
				success: function(mediaElement, domObject) {

					var runVideoAndSlide = function(){
						if (navigator.userAgent.indexOf('Safari') == -1) {
							video.css('opacity',0);
						}
						video.parents('.caption_wrap').eq(0).addClass('has_pix_section_video');
						video.parents('.slideshine_caption').eq(0).addClass('has_pix_section_video');
						$('.slideshine_caption.has_pix_section_video', $page).each(function(){
							var wrap = $(this).parents('.caption_wrap').eq(0);
							$(this).insertBefore(wrap);
						});
						if ( video.parents('.slideshine_current').length ) {
							resizeVideo(video);
							if ( mediaElement.readyState > 0 )
								mediaElement.setCurrentTime(0);
							mediaElement.play();
							if (navigator.userAgent.indexOf('Safari') == -1) {
								video.animate({opacity:1},500);
							}
							//video.parents('.pix_slideshine').data('loading',false);
							video.parents('.slideshine_current').data('video','init');
						} else {
							mediaElement.stop();
							//$(video).parents('.pix_slideshine').data('loading',false);
						}
					};
					mediaElement.setVolume(volume);
					if ( video.attr('data-autoplay')=='true' && !$(domObject).parents('.pix_slideshine').length ) {
						mediaElement.play();
						//$(video).parents('.pix_slideshine').data('loading',false);
					} else if ( video.attr('data-autoplay')=='true' && $(domObject).parents('.pix_slideshine').length && (!Modernizr.touch && $(window).width()>1024) ) {
						video.parents('.pix_slideshine').eq(0).on('slideReady', function(){
							runVideoAndSlide();
						});
						if ( video.parents('.slideshineSlide').eq(0).hasClass('loaded') ) {
							runVideoAndSlide();
						}
					}

					var MEcanPlay = function(e){
						if ( video.parents('.slideshine_current').length ) {
							video.parents('.pix_slideshine').data('loading',false);
						}
						if ( video.hasClass('pix_section_video') ) {
							resizeVideo(video);
						}
						var domObj = $(domObject).parents('.mejs-container').eq(0).addClass('loaded');
						$('.isotope').isotope('layout');
						$(window).bind('resize videocanplay', function(){
							domObj.filter(':parents(.sc-wrap-video-resp)').each(function(){
								var obj = $(this),
									objH = obj.height(),
									par = obj.parents('.sc-wrap-video-resp').eq(0),
									parH = par.height();
								obj.css({
									top: (parH-objH)/2
								});
							});
						}).trigger('videocanplay');
					};

					mediaElement.addEventListener('canplay', MEcanPlay);

					var MEplay = function(){
						if ( video.parents('.slideshine_current').length ) {
							video.parents('.pix_slideshine').data('loading',false);
						}
					};

					mediaElement.addEventListener('play', MEplay);

				},
				error : function(mediaElement) {
					//console.log('error');
				}
			});
		};

		mediaInit();
	});

	/*var audio = $('audio').mediaelementplayer({
		success: function(mediaElement, domObject) {
			mediaElement.addEventListener('loadeddata', function(e){
				$(domObject).parents('.mejs-container').eq(0).find('.mejs-horizontal-volume-slider').css({marginLeft:-1});
			});
		}
	});*/
};

GEODE.gmapAsTitle = function() {
	$('.entry-header .pix_maps').each(function(){
		var t = $(this),
			row = t.parents('.entry-header').eq(0),
			h;
		$(window).on('resize load',function(){
			h = row.outerHeight();
			if ( h>0 ) {
				t.attr('data-height', h)
				.css({
					height: h
				});
			}
		});
	});
};

GEODE.bgElems = function() {
	var $window = $(window),
		$body = $('body'),
		winW = $(window).width(),

		$bgBody = $('#bgBody'),
		bodyURL = typeof $bgBody.css('background-image') != 'undefined' ? $bgBody.css('background-image') : '',

		$bgTitle = $('#bgTitle'),
		titleURL = typeof $bgTitle.css('background-image') != 'undefined' ? $bgTitle.css('background-image') : '';

	bodyURL = bodyURL.replace('url(','').replace(')','').replace(/['\"]/g,'');
	if ( bodyURL!=='' && ( bodyURL.match(/\.jpg$/) || bodyURL.match(/\.jpg\?*/) || bodyURL.match(/\.gif$/) || bodyURL.match(/\.gif\?*/) || bodyURL.match(/\.png$/) || bodyURL.match(/\.png\?*/) || bodyURL.match(/\.svg$/) || bodyURL.match(/\.svg\?*/) ) ) {
		$('<img />').on('load',function(){
			$bgBody.animate({opacity:1},450, function(){
				$body.css({
					backgroundImage: 'url('+bodyURL+')'
				});
				$bgBody.remove();
			});
		}).attr('src', bodyURL).each(function() {
			if(this.complete) {
				$(this).load();
			}
		});
	} else {
		$bgBody.css({opacity:1});
	}

	titleURL = titleURL.replace('url(','').replace(')','').replace(/['\"]/g,'');
	if ( titleURL!=='' && ( titleURL.match(/\.jpg$/) || titleURL.match(/\.jpg\?*/) || titleURL.match(/\.gif$/) || titleURL.match(/\.gif\?*/) || titleURL.match(/\.png$/) || titleURL.match(/\.png\?*/) || titleURL.match(/\.svg$/) || titleURL.match(/\.svg\?*/) ) ) {
		$('<img />').on('load',function(){
			$bgTitle.animate({opacity:1},450);
		}).attr('src', titleURL).each(function() {
			if(this.complete) {
				$(this).load();
			}
		});
	} else {
		$bgTitle.css({opacity:1});
	}
};

GEODE.loaded = function(){
	var $body = $('body'),
		$page = $('#page');
	$body.add($page).addClass('loaded');
};

GEODE.demoPanel = function(){
	var setSet;
	if (Modernizr.localstorage) {
		$('#geode-demo-panel').each(function(){
			var t = $(this),
				a = t.find('a.toggle'),
				body_class = $('body').attr('class'),
				body_data_affix = $('body').data('offset-top'),
				page_data_affix = $('#page').data('offset-top'),
				demo_layout,
				demo_header,
				demo_sticky,
				demo_wide,
				demo_icons;

			a.click(function(e){
				e.preventDefault();
				t.add(a).toggleClass('open');
			});

			var setValues = function(){
				demo_layout = localStorage.getItem('demo_layout');

				//$(window).off('.affix');

				if ( demo_layout == 'boxed' ) {
					$('select.demo-layout option[value="boxed"]',t).prop('selected', true);
					$('body').removeClass( 'layout-noframed' ).addClass( 'layout-boxed' );
				} else if ( demo_layout == 'fullscreen' ) {
					$('select.demo-layout option[value="fullscreen"]',t).prop('selected', true);
					$('body').removeClass( 'layout-boxed' ).addClass( 'layout-noframed' );
				} else if ( demo_layout == 'framed' ) {
					$('select.demo-layout option[value="framed"]',t).prop('selected', true);
					$('body').removeClass( 'layout-boxed' ).removeClass( 'layout-noframed' );
				} else {
					if ( $('body').hasClass('layout-boxed') )
						$('select.demo-layout option[value="boxed"]',t).prop('selected', true);
					else if ( $('body').hasClass('layout-noframed') )
						$('select.demo-layout option[value="fullscreen"]',t).prop('selected', true);
					else
						$('select.demo-layout option[value="framed"]',t).prop('selected', true);
				}
				/*$('body').removeData('affix').removeClass('affix affix-top affix-bottom');
				$('body')
					.removeData('bs.affix')
					.removeClass('affix affix-top affix-bottom')
					.affix({
						offset: {
							top: parseFloat($('#above_header').outerHeight() + $('#wrap_header').outerHeight())
						}
					});*/

				demo_header = localStorage.getItem('demo_header');
				if ( demo_header == 'floating' ) {
					$('select.demo-header option[value="floating"]',t).prop('selected', true);
					$('body').removeClass( 'header-centered' );
				} else if ( demo_header == 'centered' ) {
					$('select.demo-header option[value="centered"]',t).prop('selected', true);
					$('body').addClass( 'header-centered' );
				} else {
					if ( $('body').hasClass('header-centered') )
						$('select.demo-header option[value="centered"]',t).prop('selected', true);
					else
						$('select.demo-header option[value="floating"]',t).prop('selected', true);
				}
				/*$('#page').removeData('affix').removeClass('affix affix-top affix-bottom');
				$('#page')
					.removeData('bs.affix')
					.removeClass('affix affix-top affix-bottom')
					.affix({
						offset: {
							top: parseFloat($('#page').css('margin-top'))
						}
					});*/

				demo_sticky = localStorage.getItem('demo_sticky');
				if ( demo_sticky == 'sticky' ) {
					$('select.demo-header-sticky option[value="sticky"]',t).prop('selected', true);
					$('body').addClass( 'sticky-header' );
				} else if ( demo_sticky == 'not-sticky' ) {
					$('select.demo-header-sticky option[value="not-sticky"]',t).prop('selected', true);
					$('body').removeClass( 'sticky-header' );
				} else {
					if ( $('body').hasClass('sticky-header') )
						$('select.demo-header-sticky option[value="sticky"]',t).prop('selected', true);
					else
						$('select.demo-header-sticky option[value="not-sticky"]',t).prop('selected', true);
				}
				GEODE.geodeCheckAffix();

				demo_wide = localStorage.getItem('demo_wide');
				if ( demo_wide == 'wide' ) {
					$('select.demo-header-wide option[value="wide"]',t).prop('selected', true);
					$('body').addClass( 'wide-header' );
				} else if ( demo_wide == 'boxed' ) {
					$('select.demo-header-wide option[value="boxed"]',t).prop('selected', true);
					$('body').removeClass( 'wide-header' );
				} else {
					if ( $('body').hasClass('wide-header') )
						$('select.demo-header-wide option[value="wide"]',t).prop('selected', true);
					else
						$('select.demo-header-wide option[value="boxed"]',t).prop('selected', true);
				}

				demo_icons = localStorage.getItem('demo_icons');
				if ( demo_icons == 'floating' ) {
					$('select.demo-icons option[value="floating"]',t).prop('selected', true);
					$('body').removeClass( 'iconCentered' ).addClass( 'iconFloating' );
				} else if ( demo_icons == 'centered' ) {
					$('select.demo-icons option[value="centered"]',t).prop('selected', true);
					$('body').removeClass( 'iconFloating' ).addClass( 'iconCentered' );
				} else {
					if ( $('body').hasClass('iconCentered') )
						$('select.demo-icons option[value="centered"]',t).prop('selected', true);
					else
						$('select.demo-icons option[value="floating"]',t).prop('selected', true);
				}
				clearTimeout(setSet);
				setSet = setTimeout(function(){
					$(window).trigger('resize');
					$(window).trigger('reisotope');
					$(window).trigger('refresh-stellar');
				},1500);
			};
			setValues();
			$('select:not(.demo-skins)',t).trigger('change').trigger('update');

			t.off('change','form select:not(.demo-skins)');
			t.on('change','form select:not(.demo-skins)',function(){
				var sel = $(this),
					val = sel.find('option:selected').val();
				if ( sel.hasClass('demo-layout') ) {
					localStorage.setItem('demo_layout',val);
				}
				if ( sel.hasClass('demo-header') ) {
					localStorage.setItem('demo_header',val);
				}
				if ( sel.hasClass('demo-header-sticky') ) {
					localStorage.setItem('demo_sticky',val);
				}
				if ( sel.hasClass('demo-header-wide') ) {
					localStorage.setItem('demo_wide',val);
				}
				if ( sel.hasClass('demo-icons') ) {
					localStorage.setItem('demo_icons',val);
				}
				setValues();
			});

			t.off('click','.reset');
			t.on('click', '.reset', function(e){
				e.preventDefault();
				localStorage.removeItem('demo_layout');
				localStorage.removeItem('demo_header');
				localStorage.removeItem('demo_sticky');
				localStorage.removeItem('demo_wide');
				localStorage.removeItem('demo_icons');
				$('body').attr('class',body_class);
				setValues();
			});

			t.off('change','form select.demo-skins');
			t.on('change','form select.demo-skins',function(){
				localStorage.removeItem('demo_layout');
				localStorage.removeItem('demo_header');
				localStorage.removeItem('demo_sticky');
				localStorage.removeItem('demo_wide');
				localStorage.removeItem('demo_icons');
			});
		});
	}
};

GEODE.fileSelImg = function(){
	var fileSelImgCall = function(){
		if($.isFunction($.fn.filestyle) && typeof(pix_style_enable_filestyle)!='undefined' && pix_style_enable_filestyle===true)
			$(':file').filestyle({classIcon: 'scicon-awesome-folder-open'});

		$('img[src$=".svg"]').filter(':notparents(.pix_slideshine)').svgInject();

		if(typeof(pix_style_enable_customselect)!='undefined' && pix_style_enable_customselect===true)
			$('select').not(geode_select_not_custom).geode_customSelect();
	};
	fileSelImgCall();
	$(document).bind('ajaxSuccess ajaxComplete', function() {
		fileSelImgCall();
	});
	$(window).on('resize', function(){
		$('select').not('[multiple], .hasCustomSelect, #rating, .country_select').trigger('update');
	});
};

GEODE.moveParallax = function() {

	var $window = $(window),
		$body = $('body'),
		$el = $('.entry-content > [data-extra="fullscreen"].first-slideshow:first-child, .entry-content > [data-extra="fullwidth"].first-slideshow:first-child').has('.pix_slideshine'),
		$above_header = $('#above_header'),
		$wrap_header = $('#wrap_header'),
		above_H = $above_header.outerHeight(),
		header_H = $wrap_header.outerHeight(),
		fromTop,
		data_affix = parseFloat($body.attr('data-affix')),
		data_top,
		scrolled = false,
		fixed = false;

	header_H = (above_H+header_H);

	if ( Modernizr.touch && $(window).width()<=1024 )
		return;

	$el.each(function(){

		var $div = $(this);

		var manageSlideshow = function(){
			fromTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
			data_top = $body.hasClass('layout-noframed') ? 0 : parseFloat($body.attr('data-top'));
			var data_fix = data_affix + data_top;
			var $slidesh = $('.pix_slideshine', $div),
				slideH = $slidesh.outerHeight(),
				winH = $window.height(),
				elemTop = $div.offset().top,
				elemBottom = elemTop + $div.outerHeight(),
				scrollOpacity = 1,
				winh_ratio = winH/6;

			if ( scrolled === false && Math.abs(winH/fromTop) <= 6 && winH/fromTop > 0 ) {
				scrolled = true;
				$slidesh.trigger('stopSlideshine');
			}
			if ( scrolled === true && winH/fromTop > 6 ) {
				scrolled = false;
				$slidesh.trigger('playSlideshine');
			}

			if ( fromTop >= data_fix && $body.hasClass('sticky-header') ) {
				if ( fixed !== true ) {
					$el.addClass('fixed');
					fixed = true;
				}
			} else {
				if ( fixed === true ) {
					$el.removeClass('fixed');
					fixed = false;
				}
			}

			if ( fromTop >= (slideH+header_H+100) ) {
				$div.css({opacity:0});
			} else {
				$div.css({opacity:1});
			}

			if ( scrolled === true ) {
				scrollOpacity = 1-((fromTop-winh_ratio)/(winH-winh_ratio));
			} else {
				scrollOpacity = 1;
			}
			$('.slideshine_current .slideshine_caption:not(.has_pix_section_video)', $slidesh).css({opacity:scrollOpacity});

		};

		$window.on('pix-parallax resize', function(){
			if (window.addEventListener) {
				window.addEventListener('load', manageSlideshow, false);
				window.addEventListener('scroll', manageSlideshow, false);
			} else if (window.attachEvent) {
				window.attachEvent('onload', manageSlideshow);
				window.attachEvent('onscroll', manageSlideshow);
			}
			manageSlideshow();
		});
		manageSlideshow();
	});

};

GEODE.init = function(){
	GEODE.smoothScroll();
	GEODE.fileSelImg();
	GEODE.fitVideos();
	GEODE.resizeTitles();
	GEODE.slideshineArchive();
	GEODE.fullscreenRow();
	GEODE.scrollUpDown();
	GEODE.zoomColorbox();
	GEODE.initColorbox();
	GEODE.portfolioSlideshineWA();
	GEODE.colorboxFilter();
	GEODE.geodeCheckAffix();
	GEODE.headerTransparent();
	GEODE.headerHover();
	GEODE.geodeMenu();
	GEODE.topBarWidget();
	GEODE.spansToButtons();
	GEODE.setAmountProducts();
	GEODE.moveMobileCart();
	GEODE.initIsotope();
	GEODE.geodeQuickView();
	GEODE.dynTooltips();
	GEODE.productCarousels();
	GEODE.resetVariations();
	GEODE.zoomImage();
	GEODE.geode_show_reply();
	GEODE.slidingToggle();
	GEODE.geode_init_datepickers();
	GEODE.geode_init_sliders();
	GEODE.geode_wpcf7_custom();
	GEODE.hookComparePrdcts();
	GEODE.responsiveSidebar();
	GEODE.carouselInit();
	GEODE.owlInit();
	GEODE.sectionArrows();
	GEODE.sectionTextBox();
	GEODE.gmapAsTitle();
	GEODE.bgElems();
	GEODE.initME();
	GEODE.loaded();
	GEODE.demoPanel();
	GEODE.moveParallax();
};

$(function(){
	GEODE.init();
});

})(jQuery);

function geode_hide_reply(elem){
	var $body = jQuery('body');
	$body.data('replybutton',elem);
	jQuery('.comment-reply-link').removeClass('hidden');
	jQuery(elem).addClass('hidden');
}
