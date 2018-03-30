jQuery(document).ready(function($) {

/*ios safari fix*/
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
        ua = navigator.userAgent,
        gestureStart = function() {
            viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
        },
        scaleFix = function() {
            if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                document.addEventListener("gesturestart", gestureStart, false);
            }
        };
    scaleFix();


/*ie7-8*/
    if ($.browser.msie) {
        if ($.browser.version == 8) $('body').addClass('ie8');
        if ($.browser.version == 7) $('body').addClass('ie7');
        if ($('body').hasClass('ie8')) {
            $('.widget_twitter ul li:last-child, table tr td:last-child, table th:last-child, .ef-progress-bar:last-child').addClass('ef-last');

            $('table th:nth-child(2n), .price-item ul li:nth-child(2n)').addClass('nth-2n');
            $('table tr:nth-child(2n+3)').addClass('nth-2n_3');
        };

        if ($('body').hasClass('ie7')) {
        	$('body').css({position: 'relative'}).append('<span class="ie7overlay"></span>').html('<div class="ie7message">Hello! My website requires MS Internet Explorer 8 or higher version. Please update your browser.</div>')
        }
    };

	var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    if (agentID) {
        $('body').addClass('ef-ios');
    }

/*Height for slider holder on start + adding preloader*/

	if ($(window).height() / $(window).width() >= 0 && $(window).height() / $(window).width() <= 0.7 && $(window).width() <= 780) {

    	$('.main-ctrl-container').css({height: ($(window).height() - $('.ef-head-top').height()) * 2})

    	} else {

		$('.main-ctrl-container').css({height: $(window).height() - $('.ef-head-top').height()})

	}

	$('.main-ctrl-container').find('#main-slider').parent().append('<span class="slider-preloader"></span>');


/*Hovers*/

    $('.proj-img').has('.ef-proj-more').hover(function(){

        $(this).find('.proj-description').stop().animate({
            "opacity": "1"
        }, 400).children(':first-child').stop().animate({
        	top: '0'
        }, 200).next().stop().animate({
        	top: '0'
        }, 220).next().stop().animate({
        	bottom: '0'
        }, 200);

    }, function() {

        $(this).find('.proj-description').stop().animate({
            "opacity": "0"
        }, 400).children(':first-child').stop().animate({
        	top: '-40px'
        }, 200).next().stop().animate({
        	top: '-50px'
        }, 220).next().stop().animate({
        	bottom: '-75px'
        }, 200);

    });

/*Dropdown menu */
    $('ul.sf-menu').superfish({
        delay: 0,
        animation: {
            opacity: 'show'
        },
        speed: 300
    });
    $('ul.sf-menu').mobileMenu({
        defaultText: 'Navigate to...',
        className: 'ef-select-menu',
        subMenuClass: 'sub-menu',
        subMenuDash: '&ndash;'
    });


/*jPreloader*/
    $(".proj-img").preloader();

/*Portfolio filters*/
	var $container = $('#ef-portfolio');
	var efItem = $('#ef-portfolio .ef-item');

	if ($container.is('.ef-portfolio')) {
		/*Chess folter*/
		efItem.find('.proj-img').append('<span class="ef-cover"></span>');

	    $('ul#ef-filter a').click(function() {
	        $('ul#ef-filter .p-current').removeClass('p-current');
	        $(this).parent().addClass('p-current');
	        var filterVal = $(this).attr('data-option-value');
			$('#ef-portfolio .ef-view').attr('rel', 'ef-group');
	        if (filterVal == '*') {
				$('.ef-portf-hidden').find('.ef-cover').animate({
					"opacity": "0"
				}, 400, function(){
					$('.ef-portf-hidden').removeClass('ef-portf-hidden').find('.ef-cover').css({display: "none"});
				});
	        } else {
				$('#ef-portfolio .ef-item[data-type~=' + filterVal + ']').removeClass('ef-portf-hidden').find('.ef-cover').animate({
					"opacity": "0"
				}, 400, function(){
					$('#ef-portfolio .ef-item[data-type~=' + filterVal + ']').find('.ef-cover').css({display: "none"});
				});
				$('#ef-portfolio .ef-item:not([data-type~=' + filterVal + '])').addClass('ef-portf-hidden').find('.ef-cover').css({
					display: "block"
				}).animate({
					"opacity": "0.95"
				}, 'slow');
				$('#ef-portfolio .ef-portf-hidden .ef-view').removeAttr('rel');
	        }
			new View($('#ef-portfolio .ef-view[rel=ef-group]'));
	        return false;
	    });
	} else {
		/*Izotope filter*/
		$(window).smartresize(function(){

			var itemWdt = $container.width() / 4;
			$('.ef-width2').css({width: itemWdt * 2});

			$container.isotope({
				itemSelector : efItem,
				masonry: {columnWidth: itemWdt}
			});

		});

		var $optionSets = $('.option-set'),
		    $optionLinks = $optionSets.find('a');

		$optionLinks.click(function(){
		  var $this = $(this);
		  // don't proceed if already selected
		  if ( $this.parent().hasClass('p-current') ) {
		    return false;
		  }
		  var $optionSet = $this.parents('.option-set');
		  $optionSet.find('.p-current').removeClass('p-current');
		  $this.parent().addClass('p-current');

		  // make option object dynamically, i.e. { filter: '.my-filter-class' }
		  var options = {},
		      key = $optionSet.attr('data-option-key'),
		      value = ($this.attr('data-option-value') == '*') ? '*' : '.ef-item[data-type~=' + $this.attr('data-option-value') + '], .ef-item[data-type="*"]';
		  // parse 'false' as false boolean
		  value = value === 'false' ? false : value;
		  options[ key ] = value;
		  if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
		    // changes in layout modes need extra logic
		    changeLayoutMode( $this, options )
		  } else {
		    // otherwise, apply new options
		    $container.isotope( options );
		  }
		  new View($('#ef-portfolio .isotope-item:not(.isotope-hidden) .ef-view'));
		  return false;
		});
	}


/*Tabs*/
    $('.ef-tabs').tabs({
        fx: {
            opacity: 'show'
        },
        selected: 0
    });


/*Toggle box*/
    $('.ef-toggle-box').addClass('toggle-icn');
    $('.ef-toggle-box .toggle-content').css("display", "none");
    $('.ef-toggle-box li:first-child').addClass('open').find('.toggle-content').css("display", "block");
    $('.ef-toggle-box .toggle-head').click(function() {
        $(this).next('.toggle-content').toggle('blind', 200);
        $(this).parent().toggleClass('open');
    });


/*Buttons*/
	$('.ef-custom').hover(function() {
		if ($(this).attr("rel") == 'b') {
			$(this).animate({
				backgroundColor: $(this).attr("hrel")
			}, 100);
		} else {
			$(this).animate({
				color: $(this).attr("hrel")
			}, 100);
		}
    }, function() {
		if ($(this).attr("rel") == 'b') {
			$(this).animate({
				backgroundColor: $(this).attr("crel")
			}, 100);
		} else {
			$(this).animate({
				color: $(this).attr("crel")
			}, 100);
		}
    });


/*ScrollToTop and Scroll to contant*/
    jQuery.fn.topLink = function(settings) {
        settings = jQuery.extend({
            min: 1,
            fadeSpeed: 200,
            ieOffset: 50
        }, settings);
        return this.each(function() {

        	$(window).resize(function() {
        	    var footHt = $('.ef-copyrignts').height();
        	    var marg = ($(window).width() - $('.ef-full-grid').width()) / 2 - (el.width());
        	    el.css({bottom: footHt, right: marg});
        	});

            var el = $(this);
            $(window).scroll(function() {
                if (!jQuery.support.hrefNormalized) {
                    el.css({
                        'position': 'absolute',
                        'top': $(window).scrollTop() + $(window).height() - settings.ieOffset
                    });
                }

                if ($(window).scrollTop() >= settings.min) {
                    el.fadeIn(settings.fadeSpeed);
                } else {
                    el.fadeOut(settings.fadeSpeed);
                }
            });
        });
    };
    $('a.totop').topLink({
        min: 50,
        fadeSpeed: 500
    });
    $('a.totop').click(function(e) {
        e.preventDefault();
        $.scrollTo(0, 800);
    });

    $('#ef-to-content').click(function(e) {
        e.preventDefault();
        $.scrollTo($(this), 800);
    });


/*Accordeon*/
    $(".accordion").accordion({
        autoHeight: false,
        navigation: true
    });


/*footer*/
    var expand = $('.ef-expandable');

    $('a.ef-open-close').addClass("ef-close");

    $('a.ef-open-close').click(function() {
        if (expand.is(":visible")) {
            expand.slideUp(500, 'easeInOutExpo');
            $(this).addClass("ef-close");
            $('.totop').animate({marginRight: '0'});
        } else {
            expand.slideDown(500, 'easeInOutExpo');
            $(this).removeClass("ef-close");
            $('.totop').animate({marginRight: $('.totop').width()});
        };
        return false;
    });

/*Grid blog*/
    $(window).smartresize(function(){
      	var blogList = $('#ef-bloglist');
      	var blogItem = $('.ef-blog-post');

    	blogList.isotope({
    		itemSelector : blogItem,
    		sortBy: 'original-order'
    	});

    });


/*Skill graphs*/
	$('.ef-progress-bar div').each(function() {
		var pc = $(this).attr('data-id') + '%';
		$(this).append('<span><span></span></span>')
		$(this).children().children().html(pc);
		$(this).children().animate({'width' : pc}, 1500, 'easeOutBounce');
	});

/*Alerts*/
	$('.ef-alertBox, .ef-list').append('<span></span>');
	$('.ef-alertBox span, .ef-list span').click(function() {
		$(this).parent().fadeOut(500);
	});

/*Footer to bottom*/
	function changeHeight() {
		$('#ef-content').css('min-height', '');
		var sigma = $(window).height() - $('body').height();
		if (sigma > 0) $('#ef-content').css('min-height', $('#ef-content').height() + sigma - $('html').offset().top);
	}

	function SGaddEvent( obj, type, fn ){
		if (obj.addEventListener){obj.addEventListener( type, fn, false );}
		else if (obj.attachEvent){
		obj["e"+type+fn] = fn;obj[type+fn] = function(){obj["e"+type+fn]( window.event );}
		obj.attachEvent( "on"+type, obj[type+fn] );}
	}
	SGaddEvent(window, 'load', changeHeight);
	SGaddEvent(window, 'resize', changeHeight);


/*Fixed menu*/
	var head = $('.ef-head-top');
	var canvas = $('.ef-head-top .ef-canvas');
	var menu = $('.ef-menu-wrapper');

	$(window).resize(function() {
		head.css({height: 'auto'});
		if ($(window).scrollTop() > head.height()){
			menu.removeClass('ef-default').addClass('ef-fixed');
		} else {
			menu.removeClass('ef-fixed').addClass('ef-default');
		}
	});

	$(window).scroll(function(){
		pos = head.offset();
		if ($('body').hasClass('.ef-ios') || $(window).width() <= 1066) {} else {
			head.height((head.height() > (canvas.height() + menu.height())) ? head.height() : canvas.height() + menu.height());
			if($(this).scrollTop() > pos.top+head.height() && menu.hasClass('ef-default')){
				menu.slideUp('fast', function(){
					$(this).removeClass('ef-default').addClass('ef-fixed').slideDown('fast');
				});
			} else if($(this).scrollTop() <= pos.top+head.height() && menu.hasClass('ef-fixed')){
				menu.slideUp('fast', function(){
					$(this).removeClass('ef-fixed').addClass('ef-default').slideDown('fast');
				});
			}
		}
	});


/*ef-view*/
	$('a:not(.ef-view) > img').each(function(){
		var a = $(this).parent();
		var src = $(this).attr('src');
		var url = $(a).attr('href');
		if (url.substr(-3, 3) == src.substr(-3, 3)) new View($(a));
	});
	$('div.gallery').each(function(){
		var src = $('a:first > img', this).attr('src');
		var url = $('a:first', this).attr('href');
		if (url.substr(-3, 3) == src.substr(-3, 3)) new View($('a', this));
	});


/*fitVids init*/
	$(".proj-img, .sg-vimeo-short, .sg-youtube-short").fitVids();


/* Footer Sidebar */
	$('.ef-footer .ef-col:nth-child(3n+4)').before('<div class="clear"></div>');

});


/*Window onload*/
jQuery(window).load(function() {
	var $ = jQuery;

/*Align height*/
    $(".ef-extras > .ef-col1-4, .ef-extras > .ef-col").equalHeight();


/*Some slider customizations on window resize*/
    $(window).resize(function() {
    	var sliderHeight = $(window).height() - $('.ef-head-top').height();
    	var flexViewport = $('.flex-viewport').height();
		var wpadminbarHeight = 0;

		if ($("#wpadminbar").length) {
			wpadminbarHeight = $("#wpadminbar").height();
			sliderHeight = sliderHeight - wpadminbarHeight;
		}

    	if ($(window).height() / $(window).width() >= 0 && $(window).height() / $(window).width() <= 0.7 && $(window).width() <= 780) {
			sliderHeight = sliderHeight * 2;
			$('.main-ctrl-container').css({height: sliderHeight});
    	} else {
    		$('.main-ctrl-container').css({height: sliderHeight});
    	}

    	$('.ef-slide-content').parent().each(function() {
    		$(this).css({marginTop: (flexViewport - $(this).height()) / 2, marginBottom: (flexViewport - $(this).height()) / 2})
    		.find('.flex-caption').each(function(){
				$(this).css({top: ($(this).parent().height() - $(this).height()) / 2})
			})
		});

    	$('#main-slider').css({top: ( sliderHeight - flexViewport ) / 2});

		if ($('body.ef-fullscreen').length) {
			$("#ef-header").attr("style", "height:" + ($(window).height() - wpadminbarHeight) + "px !important;");
		}

		if ($('#ef-portfolio .ef-indent').length) {
			var p = $('#ef-portfolio .ef-item:not(.ef-featured) .proj-img:first');
			if ($(p).length) {
				$('#ef-portfolio .ef-indent').css({height: p.height()});
			} else {
				$('#ef-portfolio .ef-indent').css({height: $('#ef-portfolio .ef-item .proj-img:first').height() / 2});
			}
		}

    });


/*Post slider*/
    $('.ef-post-slider').flexslider({
        slideshow: false, /* set 'true' if you want auto scrolling */
        animation: "fade", /* 'slide' or 'fade' animation style */
        controlNav: true, /* set 'false' to hide slider pagination */
        directionNav: false /*Set 'true' to enable nav arrows*/
    });

    $('.ef-blog-post, .ef-post-slider').hover(function() {
        $(this).find('.flex-control-paging').stop().animate({
        	bottom: '0'
        }, 200);

        $(this).find('.flex-direction-nav a').stop().animate({
        	marginLeft: '0', marginRight: '0'
        }, 200);

    }, function() {
        $(this).find('.flex-control-paging').stop().animate({
        	bottom: '-1.2em'
        }, 200);

        $(this).find('.flex-direction-nav a.flex-prev').stop().animate({
        	marginLeft: '-25px'
        }, 200);

        $(this).find('.flex-direction-nav a.flex-next').stop().animate({
        	marginRight: '-25px'
        }, 200);

    });


/*Flickr hover*/
    $('.jflickr li a').hover(function() {
        $(this).find('span').stop().animate({
            opacity: '0.4'
        }, 100);
    }, function() {
        $(this).find('span').stop().animate({
            opacity: '0'
        }, 300);
    });

    if ($('#ef-portfolio').is(':not(.ef-portfolio)')) {
    	$('.ef-featured').addClass('ef-width2');
    }

	$('.jflickr').each(function(){
		new View($('a', this));
	});


/*Fixed portfolio item details*/
	var sidebar = $('#theFixed');

	if (sidebar.length) {
		var sidebarOffset = sidebar.offset().top - 100;
		var windowHeight = $(window).height() -100;

		$(window).scroll(function(){
			var sidebarHeight = sidebar.height() - 100;
			var thumbsHeight = $('.ef-proj-thumbs').height();
			var bottomFix = thumbsHeight - sidebarHeight;
			var scrollVal = $(window).scrollTop();

			if(thumbsHeight > sidebarHeight && scrollVal > sidebarOffset && sidebarHeight + 100 <= windowHeight){
				sidebar.css({position: 'fixed', top: '100px'});
				if(scrollVal - sidebarOffset >= bottomFix - 100){
					sidebar.css({position: 'absolute', top: bottomFix - 100});
				}
			}else{
				sidebar.css({position: 'static', top: '0'});
			}
		});
	}

});