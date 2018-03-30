/* ====== SHARED VARS ====== */

var ua                  = navigator.userAgent,
    isiPhone            = false,
    isiPad              = false,
    isiPod              = false,
    isAndroidPhone      = false,
    android             = false,
    iOS                 = false,
    isIE                = false,
    ieMobile            = false,
    isSafari            = false,
    isMac               = false,
    // useful logs in the console
    globalDebug         = false;

(function ($, window, undefined) {
	"use strict";

/* --- 404 Page --- */
var gifImages = [
	"//media2.giphy.com/media/UslGBU1GPKc0g/giphy.gif",
	"//i.imgur.com/8ZYNp.gif",
	"//cdn.makeagif.com/media/9-04-2014/LqSsUg.gif"
];

function getGif() {
	return gifImages[Math.floor(Math.random() * gifImages.length)];
}

function changeBackground() {
	$('.error404').css('background-image', 'url(' + getGif() + ')');
}

$(window).on('load', function () {
	if ( $('.error404').length ) {
		$html.addClass('page404');
		changeBackground();
	} else {
		$html.removeClass('page404');
	}
});

$(window).keydown(function (e) {
	if (e.keyCode == 32) {
		changeBackground();
	}
});
var AjaxLoading = (function() {

	var timelinePromise = function(timeline) {
		return new Promise(function(resolve) {
			// alternate syntax for adding a callback
			timeline.eventCallback("onComplete", function() {
				resolve(true);
			});
		});
	}

	function init() {

		if ( $body.is('.is--customizer-preview') || typeof $body.data('ajaxloading') === "undefined" ) {
			return;
		}

		var ignored = ['.pdf', '.doc', '.eps', '.png', '.jpg', '.jpeg', '.zip', 'admin', 'wp-', 'wp-admin', 'feed', '#', '&add-to-cart=', '?add-to-cart=', '?remove_item'],
			$border = $('.js-border'),
			borderColor = '',
			timelineOut = null;

		if ( typeof pile_non_ajax_links === "object" && pile_non_ajax_links.length >= 1 ) {
			ignored = ignored.concat( pile_non_ajax_links )
		}

		var barbaPreventCheck = Barba.Pjax.preventCheck;

		Barba.Pjax.preventCheck = function(ev, element) {

		    if (!element || !element.href)
		      	return false;

			for (var i = ignored.length - 1; i >= 0; i--) {
				if (element.href.indexOf(ignored[i]) > -1) {
					return false;
				}
			}

			return barbaPreventCheck(ev, element);
		}

		Barba.Pjax.start();

		Barba.Dispatcher.on('linkClicked', function(obj) {
			$body.removeClass('js-open-cart is-cart-open');
			borderColor = $(obj).data('color');
			timelineOut = $(obj).is('.pile-item-wrapper-link') ? projectBorderOutTimeline($(obj)) : null;
		});

		var FadeTransition = Barba.BaseTransition.extend({
			start: function() {
			    /**
			     * This function is automatically called as soon the Transition starts
			     * this.newContainerLoading is a Promise for the loading of the new container
			     * (Barba.js also comes with an handy Promise polyfill!)
			     */
			     var _this = this;
			    // As soon the loading is finished and the old page is faded out, let's fade the new page
			    Promise
			    .all([this.newContainerLoading, this.fadeOut()])
			    .then(this.fadeIn.bind(this));
			},

			fadeOut: function() {
			    /**
			     * this.oldContainer is the HTMLElement of the old Container
			     */
				var _this = this;

			     if ( timelineOut === null ) {
			     	timelineOut = borderOutTimeline();
			     }

				timelineOut.play();

				Nav.hideMenu();

			    return timelinePromise(timelineOut).then(function() {
			    	var $old = $(_this.oldContainer);

	    			$old.find('video').each(function() {
					    this.pause(); // can't hurt
					    delete this; // @sparkey reports that this did the trick (even though it makes no sense!)
					    this.src = ""; // empty source
						this.load();
					    $(this).remove(); // this is probably what actually does the trick
					});

			    	$old.hide();
			    	timelineOut = null;
			    });
			 },

			 fadeIn: function() {
			    /**
			     * this.newContainer is the HTMLElement of the new Container
			     * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
			     * Please note, newContainer is available just after newContainerLoading is resolved!
			     */
			    var _this = this;
			    var $el = $(this.newContainer);

			    var timeline = new TimelineMax({ paused: true });

				$(window).scrollTop(0);
				$border.css('backgroundColor', 'transparent');

				timeline.to($border, 0.6, { borderWidth: 0, ease: Quart.easeInOut });
				timeline.fromTo('.hero-content', .4, { opacity: 0, y: 50 }, { opacity: 1, y: 0, ease: Quad.easeOut }, '-=.4');
				timeline.fromTo('.hero-slider', .4, { scale: 1.2 }, { scale: 1, ease: Quad.easeOut }, '-=.4');

				Barba.Pjax.Cache.data[Barba.HistoryManager.currentStatus().url].then(function(data) {
					// get data and replace the body tag with a nobody tag
					// because jquery strips the body tag when creating objects from data

					data = data.replace(/(<\/?)body( .+?)?>/gi, '$1NOTBODY$2>', data);

					// get the nobody tag's classes

					var nobodyClass = $(data).filter('notbody').attr("class");

					// set it to current body tag

					if ($body.hasClass('error404')) {
						$body.css('backgroundImage', '');
					}
					$body.attr('class', nobodyClass);

					// need to get the id and edit string from the data attributes
					var curPostID = $(data).filter('notbody').data("curpostid"),
						curPostTax = $(data).filter('notbody').data("curtaxonomy"),
						curPostEditString = $(data).filter('notbody').data("curpostedit");

					adminBarEditFix(curPostID, curPostEditString, curPostTax);
					onDjaxLoad();
				});

				_this.done();
				timeline.play();
			}
		});

		function onDjaxLoad() {
			onLoad();
			eventHandlers();
			// there are some things that should happen only when loading a page with dJax, not in the first "normal" loadUp
			loadUpDJaxOnly();
		}

		function borderOutTimeline() {

			var borderX = windowWidth / 2,
				borderY = windowHeight / 2,
				timeline = new TimelineMax({ paused: true });

			$border.css({
				top: 0,
				left: 0,
				scale: 1,
				width: windowWidth,
				height: windowHeight,
		        borderWidth: '0 0',
		        borderColor: borderColor,
				display: 'block'
			});

			timeline.fromTo($border, 0.6, {
				x: 0,
				y: 0,
				scale: 1
			}, {
		        borderWidth: borderY + ' ' + borderX,
		        ease: Quart.easeInOut
			});

			return timeline;
		}

		function projectBorderOutTimeline($item) {

			var offset 		= $item.offset(),
				itemWidth 	= $item.outerWidth(),
				itemHeight 	= $item.outerHeight(),
				borderX 	= (itemWidth + 1) % 2 ? (itemWidth + 1) / 2 : itemWidth / 2 + 1,
				borderY 	= (itemHeight + 1) % 2 ? (itemHeight + 1) / 2 : itemHeight / 2 + 1,
				scaleX 		= windowWidth / itemWidth,
				scaleY 		= windowHeight / itemHeight,
				borderColor = $item.find('.pile-item-border').css('borderTopColor'),
				moveX 		= windowWidth / 2 - offset.left - itemWidth / 2,
				moveY 		= windowHeight / 2 - (offset.top - latestKnownScrollY) - itemHeight / 2;

			$border.css({
				display: 'block',
				top: offset.top - latestKnownScrollY - 1,
				left: offset.left - 1,
				right: 'auto',
				bottom: 'auto',
				width: itemWidth + 2,
				height: itemHeight + 2,
				borderColor: borderColor
			});

			var timeline = new TimelineMax({paused: true});

			timeline.to($border, .4, {
		        borderWidth: borderY + ' ' + borderX,
				ease: Quart.easeInOut,
				onComplete: function () {
					$border.css('backgroundColor', $border.css('borderTopColor'));
				}
			});

			timeline.fromTo($border, .5, {
				x: 0,
				y: 0,
				scaleX: 1,
				scaleY: 1
			}, {
				x: moveX,
				y: moveY,
				scaleX: scaleX,
				scaleY: scaleY,
				ease: Power3.easeInOut
			});

			return timeline;
		}


		/**
		 * Next step, you have to tell Barba to use the new Transition
		 */

		 Barba.Pjax.getTransition = function() {
		  /**
		   * Here you can use your own logic!
		   * For example you can use different Transition based on the current page or link...
		   */

		   return FadeTransition;
		};
	}


	return {
		init: init
	}

})();


var ArchiveParallax = (function() {

	var $pileItems,
		initialized = false,
		top,
		bottom;

	function initialize() {

		bindEvents();
		$window.on('infiniteLoad', function() {
			bindEvents();
		});

        if ( $('.pile').is('.pile--no-3d, .pile--single') ) return;

        $pileItems = $('.pile-item--archive');

		var count = Math.round( $('.pile').width() / $pileItems.first().outerWidth() );

		set3DClasses(count);
		bindEvents();

		$('.pile--portfolio-archive').imagesLoaded(function() {
			// Call the Parallax only when 3D Grid is active
		    addMissingPadding();

		    prepare();
		    initialized = true;
		    update();
		});
	}

	function bindEvents() {

		if ( Modernizr.touchevents ) {
			return;
		}

		$('.pile-item-wrap').unbind('mouseenter mouseleave');

		$('.pile-item-wrap').each(function(index, item) {
			var $item       = $(item),
	            $border     = $item.find('.pile-item-border'),
	            $image      = $item.find('img'),
	            $content    = $item.find('.pile-item-content'),
	            $title      = $item.find('.pile-item-title'),
	            $meta       = $item.find('.pile-item-meta'),
	            $bg       	= $item.find('.pile-item-bg'),
	            $link       = $item.find('.pile-item-link'),
	            is3D        = !! $item.closest('.js-3d').length,
	            borderWidth = parseInt($border.css('fontSize')),
	            transitionReset = Math.min(Math.max(parseInt(parseInt($border.css('lineHeight'))), 0), 1),
	            // Make the transition timing dependend to borderWidth
	            // but keep it within a 0.3s to 0.8s interval
	            transition  = Math.min(Math.max(parseInt(borderWidth)/5, 3), 8)/10*transitionReset;

	        if ( is3D || $item.closest('.pile-item').is('.product') ) {
	            borderWidth = borderWidth / 1.4;
	            $title.css('fontSize', '24px');
	        } else {
	            $title.css('fontSize', '38px');
	        }

	        var removeClassTimeout;

            $item.hover(function () {
            	clearTimeout(removeClassTimeout);
    			$bg.removeAttr('style');
            	$bg.addClass('to-animate');

	            TweenMax.from($bg, transition, {opacity: 0});
	            TweenMax.to($border, transition, {borderWidth: borderWidth, ease: Power4.easeOut});
	            TweenMax.fromTo($meta, transition, {y: - borderWidth}, {y: 0, ease: Power4.easeOut});
	            TweenMax.fromTo($link, transition, {y: borderWidth}, {y: 0, ease: Power4.easeOut});
	            TweenMax.to($content, transition, {opacity: 1, ease: Power2.easeOut});

            }, function () {
	            TweenMax.to($bg, transition, {opacity: ''});
	            TweenMax.to($border, transition, {borderWidth: 0, ease: Power4.easeOut});
	            TweenMax.to($meta, transition, {y: - borderWidth, ease: Power4.easeOut});
	            TweenMax.to($link, transition, {y: borderWidth, ease: Power4.easeOut});
	            TweenMax.to($content, transition, {opacity: 0, ease: Power2.easeOut});

        		removeClassTimeout = setTimeout(function() {
        			$bg.removeClass('to-animate');
        			$bg.removeAttr('style');
        		}, transition * 1000);

            });

		});

	}

	function prepare() {

		var parallaxAmount = parseInt($body.data('parallax'), 10) / 100;

		$pileItems.each(function (i, element) {

			var $item           = $(element),
                itemTop         = $item.offset().top,
				itemHeight      = $item.outerHeight(),
				parallaxInfo    = {
					start       : itemTop - windowHeight,
					end         : itemTop + itemHeight
				},
				initialTop      = itemHeight * parallaxAmount / 2,
				timeline        = new TimelineMax({paused: true});

			if ($item.is('.js-3d')) {
				initialTop = initialTop * 2;
			}

			timeline.fromTo($item, 1, {
				y: initialTop
			}, {
                y: initialTop * -1,
                ease: Linear.easeNone,
                force3D: true
            });

			parallaxInfo.timeline = timeline;
			// bind sensible variables for tweening to the image using a data attribute
			$item.data('parallax', parallaxInfo);

		});
	}

	function set3DClasses(count) {
		var odd = 0;

		if ( $('.pile').hasClass('pile--odd') ) {
			odd = 1;
		}

		if ( count < 2 ) {
			$pileItems.removeClass('js-3d');
		}

		$pileItems.each(function (i, element) {
			var $item = $(element),
				index = i;

			if ( $('.pile').hasClass('pile--column') ) {
				$item.toggleClass('js-3d', !! ((parseInt(index / count) + odd + index) % 2));
			} else {
				$item.toggleClass('js-3d', !! ((parseInt(index / count) + odd + index % count) % 2));
			}
		});
	}

	function addMissingPadding() {
		var parallaxAmount = parseInt($body.data('parallax'), 10) / 100;

		var $content = $('.pile'),
			top = 0,
			bottom = 0,
			maxMissingTop   = 0,
            maxMissingBtm   = 0;

        $content.css({
            'paddingTop': '',
            'paddingBottom': ''
        });

        bottom = $document.height();

        $pileItems.each(function (i, element) {

            TweenMax.to($(element), 0, {y: 0});

            var $item           = $(element),
                itemTop         = $item.offset().top,
                itemHeight      = $item.outerHeight(),
                toTop           = itemTop + itemHeight/2 - top,
                toBottom        = bottom - itemTop - itemHeight/2,
                missingTop      = toTop < windowHeight/2 ? (windowHeight/2 - toTop) : 0,
                missingBottom   = toBottom < windowHeight/2 ? (windowHeight/2 - toBottom) : 0,
                paddingLimit 	= itemHeight * parallaxAmount/2;

            maxMissingTop   = Math.max(Math.min(missingTop, paddingLimit), maxMissingTop);
            maxMissingBtm   = Math.max(Math.min(missingBottom, paddingLimit), maxMissingBtm);
        });

        if ( maxMissingBtm || maxMissingBtm ) {
	        $content.css({
	            'paddingTop': '+=' + maxMissingTop,
	            'paddingBottom': '+=' + maxMissingBtm
	        });
        }
	}

	function update() {
		if ( ! initialized ) return;

		$pileItems.each(function (i, obj) {
			var $item 	= $(obj),
				options = $item.data('parallax');

			if ( ! empty(options) ) {
				if (options.end - options.start == 0) {
					return;
				}

				var progress = (1 / (options.end - options.start)) * (latestKnownScrollY - options.start);

				if (1 >= progress && 0 <= progress) {
			    	options.timeline.progress(progress);
				}
			}

		});
	}

	function destroy() {
		initialized = false;
		$pileItems = $();
	}

	return {
		initialize: initialize,
		update: update,
		destroy: destroy
	}
})();

var Header = (function() {

	var $header, heroHeight, headerHeight,
		above,
		initialized = false;

	function init() {
		above = undefined;
		$header = $('.js-transparent-header');
		heroHeight = $('.js-hero:visible').outerHeight() || $('.single-product .js-post-gallery').outerHeight();
		headerHeight = $('.header-height').outerHeight();

		if ( heroHeight && ! $body.is('.page-template-contact') ) {
			initialized = true;
			update();
		} else {
			initialized = false;
			$header.removeClass('site-header--transparent');
		}
	}

	function update() {
		if ( ! initialized ) return;

		if ( above !== true && latestKnownScrollY <= heroHeight - headerHeight/2 ) {
			$header.addClass('site-header--transparent');
			above = true;
		}

		if ( above !== false && latestKnownScrollY > heroHeight - headerHeight/2 ) {
			$header.removeClass('site-header--transparent');
			above = false;
		}
	}

	return {
		init: init,
		update: update
	}

})(undefined);
function copyrightOverlayAnimation(direction, x, y){
    switch (direction){
        case 'in':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - IN"+timestamp);}

            TweenMax.fromTo($('.copyright-overlay'), 0.1, {opacity: 0, scale: 0.7}, {opacity: 1, scale: 1,
                onStart: function(){
                    $('.copyright-overlay').css({top: y, left: x});
                    $('body').addClass('is--active-copyright-overlay');
                }
            });

            break;
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - OUT"+timestamp);}

            TweenMax.fromTo($('.copyright-overlay'), 0.1, {opacity: 1, scale: 1}, {opacity: 0, scale: 0.7,
                onComplete: function(){
                    $('body').removeClass('is--active-copyright-overlay');
                }
            });

            break;
        }

        default: break;
    }
}

function copyrightOverlayInit(){
    $(document).on('contextmenu', '.entry__featured-image, .hero, .entry-content img, .pile-item img, .mfp-img', function(event){
        if( !empty($('.copyright-overlay'))){
            event.preventDefault();
            event.stopPropagation();

            copyrightOverlayAnimation('in', event.clientX, event.clientY);
        }
    });

    $(document).on('mousedown', function(){
        if($('body').hasClass('is--active-copyright-overlay'))
            copyrightOverlayAnimation('out');
    });
}
(function(){

    var $hero = $('.hero-content'),
        $document = $(document),
        keysBound = false;

    function positionHeroContent(e) {
        switch(e.which) {
            case 37: // left
                if ( $hero.hasClass('right') ) {
                    $hero.removeClass('right');
                } else {
                    $hero.addClass('left');
                }
            break;

            case 38: // up
                if ( $hero.hasClass('bottom') ) {
                    $hero.removeClass('bottom');
                } else {
                    $hero.addClass('top');
                }
            break;

            case 39: // right
                if ( $hero.hasClass('left') ) {
                    $hero.removeClass('left');
                } else {
                    $hero.addClass('right');
                }
            break;

            case 40: // down
                if ( $hero.hasClass('top') ) {
                    $hero.removeClass('top');
                } else {
                    $hero.addClass('bottom');
                }
            break;

            default: return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    }

    function bindArrowKeys(e) {
        if (keysBound) return;
        switch(e.which) {
            case 37:
            case 39:
                positionHeroContent(e);
                $document.off('keydown', bindArrowKeys);
                keysBound = true;
                $document.on('keydown', positionHeroContent);
            break;
            default: return;
        }
    }

    $document.on('keydown', bindArrowKeys);

})();

/* --- GMAP Init --- */

window.GMap = (function () {

	function init() {
		if ( $body.hasClass('is-loaded') ) {
			refresh();
		} else {
			$window.load(function() {
				refresh();
			});
		}
	}

	function refresh() {
		var $gmap = $('#gmap');

		// Make the Hero map untouchable at first
		// on touch devices. Activate it after a click.
		if ( Modernizr.touch && $gmap.parent().hasClass('hero-container') ) {
			$gmap.parent().addClass('is--untouchable').one('click', function() {
				$(this).removeClass('is--untouchable');
			});
		}

		if ($gmap.length && typeof google !== 'undefined') {
			if (globalDebug) { console.log("GMap Init"); }

			var gmap_link, gmap_variables, gmap_zoom, gmap_style;
			gmap_link = $gmap.data('url');
			gmap_style = typeof $gmap.data('customstyle') !== "undefined" ? "style1" : google.maps.MapTypeId.ROADMAP;
			var gmap_markercontent = $gmap.data('markercontent');

			// Overwrite Math.log to accept a second optional parameter as base for logarhitm
			Math.log = (function () {
				var log = Math.log;
				return function (n, base) {
					return log(n) / (base ? log(base) : 1);
				};
			})();

			var get_url_parameter = function (needed_param, gmap_url) {
				var sURLVariables = (gmap_url.split('?'))[1];
				if (typeof sURLVariables === "undefined") {
					return sURLVariables;
				}
				sURLVariables = sURLVariables.split('&');
				for (var i = 0; i < sURLVariables.length; i++) {
					var sParameterName = sURLVariables[i].split('=');
					if (sParameterName[0] == needed_param) {
						return sParameterName[1];
					}
				}
			};

			var gmap_coordinates = [],
				gmap_zoom;

			if (gmap_link) {
				//Parse the URL and load variables (ll = latitude/longitude; z = zoom)
				var gmap_variables = get_url_parameter('ll', gmap_link);
				if (typeof gmap_variables === "undefined") {
					gmap_variables = get_url_parameter('sll', gmap_link);
				}
				// if gmap_variables is still undefined that means the url was pasted from the new version of google maps
				if (typeof gmap_variables === "undefined") {

					if (gmap_link.split('!3d') != gmap_link) {
						//new google maps old link type

						var split, lt, ln, dist, z;
						split = gmap_link.split('!3d');
						lt = split[1];
						split = split[0].split('!2d');
						ln = split[1];
						split = split[0].split('!1d');
						dist = split[1];
						gmap_zoom = 21 - Math.round(Math.log(Math.round(dist / 218), 2));
						gmap_coordinates = [lt, ln];

					} else {
						//new google maps new link type

						var gmap_link_l;

						gmap_link_l = gmap_link.split('@')[1];
						gmap_link_l = gmap_link_l.split('z/')[0];

						gmap_link_l = gmap_link_l.split(',');

						var latitude = gmap_link_l[0];
						var longitude = gmap_link_l[1];
						var zoom = gmap_link_l[2];

						if (zoom.indexOf('z') >= 0)
							zoom = zoom.substring(0, zoom.length - 1);

						gmap_coordinates[0] = latitude;
						gmap_coordinates[1] = longitude;
						gmap_zoom = zoom;
					}


				} else {
					gmap_zoom = get_url_parameter('z', gmap_link);
					if (typeof gmap_zoom === "undefined") {
						gmap_zoom = 10;
					}
					gmap_coordinates = gmap_variables.split(',');
				}
			}

			if ( gmap_markercontent.length ) {
				gmap_markercontent = '<div class="map__marker-wrap">' +
					'<div class="map__marker">' +
						gmap_markercontent +
					'</div>' +
				'</div>';
			} else {
				gmap_markercontent = '<div class="map__marker-wrap is-empty">' +
					'<div class="map__marker"></div>' +
				'</div>';
			}

			$gmap.gmap3({
				map: {
					options: {
						center: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
						zoom: parseInt(gmap_zoom),
						mapTypeId: gmap_style,
						mapTypeControlOptions: {mapTypeIds: []},
						scrollwheel: false
					}
				},
				overlay: {
					latLng: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
					options: {
						content: gmap_markercontent
					}
				},
				styledmaptype: {
					id: "style1",
					options: {
						name: "Style 1"
					},
					styles: [
						{
							"stylers": [
								{"saturation": -100},
								{"gamma": 2.45},
								{"visibility": "simplified"}
							]
						}, {
							"featureType": "road",
							"stylers": [
								{"hue": $("body").data("color") ? $("body").data("color") : "#ffaa00"},
								{"saturation": 48},
								{"gamma": 0.40},
								{"visibility": "on"}
							]
						}, {
							"featureType": "administrative",
							"stylers": [
								{"visibility": "on"}
							]
						}
					]
				}
			});
		}
	}

	return {
		init: init,
		refresh: refresh
	}

})();


var loadingAnimation = (function() {
    var timeline,
        initialized = false;

    function init() {
        initialized = true;
    }

    function play() {

        if ( ! initialized ) return;

        TweenMax.to($('.border-logo-fill'), .3, {
            x: 0,
            onComplete: function() {
                $('.border-logo').css('opacity', 0);
            },
            ease: Circ.easeIn
        });

        TweenMax.to($('.border-logo-bgscale'), .3, {
            scaleY: 0,
            delay: .3,
            ease: Quad.easeInOut
        });

        TweenMax.fromTo($('.js-border'), 0.6, {
            borderWidth: windowHeight/2 + ' ' + windowWidth/2
        }, {
            background: 'none',
            borderWidth: 0,
            delay: .5,
            ease: Quart.easeInOut
        });

        TweenMax.fromTo('.hero-content', .4, { opacity: 0, y: 50 }, { opacity: 1, y: 0, ease: Quad.easeOut, delay: .7 });
        TweenMax.fromTo('.hero-slider', .4, { scale: 1.2 }, { scale: 1, ease: Quad.easeOut, delay: .7 });
    }

    return {
        init: init,
        play: play
    }
})();
/* --- Magnific Popup Initialization --- */

function magnificPopupInit() {
	if (globalDebug) {
		console.log("Magnific Popup - Init");
	}

	$('.js-post-gallery').each(function () { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
			type: 'image',
			closeOnContentClick: false,
			closeBtnInside: false,
			removalDelay: 500,
			mainClass: 'mfp-fade',
			image: {
				markup: '<div class="mfp-figure">' +
				'<div class="mfp-img"></div>' +
				'<div class="mfp-bottom-bar">' +
				'<div class="mfp-title"></div>' +
				'<div class="mfp-counter"></div>' +
				'</div>' +
				'</div>',
				titleSrc: function (item) {
					var output = '';
					if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>' + item.el.attr('data-alt') + '</small>';
					}
					return output;
				}
			},
			gallery: {
				enabled: true,
				navigateByImgClick: true
				//arrowMarkup: '<a href="#" class="gallery-arrow gallery-arrow--%dir% control-item arrow-button arrow-button--%dir%">%dir%</a>'
			},
			callbacks: {
				elementParse: function (item) {

					if (this.currItem != undefined) {
						item = this.currItem;
					}

					var output = '';
					if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>' + item.el.attr('data-alt') + '</small>';
					}

					$('.mfp-title').html(output);
				},
				change: function (item) {
					var output = '';
					if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>' + item.el.attr('data-alt') + '</small>';
					}

					$('.mfp-title').html(output);
				}
			}
		});
	});

	$('.js-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: '.mfp-image, .mfp-video', // the container for each your gallery items
			mainClass: 'mfp-fade',
			closeOnBgClick: true,
			closeBtnInside: false,
			image: {
				markup:
				'<div class="mfp-figure">' +
					'<div class="mfp-img"></div>' +
					'<div class="mfp-bottom-bar">' +
						'<div class="mfp-title"></div>' +
						'<div class="mfp-counter"></div>' +
					'</div>' +
				'</div>'
			},
			iframe: {
				markup:
				'<div class="mfp-figure">'+
					'<div class="mfp-iframe-scaler">'+
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					'</div>'+
					'<div class="mfp-bottom-bar">' +
						'<div class="mfp-title mfp-title--video"></div>' +
						'<div class="mfp-counter"></div>' +
					'</div>' +
				'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: function(url){
							var video_id = url.split('v=')[1];
							var ampersandPosition = video_id.indexOf('&');
							if(ampersandPosition != -1) {
								video_id = video_id.substring(0, ampersandPosition);
							}

							return video_id;
						}, // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},
					youtu_be: {
						index: 'youtu.be/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: '.be/', // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},

					vimeo: {
						index: 'vimeo.com/',
						id: '/',
						src: '//player.vimeo.com/video/%id%'
					},
					gmaps: {
						index: '//maps.google.',
						src: '%id%&output=embed'
					}
					// you may add here more sources
				},
				srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true
			},
			callbacks:{
				change: function(item){
					$(this.content).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
					});
				},
				elementParse: function(item) {
					if (globalDebug) {console.log("Magnific Popup - Parse Element");}

					$(item).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", url+"?wmode=transparent");
					});
				},
				markupParse: function(template, values, item) {
					values.title = '<span class="title">' + item.el.attr('data-title') + '</span>' + '<span class="description">' + item.el.attr('data-caption') + '</span>';
				}
			}
		});
	});

}

var Nav = (function() {

    var navIsOpen   = false;

    function init() {

        $('.js-nav-toggle').on('touchstart click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            if (!navIsOpen) {
                showMenu();
            } else {
                hideMenu();
            }
        });

        if( $html.is('.no-touchevents') ) {
            $('.site-header').on('mouseleave', function () {
                setTimeout(hideMenu, 300);
            });
        }

        $('.js-mobile-nav-close').on('click', hideMenu);

        // touch menus
        $('.sub-menu-toggle').on('touchstart', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var $this = $(this);

            $this.toggleClass('is-toggled');
            $this.closest('.menu-item').children('ul').fadeToggle();
        });

    }

    function hideMenu() {

        if (!navIsOpen) return;

        if (windowWidth < 900) {
            $html.removeClass('scroll-lock');
        }

        $html.removeClass('nav--is-visible');

        navIsOpen = false;
    }

    function showMenu() {

        if (navIsOpen) return;

        if (windowWidth < 900) {
            $html.addClass('scroll-lock');
        }

        $html.addClass('nav--is-visible');

        navIsOpen = true;
    }

    return {
        init: init,
        hideMenu: hideMenu
    }
})();
/* --- Parallax Init --- */

var Parallax = (function() {

    var detectIE = false;

    var selector = '.js-hero',
        $covers = $(),
        amount = 0,
        initialized = false,
        bleed = 20;


    function initialize() {
        if (globalDebug) {console.group("parallax::initialize");}

        $covers = $();

        $(selector).each(function (i, hero) {

            $('#djaxHero').css('height', '');

            var $hero = $(hero),
                $target, $image, $slider, amount, distance, heroHeight, heroOffset, newHeight;

            amount          = computeAmountValue($hero);
            heroHeight      = $hero.outerHeight();
            heroOffset      = $hero.offset();
            newHeight       = heroHeight + (windowHeight - heroHeight) * amount;
            distance        = (windowHeight + heroHeight) * amount;

            $target         = $hero.children('.hero-slider');

            $covers         = $covers.add($hero);

            if ( Modernizr.touchevents ) {
                $('#djaxHero').height(heroHeight);
            }

            $target.removeAttr('style');

            $target.css('height', newHeight);
            $target.find('.hero').css('height', heroHeight);
            $target.css('top', (heroHeight - newHeight) * 0.5);
            $target.find('.hero').css('top', (heroHeight - newHeight) * -0.5);

            // prepare image / slider timeline
            var parallax = {
                start:      heroOffset.top - windowHeight,
                end:        heroOffset.top + heroHeight,
                distance:   distance,
                target:     $target
            };

            scaleImage($target.find('.hero-bg--image, .hero-bg--video'), amount);

            $hero.data('parallax', parallax);
        });

        initialized = true;
        update();

        if (globalDebug) {console.groupEnd();}
    }

    function update() {
        if ( ! initialized ) return;

        $covers.each(function (i, hero) {
            var $hero = $(hero),
                parallax = $(hero).data('parallax'),
                progress;


            if ( typeof parallax == "undefined" ) return;
            progress = (latestKnownScrollY - parallax.start) / (parallax.end - parallax.start);
            if (0 <= progress && 1 >= progress) {
                var travel = Math.round(parallax.distance * progress - parallax.distance * 0.5) + 'px';
                TweenMax.to($hero.find('.hero-bg--image, .hero-bg--map, .hero-bg--video'), 0, {y: travel});
            }
        });

    }

    function computeAmountValue($hero) {
        var myAmount = 0.5,
            speeds = {
                static: 0,
                slow:   0.25,
                medium: 0.5,
                fast:   0.75,
                fixed:  1
            };

        // let's see if the user wants different speed for different whateva'
        if (typeof parallax_speeds !== "undefined") {
            $.each(speeds, function(speed, value) {
                if (typeof parallax_speeds[speed] !== "undefined") {
                    if ($hero.is(parallax_speeds[speed])) {
                        myAmount = value;

                    }
                }
            });
        }

        return myAmount;
    }

    return {
        initialize: initialize,
        update: update
    }

})();

var Pile = (function() {

    function initialize() {
        if (globalDebug) { console.group("pile::initialize"); }

        $('.pile-item').each(function (i, item) {

            var $item       = $(item),
                itemOffset  = $item.offset(),
                itemHeight  = $item.outerHeight(),
                stickTop    = itemOffset.top - windowHeight,
                timeline    = new TimelineMax({paused: true}),
                isArchive   = $item.hasClass('pile-item--archive');

            $item.data('height', itemHeight);

            if ( isArchive || latestKnownScrollY > stickTop ) {
                $item.addClass('is-visible');
            }

            $item.data('stickTop', stickTop);
        });

        $portfolio_container = $('.pile--portfolio-archive');

        if ( ! $portfolio_container.length || ! $portfolio_container.hasClass('infinite-scroll') ) {
            if (globalDebug) { console.groupEnd(); }
            return;
        }

        // if there are not sufficient projects to have scroll - load the next page also (prepending)
        if ( $portfolio_container.children('.pile-item--archive').last().offset().top < window.innerHeight ) {
            loadNextProjects();
        }

        if (globalDebug) { console.groupEnd(); }
    }

	function refresh() {
        if (globalDebug) { console.group("pile::refresh"); }

        $portfolio_container = $('.pile--portfolio-archive');

        $('.pile-item').each(function (i, item) {
            var $item       = $(item),
                itemOffset  = $item.offset(),
                stickTop    = itemOffset.top - windowHeight;

            $item.data('stickTop', stickTop);
        });

        update();

        if (globalDebug) { console.groupEnd(); }
	}

	function update() {
        maybeloadNextProjects();

        $('.pile-item--single').each(function (i, item) {

            var $item       = $(item),
                itemHeight  = $item.data('height'),
                stickTop    = $item.data('stickTop'),
                timeline    = $item.data('pile');

            if ('up' == scrollDirection && latestKnownScrollY <= stickTop + itemHeight / 2) {
                $item.removeClass('is-visible');
                return;
            }

            if ('down' == scrollDirection && latestKnownScrollY > stickTop) {
                $item.addClass('is-visible');
            }
		});
	}

    function loadNextProjects() {
        var $portfolio_container = $('.pile--portfolio-archive'),
            offset = $portfolio_container.find('.pile-item--archive').length;

        if (globalDebug) {console.log("Loading More Projects - AJAX Offset = " + offset);}

        isLoadingProjects = true;

        var args = {
            action : 'pile_load_next_projects',
            nonce : pile_ajax.nonce,
            offset : offset,
            pageid: $portfolio_container.data('pageid')
        };

        if ( !empty($portfolio_container.data('taxonomy')) ) {
            args['taxonomy'] = $portfolio_container.data('taxonomy');
            args['term_id'] = $portfolio_container.data('termid');
        }

        $.post(
            ajaxurl,
            args,
            function(response_data) {

                if( response_data.success ){
                    if (globalDebug) {console.log("Loaded next projects");}

                    var $result = $( response_data.data.posts).filter('.pile-item--archive');

                    if (globalDebug) {console.log("Adding new "+$result.length+" items to the DOM");}

                    $result.imagesLoaded(function() {
                        $portfolio_container.append( $result );
                        $window.trigger('infiniteLoad');
                        isLoadingProjects = false;
                    });
                } else {
                    // we have failed
                    // it's time to call it a day
                    if (globalDebug) {console.log("It seems that there are no more projects to load");}

                    $('.pagination--archive').fadeOut();

                    // don't make isLoadingProjects true so we won't load any more projects
                }
            }
        );
    }

    function maybeloadNextProjects() {
        var $portfolio_container = $('.pile--portfolio-archive');

        if ( ! $portfolio_container.length || ! $portfolio_container.hasClass('infinite-scroll') || isLoadingProjects ) {
            return;
        }

        var $lastChild = $portfolio_container.children('.pile-item--archive').last();

        // if the last child is in view then load more projects
        if ( $lastChild.is(':appeared') ) {
            loadNextProjects();
        }
    }

    return {
        initialize: initialize,
        update: update
    }

})();
// Platform Detection
function getIOSVersion(ua) {
    ua = ua || navigator.userAgent;
    return parseFloat(
        ('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(ua) || [0,''])[1])
            .replace('undefined', '3_2').replace('_', '.').replace('_', '')
    ) || false;
}

function getAndroidVersion(ua) {
    var matches;
    ua = ua || navigator.userAgent;
    matches = ua.match(/[A|a]ndroid\s([0-9\.]*)/);
    return matches ? matches[1] : false;
}

function platformDetect() {

    var navUA           = navigator.userAgent.toLowerCase(),
        navPlat         = navigator.platform.toLowerCase();

    isiPhone        = /iphone|ipod/.test( navUA );
    isiPad          = navUA.match(/iPad/i) != null;
    isiPod          = navPlat.indexOf("ipod");
    isAndroidPhone  = navPlat.indexOf("android");
    isSafari        = navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1;
    isIE            = typeof (is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window);
    ieMobile        = ua.match(/Windows Phone/i) ? true : false;
    iOS             = getIOSVersion();
    android         = getAndroidVersion();
    isMac           = navigator.platform.toUpperCase().indexOf('MAC')>=0;

    if (Modernizr.touch) {
        $html.addClass('touch');
    }

    if (iOS && iOS < 8) {
        $html.addClass('no-scroll-fx');
    }

    if (isIE) {
        $html.addClass('is--ie');
    }

    if (ieMobile) {
        $html.addClass('is--ie-mobile');
    }
}
/* --- $VIDEOS --- */

// function used to resize videos to fit their containers by keeping the original aspect ratio
function initVideos() {
    if (globalDebug) {console.group("videos::init");}

    var videos = $('.youtube-player, .entry-media iframe, .entry-media video, .entry-media embed, .entry-media object, iframe[width][height]');

    // Figure out and save aspect ratio for each video
    videos.each(function () {
        $(this).attr('data-aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');
    });

    resizeVideos();

    // Firefox Opacity Video Hack
    $('iframe').each(function () {
        var url = $(this).attr("src");
        if (!empty(url))
            $(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
    });

    if (globalDebug) {console.groupEnd();}
}

function resizeVideos() {
    if (globalDebug) {console.group("videos::resize");}

    var videos = $('.youtube-player, .entry-media iframe, .entry-media video, .entry-media embed, .entry-media object, iframe[data-aspectRatio]');

    videos.each(function () {
        var video = $(this),
            ratio = video.attr('data-aspectRatio'),
            w = video.css('width', '100%').width(),
            h = w / ratio;

        video.height(h);
    });

    if (globalDebug) {console.groupEnd();}
}
/* --- Royal Slider Init --- */

function royalSliderInit($container) {
	$container = typeof $container !== 'undefined' ? $container : $('body');

	// Transform Wordpress Galleries to Sliders
	$container.find('.wp-gallery').each(function () {
		sliderMarkupGallery($(this));
	});

	// Find and initialize each slider
	$container.find('.js-pixslider').each(function () {

		var $slider = $(this);

		if ( $slider.children().length < 2 ) {
			return;
		}

		sliderInit($slider);

		var slider = $slider.data('royalSlider');

		var firstSlide 			= slider.slides[0],
			firstSlideContent 	= $(firstSlide.content),
			$video 				= firstSlideContent.hasClass('video') ? firstSlideContent : firstSlideContent.find('.video'),
			firstSlideAutoPlay 	= typeof $video.data('video_autoplay') !== "undefined";


		var lastSlide = slider.currSlideId;

		if ( $slider.closest('.js-hero').length ) {
			// autoplay the first slide
			firstSlide.holder.on('rsAfterContentSet', function () {
				if ( firstSlideAutoPlay ) {
					slider.playVideo();
				}
			});

			var $video = $(firstSlide.holder).find('video');
			if ($video.length) {
				$video.get(0).play();
			}

			slider.ev.on('rsBeforeAnimStart', function(event) {
				requestAnimationFrame(Parallax.initialize);

				$('.slider-arrows-header').addClass('is--inactive');
				setTimeout(function() {
					$('.slider-arrows-header').removeClass('is--inactive');
				}, 1000);

				var $slide = slider.currSlide.holder,
					slideWidth = $slide.width(),
					move = 300,
					direction = 1;

				$(slider.slides).each(function(i, obj) {
					$(obj.holder).css('z-index', 1);
				});

				$slide.css('z-index', 2);

				if (lastSlide == slider.currSlideId - 1 || (lastSlide == slider.slides.length - 1) && slider.currSlideId === 0) {
					direction = -1;
				}

				var $lastSlide = $(slider.slides[lastSlide].holder),
					$lastVideo = $lastSlide.find('video'),
					$video = $slide.find('video');

				if ( $video.length ) {
					if ( isiPhone ) {
						makeVideoPlayableInline( $video.get(0), /* hasAudio */ false);
					}
					$video.get(0).play();
				}

				TweenMax.to($slide.find('.hero-content'), 0, {x: 0, ease: Quart.easeInOut});
				TweenMax.fromTo($slide, 1, {x: slideWidth * direction * -1}, {x: 0, ease: Quart.easeInOut});
				TweenMax.fromTo($slide.children(), 1, {x: (slideWidth - move) * direction}, {x: 0, ease: Quart.easeInOut});

				TweenMax.fromTo($slide.find('.hero-content'), 1, {x: move * direction}, {x: 0, ease: Quart.easeInOut});

				TweenMax.to($slide.find('.hero-content'), 0, {opacity: 0, ease: Quad.easeOut});
				setTimeout(function() {
					TweenMax.to($slide.find('.hero-content'), .5, {opacity: 1, ease: Quad.easeOut});
				}, 900);

				TweenMax.to($lastSlide, 1, {x: move * direction, ease: Quart.easeInOut});
				TweenMax.fromTo($lastSlide.find('.hero-content'), 1, {x: 0}, {x: move * direction * -1, ease: Quart.easeInOut});

				lastSlide = slider.currSlideId;

				slider.stopVideo();
			});

			slider.ev.on('rsAfterSlideChange', function(event) {

				var $slide_content 		= $(slider.currSlide.content),
					$video 				= $slide_content.hasClass('video') ? $slide_content : $slide_content.find('.video'),
					rs_videoAutoPlay 	= typeof $video.data('video_autoplay') !== "undefined";

				//autoplay videos on slide change
				if ( rs_videoAutoPlay || ieMobile || iOS || android ) {
					slider.stopVideo();
					slider.playVideo();
				}
			});
		}

		// after destroying a video remove the autoplay class (this way the image gets visible)
		slider.ev.on('rsOnDestroyVideoElement', function(i ,el){

			var $slide_content 		= $( this.currSlide.content),
				$video 				= $slide_content.hasClass('video') ? $slide_content : $slide_content.find('.video');

			$video.removeClass('video_autoplay');

		});

	});

}

/*
 * Slider Initialization
 */
function sliderInit($slider) {
	if (globalDebug) {
		console.log("Royal Slider Init");
	}

	$slider.find('img').removeClass('invisible');

	var $children                   = $slider.children(),
		rs_arrows                   = typeof $slider.data('arrows') !== "undefined",
		rs_bullets                  = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
		rs_autoheight               = typeof $slider.data('autoheight') !== "undefined",
		rs_autoScaleSlider          = false,
		rs_autoScaleSliderWidth     = typeof $slider.data('autoscalesliderwidth') !== "undefined" && $slider.data('autoscalesliderwidth') != '' ? $slider.data('autoscalesliderwidth') : false,
		rs_autoScaleSliderHeight    = typeof $slider.data('autoscalesliderheight') !== "undefined" && $slider.data('autoscalesliderheight') != '' ? $slider.data('autoscalesliderheight') : false,
		rs_customArrows             = typeof $slider.data('customarrows') !== "undefined",
		rs_slidesSpacing            = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
		rs_keyboardNav              = typeof $slider.data('fullscreen') !== "undefined",
		rs_imageScale               = $slider.data('imagescale'),
		rs_visibleNearby            = typeof $slider.data('visiblenearby') !== "undefined",
		rs_imageAlignCenter         = typeof $slider.data('imagealigncenter') !== "undefined",
		//rs_imageAlignCenter = false,
		rs_transition               = typeof $slider.data('slidertransition') !== "undefined" ? $slider.data('slidertransition') : 'fade',
		rs_transitionSpeed          = 1000,
		rs_autoPlay                 = typeof $slider.data('sliderautoplay') !== "undefined",
		rs_delay                    = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? parseFloat($slider.data('sliderdelay')) * 1000 : '1000',
		rs_drag                     = true,
		rs_globalCaption            = typeof $slider.data('showcaptions') !== "undefined",
		is_headerSlider             = $slider.hasClass('hero-slider') ? true : false,
		hoverArrows                 = typeof $slider.data('hoverarrows') !== "undefined";

	if (rs_autoheight) {
		rs_autoScaleSlider = false;
		rs_imageScale = 'none';
		rs_imageAlignCenter = false;
	} else {
		rs_autoheight = false;
		rs_autoScaleSlider = true;
	}

	// Single slide case
	if ($children.length == 1) {
		rs_arrows = false;
		rs_bullets = 'none';
		rs_keyboardNav = false;
		rs_drag = false;
		rs_customArrows = false;
	}

	// make sure default arrows won't appear if customArrows is set
	if (rs_customArrows) rs_arrows = false;

	//the main params for Royal Slider
	var royalSliderParams = {
		autoHeight: rs_autoheight,
		autoScaleSlider: rs_autoScaleSlider,
		loop: true,
		navigateByClick: false,
		autoScaleSliderWidth: rs_autoScaleSliderWidth,
		autoScaleSliderHeight: rs_autoScaleSliderHeight,
		imageScaleMode: rs_imageScale,
		imageAlignCenter: rs_imageAlignCenter,
		slidesSpacing: rs_slidesSpacing,
		arrowsNav: rs_arrows,
		controlNavigation: rs_bullets,
		keyboardNavEnabled: rs_keyboardNav,
		arrowsNavAutoHide: false,
		sliderDrag: rs_drag,
		transitionType: rs_transition,
		transitionSpeed: rs_transitionSpeed,
		imageScalePadding: 0,
		autoPlay: {
			enabled: rs_autoPlay,
			stopAtAction: true,
			pauseOnHover: true,
			delay: rs_delay
		},
		globalCaption: rs_globalCaption,
		numImagesToPreload: 2,
		video: {
			// video options go here
			autoHideArrows: false,
			autoHideControlNav: false,
			autoHideBlocks: false
		}
	};

	if (rs_visibleNearby) {
		royalSliderParams['visibleNearby'] = {
			enabled: true,
			center: true,
			breakpoint: 0,
			//breakpointCenterArea: 0.64,
			navigateByCenterClick: false
		}
	}

	//lets fire it up
	$slider.royalSlider(royalSliderParams);

	var royalSlider = $slider.data('royalSlider' ),
		slidesNumber = royalSlider.numSlides;

	// create the markup for the customArrows
	//don't need it if we have only one slide
	if (royalSlider && rs_customArrows && slidesNumber > 1 ) {

		var classes = '';

		if (is_headerSlider) classes = 'slider-arrows-header';
		if (hoverArrows && !Modernizr.touch) classes += ' arrows--hover ';

		var $gallery_control = $(
			'<div class="' + classes + '">' +
			'<div class="rsArrow rsArrowLeft js-arrow-left" style="display: block;"><div class="rsArrowIcn"></div></div>' +
			'<div class="rsArrow rsArrowRight js-arrow-right" style="display: block;"><div class="rsArrowIcn"></div></div>' +
			'</div>'
		);

		if ($slider.data('customarrows') == "left") {
			$gallery_control.addClass('gallery-control--left');
		}

		$gallery_control.insertBefore($slider);

		$gallery_control.on('click', '.js-arrow-left', function (event) {
			event.preventDefault();
			royalSlider.prev();
		});

		$gallery_control.on('click', '.js-arrow-right', function (event) {
			event.preventDefault();
			royalSlider.next();
		});

		if (hoverArrows && !Modernizr.touch) {
			hoverArrow( $('.slider-arrows-header .rsArrow') );
		}
	}

	$slider.find('.rsNav').insertAfter($slider);

	setTimeout(function() {
		$slider.closest('.hero').addClass('slider--loaded');
	}, 10);
}

/*
 * Wordpress Galleries to Sliders
 * Create the markup for the slider from the gallery shortcode
 * take all the images and insert them in the .gallery <div>
 */
function sliderMarkupGallery($gallery) {
	var $old_gallery = $gallery,
		gallery_data = $gallery.data(),
		$images = $old_gallery.find('img'),
		$new_gallery = $('<div class="pixslider js-pixslider">');

	$images.prependTo($new_gallery).addClass('rsImg');

	//add the data attributes
	$.each(gallery_data, function (key, value) {
		$new_gallery.attr('data-' + key, value);
	});

	$old_gallery.replaceWith($new_gallery);
}

/*
 Get slider arrows to hover, following the cursor
 */

function hoverArrow($arrow) {
	var $mouseX = 0, $mouseY = 0;
	var $arrowH = 35, $arrowW = 35;

	$arrow.mouseenter(function (e) {
		$(this).addClass('visible');

		moveArrow($(this));
	});

	var $loop;

	function moveArrow($arrow) {
		var $mouseX;
		var $mouseY;

		$arrow.mousemove(function (e) {
			$mouseX = e.pageX - $arrow.offset().left - 40;
			$mouseY = e.pageY - $arrow.offset().top - 40;

			var $arrowIcn = $arrow.find('.rsArrowIcn');
			TweenMax.to($arrowIcn, 0, {x: $mouseX, y: $mouseY, z: 0.01});
		});

		$arrow.mouseleave(function (e) {
			$(this).removeClass('visible').removeClass('is--scrolled');
			clearInterval($loop);
		});

		$(window).scroll(function() {
			if($arrow.hasClass('visible')){

				$arrow.addClass('is--scrolled');

				clearTimeout($.data(this, 'scrollTimer'));
				$.data(this, 'scrollTimer', setTimeout(function() {
					$arrow.removeClass('is--scrolled');
				}, 100));
			}
		});
	}
}
function smoothScrollTo(y, speed) {

    speed = typeof speed == "undefined" ? 1 : speed;

    var distance = Math.abs(latestKnownScrollY - y),
        time     = speed * distance / 2000;

    TweenMax.to($(window), time, {scrollTo: {y: y, autoKill: true, ease: Quint.easeInOut}});
}
var Videos = (function() {
	var $hero = $('.js-hero'),
		$mejs, $video,
		videoWidth, videoHeight, headerWidth, headerHeight;

	function init() {
		$video 			= $hero.find('video');

    	if ( ! $video.length ) return;

	    videoWidth      = $video.outerWidth();
	    videoHeight     = $video.outerHeight();
	    headerWidth     = $hero.outerWidth();
	    headerHeight    = $hero.outerHeight();

        $video.prop('muted', true);

    	stretch();
    	setTimeout(function(){
			$video.get(0).play();
    	}, 100);

        $window.on('debouncedresize', function() {
            headerWidth     = $hero.outerWidth();
            headerHeight    = $hero.outerHeight();
            stretch();
        });

	}

	function stretch() {

		var newWidth, newHeight;

		if ( (videoWidth/videoHeight) > (headerWidth/headerHeight) ) {
			newHeight = headerHeight;
			newWidth = newHeight * videoWidth / videoHeight;
		} else {
			newWidth = headerWidth;
			newHeight = newWidth * videoHeight / videoWidth;
		}

		$video.css({
			width: newWidth,
			height: newHeight
		});
	}

	return {
		init: init
	}
})();
var $window             = $(window),
    $document           = $(document),
    $html               = $('html'),
    $body               = $('body'),
    // needed for browserSize
    windowWidth         = window.innerWidth,
    windowHeight        = window.innerHeight,
    orientation         = windowWidth > windowHeight ? 'landscape' : 'portrait',
    documentHeight      = $document.height(),
    // needed for requestAnimationFrame
    knownScrollY        = -1,
    latestKnownScrollY  = window.scrollY,
    scrollDirection     = 'down',
    resized             = true,
    scrolled            = true,
    isLoadingProjects   = false,
    $portfolio_container;

if ( window.location.hash.indexOf('comment') > -1 ) {
    $html.css('opacity', 0);
    window.location.href = window.location.href.split('#')[0];
}

fixWindowHeight();

function fixWindowHeight() {
    if ( Modernizr.touchevents && typeof window.screen.height !== "undefined" && orientation == 'portrait' ) {
        windowHeight = window.screen.height;
    }
}

function onResize() {
    var newOrientation;

    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;
    documentHeight = $document.height();
    newOrientation = windowWidth > windowHeight ? 'landscape' : 'portrait';
    fixWindowHeight();

    if ( ! Modernizr.touchevents || newOrientation !== orientation ) {
        orientation = newOrientation;
        fixWindowHeight();
        resizeVideos();
        requestAnimationFrame(refresh);
    }
}

$(document).on('ready', function() {
    init();
});

function init() {
    if (globalDebug) {console.group("global::init");}

    var iexplore = getInternetExplorerVersion();
    if ( iexplore ) { $body.addClass('is--ie is--ie-' + iexplore); }

    eventHandlersOnce();
    eventHandlers();

    if (globalDebug) {console.groupEnd();}
}

function onDocumentReady() {
    if (globalDebug) {console.log("document.ready");}

    $html.addClass('is-ready');

    platformDetect();
    loadAddThisScript();
    AjaxLoading.init();

    loadingAnimation.init();
    updateLoop();

    $('.article').addClass('post--loaded');
}

function refresh() {
    Parallax.initialize();
    ArchiveParallax.initialize();
    Pile.initialize();
    Header.init();

    $('.hero--next').imagesLoaded(function() {
        scaleImage($('.hero--next').find('img, video'));
    });
}



/* ====== CONDITIONAL LOADING ====== */

function onLoad() {
    if (globalDebug) {console.group("global::onLoad");}

    initVideos();
    resizeVideos();
    Nav.init();
    magnificPopupInit();

    var $masonry = $('.masonry');
    $masonry.imagesLoaded(function() {
        $masonry.masonry({ transitionDuration: 0 });
    });

    $('.pixcode--tabs').organicTabs();

    if (typeof woocommerce_events_handlers == 'function') {
        woocommerce_events_handlers();
    }

    $('.video-placeholder').each(function(i, obj) {
        var $placeholder = $(obj),
            video = document.createElement('video'),
            $video = $(video).addClass('hero-bg hero-bg--video');

        video.onloadedmetadata = function() {
            scaleImage($video);
            video.play();
        };

        video.src       = $placeholder.data('src');
        video.poster    = $placeholder.data('poster');
        video.muted     = true;
        video.loop      = true;
        $placeholder.replaceWith($video);

        if ( Modernizr.touchevents ) {
            // if ( isiPhone ) {
                makeVideoPlayableInline( video, /* hasAudio */ false);
            // }
        }

    });

    requestAnimationFrame(refresh);
    royalSliderInit();
    handleCustomCSS();

    $('iframe').each(function() {
        var $iframe = $(this),
            url = $iframe.attr("src");
        $iframe.attr("src",url+"?wmode=transparent");
        $iframe.on('load', resizeVideos);
    });

    if ( $body.is('.js-open-cart') ) {
        TweenMax.to($body, .3, {opacity: 1});
        $body.addClass('is-cart-open');
    }

    loadDynamicScripts();

    if (globalDebug) {console.groupEnd();}
}

function handleCustomCSS() {
    var $element, css;

    $element = $('#customCSS');

    if ( $element.length ) {
        css = $element.data('css');

        if ( typeof css !== "undefined" ) {
            $('<style type="text/css">' + css + '</style>').insertAfter($element);
            $element.remove();
        }
    }
}

function loadDynamicScripts() {
    if ( ! window.hasOwnProperty('pile_static_resources') ) return;

    var $scripts = $('#pile_scripts_and_styles'),
        scripts = $scripts.data('scripts'),
        styles = $scripts.data('styles');

    // pile_dynamic_loaded_scripts is generated in footer when all the scripts should be already enqueued
    $.each(scripts, function (key, url) {
        if (key in pile_static_resources.scripts) return;

        // add this script to our global stack so we don't enqueue it again
        pile_static_resources.scripts[key] = url;

        $.ajaxSetup({
            cache: true,
            async: false
        });

        jQuery.ajax({
            async:false,
            type:'GET',
            url:url,
            data:null,
            success:function (script, textStatus) {
//                                  console.log(textStatus);
                $(document).trigger('pile' + key + ':script:loaded');
            },
            fail:function (script, textStatus) {
//                                  console.log(textStatus);
                console.log('could not load ' + key + ' script');
            },
            dataType:'script'
        });

        if (globalDebug) {
            console.groupEnd();
        }

    });

    $(document).trigger('pile:dynamic_scripts:loaded');

    $.each(styles, function (key, url) {

        if (key in pile_static_resources.styles) return;

        // add this style to our global stack so we don't enqueue it again
        pile_static_resources.styles[key] = url;

        $.ajax({
            cache: true,
            async: true,
            url: url,
            dataType: 'html',
            success: function (data) {
                $('<style type="text/css">\n' + data + '</style>').appendTo("head");
            }
        });

        if (globalDebug) {
            console.groupEnd();
        }

    });
    $(document).trigger('pile:dynamic_styles:loaded');
}

/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {
    if (globalDebug) {console.group("eventHandlers::once");}

    copyrightOverlayInit();

    $('a[href="#top"]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        smoothScrollTo(0);
    });

    var resizeTimer;

    $window.on('resize', function(e) {

        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Run code here, resizing has "stopped"
            $window.trigger('debouncedresize');
            onResize();
        }, 250);

    });


    $window.scroll(onScroll);
    $window.load(function() {
        if (globalDebug) {console.log("window.load");}
        $html.addClass('is-loaded');
        onLoad();
        loadingAnimation.play();
    });

    $document.ready(onDocumentReady);

    $document.on('post-load', function () {
        if (globalDebug) {console.log("Jetpack Post load");}

        initVideos();
        resizeVideos();

        // figure out which are the new loaded posts
        var $newBlocks = $('.masonry').children().not('.post--loaded').addClass('post--loaded').filter('.article');

        $newBlocks.imagesLoaded(function () {
            $('.masonry').masonry('appended', $newBlocks, true).masonry('layout');
        });

    });

    if (globalDebug) {console.groupEnd();}
}

function eventHandlers() {
    if (globalDebug) {console.group("eventHandlers");}

    // var nextVideoTimeout;

    // $('.hero--next').hover(function() {
    //     $(this).find('video').each(function(i, video) {
    //         clearTimeout(nextVideoTimeout);
    //         video.play();
    //     });
    // }, function() {
    //     $(this).find('video').each(function(i, video) {
    //         nextVideoTimeout = setTimeout(function() {
    //             video.pause();
    //         }, 300);
    //     });
    // });

    $body.on('click touchstart .cart-widget', function(e) {
        var $target = $(e.target);

        if ( $target.is('.cart-widget') ) {
            $body.removeClass('is-cart-open');

            // Prevent click event from bubbling
            // onto other element beneath cart widget
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $('.hero-bg--map').on('click', function() {
        $(this).addClass('is-active');
    });

    // Scroll Down Arrows on Full Height Hero
    $('.hero-scroll-down').on('click', function(e) {
        smoothScrollTo(windowHeight);
    });

    var $thumbnails = $('.js-post-gallery .thumbnails'),
        $images = $('.js-post-gallery .big-images');

    $thumbnails.on('click', 'a', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $item = $(this),
            index = $item.index();

        $thumbnails.children().removeClass('current').eq(index).addClass('current');
        $images.children().removeClass('current').eq(index).addClass('current');

        return false;
    });

    $('.js-cart-icon').on('click', function(e) {
        $body.addClass('is-cart-open');
        e.preventDefault();
    });

    $document.keyup(function(e){
        if (e.keyCode === 27) {
            $body.removeClass('is-cart-open');
        }
    });

    if (globalDebug) {console.groupEnd();}
}


function onScroll(e) {
    latestKnownScrollY = $(this).scrollTop();
}

var scheduledAnimationFrame = false;

function updateLoop() {
    if (scheduledAnimationFrame) return;
    scheduledAnimationFrame = true;

    if ( knownScrollY !== latestKnownScrollY ) {
        scrollDirection = latestKnownScrollY > knownScrollY ? 'down' : 'up';
        knownScrollY = latestKnownScrollY;
        update();
    }

    requestAnimationFrame(function() {
        scheduledAnimationFrame = false;
        updateLoop();
    });

    scrolled = false;
    resized = false;
}

function update() {
    Parallax.update();
    ArchiveParallax.update();
    Pile.update();
    Header.update();
}


// here we change the link of the Edit button in the Admin Bar
// to make sure it reflects the current page
function adminBarEditFix(id, editString, taxonomy) {
	//get the admin ajax url and clean it
	var baseEditURL = ajaxurl.replace('admin-ajax.php','post.php'),
		baseEditTaxURL = ajaxurl.replace('admin-ajax.php','edit-tags.php'),
		$editButton = $('#wp-admin-bar-edit a');

	if ( !empty($editButton) ) {
		if ( id !== undefined && editString !== undefined ) { //modify the current Edit button
			if (!empty(taxonomy)) { //it seems we need to edit a taxonomy
				$editButton.attr('href', baseEditTaxURL + '?tag_ID=' + id + '&taxonomy=' + taxonomy + '&action=edit');
			} else {
				$editButton.attr('href', baseEditURL + '?post=' + id + '&action=edit');
			}
			$editButton.html(editString);
		} else { //we have found an edit button but right now we don't need it anymore since we have no id
			$('#wp-admin-bar-edit').remove();
		}
	} else { //upss ... no edit button
		//lets see if we need one
		if ( id !== undefined && editString !== undefined ) { //we do need one after all
			//locate the New button because we need to add stuff after it
			var $newButton = $('#wp-admin-bar-new-content');

			if (!empty($newButton)) {
				if (!empty(taxonomy)) { //it seems we need to generate a taxonomy edit thingy
					$newButton.after('<li id="wp-admin-bar-edit"><a class="ab-item dJAX_internal" href="' + baseEditTaxURL + '?tag_ID=' + id + '&taxonomy=' + taxonomy + '&action=edit">' + editString + '</a></li>');
				} else { //just a regular edit
					$newButton.after('<li id="wp-admin-bar-edit"><a class="ab-item dJAX_internal" href="' + baseEditURL + '?post=' + id + '&action=edit">' + editString + '</a></li>');
				}
			}
		}
	}

	//Also we need to fix the (no-)customize-support class on body by running the WordPress inline script again
	// The original code is generated by the wp_customize_support_script() function in wp-includes/theme.php @2145
	var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

	request = true;

	b[c] = b[c].replace( rcs, ' ' );
	b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;

	//Plus, we need to change the url of the Customize button to the current url
	var $customizeButton = $('#wp-admin-bar-customize a'),
		baseCustomizeURL = ajaxurl.replace('admin-ajax.php','customize.php');
	if ( ! empty( $customizeButton ) ) {
		$customizeButton.attr( 'href', baseCustomizeURL + '?url=' + encodeURIComponent( window.location.href ) );
	}

}

/* --- Load AddThis Async --- */
function loadAddThisScript() {
	if (window.addthis) {
		if (globalDebug) {console.log("addthis::Load Script");}
		// Listen for the ready event
		addthis.addEventListener('addthis.ready', addthisReady);
		addthis.init();
	}
}

/* --- AddThis On Ready - The API is fully loaded --- */
//only fire this the first time we load the AddThis API - even when using ajax
function addthisReady() {
	if (globalDebug) {console.log("addthis::Ready");}
	addThisInit();
}

/* --- AddThis Init --- */
function addThisInit() {
	if (window.addthis) {
		if (globalDebug) {console.log("addthis::Toolbox INIT");}

		addthis.toolbox('.js-share-icons');
	}
}

/* --- Do all the cleanup that is needed when going to another page with dJax --- */
function cleanupBeforeDJax() {
	if (globalDebug) {console.group("djax::Cleanup Before dJax");}

	/* --- KILL ROYALSLIDER ---*/
	var sliders = $('.js-pixslider');
	if (!empty(sliders)) {
		sliders.each(function() {
			var slider = $(this).data('royalSlider');
			if (!empty(slider)) {
				slider.destroy();
			}
		});
	}

	/* --- KILL MAGNIFIC POPUP ---*/
	//when hitting back or forward we need to make sure that there is no rezidual Magnific Popup
	$.magnificPopup.close(); // Close popup that is currently opened (shorthand)

    if (globalDebug) {console.groupEnd();}

}

function loadUpDJaxOnly(data) {
	if (globalDebug) {console.group("djax::loadup - dJaxOnly");}

	//fire the AddThis reinitialization separate from loadUp()
	//because on normal load we want to fire it only after the API is fully loaded - addthisReady()
	addThisInit();

	//find and initialize Tiled Galleries via Jetpack
	if ( typeof tiledGalleries !== "undefined" ) {
		if (globalDebug) {console.log("Find and setup new galleries - Jetpack");}
		tiledGalleries.findAndSetupNewGalleries();
	}

	//lets do some Google Analytics Tracking
	if (window._gaq) {
		_gaq.push(['_trackPageview']);
	}

	if (globalDebug) {console.groupEnd();}
}

function scaleImage($image, amount) {

    amount = (typeof amount == "undefined") ? 1 : amount;

    $image.imagesLoaded(function() {
	    $image.each(function(i, image) {

	        var $image = $(image);

	        $image.css({
	            width: '',
	            top: '',
	            left: ''
	        });

	        var imageWidth  = $image.outerWidth(),
	            imageHeight = $image.outerHeight(),
	            $hero       = $image.parent(),
	            heroHeight  = $hero.outerHeight(),
	            scaleX      = (windowWidth + 2) / imageWidth,
	            scaleY      = (heroHeight + (windowHeight - heroHeight) * amount + 2) / imageHeight,
	            scale       = Math.max(scaleX, scaleY);

	        $image.css({
	        	width: imageWidth * scale,
	            top: (heroHeight - imageHeight * scale) / 2,
	            left: (windowWidth - imageWidth * scale) / 2
	        });
	    });
    });
}

function getInternetExplorerVersion() {
  var rv = false;
  if (navigator.appName == 'Microsoft Internet Explorer') {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  } else if (navigator.appName == 'Netscape') {
    var ua = navigator.userAgent;
    var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

})(jQuery, window);
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define("Barba", [], factory);
	else if(typeof exports === 'object')
		exports["Barba"] = factory();
	else
		root["Barba"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "http://localhost:8080/dist";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	//Promise polyfill https://github.com/taylorhakes/promise-polyfill

	if (typeof Promise !== 'function') {
	 window.Promise = __webpack_require__(1);
	}

	var Barba = {
	  version: '0.0.10',
	  BaseTransition: __webpack_require__(4),
	  BaseView: __webpack_require__(6),
	  BaseCache: __webpack_require__(8),
	  Dispatcher: __webpack_require__(7),
	  HistoryManager: __webpack_require__(9),
	  Pjax: __webpack_require__(10),
	  Prefetch: __webpack_require__(13),
	  Utils: __webpack_require__(5)
	};

	module.exports = Barba;


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(setImmediate) {(function (root) {

	  // Store setTimeout reference so promise-polyfill will be unaffected by
	  // other code modifying setTimeout (like sinon.useFakeTimers())
	  var setTimeoutFunc = setTimeout;

	  function noop() {
	  }

	  // Use polyfill for setImmediate for performance gains
	  var asap = (typeof setImmediate === 'function' && setImmediate) ||
	    function (fn) {
	      setTimeoutFunc(fn, 0);
	    };

	  var onUnhandledRejection = function onUnhandledRejection(err) {
	    if (typeof console !== 'undefined' && console) {
	      console.warn('Possible Unhandled Promise Rejection:', err); // eslint-disable-line no-console
	    }
	  };

	  // Polyfill for Function.prototype.bind
	  function bind(fn, thisArg) {
	    return function () {
	      fn.apply(thisArg, arguments);
	    };
	  }

	  function Promise(fn) {
	    if (typeof this !== 'object') throw new TypeError('Promises must be constructed via new');
	    if (typeof fn !== 'function') throw new TypeError('not a function');
	    this._state = 0;
	    this._handled = false;
	    this._value = undefined;
	    this._deferreds = [];

	    doResolve(fn, this);
	  }

	  function handle(self, deferred) {
	    while (self._state === 3) {
	      self = self._value;
	    }
	    if (self._state === 0) {
	      self._deferreds.push(deferred);
	      return;
	    }
	    self._handled = true;
	    asap(function () {
	      var cb = self._state === 1 ? deferred.onFulfilled : deferred.onRejected;
	      if (cb === null) {
	        (self._state === 1 ? resolve : reject)(deferred.promise, self._value);
	        return;
	      }
	      var ret;
	      try {
	        ret = cb(self._value);
	      } catch (e) {
	        reject(deferred.promise, e);
	        return;
	      }
	      resolve(deferred.promise, ret);
	    });
	  }

	  function resolve(self, newValue) {
	    try {
	      // Promise Resolution Procedure: https://github.com/promises-aplus/promises-spec#the-promise-resolution-procedure
	      if (newValue === self) throw new TypeError('A promise cannot be resolved with itself.');
	      if (newValue && (typeof newValue === 'object' || typeof newValue === 'function')) {
	        var then = newValue.then;
	        if (newValue instanceof Promise) {
	          self._state = 3;
	          self._value = newValue;
	          finale(self);
	          return;
	        } else if (typeof then === 'function') {
	          doResolve(bind(then, newValue), self);
	          return;
	        }
	      }
	      self._state = 1;
	      self._value = newValue;
	      finale(self);
	    } catch (e) {
	      reject(self, e);
	    }
	  }

	  function reject(self, newValue) {
	    self._state = 2;
	    self._value = newValue;
	    finale(self);
	  }

	  function finale(self) {
	    if (self._state === 2 && self._deferreds.length === 0) {
	      asap(function() {
	        if (!self._handled) {
	          onUnhandledRejection(self._value);
	        }
	      });
	    }

	    for (var i = 0, len = self._deferreds.length; i < len; i++) {
	      handle(self, self._deferreds[i]);
	    }
	    self._deferreds = null;
	  }

	  function Handler(onFulfilled, onRejected, promise) {
	    this.onFulfilled = typeof onFulfilled === 'function' ? onFulfilled : null;
	    this.onRejected = typeof onRejected === 'function' ? onRejected : null;
	    this.promise = promise;
	  }

	  /**
	   * Take a potentially misbehaving resolver function and make sure
	   * onFulfilled and onRejected are only called once.
	   *
	   * Makes no guarantees about asynchrony.
	   */
	  function doResolve(fn, self) {
	    var done = false;
	    try {
	      fn(function (value) {
	        if (done) return;
	        done = true;
	        resolve(self, value);
	      }, function (reason) {
	        if (done) return;
	        done = true;
	        reject(self, reason);
	      });
	    } catch (ex) {
	      if (done) return;
	      done = true;
	      reject(self, ex);
	    }
	  }

	  Promise.prototype['catch'] = function (onRejected) {
	    return this.then(null, onRejected);
	  };

	  Promise.prototype.then = function (onFulfilled, onRejected) {
	    var prom = new (this.constructor)(noop);

	    handle(this, new Handler(onFulfilled, onRejected, prom));
	    return prom;
	  };

	  Promise.all = function (arr) {
	    var args = Array.prototype.slice.call(arr);

	    return new Promise(function (resolve, reject) {
	      if (args.length === 0) return resolve([]);
	      var remaining = args.length;

	      function res(i, val) {
	        try {
	          if (val && (typeof val === 'object' || typeof val === 'function')) {
	            var then = val.then;
	            if (typeof then === 'function') {
	              then.call(val, function (val) {
	                res(i, val);
	              }, reject);
	              return;
	            }
	          }
	          args[i] = val;
	          if (--remaining === 0) {
	            resolve(args);
	          }
	        } catch (ex) {
	          reject(ex);
	        }
	      }

	      for (var i = 0; i < args.length; i++) {
	        res(i, args[i]);
	      }
	    });
	  };

	  Promise.resolve = function (value) {
	    if (value && typeof value === 'object' && value.constructor === Promise) {
	      return value;
	    }

	    return new Promise(function (resolve) {
	      resolve(value);
	    });
	  };

	  Promise.reject = function (value) {
	    return new Promise(function (resolve, reject) {
	      reject(value);
	    });
	  };

	  Promise.race = function (values) {
	    return new Promise(function (resolve, reject) {
	      for (var i = 0, len = values.length; i < len; i++) {
	        values[i].then(resolve, reject);
	      }
	    });
	  };

	  /**
	   * Set the immediate function to execute callbacks
	   * @param fn {function} Function to execute
	   * @private
	   */
	  Promise._setImmediateFn = function _setImmediateFn(fn) {
	    asap = fn;
	  };

	  Promise._setUnhandledRejectionFn = function _setUnhandledRejectionFn(fn) {
	    onUnhandledRejection = fn;
	  };

	  if (typeof module !== 'undefined' && module.exports) {
	    module.exports = Promise;
	  } else if (!root.Promise) {
	    root.Promise = Promise;
	  }

	})(this);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(2).setImmediate))

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(setImmediate, clearImmediate) {var nextTick = __webpack_require__(3).nextTick;
	var apply = Function.prototype.apply;
	var slice = Array.prototype.slice;
	var immediateIds = {};
	var nextImmediateId = 0;

	// DOM APIs, for completeness

	exports.setTimeout = function() {
	  return new Timeout(apply.call(setTimeout, window, arguments), clearTimeout);
	};
	exports.setInterval = function() {
	  return new Timeout(apply.call(setInterval, window, arguments), clearInterval);
	};
	exports.clearTimeout =
	exports.clearInterval = function(timeout) { timeout.close(); };

	function Timeout(id, clearFn) {
	  this._id = id;
	  this._clearFn = clearFn;
	}
	Timeout.prototype.unref = Timeout.prototype.ref = function() {};
	Timeout.prototype.close = function() {
	  this._clearFn.call(window, this._id);
	};

	// Does not start the time, just sets up the members needed.
	exports.enroll = function(item, msecs) {
	  clearTimeout(item._idleTimeoutId);
	  item._idleTimeout = msecs;
	};

	exports.unenroll = function(item) {
	  clearTimeout(item._idleTimeoutId);
	  item._idleTimeout = -1;
	};

	exports._unrefActive = exports.active = function(item) {
	  clearTimeout(item._idleTimeoutId);

	  var msecs = item._idleTimeout;
	  if (msecs >= 0) {
	    item._idleTimeoutId = setTimeout(function onTimeout() {
	      if (item._onTimeout)
	        item._onTimeout();
	    }, msecs);
	  }
	};

	// That's not how node.js implements it but the exposed api is the same.
	exports.setImmediate = typeof setImmediate === "function" ? setImmediate : function(fn) {
	  var id = nextImmediateId++;
	  var args = arguments.length < 2 ? false : slice.call(arguments, 1);

	  immediateIds[id] = true;

	  nextTick(function onNextTick() {
	    if (immediateIds[id]) {
	      // fn.call() is faster so we optimize for the common use-case
	      // @see http://jsperf.com/call-apply-segu
	      if (args) {
	        fn.apply(null, args);
	      } else {
	        fn.call(null);
	      }
	      // Prevent ids from leaking
	      exports.clearImmediate(id);
	    }
	  });

	  return id;
	};

	exports.clearImmediate = typeof clearImmediate === "function" ? clearImmediate : function(id) {
	  delete immediateIds[id];
	};
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(2).setImmediate, __webpack_require__(2).clearImmediate))

/***/ },
/* 3 */
/***/ function(module, exports) {

	// shim for using process in browser

	var process = module.exports = {};
	var queue = [];
	var draining = false;
	var currentQueue;
	var queueIndex = -1;

	function cleanUpNextTick() {
	    if (!draining || !currentQueue) {
	        return;
	    }
	    draining = false;
	    if (currentQueue.length) {
	        queue = currentQueue.concat(queue);
	    } else {
	        queueIndex = -1;
	    }
	    if (queue.length) {
	        drainQueue();
	    }
	}

	function drainQueue() {
	    if (draining) {
	        return;
	    }
	    var timeout = setTimeout(cleanUpNextTick);
	    draining = true;

	    var len = queue.length;
	    while(len) {
	        currentQueue = queue;
	        queue = [];
	        while (++queueIndex < len) {
	            if (currentQueue) {
	                currentQueue[queueIndex].run();
	            }
	        }
	        queueIndex = -1;
	        len = queue.length;
	    }
	    currentQueue = null;
	    draining = false;
	    clearTimeout(timeout);
	}

	process.nextTick = function (fun) {
	    var args = new Array(arguments.length - 1);
	    if (arguments.length > 1) {
	        for (var i = 1; i < arguments.length; i++) {
	            args[i - 1] = arguments[i];
	        }
	    }
	    queue.push(new Item(fun, args));
	    if (queue.length === 1 && !draining) {
	        setTimeout(drainQueue, 0);
	    }
	};

	// v8 likes predictible objects
	function Item(fun, array) {
	    this.fun = fun;
	    this.array = array;
	}
	Item.prototype.run = function () {
	    this.fun.apply(null, this.array);
	};
	process.title = 'browser';
	process.browser = true;
	process.env = {};
	process.argv = [];
	process.version = ''; // empty string to avoid regexp issues
	process.versions = {};

	function noop() {}

	process.on = noop;
	process.addListener = noop;
	process.once = noop;
	process.off = noop;
	process.removeListener = noop;
	process.removeAllListeners = noop;
	process.emit = noop;

	process.binding = function (name) {
	    throw new Error('process.binding is not supported');
	};

	process.cwd = function () { return '/' };
	process.chdir = function (dir) {
	    throw new Error('process.chdir is not supported');
	};
	process.umask = function() { return 0; };


/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	var Utils = __webpack_require__(5);

	/**
	 * BaseTransition to extend
	 *
	 * @namespace Barba.BaseTransition
	 * @type {Object}
	 */
	var BaseTransition = {
	  /**
	   * @memberOf Barba.BaseTransition
	   * @type {HTMLElement}
	   */
	  oldContainer: undefined,

	  /**
	   * @memberOf Barba.BaseTransition
	   * @type {HTMLElement}
	   */
	  newContainer: undefined,

	  /**
	   * @memberOf Barba.BaseTransition
	   * @type {Promise}
	   */
	  newContainerLoading: undefined,

	  /**
	   * Helper to extend the object
	   *
	   * @memberOf Barba.BaseTransition
	   * @param  {Object} newObject
	   * @return {Object} newInheritObject
	   */
	  extend: function(obj){
	    return Utils.extend(this, obj);
	  },

	  /**
	   * This function is called from Pjax module to initialize
	   * the transition.
	   *
	   * @memberOf Barba.BaseTransition
	   * @private
	   * @param  {HTMLElement} oldContainer
	   * @param  {Promise} newContainer
	   * @return {Promise}
	   */
	  init: function(oldContainer, newContainer) {
	    var _this = this;

	    this.oldContainer = oldContainer;
	    this._newContainerPromise = newContainer;

	    this.deferred = Utils.deferred();
	    this.newContainerReady = Utils.deferred();
	    this.newContainerLoading = this.newContainerReady.promise;

	    this.start();

	    this._newContainerPromise.then(function(newContainer) {
	      _this.newContainer = newContainer;
	      _this.newContainerReady.resolve();
	    });

	    return this.deferred.promise;
	  },

	  /**
	   * This function needs to be called as soon the Transition is finished
	   *
	   * @memberOf Barba.BaseTransition
	   */
	  done: function() {
	    this.oldContainer.parentNode.removeChild(this.oldContainer);
	    this.newContainer.style.visibility = 'visible';
	    this.deferred.resolve();
	  },

	  /**
	   * Constructor for your Transition
	   *
	   * @memberOf Barba.BaseTransition
	   * @abstract
	   */
	  start: function() {},
	};

	module.exports = BaseTransition;


/***/ },
/* 5 */
/***/ function(module, exports) {

	/**
	 * Just an object with some helpful functions
	 *
	 * @type {Object}
	 * @namespace Barba.Utils
	 */
	var Utils = {
	  /**
	   * Return the current url
	   *
	   * @memberOf Barba.Utils
	   * @return {String} currentUrl
	   */
	  getCurrentUrl: function() {
	    return window.location.protocol + '//' +
	           window.location.host +
	           window.location.pathname +
	           window.location.search;
	  },

	  /**
	   * Given an url, return it without the hash
	   *
	   * @memberOf Barba.Utils
	   * @private
	   * @param  {String} url
	   * @return {String} newCleanUrl
	   */
	  cleanLink: function(url) {
	    return url.replace(/#.*/, '');
	  },

	  /**
	   * Time in millisecond after the xhr request goes in timeout
	   *
	   * @memberOf Barba.Utils
	   * @type {Number}
	   * @default
	   */
	  xhrTimeout: 5000,

	  /**
	   * Start an XMLHttpRequest() and return a Promise
	   *
	   * @memberOf Barba.Utils
	   * @param  {String} url
	   * @return {Promise}
	   */
	  xhr: function(url) {
	    var deferred = this.deferred();
	    var req = new XMLHttpRequest();

	    req.onreadystatechange = function() {
	      if (req.readyState === 4) {
	        if (req.status === 200) {
	          return deferred.resolve(req.responseText);
	        } else {
	          return deferred.reject(new Error('xhr: HTTP code is not 200'));
	        }
	      }
	    };

	    req.ontimeout = function() {
	      return deferred.reject(new Error('xhr: Timeout exceeded'));
	    };

	    req.open('GET', url);
	    req.timeout = this.xhrTimeout;
	    req.setRequestHeader('x-barba', 'yes');
	    req.send();

	    return deferred.promise;
	  },

	  /**
	   * Get obj and props and return a new object with the property merged
	   *
	   * @memberOf Barba.Utils
	   * @param  {object} obj
	   * @param  {object} props
	   * @return {object}
	   */
	  extend: function(obj, props) {
	    var newObj = Object.create(obj);

	    for(var prop in props) {
	      if(props.hasOwnProperty(prop)) {
	        newObj[prop] = props[prop];
	      }
	    }

	    return newObj;
	  },

	  /**
	   * Return a new "Deferred" object
	   * https://developer.mozilla.org/en-US/docs/Mozilla/JavaScript_code_modules/Promise.jsm/Deferred
	   *
	   * @memberOf Barba.Utils
	   * @return {Deferred}
	   */
	  deferred: function() {
	    return new function() {
	      this.resolve = null;
	      this.reject = null;

	      this.promise = new Promise(function(resolve, reject) {
	        this.resolve = resolve;
	        this.reject = reject;
	      }.bind(this));
	    };
	  },

	  /**
	   * Return the port number normalized, eventually you can pass a string to be normalized.
	   *
	   * @memberOf Barba.Utils
	   * @private
	   * @param  {String} p
	   * @return {Int} port
	   */
	  getPort: function(p) {
	    var port = typeof p !== 'undefined' ? p : window.location.port;
	    var protocol = window.location.protocol;

	    if (port != '')
	      return parseInt(port);

	    if (protocol === 'http:')
	      return 80;

	    if (protocol === 'https:')
	      return 443;
	  }
	};

	module.exports = Utils;


/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	var Dispatcher = __webpack_require__(7);
	var Utils = __webpack_require__(5);

	/**
	 * BaseView to be extended
	 *
	 * @namespace Barba.BaseView
	 * @type {Object}
	 */
	var BaseView  = {
	  /**
	   * Namespace of the view.
	   * (need to be associated with the data-namespace of the container)
	   *
	   * @memberOf Barba.BaseView
	   * @type {String}
	   */
	  namespace: null,

	  /**
	   * Helper to extend the object
	   *
	   * @memberOf Barba.BaseView
	   * @param  {Object} newObject
	   * @return {Object} newInheritObject
	   */
	  extend: function(obj){
	    return Utils.extend(this, obj);
	  },

	  /**
	   * Init the view.
	   * P.S. Is suggested to init the view before starting Barba.Pjax.start(),
	   * in this way .onEnter() and .onEnterCompleted() will be fired for the current
	   * container when the page is loaded.
	   *
	   * @memberOf Barba.BaseView
	   */
	  init: function() {
	    var _this = this;

	    Dispatcher.on('initStateChange',
	      function(newStatus, oldStatus) {
	        if (oldStatus && oldStatus.namespace === _this.namespace)
	          _this.onLeave();
	      }
	    );

	    Dispatcher.on('newPageReady',
	      function(newStatus, oldStatus, container) {
	        _this.container = container;

	        if (newStatus.namespace === _this.namespace)
	          _this.onEnter();
	      }
	    );

	    Dispatcher.on('transitionCompleted',
	      function(newStatus, oldStatus) {
	        if (newStatus.namespace === _this.namespace)
	          _this.onEnterCompleted();

	        if (oldStatus && oldStatus.namespace === _this.namespace)
	          _this.onLeaveCompleted();
	      }
	    );
	  },

	 /**
	  * This function will be fired when the container
	  * is ready and attached to the DOM.
	  *
	  * @memberOf Barba.BaseView
	  * @abstract
	  */
	  onEnter: function() {},

	  /**
	   * This function will be fired when the transition
	   * to this container has just finished.
	   *
	   * @memberOf Barba.BaseView
	   * @abstract
	   */
	  onEnterCompleted: function() {},

	  /**
	   * This function will be fired when the transition
	   * to a new container has just started.
	   *
	   * @memberOf Barba.BaseView
	   * @abstract
	   */
	  onLeave: function() {},

	  /**
	   * This function will be fired when the container
	   * has just been removed from the DOM.
	   *
	   * @memberOf Barba.BaseView
	   * @abstract
	   */
	  onLeaveCompleted: function() {}
	}

	module.exports = BaseView;


/***/ },
/* 7 */
/***/ function(module, exports) {

	/**
	 * Little Dispatcher inspired by MicroEvent.js
	 *
	 * @namespace Barba.Dispatcher
	 * @type {Object}
	 */
	var Dispatcher = {
	  /**
	   * Object that keeps all the events
	   *
	   * @memberOf Barba.Dispatcher
	   * @readOnly
	   * @type {Object}
	   */
	  events: {},

	  /**
	   * Bind a callback to an event
	   *
	   * @memberOf Barba.Dispatcher
	   * @param  {String} eventName
	   * @param  {Function} function
	   */
	  on: function(e, f) {
	    this.events[e] = this.events[e] || [];
	    this.events[e].push(f);
	  },

	  /**
	   * Unbind event
	   *
	   * @memberOf Barba.Dispatcher
	   * @param  {String} eventName
	   * @param  {Function} function
	   */
	  off: function(e, f) {
	    if(e in this.events === false)
	      return;

	    this.events[e].splice(this.events[e].indexOf(f), 1);
	  },

	  /**
	   * Fire the event running all the event associated to it
	   *
	   * @memberOf Barba.Dispatcher
	   * @param  {String} eventName
	   * @param  {...*} args
	   */
	  trigger: function(e) {//e, ...args
	    if (e in this.events === false)
	      return;

	    for(var i = 0; i < this.events[e].length; i++){
	      this.events[e][i].apply(this, Array.prototype.slice.call(arguments, 1));
	    }
	  }
	};

	module.exports = Dispatcher;


/***/ },
/* 8 */
/***/ function(module, exports, __webpack_require__) {

	var Utils = __webpack_require__(5);

	/**
	 * BaseCache it's a simple static cache
	 *
	 * @namespace Barba.BaseCache
	 * @type {Object}
	 */
	var BaseCache = {
	  /**
	   * The Object that keeps all the key value information
	   *
	   * @memberOf Barba.BaseCache
	   * @type {Object}
	   */
	  data: {},

	  /**
	   * Helper to extend this object
	   *
	   * @memberOf Barba.BaseCache
	   * @private
	   * @param  {Object} newObject
	   * @return {Object} newInheritObject
	   */
	  extend: function(obj) {
	    return Utils.extend(this, obj);
	  },

	  /**
	   * Set a key and value data, mainly Barba is going to save promises
	   *
	   * @memberOf Barba.BaseCache
	   * @param {String} key
	   * @param {*} value
	   */
	  set: function(key, val) {
	    this.data[key] = val;
	  },

	  /**
	   * Retrieve the data using the key
	   *
	   * @memberOf Barba.BaseCache
	   * @param  {String} key
	   * @return {*}
	   */
	  get: function(key) {
	    return this.data[key];
	  },

	  /**
	   * Flush the cache
	   *
	   * @memberOf Barba.BaseCache
	   */
	  reset: function() {
	    this.data = {};
	  }
	};

	module.exports = BaseCache;


/***/ },
/* 9 */
/***/ function(module, exports) {

	/**
	 * HistoryManager helps to keep track of the navigation
	 *
	 * @namespace Barba.HistoryManager
	 * @type {Object}
	 */
	var HistoryManager = {
	  /**
	   * Keep track of the status in historic order
	   *
	   * @memberOf Barba.HistoryManager
	   * @readOnly
	   * @type {Array}
	   */
	  history: [],

	  /**
	   * Add a new set of url and namespace
	   *
	   * @memberOf Barba.HistoryManager
	   * @param {String} url
	   * @param {String} namespace
	   * @private
	   */
	  add: function(url, namespace) {
	    if (!namespace)
	      namespace = undefined;

	    this.history.push({
	      url: url,
	      namespace: namespace
	    });
	  },

	  /**
	   * Return information about the current status
	   *
	   * @memberOf Barba.HistoryManager
	   * @return {Object}
	   */
	  currentStatus: function() {
	    return this.history[this.history.length - 1];
	  },

	  /**
	   * Return information about the previous status
	   *
	   * @memberOf Barba.HistoryManager
	   * @return {Object}
	   */
	  prevStatus: function() {
	    var history = this.history;

	    if (history.length < 2)
	      return null;

	    return history[history.length - 2];
	  }
	};

	module.exports = HistoryManager;


/***/ },
/* 10 */
/***/ function(module, exports, __webpack_require__) {

	var Utils = __webpack_require__(5);
	var Dispatcher = __webpack_require__(7);
	var HideShowTransition = __webpack_require__(11);
	var BaseCache = __webpack_require__(8);

	var HistoryManager = __webpack_require__(9);
	var Dom = __webpack_require__(12);

	/**
	 * Pjax is a static object with main function
	 *
	 * @namespace Barba.Pjax
	 * @borrows Dom as Dom
	 * @type {Object}
	 */
	var Pjax = {
	  Dom: Dom,
	  History: HistoryManager,
	  Cache: BaseCache,

	  /**
	   * Indicate wether or not use the cache
	   *
	   * @memberOf Barba.Pjax
	   * @type {Boolean}
	   * @default
	   */
	  cacheEnabled: true,

	  /**
	   * Indicate if there is an animation in progress
	   *
	   * @memberOf Barba.Pjax
	   * @readOnly
	   * @type {Boolean}
	   */
	  transitionProgress: false,

	  /**
	   * Class name used to ignore links
	   *
	   * @memberOf Barba.Pjax
	   * @type {String}
	   * @default
	   */
	  ignoreClassLink: 'no-barba',

	  /**
	   * Function to be called to start Pjax
	   *
	   * @memberOf Barba.Pjax
	   */
	  start: function() {
	    this.init();
	  },

	  /**
	   * Init the events
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   */
	  init: function() {
	    var container = this.Dom.getContainer();
	    var wrapper = this.Dom.getWrapper();

	    wrapper.setAttribute('aria-live', 'polite');

	    this.History.add(
	      this.getCurrentUrl(),
	      this.Dom.getNamespace(container)
	    );

	    //Fire for the current view.
	    Dispatcher.trigger('initStateChange', this.History.currentStatus());
	    Dispatcher.trigger('newPageReady', this.History.currentStatus(), {}, container);
	    Dispatcher.trigger('transitionCompleted', this.History.currentStatus());

	    this.bindEvents();
	  },

	  /**
	   * Attach the eventlisteners
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   */
	  bindEvents: function() {
	    document.addEventListener('click',
	      this.onLinkClick.bind(this)
	    );

	    window.addEventListener('popstate',
	      this.onStateChange.bind(this)
	    );
	  },

	  /**
	   * Return the currentURL cleaned
	   *
	   * @memberOf Barba.Pjax
	   * @return {String} currentUrl
	   */
	  getCurrentUrl: function() {
	    return Utils.cleanLink(
	      Utils.getCurrentUrl()
	    );
	  },

	  /**
	   * Change the URL with pushstate and trigger the state change
	   *
	   * @memberOf Barba.Pjax
	   * @param {String} newUrl
	   */
	  goTo: function(url) {
	    window.history.pushState(null, null, url);
	    this.onStateChange();
	  },

	  /**
	   * Force the browser to go to a certain url
	   *
	   * @memberOf Barba.Pjax
	   * @param {String} url
	   * @private
	   */
	  forceGoTo: function(url) {
	    window.location = url;
	  },

	  /**
	   * Load an url, will start an xhr request or load from the cache
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   * @param  {String} url
	   * @return {Promise}
	   */
	  load: function(url) {
	    var deferred = Utils.deferred();
	    var _this = this;
	    var xhr;

	    xhr = this.Cache.get(url);

	    if (!xhr) {
	      xhr = Utils.xhr(url);
	      this.Cache.set(url, xhr);
	    }

	    xhr.then(
	      function(data) {
	        var container = _this.Dom.parseResponse(data);

	        _this.Dom.putContainer(container);

	        if (!_this.cacheEnabled)
	          _this.Cache.reset();

	        deferred.resolve(container);
	      },
	      function() {
	        //Something went wrong (timeout, 404, 505...)
	        _this.forceGoTo(url);

	        deferred.reject();
	      }
	    );

	    return deferred.promise;
	  },

	  /**
	   * Callback called from click event
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   * @param {MouseEvent} evt
	   */
	  onLinkClick: function(evt) {
	    var el = evt.target;

	    //Go up in the nodelist until we
	    //find something with .href
	    while (el && !el.href) {
	      el = el.parentNode;
	    }

	    if (this.preventCheck(evt, el)) {
	      evt.stopPropagation();
	      evt.preventDefault();

	      Dispatcher.trigger('linkClicked', el);
	      this.goTo(el.href);
	    }
	  },

	  /**
	   * Determine if the link should be followed
	   *
	   * @memberOf Barba.Pjax
	   * @param  {MouseEvent} evt
	   * @param  {HTMLElement} element
	   * @return {Boolean}
	   */
	  preventCheck: function(evt, element) {
	    if (!window.history.pushState)
	      return false;

	    //User
	    if (!element || !element.href)
	      return false;

	    //Middle click, cmd click, and ctrl click
	    if (evt.which > 1 || evt.metaKey || evt.ctrlKey || evt.shiftKey || evt.altKey)
	      return false;

	    //Ignore target with _blank target
	    if (element.target && element.target === '_blank')
	      return false;

	    //Check if it's the same domain
	    if (window.location.protocol !== element.protocol || window.location.hostname !== element.hostname)
	      return false;

	    //Check if the port is the same
	    if (Utils.getPort() !== Utils.getPort(element.port))
	      return false;

	    //Ignore case when a hash is being tacked on the current URL
	    if (element.href.indexOf('#') > -1)
	      return false;

	    //In case you're trying to load the same page
	    if (Utils.cleanLink(element.href) == Utils.cleanLink(location.href))
	      return false;

	    if (element.classList.contains(this.ignoreClassLink))
	      return false;

	    return true;
	  },

	  /**
	   * Return a transition object
	   *
	   * @memberOf Barba.Pjax
	   * @return {Barba.Transition} Transition object
	   */
	  getTransition: function() {
	    //User customizable
	    return HideShowTransition;
	  },

	  /**
	   * Method called after a 'popstate' or from .goTo()
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   */
	  onStateChange: function() {
	    var newUrl = this.getCurrentUrl();

	    if (this.transitionProgress)
	      this.forceGoTo(newUrl);

	    if (this.History.currentStatus().url === newUrl)
	      return false;

	    this.History.add(newUrl);

	    var newContainer = this.load(newUrl);
	    var transition = Object.create(this.getTransition());

	    this.transitionProgress = true;

	    Dispatcher.trigger('initStateChange',
	      this.History.currentStatus(),
	      this.History.prevStatus()
	    );

	    var transitionInstance = transition.init(
	      this.Dom.getContainer(),
	      newContainer
	    );

	    newContainer.then(
	      this.onNewContainerLoaded.bind(this)
	    );

	    transitionInstance.then(
	      this.onTransitionEnd.bind(this)
	    );
	  },

	  /**
	   * Function called as soon the new container is ready
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   * @param {HTMLElement} container
	   */
	  onNewContainerLoaded: function(container) {
	    var currentStatus = this.History.currentStatus();
	    currentStatus.namespace = this.Dom.getNamespace(container);

	    Dispatcher.trigger('newPageReady',
	      this.History.currentStatus(),
	      this.History.prevStatus(),
	      container
	    );
	  },

	  /**
	   * Function called as soon the transition is finished
	   *
	   * @memberOf Barba.Pjax
	   * @private
	   */
	  onTransitionEnd: function() {
	    this.transitionProgress = false;

	    Dispatcher.trigger('transitionCompleted',
	      this.History.currentStatus(),
	      this.History.prevStatus()
	    );
	  }
	};

	module.exports = Pjax;


/***/ },
/* 11 */
/***/ function(module, exports, __webpack_require__) {

	var BaseTransition = __webpack_require__(4);

	/**
	 * Basic Transition object, wait for the new Container to be ready,
	 * scroll top, and finish the transition (removing the old container and displaying the new one)
	 *
	 * @private
	 * @namespace Barba.HideShowTransition
	 * @augments Barba.BaseTransition
	 */
	var HideShowTransition = BaseTransition.extend({
	  start: function() {
	    this.newContainerLoading.then(this.finish.bind(this));
	  },

	  finish: function() {
	    document.body.scrollTop = 0;
	    this.done();
	  }
	});

	module.exports = HideShowTransition;


/***/ },
/* 12 */
/***/ function(module, exports) {

	/**
	 * Object that is going to deal with DOM parsing/manipulation
	 *
	 * @namespace Barba.Pjax.Dom
	 * @type {Object}
	 */
	var Dom = {
	  /**
	   * The name of the data attribute on the container
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @type {String}
	   * @default
	   */
	  dataNamespace: 'namespace',

	  /**
	   * Id of the main wrapper
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @type {String}
	   * @default
	   */
	  wrapperId: 'barba-wrapper',

	  /**
	   * Class name used to identify the containers
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @type {String}
	   * @default
	   */
	  containerClass: 'barba-container',

	  /**
	   * Parse the responseText obtained from the xhr call
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @private
	   * @param  {String} responseText
	   * @return {HTMLElement}
	   */
	  parseResponse: function(responseText) {
	    var wrapper = document.createElement('div');
	    wrapper.innerHTML = responseText;

	    var titleEl = wrapper.querySelector('title');

	    if (titleEl)
	      document.title = titleEl.textContent;

	    return this.getContainer(wrapper);
	  },

	  /**
	   * Get the main barba wrapper by the ID `wrapperId`
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @return {HTMLElement} element
	   */
	  getWrapper: function() {
	    var wrapper = document.getElementById(this.wrapperId);

	    if (!wrapper)
	      throw new Error('Barba.js: wrapper not found!');

	    return wrapper;
	  },

	  /**
	   * Get the container on the current DOM,
	   * or from an HTMLElement passed via argument
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @private
	   * @param  {HTMLElement} element
	   * @return {HTMLElement}
	   */
	  getContainer: function(element) {
	    if (!element)
	      element = document.body;

	    if (!element)
	      throw new Error('Barba.js: DOM not ready!');

	    var container = this.parseContainer(element);

	    if (container && container.jquery)
	      container = container[0];

	    if (!container)
	      throw new Error('Barba.js: no container found');

	    return container;
	  },

	  /**
	   * Get the namespace of the container
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @private
	   * @param  {HTMLElement} element
	   * @return {String}
	   */
	  getNamespace: function(element) {
	    if (element && element.dataset) {
	      return element.dataset[this.dataNamespace];
	    } else if (element) {
	      return element.getAttribute('data-' + this.dataNamespace);
	    }

	    return null;
	  },

	  /**
	   * Put the container on the page
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @private
	   * @param  {HTMLElement} element
	   */
	  putContainer: function(element) {
	    element.style.visibility = 'hidden';

	    var wrapper = this.getWrapper();
	    wrapper.appendChild(element);
	  },

	  /**
	   * Get container selector
	   *
	   * @memberOf Barba.Pjax.Dom
	   * @private
	   * @param  {HTMLElement} element
	   * @return {HTMLElement} element
	   */
	  parseContainer: function(element) {
	    return element.querySelector('.' + this.containerClass);
	  }
	};

	module.exports = Dom;


/***/ },
/* 13 */
/***/ function(module, exports, __webpack_require__) {

	var Utils = __webpack_require__(5);
	var Pjax = __webpack_require__(10);

	/**
	 * Prefetch
	 *
	 * @namespace Barba.Prefetch
	 * @type {Object}
	 */
	var Prefetch = {
	  /**
	   * Class name used to ignore prefetch on links
	   *
	   * @memberOf Barba.Prefetch
	   * @type {String}
	   * @default
	   */
	  ignoreClassLink: 'no-barba-prefetch',

	  /**
	   * Init the event listener on mouseover and touchstart
	   * for the prefetch
	   *
	   * @memberOf Barba.Prefetch
	   */
	  init: function() {
	    if (!window.history.pushState) {
	      return false;
	    }

	    document.body.addEventListener('mouseover', this.onLinkEnter.bind(this));
	    document.body.addEventListener('touchstart', this.onLinkEnter.bind(this));
	  },

	  /**
	   * Callback for the mousehover/touchstart
	   *
	   * @memberOf Barba.Prefetch
	   * @private
	   * @param  {Object} evt
	   */
	  onLinkEnter: function(evt) {
	    var el = evt.target;

	    while (el && !el.href) {
	      el = el.parentNode;
	    }

	    if (!el || el.classList.contains(this.ignoreClassLink)) {
	      return;
	    }

	    var url = el.href;

	    //Check if the link is elegible for Pjax
	    if (Pjax.preventCheck(evt, el) && !Pjax.Cache.get(url)) {
	      var xhr = Utils.xhr(url);
	      Pjax.Cache.set(url, xhr);
	    }
	  }
	};

	module.exports = Prefetch;


/***/ }
/******/ ])
});
;
//# sourceMappingURL=barba.js.map
/* --- $GMAP3 ---*/

/* GMap 3 v5.1.1
 *  Author   : DEMONTE Jean-Baptiste
 *  Contact  : jbdemonte@gmail.com
 *  Web site : http://gmap3.net
 *  Licence  : GPL-3.0+
*/

(function (y, t) {
	"use strict";
	var z, i = 0;

	function J() {
		if (!z) {
			z = {
				verbose: false,
				queryLimit: {attempt: 5, delay: 250, random: 250},
				classes: {
					Map: google.maps.Map,
					Marker: google.maps.Marker,
					InfoWindow: google.maps.InfoWindow,
					Circle: google.maps.Circle,
					Rectangle: google.maps.Rectangle,
					OverlayView: google.maps.OverlayView,
					StreetViewPanorama: google.maps.StreetViewPanorama,
					KmlLayer: google.maps.KmlLayer,
					TrafficLayer: google.maps.TrafficLayer,
					BicyclingLayer: google.maps.BicyclingLayer,
					GroundOverlay: google.maps.GroundOverlay,
					StyledMapType: google.maps.StyledMapType,
					ImageMapType: google.maps.ImageMapType
				},
				map: {mapTypeId: google.maps.MapTypeId.ROADMAP, center: [46.578498, 2.457275], zoom: 2},
				overlay: {pane: "floatPane", content: "", offset: {x: 0, y: 0}},
				geoloc: {getCurrentPosition: {maximumAge: 60000, timeout: 5000}}
			}
		}
	}

	function k(M, L) {
		return M !== t ? M : "gmap3_" + (L ? i + 1 : ++i)
	}

	function d(L) {
		var O = function (P) {
			return parseInt(P, 10)
		}, N = google.maps.version.split(".").map(O), M;
		L = L.split(".").map(O);
		for (M = 0; M < L.length; M++) {
			if (N.hasOwnProperty(M)) {
				if (N[M] < L[M]) {
					return false
				}
			} else {
				return false
			}
		}
		return true
	}

	function n(P, L, N, Q, O) {
		if (L.todo.events || L.todo.onces) {
			var M = {id: Q, data: L.todo.data, tag: L.todo.tag};
			if (L.todo.events) {
				y.each(L.todo.events, function (R, U) {
					var T = P, S = U;
					if (y.isArray(U)) {
						T = U[0];
						S = U[1]
					}
					google.maps.event.addListener(N, R, function (V) {
						S.apply(T, [O ? O : N, V, M])
					})
				})
			}
			if (L.todo.onces) {
				y.each(L.todo.onces, function (R, U) {
					var T = P, S = U;
					if (y.isArray(U)) {
						T = U[0];
						S = U[1]
					}
					google.maps.event.addListenerOnce(N, R, function (V) {
						S.apply(T, [O ? O : N, V, M])
					})
				})
			}
		}
	}

	function l() {
		var L = [];
		this.empty = function () {
			return !L.length
		};
		this.add = function (M) {
			L.push(M)
		};
		this.get = function () {
			return L.length ? L[0] : false
		};
		this.ack = function () {
			L.shift()
		}
	}

	function w(T, L, N) {
		var R = {}, P = this, Q, S = {
			latLng: {
				map: false,
				marker: false,
				infowindow: false,
				circle: false,
				overlay: false,
				getlatlng: false,
				getmaxzoom: false,
				getelevation: false,
				streetviewpanorama: false,
				getaddress: true
			}, geoloc: {getgeoloc: true}
		};
		if (typeof N === "string") {
			N = M(N)
		}
		function M(V) {
			var U = {};
			U[V] = {};
			return U
		}

		function O() {
			var U;
			for (U in N) {
				if (U in R) {
					continue
				}
				return U
			}
		}

		this.run = function () {
			var U, V;
			while (U = O()) {
				if (typeof T[U] === "function") {
					Q = U;
					V = y.extend(true, {}, z[U] || {}, N[U].options || {});
					if (U in S.latLng) {
						if (N[U].values) {
							x(N[U].values, T, T[U], {todo: N[U], opts: V, session: R})
						} else {
							v(T, T[U], S.latLng[U], {todo: N[U], opts: V, session: R})
						}
					} else {
						if (U in S.geoloc) {
							o(T, T[U], {todo: N[U], opts: V, session: R})
						} else {
							T[U].apply(T, [
								{todo: N[U], opts: V, session: R}
							])
						}
					}
					return
				} else {
					R[U] = null
				}
			}
			L.apply(T, [N, R])
		};
		this.ack = function (U) {
			R[Q] = U;
			P.run.apply(P, [])
		}
	}

	function c(N) {
		var L, M = [];
		for (L in N) {
			M.push(L)
		}
		return M
	}

	function b(N, Q) {
		var L = {};
		if (N.todo) {
			for (var M in N.todo) {
				if ((M !== "options") && (M !== "values")) {
					L[M] = N.todo[M]
				}
			}
		}
		var O, P = ["data", "tag", "id", "events", "onces"];
		for (O = 0; O < P.length; O++) {
			A(L, P[O], Q, N.todo)
		}
		L.options = y.extend({}, N.opts || {}, Q.options || {});
		return L
	}

	function A(N, M) {
		for (var L = 2; L < arguments.length; L++) {
			if (M in arguments[L]) {
				N[M] = arguments[L][M];
				return
			}
		}
	}

	function r() {
		var L = [];
		this.get = function (S) {
			if (L.length) {
				var P, O, N, R, M, Q = c(S);
				for (P = 0; P < L.length; P++) {
					R = L[P];
					M = Q.length == R.keys.length;
					for (O = 0; (O < Q.length) && M; O++) {
						N = Q[O];
						M = N in R.request;
						if (M) {
							if ((typeof S[N] === "object") && ("equals" in S[N]) && (typeof S[N] === "function")) {
								M = S[N].equals(R.request[N])
							} else {
								M = S[N] === R.request[N]
							}
						}
					}
					if (M) {
						return R.results
					}
				}
			}
		};
		this.store = function (N, M) {
			L.push({request: N, keys: c(N), results: M})
		}
	}

	function e(Q, P, O, L) {
		var N = this, M = [];
		z.classes.OverlayView.call(this);
		this.setMap(Q);
		this.onAdd = function () {
			var R = this.getPanes();
			if (P.pane in R) {
				y(R[P.pane]).append(L)
			}
			y.each("dblclick click mouseover mousemove mouseout mouseup mousedown".split(" "), function (T, S) {
				M.push(google.maps.event.addDomListener(L[0], S, function (U) {
					y.Event(U).stopPropagation();
					google.maps.event.trigger(N, S, [U]);
					N.draw()
				}))
			});
			M.push(google.maps.event.addDomListener(L[0], "contextmenu", function (S) {
				y.Event(S).stopPropagation();
				google.maps.event.trigger(N, "rightclick", [S]);
				N.draw()
			}))
		};
		this.getPosition = function () {
			return O
		};
		this.draw = function () {
			var R = this.getProjection().fromLatLngToDivPixel(O);
			L.css("left", (R.x + P.offset.x) + "px").css("top", (R.y + P.offset.y) + "px")
		};
		this.onRemove = function () {
			for (var R = 0; R < M.length; R++) {
				google.maps.event.removeListener(M[R])
			}
			L.remove()
		};
		this.hide = function () {
			L.hide()
		};
		this.show = function () {
			L.show()
		};
		this.toggle = function () {
			if (L) {
				if (L.is(":visible")) {
					this.show()
				} else {
					this.hide()
				}
			}
		};
		this.toggleDOM = function () {
			if (this.getMap()) {
				this.setMap(null)
			} else {
				this.setMap(Q)
			}
		};
		this.getDOMElement = function () {
			return L[0]
		}
	}

	function f(O, L) {
		function M() {
			this.onAdd = function () {
			};
			this.onRemove = function () {
			};
			this.draw = function () {
			};
			return z.classes.OverlayView.apply(this, [])
		}

		M.prototype = z.classes.OverlayView.prototype;
		var N = new M();
		N.setMap(O);
		return N
	}

	function F(ae, ao, aa) {
		var an = false, ai = false, af = false, Z = false, W = true, V = this, N = [], T = {}, ad = {}, U = {}, aj = [], ah = [], O = [], ak = f(ao, aa.radius), Y, ap, am, P, Q;
		S();
		function L(aq) {
			if (!aj[aq]) {
				delete ah[aq].options.map;
				aj[aq] = new z.classes.Marker(ah[aq].options);
				n(ae, {todo: ah[aq]}, aj[aq], ah[aq].id)
			}
		}

		this.getById = function (aq) {
			if (aq in ad) {
				L(ad[aq]);
				return aj[ad[aq]]
			}
			return false
		};
		this.rm = function (ar) {
			var aq = ad[ar];
			if (aj[aq]) {
				aj[aq].setMap(null)
			}
			delete aj[aq];
			aj[aq] = false;
			delete ah[aq];
			ah[aq] = false;
			delete O[aq];
			O[aq] = false;
			delete ad[ar];
			delete U[aq];
			ai = true
		};
		this.clearById = function (aq) {
			if (aq in ad) {
				this.rm(aq);
				return true
			}
		};
		this.clear = function (az, av, aA) {
			var ar, ay, at, aw, au, ax = [], aq = C(aA);
			if (az) {
				ar = ah.length - 1;
				ay = -1;
				at = -1
			} else {
				ar = 0;
				ay = ah.length;
				at = 1
			}
			for (aw = ar; aw != ay; aw += at) {
				if (ah[aw]) {
					if (!aq || aq(ah[aw].tag)) {
						ax.push(U[aw]);
						if (av || az) {
							break
						}
					}
				}
			}
			for (au = 0; au < ax.length; au++) {
				this.rm(ax[au])
			}
		};
		this.add = function (aq, ar) {
			aq.id = k(aq.id);
			this.clearById(aq.id);
			ad[aq.id] = aj.length;
			U[aj.length] = aq.id;
			aj.push(null);
			ah.push(aq);
			O.push(ar);
			ai = true
		};
		this.addMarker = function (ar, aq) {
			aq = aq || {};
			aq.id = k(aq.id);
			this.clearById(aq.id);
			if (!aq.options) {
				aq.options = {}
			}
			aq.options.position = ar.getPosition();
			n(ae, {todo: aq}, ar, aq.id);
			ad[aq.id] = aj.length;
			U[aj.length] = aq.id;
			aj.push(ar);
			ah.push(aq);
			O.push(aq.data || {});
			ai = true
		};
		this.todo = function (aq) {
			return ah[aq]
		};
		this.value = function (aq) {
			return O[aq]
		};
		this.marker = function (aq) {
			if (aq in aj) {
				L(aq);
				return aj[aq]
			}
			return false
		};
		this.markerIsSet = function (aq) {
			return Boolean(aj[aq])
		};
		this.setMarker = function (ar, aq) {
			aj[ar] = aq
		};
		this.store = function (aq, ar, at) {
			T[aq.ref] = {obj: ar, shadow: at}
		};
		this.free = function () {
			for (var aq = 0; aq < N.length; aq++) {
				google.maps.event.removeListener(N[aq])
			}
			N = [];
			y.each(T, function (ar) {
				ac(ar)
			});
			T = {};
			y.each(ah, function (ar) {
				ah[ar] = null
			});
			ah = [];
			y.each(aj, function (ar) {
				if (aj[ar]) {
					aj[ar].setMap(null);
					delete aj[ar]
				}
			});
			aj = [];
			y.each(O, function (ar) {
				delete O[ar]
			});
			O = [];
			ad = {};
			U = {}
		};
		this.filter = function (aq) {
			am = aq;
			ag()
		};
		this.enable = function (aq) {
			if (W != aq) {
				W = aq;
				ag()
			}
		};
		this.display = function (aq) {
			P = aq
		};
		this.error = function (aq) {
			Q = aq
		};
		this.beginUpdate = function () {
			an = true
		};
		this.endUpdate = function () {
			an = false;
			if (ai) {
				ag()
			}
		};
		this.autofit = function (ar) {
			for (var aq = 0; aq < ah.length; aq++) {
				if (ah[aq]) {
					ar.extend(ah[aq].options.position)
				}
			}
		};
		function S() {
			ap = ak.getProjection();
			if (!ap) {
				setTimeout(function () {
					S.apply(V, [])
				}, 25);
				return
			}
			Z = true;
			N.push(google.maps.event.addListener(ao, "zoom_changed", function () {
				al()
			}));
			N.push(google.maps.event.addListener(ao, "bounds_changed", function () {
				al()
			}));
			ag()
		}

		function ac(aq) {
			if (typeof T[aq] === "object") {
				if (typeof(T[aq].obj.setMap) === "function") {
					T[aq].obj.setMap(null)
				}
				if (typeof(T[aq].obj.remove) === "function") {
					T[aq].obj.remove()
				}
				if (typeof(T[aq].shadow.remove) === "function") {
					T[aq].obj.remove()
				}
				if (typeof(T[aq].shadow.setMap) === "function") {
					T[aq].shadow.setMap(null)
				}
				delete T[aq].obj;
				delete T[aq].shadow
			} else {
				if (aj[aq]) {
					aj[aq].setMap(null)
				}
			}
			delete T[aq]
		}

		function M() {
			var ay, ax, aw, au, av, at, ar, aq;
			if (arguments[0] instanceof google.maps.LatLng) {
				ay = arguments[0].lat();
				aw = arguments[0].lng();
				if (arguments[1] instanceof google.maps.LatLng) {
					ax = arguments[1].lat();
					au = arguments[1].lng()
				} else {
					ax = arguments[1];
					au = arguments[2]
				}
			} else {
				ay = arguments[0];
				aw = arguments[1];
				if (arguments[2] instanceof google.maps.LatLng) {
					ax = arguments[2].lat();
					au = arguments[2].lng()
				} else {
					ax = arguments[2];
					au = arguments[3]
				}
			}
			av = Math.PI * ay / 180;
			at = Math.PI * aw / 180;
			ar = Math.PI * ax / 180;
			aq = Math.PI * au / 180;
			return 1000 * 6371 * Math.acos(Math.min(Math.cos(av) * Math.cos(ar) * Math.cos(at) * Math.cos(aq) + Math.cos(av) * Math.sin(at) * Math.cos(ar) * Math.sin(aq) + Math.sin(av) * Math.sin(ar), 1))
		}

		function R() {
			var aq = M(ao.getCenter(), ao.getBounds().getNorthEast()), ar = new google.maps.Circle({
				center: ao.getCenter(),
				radius: 1.25 * aq
			});
			return ar.getBounds()
		}

		function X() {
			var ar = {}, aq;
			for (aq in T) {
				ar[aq] = true
			}
			return ar
		}

		function al() {
			clearTimeout(Y);
			Y = setTimeout(function () {
				ag()
			}, 25)
		}

		function ab(ar) {
			var au = ap.fromLatLngToDivPixel(ar), at = ap.fromDivPixelToLatLng(new google.maps.Point(au.x + aa.radius, au.y - aa.radius)), aq = ap.fromDivPixelToLatLng(new google.maps.Point(au.x - aa.radius, au.y + aa.radius));
			return new google.maps.LatLngBounds(aq, at)
		}

		function ag() {
			if (an || af || !Z) {
				return
			}
			var aE = [], aG = {}, aF = ao.getZoom(), aH = ("maxZoom" in aa) && (aF > aa.maxZoom), aw = X(), av, au, at, aA, ar = false, aq, aD, ay, az, aB, aC, ax;
			ai = false;
			if (aF > 3) {
				aq = R();
				ar = aq.getSouthWest().lng() < aq.getNorthEast().lng()
			}
			for (av = 0; av < ah.length; av++) {
				if (ah[av] && (!ar || aq.contains(ah[av].options.position)) && (!am || am(O[av]))) {
					aE.push(av)
				}
			}
			while (1) {
				av = 0;
				while (aG[av] && (av < aE.length)) {
					av++
				}
				if (av == aE.length) {
					break
				}
				aA = [];
				if (W && !aH) {
					ax = 10;
					do {
						az = aA;
						aA = [];
						ax--;
						if (az.length) {
							ay = aq.getCenter()
						} else {
							ay = ah[aE[av]].options.position
						}
						aq = ab(ay);
						for (au = av; au < aE.length; au++) {
							if (aG[au]) {
								continue
							}
							if (aq.contains(ah[aE[au]].options.position)) {
								aA.push(au)
							}
						}
					} while ((az.length < aA.length) && (aA.length > 1) && ax)
				} else {
					for (au = av; au < aE.length; au++) {
						if (aG[au]) {
							continue
						}
						aA.push(au);
						break
					}
				}
				aD = {indexes: [], ref: []};
				aB = aC = 0;
				for (at = 0; at < aA.length; at++) {
					aG[aA[at]] = true;
					aD.indexes.push(aE[aA[at]]);
					aD.ref.push(aE[aA[at]]);
					aB += ah[aE[aA[at]]].options.position.lat();
					aC += ah[aE[aA[at]]].options.position.lng()
				}
				aB /= aA.length;
				aC /= aA.length;
				aD.latLng = new google.maps.LatLng(aB, aC);
				aD.ref = aD.ref.join("-");
				if (aD.ref in aw) {
					delete aw[aD.ref]
				} else {
					if (aA.length === 1) {
						T[aD.ref] = true
					}
					P(aD)
				}
			}
			y.each(aw, function (aI) {
				ac(aI)
			});
			af = false
		}
	}

	function a(M, L) {
		this.id = function () {
			return M
		};
		this.filter = function (N) {
			L.filter(N)
		};
		this.enable = function () {
			L.enable(true)
		};
		this.disable = function () {
			L.enable(false)
		};
		this.add = function (O, N, P) {
			if (!P) {
				L.beginUpdate()
			}
			L.addMarker(O, N);
			if (!P) {
				L.endUpdate()
			}
		};
		this.getById = function (N) {
			return L.getById(N)
		};
		this.clearById = function (P, O) {
			var N;
			if (!O) {
				L.beginUpdate()
			}
			N = L.clearById(P);
			if (!O) {
				L.endUpdate()
			}
			return N
		};
		this.clear = function (P, Q, N, O) {
			if (!O) {
				L.beginUpdate()
			}
			L.clear(P, Q, N);
			if (!O) {
				L.endUpdate()
			}
		}
	}

	function D() {
		var M = {}, N = {};

		function L(P) {
			return{id: P.id, name: P.name, object: P.obj, tag: P.tag, data: P.data}
		}

		this.add = function (R, Q, T, S) {
			var P = R.todo || {}, U = k(P.id);
			if (!M[Q]) {
				M[Q] = []
			}
			if (U in N) {
				this.clearById(U)
			}
			N[U] = {obj: T, sub: S, name: Q, id: U, tag: P.tag, data: P.data};
			M[Q].push(U);
			return U
		};
		this.getById = function (R, Q, P) {
			if (R in N) {
				if (Q) {
					return N[R].sub
				} else {
					if (P) {
						return L(N[R])
					}
				}
				return N[R].obj
			}
			return false
		};
		this.get = function (R, T, P, S) {
			var V, U, Q = C(P);
			if (!M[R] || !M[R].length) {
				return null
			}
			V = M[R].length;
			while (V) {
				V--;
				U = M[R][T ? V : M[R].length - V - 1];
				if (U && N[U]) {
					if (Q && !Q(N[U].tag)) {
						continue
					}
					return S ? L(N[U]) : N[U].obj
				}
			}
			return null
		};
		this.all = function (S, Q, T) {
			var P = [], R = C(Q), U = function (X) {
				var V, W;
				for (V = 0; V < M[X].length; V++) {
					W = M[X][V];
					if (W && N[W]) {
						if (R && !R(N[W].tag)) {
							continue
						}
						P.push(T ? L(N[W]) : N[W].obj)
					}
				}
			};
			if (S in M) {
				U(S)
			} else {
				if (S === t) {
					for (S in M) {
						U(S)
					}
				}
			}
			return P
		};
		function O(P) {
			if (typeof(P.setMap) === "function") {
				P.setMap(null)
			}
			if (typeof(P.remove) === "function") {
				P.remove()
			}
			if (typeof(P.free) === "function") {
				P.free()
			}
			P = null
		}

		this.rm = function (S, Q, R) {
			var P, T;
			if (!M[S]) {
				return false
			}
			if (Q) {
				if (R) {
					for (P = M[S].length - 1; P >= 0; P--) {
						T = M[S][P];
						if (Q(N[T].tag)) {
							break
						}
					}
				} else {
					for (P = 0; P < M[S].length; P++) {
						T = M[S][P];
						if (Q(N[T].tag)) {
							break
						}
					}
				}
			} else {
				P = R ? M[S].length - 1 : 0
			}
			if (!(P in M[S])) {
				return false
			}
			return this.clearById(M[S][P], P)
		};
		this.clearById = function (S, P) {
			if (S in N) {
				var R, Q = N[S].name;
				for (R = 0; P === t && R < M[Q].length; R++) {
					if (S === M[Q][R]) {
						P = R
					}
				}
				O(N[S].obj);
				if (N[S].sub) {
					O(N[S].sub)
				}
				delete N[S];
				M[Q].splice(P, 1);
				return true
			}
			return false
		};
		this.objGetById = function (R) {
			var Q;
			if (M.clusterer) {
				for (var P in M.clusterer) {
					if ((Q = N[M.clusterer[P]].obj.getById(R)) !== false) {
						return Q
					}
				}
			}
			return false
		};
		this.objClearById = function (Q) {
			if (M.clusterer) {
				for (var P in M.clusterer) {
					if (N[M.clusterer[P]].obj.clearById(Q)) {
						return true
					}
				}
			}
			return null
		};
		this.clear = function (V, U, W, P) {
			var R, T, S, Q = C(P);
			if (!V || !V.length) {
				V = [];
				for (R in M) {
					V.push(R)
				}
			} else {
				V = g(V)
			}
			for (T = 0; T < V.length; T++) {
				S = V[T];
				if (U) {
					this.rm(S, Q, true)
				} else {
					if (W) {
						this.rm(S, Q, false)
					} else {
						while (this.rm(S, Q, false)) {
						}
					}
				}
			}
		};
		this.objClear = function (S, R, T, Q) {
			if (M.clusterer && (y.inArray("marker", S) >= 0 || !S.length)) {
				for (var P in M.clusterer) {
					N[M.clusterer[P]].obj.clear(R, T, Q)
				}
			}
		}
	}

	var m = {}, H = new r();

	function p() {
		if (!m.geocoder) {
			m.geocoder = new google.maps.Geocoder()
		}
		return m.geocoder
	}

	function G() {
		if (!m.directionsService) {
			m.directionsService = new google.maps.DirectionsService()
		}
		return m.directionsService
	}

	function h() {
		if (!m.elevationService) {
			m.elevationService = new google.maps.ElevationService()
		}
		return m.elevationService
	}

	function q() {
		if (!m.maxZoomService) {
			m.maxZoomService = new google.maps.MaxZoomService()
		}
		return m.maxZoomService
	}

	function B() {
		if (!m.distanceMatrixService) {
			m.distanceMatrixService = new google.maps.DistanceMatrixService()
		}
		return m.distanceMatrixService
	}

	function u() {
		if (z.verbose) {
			var L, M = [];
			if (window.console && (typeof console.error === "function")) {
				for (L = 0; L < arguments.length; L++) {
					M.push(arguments[L])
				}
				console.error.apply(console, M)
			} else {
				M = "";
				for (L = 0; L < arguments.length; L++) {
					M += arguments[L].toString() + " "
				}
				alert(M)
			}
		}
	}

	function E(L) {
		return(typeof(L) === "number" || typeof(L) === "string") && L !== "" && !isNaN(L)
	}

	function g(N) {
		var M, L = [];
		if (N !== t) {
			if (typeof(N) === "object") {
				if (typeof(N.length) === "number") {
					L = N
				} else {
					for (M in N) {
						L.push(N[M])
					}
				}
			} else {
				L.push(N)
			}
		}
		return L
	}

	function C(L) {
		if (L) {
			if (typeof L === "function") {
				return L
			}
			L = g(L);
			return function (N) {
				if (N === t) {
					return false
				}
				if (typeof N === "object") {
					for (var M = 0; M < N.length; M++) {
						if (y.inArray(N[M], L) >= 0) {
							return true
						}
					}
					return false
				}
				return y.inArray(N, L) >= 0
			}
		}
	}

	function I(M, O, L) {
		var N = O ? M : null;
		if (!M || (typeof M === "string")) {
			return N
		}
		if (M.latLng) {
			return I(M.latLng)
		}
		if (M instanceof google.maps.LatLng) {
			return M
		} else {
			if (E(M.lat)) {
				return new google.maps.LatLng(M.lat, M.lng)
			} else {
				if (!L && y.isArray(M)) {
					if (!E(M[0]) || !E(M[1])) {
						return N
					}
					return new google.maps.LatLng(M[0], M[1])
				}
			}
		}
		return N
	}

	function j(M) {
		var N, L;
		if (!M || M instanceof google.maps.LatLngBounds) {
			return M || null
		}
		if (y.isArray(M)) {
			if (M.length == 2) {
				N = I(M[0]);
				L = I(M[1])
			} else {
				if (M.length == 4) {
					N = I([M[0], M[1]]);
					L = I([M[2], M[3]])
				}
			}
		} else {
			if (("ne" in M) && ("sw" in M)) {
				N = I(M.ne);
				L = I(M.sw)
			} else {
				if (("n" in M) && ("e" in M) && ("s" in M) && ("w" in M)) {
					N = I([M.n, M.e]);
					L = I([M.s, M.w])
				}
			}
		}
		if (N && L) {
			return new google.maps.LatLngBounds(L, N)
		}
		return null
	}

	function v(T, L, O, S, P) {
		var N = O ? I(S.todo, false, true) : false, R = N ? {latLng: N} : (S.todo.address ? (typeof(S.todo.address) === "string" ? {address: S.todo.address} : S.todo.address) : false), M = R ? H.get(R) : false, Q = this;
		if (R) {
			P = P || 0;
			if (M) {
				S.latLng = M.results[0].geometry.location;
				S.results = M.results;
				S.status = M.status;
				L.apply(T, [S])
			} else {
				if (R.location) {
					R.location = I(R.location)
				}
				if (R.bounds) {
					R.bounds = j(R.bounds)
				}
				p().geocode(R, function (V, U) {
					if (U === google.maps.GeocoderStatus.OK) {
						H.store(R, {results: V, status: U});
						S.latLng = V[0].geometry.location;
						S.results = V;
						S.status = U;
						L.apply(T, [S])
					} else {
						if ((U === google.maps.GeocoderStatus.OVER_QUERY_LIMIT) && (P < z.queryLimit.attempt)) {
							setTimeout(function () {
								v.apply(Q, [T, L, O, S, P + 1])
							}, z.queryLimit.delay + Math.floor(Math.random() * z.queryLimit.random))
						} else {
							u("geocode failed", U, R);
							S.latLng = S.results = false;
							S.status = U;
							L.apply(T, [S])
						}
					}
				})
			}
		} else {
			S.latLng = I(S.todo, false, true);
			L.apply(T, [S])
		}
	}

	function x(Q, L, R, M) {
		var O = this, N = -1;

		function P() {
			do {
				N++
			} while ((N < Q.length) && !("address" in Q[N]));
			if (N >= Q.length) {
				R.apply(L, [M]);
				return
			}
			v(O, function (S) {
				delete S.todo;
				y.extend(Q[N], S);
				P.apply(O, [])
			}, true, {todo: Q[N]})
		}

		P()
	}

	function o(L, O, M) {
		var N = false;
		if (navigator && navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (P) {
				if (N) {
					return
				}
				N = true;
				M.latLng = new google.maps.LatLng(P.coords.latitude, P.coords.longitude);
				O.apply(L, [M])
			}, function () {
				if (N) {
					return
				}
				N = true;
				M.latLng = false;
				O.apply(L, [M])
			}, M.opts.getCurrentPosition)
		} else {
			M.latLng = false;
			O.apply(L, [M])
		}
	}

	function K(T) {
		var S = this, U = new l(), V = new D(), N = null, P;
		this._plan = function (Z) {
			for (var Y = 0; Y < Z.length; Y++) {
				U.add(new w(S, R, Z[Y]))
			}
			Q()
		};
		function Q() {
			if (!P && (P = U.get())) {
				P.run()
			}
		}

		function R() {
			P = null;
			U.ack();
			Q.call(S)
		}

		function X(Y) {
			if (Y.todo.callback) {
				var Z = Array.prototype.slice.call(arguments, 1);
				if (typeof Y.todo.callback === "function") {
					Y.todo.callback.apply(T, Z)
				} else {
					if (y.isArray(Y.todo.callback)) {
						if (typeof Y.todo.callback[1] === "function") {
							Y.todo.callback[1].apply(Y.todo.callback[0], Z)
						}
					}
				}
			}
		}

		function O(Y, Z, aa) {
			if (aa) {
				n(T, Y, Z, aa)
			}
			X(Y, Z);
			P.ack(Z)
		}

		function L(aa, Y) {
			Y = Y || {};
			if (N) {
				if (Y.todo && Y.todo.options) {
					if (Y.todo.options.center) {
						Y.todo.options.center = I(Y.todo.options.center)
					}
					N.setOptions(Y.todo.options)
				}
			} else {
				var Z = Y.opts || y.extend(true, {}, z.map, Y.todo && Y.todo.options ? Y.todo.options : {});
				Z.center = aa || I(Z.center);
				N = new z.classes.Map(T.get(0), Z)
			}
		}

		this.map = function (Y) {
			L(Y.latLng, Y);
			n(T, Y, N);
			O(Y, N)
		};
		this.destroy = function (Y) {
			V.clear();
			T.empty();
			if (N) {
				N = null
			}
			O(Y, true)
		};
		this.infowindow = function (Z) {
			var aa = [], Y = "values" in Z.todo;
			if (!Y) {
				if (Z.latLng) {
					Z.opts.position = Z.latLng
				}
				Z.todo.values = [
					{options: Z.opts}
				]
			}
			y.each(Z.todo.values, function (ac, ad) {
				var af, ae, ab = b(Z, ad);
				ab.options.position = ab.options.position ? I(ab.options.position) : I(ad.latLng);
				if (!N) {
					L(ab.options.position)
				}
				ae = new z.classes.InfoWindow(ab.options);
				if (ae && ((ab.open === t) || ab.open)) {
					if (Y) {
						ae.open(N, ab.anchor ? ab.anchor : t)
					} else {
						ae.open(N, ab.anchor ? ab.anchor : (Z.latLng ? t : (Z.session.marker ? Z.session.marker : t)))
					}
				}
				aa.push(ae);
				af = V.add({todo: ab}, "infowindow", ae);
				n(T, {todo: ab}, ae, af)
			});
			O(Z, Y ? aa : aa[0])
		};
		this.circle = function (Z) {
			var aa = [], Y = "values" in Z.todo;
			if (!Y) {
				Z.opts.center = Z.latLng || I(Z.opts.center);
				Z.todo.values = [
					{options: Z.opts}
				]
			}
			if (!Z.todo.values.length) {
				O(Z, false);
				return
			}
			y.each(Z.todo.values, function (ac, ad) {
				var af, ae, ab = b(Z, ad);
				ab.options.center = ab.options.center ? I(ab.options.center) : I(ad);
				if (!N) {
					L(ab.options.center)
				}
				ab.options.map = N;
				ae = new z.classes.Circle(ab.options);
				aa.push(ae);
				af = V.add({todo: ab}, "circle", ae);
				n(T, {todo: ab}, ae, af)
			});
			O(Z, Y ? aa : aa[0])
		};
		this.overlay = function (aa, Z) {
			var ab = [], Y = "values" in aa.todo;
			if (!Y) {
				aa.todo.values = [
					{latLng: aa.latLng, options: aa.opts}
				]
			}
			if (!aa.todo.values.length) {
				O(aa, false);
				return
			}
			if (!e.__initialised) {
				e.prototype = new z.classes.OverlayView();
				e.__initialised = true
			}
			y.each(aa.todo.values, function (ae, af) {
				var ah, ag, ac = b(aa, af), ad = y(document.createElement("div")).css({
					border: "none",
					borderWidth: "0px",
					position: "absolute"
				});
				ad.append(ac.options.content);
				ag = new e(N, ac.options, I(ac) || I(af), ad);
				ab.push(ag);
				ad = null;
				if (!Z) {
					ah = V.add(aa, "overlay", ag);
					n(T, {todo: ac}, ag, ah)
				}
			});
			if (Z) {
				return ab[0]
			}
			O(aa, Y ? ab : ab[0])
		};
		this.getaddress = function (Y) {
			X(Y, Y.results, Y.status);
			P.ack()
		};
		this.getlatlng = function (Y) {
			X(Y, Y.results, Y.status);
			P.ack()
		};
		this.getmaxzoom = function (Y) {
			q().getMaxZoomAtLatLng(Y.latLng, function (Z) {
				X(Y, Z.status === google.maps.MaxZoomStatus.OK ? Z.zoom : false, status);
				P.ack()
			})
		};
		this.getelevation = function (Z) {
			var aa, Y = [], ab = function (ad, ac) {
				X(Z, ac === google.maps.ElevationStatus.OK ? ad : false, ac);
				P.ack()
			};
			if (Z.latLng) {
				Y.push(Z.latLng)
			} else {
				Y = g(Z.todo.locations || []);
				for (aa = 0; aa < Y.length; aa++) {
					Y[aa] = I(Y[aa])
				}
			}
			if (Y.length) {
				h().getElevationForLocations({locations: Y}, ab)
			} else {
				if (Z.todo.path && Z.todo.path.length) {
					for (aa = 0; aa < Z.todo.path.length; aa++) {
						Y.push(I(Z.todo.path[aa]))
					}
				}
				if (Y.length) {
					h().getElevationAlongPath({path: Y, samples: Z.todo.samples}, ab)
				} else {
					P.ack()
				}
			}
		};
		this.defaults = function (Y) {
			y.each(Y.todo, function (Z, aa) {
				if (typeof z[Z] === "object") {
					z[Z] = y.extend({}, z[Z], aa)
				} else {
					z[Z] = aa
				}
			});
			P.ack(true)
		};
		this.rectangle = function (Z) {
			var aa = [], Y = "values" in Z.todo;
			if (!Y) {
				Z.todo.values = [
					{options: Z.opts}
				]
			}
			if (!Z.todo.values.length) {
				O(Z, false);
				return
			}
			y.each(Z.todo.values, function (ac, ad) {
				var af, ae, ab = b(Z, ad);
				ab.options.bounds = ab.options.bounds ? j(ab.options.bounds) : j(ad);
				if (!N) {
					L(ab.options.bounds.getCenter())
				}
				ab.options.map = N;
				ae = new z.classes.Rectangle(ab.options);
				aa.push(ae);
				af = V.add({todo: ab}, "rectangle", ae);
				n(T, {todo: ab}, ae, af)
			});
			O(Z, Y ? aa : aa[0])
		};
		function M(Z, aa, ab) {
			var ac = [], Y = "values" in Z.todo;
			if (!Y) {
				Z.todo.values = [
					{options: Z.opts}
				]
			}
			if (!Z.todo.values.length) {
				O(Z, false);
				return
			}
			L();
			y.each(Z.todo.values, function (af, ah) {
				var aj, ag, ae, ai, ad = b(Z, ah);
				if (ad.options[ab]) {
					if (ad.options[ab][0][0] && y.isArray(ad.options[ab][0][0])) {
						for (ag = 0; ag < ad.options[ab].length; ag++) {
							for (ae = 0; ae < ad.options[ab][ag].length; ae++) {
								ad.options[ab][ag][ae] = I(ad.options[ab][ag][ae])
							}
						}
					} else {
						for (ag = 0; ag < ad.options[ab].length; ag++) {
							ad.options[ab][ag] = I(ad.options[ab][ag])
						}
					}
				}
				ad.options.map = N;
				ai = new google.maps[aa](ad.options);
				ac.push(ai);
				aj = V.add({todo: ad}, aa.toLowerCase(), ai);
				n(T, {todo: ad}, ai, aj)
			});
			O(Z, Y ? ac : ac[0])
		}

		this.polyline = function (Y) {
			M(Y, "Polyline", "path")
		};
		this.polygon = function (Y) {
			M(Y, "Polygon", "paths")
		};
		this.trafficlayer = function (Y) {
			L();
			var Z = V.get("trafficlayer");
			if (!Z) {
				Z = new z.classes.TrafficLayer();
				Z.setMap(N);
				V.add(Y, "trafficlayer", Z)
			}
			O(Y, Z)
		};
		this.bicyclinglayer = function (Y) {
			L();
			var Z = V.get("bicyclinglayer");
			if (!Z) {
				Z = new z.classes.BicyclingLayer();
				Z.setMap(N);
				V.add(Y, "bicyclinglayer", Z)
			}
			O(Y, Z)
		};
		this.groundoverlay = function (Y) {
			Y.opts.bounds = j(Y.opts.bounds);
			if (Y.opts.bounds) {
				L(Y.opts.bounds.getCenter())
			}
			var aa, Z = new z.classes.GroundOverlay(Y.opts.url, Y.opts.bounds, Y.opts.opts);
			Z.setMap(N);
			aa = V.add(Y, "groundoverlay", Z);
			O(Y, Z, aa)
		};
		this.streetviewpanorama = function (Y) {
			if (!Y.opts.opts) {
				Y.opts.opts = {}
			}
			if (Y.latLng) {
				Y.opts.opts.position = Y.latLng
			} else {
				if (Y.opts.opts.position) {
					Y.opts.opts.position = I(Y.opts.opts.position)
				}
			}
			if (Y.todo.divId) {
				Y.opts.container = document.getElementById(Y.todo.divId)
			} else {
				if (Y.opts.container) {
					Y.opts.container = y(Y.opts.container).get(0)
				}
			}
			var aa, Z = new z.classes.StreetViewPanorama(Y.opts.container, Y.opts.opts);
			if (Z) {
				N.setStreetView(Z)
			}
			aa = V.add(Y, "streetviewpanorama", Z);
			O(Y, Z, aa)
		};
		this.kmllayer = function (Z) {
			var aa = [], Y = "values" in Z.todo;
			if (!Y) {
				Z.todo.values = [
					{options: Z.opts}
				]
			}
			if (!Z.todo.values.length) {
				O(Z, false);
				return
			}
			y.each(Z.todo.values, function (ad, ae) {
				var ag, af, ac, ab = b(Z, ae);
				if (!N) {
					L()
				}
				ac = ab.options;
				if (ab.options.opts) {
					ac = ab.options.opts;
					if (ab.options.url) {
						ac.url = ab.options.url
					}
				}
				ac.map = N;
				if (d("3.10")) {
					af = new z.classes.KmlLayer(ac)
				} else {
					af = new z.classes.KmlLayer(ac.url, ac)
				}
				aa.push(af);
				ag = V.add({todo: ab}, "kmllayer", af);
				n(T, {todo: ab}, af, ag)
			});
			O(Z, Y ? aa : aa[0])
		};
		this.panel = function (ab) {
			L();
			var ad, Y = 0, ac = 0, aa, Z = y(document.createElement("div"));
			Z.css({position: "absolute", zIndex: 1000, visibility: "hidden"});
			if (ab.opts.content) {
				aa = y(ab.opts.content);
				Z.append(aa);
				T.first().prepend(Z);
				if (ab.opts.left !== t) {
					Y = ab.opts.left
				} else {
					if (ab.opts.right !== t) {
						Y = T.width() - aa.width() - ab.opts.right
					} else {
						if (ab.opts.center) {
							Y = (T.width() - aa.width()) / 2
						}
					}
				}
				if (ab.opts.top !== t) {
					ac = ab.opts.top
				} else {
					if (ab.opts.bottom !== t) {
						ac = T.height() - aa.height() - ab.opts.bottom
					} else {
						if (ab.opts.middle) {
							ac = (T.height() - aa.height()) / 2
						}
					}
				}
				Z.css({top: ac, left: Y, visibility: "visible"})
			}
			ad = V.add(ab, "panel", Z);
			O(ab, Z, ad);
			Z = null
		};
		function W(aa) {
			var af = new F(T, N, aa), Y = {}, ab = {}, ae = [], ad = /^[0-9]+$/, ac, Z;
			for (Z in aa) {
				if (ad.test(Z)) {
					ae.push(1 * Z);
					ab[Z] = aa[Z];
					ab[Z].width = ab[Z].width || 0;
					ab[Z].height = ab[Z].height || 0
				} else {
					Y[Z] = aa[Z]
				}
			}
			ae.sort(function (ah, ag) {
				return ah > ag
			});
			if (Y.calculator) {
				ac = function (ag) {
					var ah = [];
					y.each(ag, function (aj, ai) {
						ah.push(af.value(ai))
					});
					return Y.calculator.apply(T, [ah])
				}
			} else {
				ac = function (ag) {
					return ag.length
				}
			}
			af.error(function () {
				u.apply(S, arguments)
			});
			af.display(function (ag) {
				var ai, aj, am, ak, al, ah = ac(ag.indexes);
				if (aa.force || ah > 1) {
					for (ai = 0; ai < ae.length; ai++) {
						if (ae[ai] <= ah) {
							aj = ab[ae[ai]]
						}
					}
				}
				if (aj) {
					al = aj.offset || [-aj.width / 2, -aj.height / 2];
					am = y.extend({}, Y);
					am.options = y.extend({
						pane: "overlayLayer",
						content: aj.content ? aj.content.replace("CLUSTER_COUNT", ah) : "",
						offset: {x: ("x" in al ? al.x : al[0]) || 0, y: ("y" in al ? al.y : al[1]) || 0}
					}, Y.options || {});
					ak = S.overlay({todo: am, opts: am.options, latLng: I(ag)}, true);
					am.options.pane = "floatShadow";
					am.options.content = y(document.createElement("div")).width(aj.width + "px").height(aj.height + "px").css({cursor: "pointer"});
					shadow = S.overlay({todo: am, opts: am.options, latLng: I(ag)}, true);
					Y.data = {latLng: I(ag), markers: []};
					y.each(ag.indexes, function (ao, an) {
						Y.data.markers.push(af.value(an));
						if (af.markerIsSet(an)) {
							af.marker(an).setMap(null)
						}
					});
					n(T, {todo: Y}, shadow, t, {main: ak, shadow: shadow});
					af.store(ag, ak, shadow)
				} else {
					y.each(ag.indexes, function (ao, an) {
						af.marker(an).setMap(N)
					})
				}
			});
			return af
		}

		this.marker = function (aa) {
			var Y = "values" in aa.todo, ad = !N;
			if (!Y) {
				aa.opts.position = aa.latLng || I(aa.opts.position);
				aa.todo.values = [
					{options: aa.opts}
				]
			}
			if (!aa.todo.values.length) {
				O(aa, false);
				return
			}
			if (ad) {
				L()
			}
			if (aa.todo.cluster && !N.getBounds()) {
				google.maps.event.addListenerOnce(N, "bounds_changed", function () {
					S.marker.apply(S, [aa])
				});
				return
			}
			if (aa.todo.cluster) {
				var Z, ab;
				if (aa.todo.cluster instanceof a) {
					Z = aa.todo.cluster;
					ab = V.getById(Z.id(), true)
				} else {
					ab = W(aa.todo.cluster);
					Z = new a(k(aa.todo.id, true), ab);
					V.add(aa, "clusterer", Z, ab)
				}
				ab.beginUpdate();
				y.each(aa.todo.values, function (af, ag) {
					var ae = b(aa, ag);
					ae.options.position = ae.options.position ? I(ae.options.position) : I(ag);
					ae.options.map = N;
					if (ad) {
						N.setCenter(ae.options.position);
						ad = false
					}
					ab.add(ae, ag)
				});
				ab.endUpdate();
				O(aa, Z)
			} else {
				var ac = [];
				y.each(aa.todo.values, function (af, ag) {
					var ai, ah, ae = b(aa, ag);
					ae.options.position = ae.options.position ? I(ae.options.position) : I(ag);
					ae.options.map = N;
					if (ad) {
						N.setCenter(ae.options.position);
						ad = false
					}
					ah = new z.classes.Marker(ae.options);
					ac.push(ah);
					ai = V.add({todo: ae}, "marker", ah);
					n(T, {todo: ae}, ah, ai)
				});
				O(aa, Y ? ac : ac[0])
			}
		};
		this.getroute = function (Y) {
			Y.opts.origin = I(Y.opts.origin, true);
			Y.opts.destination = I(Y.opts.destination, true);
			G().route(Y.opts, function (aa, Z) {
				X(Y, Z == google.maps.DirectionsStatus.OK ? aa : false, Z);
				P.ack()
			})
		};
		this.directionsrenderer = function (Y) {
			Y.opts.map = N;
			var aa, Z = new google.maps.DirectionsRenderer(Y.opts);
			if (Y.todo.divId) {
				Z.setPanel(document.getElementById(Y.todo.divId))
			} else {
				if (Y.todo.container) {
					Z.setPanel(y(Y.todo.container).get(0))
				}
			}
			aa = V.add(Y, "directionsrenderer", Z);
			O(Y, Z, aa)
		};
		this.getgeoloc = function (Y) {
			O(Y, Y.latLng)
		};
		this.styledmaptype = function (Y) {
			L();
			var Z = new z.classes.StyledMapType(Y.todo.styles, Y.opts);
			N.mapTypes.set(Y.todo.id, Z);
			O(Y, Z)
		};
		this.imagemaptype = function (Y) {
			L();
			var Z = new z.classes.ImageMapType(Y.opts);
			N.mapTypes.set(Y.todo.id, Z);
			O(Y, Z)
		};
		this.autofit = function (Y) {
			var Z = new google.maps.LatLngBounds();
			y.each(V.all(), function (aa, ab) {
				if (ab.getPosition) {
					Z.extend(ab.getPosition())
				} else {
					if (ab.getBounds) {
						Z.extend(ab.getBounds().getNorthEast());
						Z.extend(ab.getBounds().getSouthWest())
					} else {
						if (ab.getPaths) {
							ab.getPaths().forEach(function (ac) {
								ac.forEach(function (ad) {
									Z.extend(ad)
								})
							})
						} else {
							if (ab.getPath) {
								ab.getPath().forEach(function (ac) {
									Z.extend(ac);
									""
								})
							} else {
								if (ab.getCenter) {
									Z.extend(ab.getCenter())
								} else {
									if (ab instanceof a) {
										ab = V.getById(ab.id(), true);
										if (ab) {
											ab.autofit(Z)
										}
									}
								}
							}
						}
					}
				}
			});
			if (!Z.isEmpty() && (!N.getBounds() || !N.getBounds().equals(Z))) {
				if ("maxZoom" in Y.todo) {
					google.maps.event.addListenerOnce(N, "bounds_changed", function () {
						if (this.getZoom() > Y.todo.maxZoom) {
							this.setZoom(Y.todo.maxZoom)
						}
					})
				}
				N.fitBounds(Z)
			}
			O(Y, true)
		};
		this.clear = function (Y) {
			if (typeof Y.todo === "string") {
				if (V.clearById(Y.todo) || V.objClearById(Y.todo)) {
					O(Y, true);
					return
				}
				Y.todo = {name: Y.todo}
			}
			if (Y.todo.id) {
				y.each(g(Y.todo.id), function (Z, aa) {
					V.clearById(aa) || V.objClearById(aa)
				})
			} else {
				V.clear(g(Y.todo.name), Y.todo.last, Y.todo.first, Y.todo.tag);
				V.objClear(g(Y.todo.name), Y.todo.last, Y.todo.first, Y.todo.tag)
			}
			O(Y, true)
		};
		this.exec = function (Y) {
			var Z = this;
			y.each(g(Y.todo.func), function (aa, ab) {
				y.each(Z.get(Y.todo, true, Y.todo.hasOwnProperty("full") ? Y.todo.full : true), function (ac, ad) {
					ab.call(T, ad)
				})
			});
			O(Y, true)
		};
		this.get = function (aa, ad, ac) {
			var Z, ab, Y = ad ? aa : aa.todo;
			if (!ad) {
				ac = Y.full
			}
			if (typeof Y === "string") {
				ab = V.getById(Y, false, ac) || V.objGetById(Y);
				if (ab === false) {
					Z = Y;
					Y = {}
				}
			} else {
				Z = Y.name
			}
			if (Z === "map") {
				ab = N
			}
			if (!ab) {
				ab = [];
				if (Y.id) {
					y.each(g(Y.id), function (ae, af) {
						ab.push(V.getById(af, false, ac) || V.objGetById(af))
					});
					if (!y.isArray(Y.id)) {
						ab = ab[0]
					}
				} else {
					y.each(Z ? g(Z) : [t], function (af, ag) {
						var ae;
						if (Y.first) {
							ae = V.get(ag, false, Y.tag, ac);
							if (ae) {
								ab.push(ae)
							}
						} else {
							if (Y.all) {
								y.each(V.all(ag, Y.tag, ac), function (ai, ah) {
									ab.push(ah)
								})
							} else {
								ae = V.get(ag, true, Y.tag, ac);
								if (ae) {
									ab.push(ae)
								}
							}
						}
					});
					if (!Y.all && !y.isArray(Z)) {
						ab = ab[0]
					}
				}
			}
			ab = y.isArray(ab) || !Y.all ? ab : [ab];
			if (ad) {
				return ab
			} else {
				O(aa, ab)
			}
		};
		this.getdistance = function (Y) {
			var Z;
			Y.opts.origins = g(Y.opts.origins);
			for (Z = 0; Z < Y.opts.origins.length; Z++) {
				Y.opts.origins[Z] = I(Y.opts.origins[Z], true)
			}
			Y.opts.destinations = g(Y.opts.destinations);
			for (Z = 0; Z < Y.opts.destinations.length; Z++) {
				Y.opts.destinations[Z] = I(Y.opts.destinations[Z], true)
			}
			B().getDistanceMatrix(Y.opts, function (ab, aa) {
				X(Y, aa === google.maps.DistanceMatrixStatus.OK ? ab : false, aa);
				P.ack()
			})
		};
		this.trigger = function (Z) {
			if (typeof Z.todo === "string") {
				google.maps.event.trigger(N, Z.todo)
			} else {
				var Y = [N, Z.todo.eventName];
				if (Z.todo.var_args) {
					y.each(Z.todo.var_args, function (ab, aa) {
						Y.push(aa)
					})
				}
				google.maps.event.trigger.apply(google.maps.event, Y)
			}
			X(Z);
			P.ack()
		}
	}

	function s(M) {
		var L;
		if (!typeof M === "object" || !M.hasOwnProperty("get")) {
			return false
		}
		for (L in M) {
			if (L !== "get") {
				return false
			}
		}
		return !M.get.hasOwnProperty("callback")
	}

	y.fn.gmap3 = function () {
		var M, O = [], N = true, L = [];
		J();
		for (M = 0; M < arguments.length; M++) {
			if (arguments[M]) {
				O.push(arguments[M])
			}
		}
		if (!O.length) {
			O.push("map")
		}
		y.each(this, function () {
			var P = y(this), Q = P.data("gmap3");
			N = false;
			if (!Q) {
				Q = new K(P);
				P.data("gmap3", Q)
			}
			if (O.length === 1 && (O[0] === "get" || s(O[0]))) {
				if (O[0] === "get") {
					L.push(Q.get("map", true))
				} else {
					L.push(Q.get(O[0].get, true, O[0].get.full))
				}
			} else {
				Q._plan(O)
			}
		});
		if (L.length) {
			if (L.length === 1) {
				return L[0]
			} else {
				return L
			}
		}
		return this
	}
})(jQuery);

/**
 * @preserve HTML5 Shiv 3.7.2 | @afarkas @jdalton @jon_neal @rem | MIT/GPL2 Licensed
 */
!function(a,b){function c(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function d(){var a=t.elements;return"string"==typeof a?a.split(" "):a}function e(a,b){var c=t.elements;"string"!=typeof c&&(c=c.join(" ")),"string"!=typeof a&&(a=a.join(" ")),t.elements=c+" "+a,j(b)}function f(a){var b=s[a[q]];return b||(b={},r++,a[q]=r,s[r]=b),b}function g(a,c,d){if(c||(c=b),l)return c.createElement(a);d||(d=f(c));var e;return e=d.cache[a]?d.cache[a].cloneNode():p.test(a)?(d.cache[a]=d.createElem(a)).cloneNode():d.createElem(a),!e.canHaveChildren||o.test(a)||e.tagUrn?e:d.frag.appendChild(e)}function h(a,c){if(a||(a=b),l)return a.createDocumentFragment();c=c||f(a);for(var e=c.frag.cloneNode(),g=0,h=d(),i=h.length;i>g;g++)e.createElement(h[g]);return e}function i(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return t.shivMethods?g(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+d().join().replace(/[\w\-:]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(t,b.frag)}function j(a){a||(a=b);var d=f(a);return!t.shivCSS||k||d.hasCSS||(d.hasCSS=!!c(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),l||i(a,d),a}var k,l,m="3.7.2",n=a.html5||{},o=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,q="_html5shiv",r=0,s={};!function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",k="hidden"in a,l=1==a.childNodes.length||function(){b.createElement("a");var a=b.createDocumentFragment();return"undefined"==typeof a.cloneNode||"undefined"==typeof a.createDocumentFragment||"undefined"==typeof a.createElement}()}catch(c){k=!0,l=!0}}();var t={elements:n.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:m,shivCSS:n.shivCSS!==!1,supportsUnknownElements:l,shivMethods:n.shivMethods!==!1,type:"default",shivDocument:j,createElement:g,createDocumentFragment:h,addElements:e};a.html5=t,j(b)}(this,document);
// https://github.com/bfred-it/iphone-inline-video
//
// DO NOT UPDATE BEFORE CHECKING CHANGES IN GIT HISTORY
var makeVideoPlayableInline = function($) {
    "use strict";

    function e(e) {
        var r = this;
        this.start = function(n) {
            if (n || !r.id) {
                r.id = requestAnimationFrame(r.start);
                e(n - (r.prev || n));
                r.prev = n
            }
        };
        this.stop = function() {
            cancelAnimationFrame(r.id);
            delete r.id;
            delete r.prev
        }
    }

    function r(e, r, n, i) {
        var t = function u(r) {
            var t = n && e[n];
            delete e[n];
            if (Boolean(t) === Boolean(i)) {
                r.stopImmediatePropagation()
            }
        };
        e.addEventListener(r, t, false);
        return {
            forget: function d() {
                return e.removeEventListener(r, t, false)
            }
        }
    }

    function n(e, r, n, i) {
        function t() {
            return n[r]
        }

        function u(e) {
            n[r] = e
        }
        if (i) {
            u(e[r])
        }
        Object.defineProperty(e, r, {
            get: t,
            set: u
        })
    }
    var i = typeof Symbol === "undefined" ? function(e) {
        return "@" + (e ? e : "@") + Math.random().toString(26)
    } : Symbol;
    var t = /iPhone|iPad|iPod/i.test(navigator.userAgent);
    var u = i();
    var d = i();
    var a = i("nativeplay");
    var o = i("nativepause");

    function v(e) {
        var r = new Audio;
        r.src = e.currentSrc || e.src;
        return r
    }
    var s = [];
    s.i = 0;

    function f(e, r) {
        if ((s.tue || 0) + 200 < Date.now()) {
            e[d] = true;
            s.tue = Date.now()
        }
        if ( isNaN(r) ) r = 0;
        e.currentTime = r;
        s[++s.i % 3] = r * 100 | 0 / 100
    }

    function c(e) {
        return e.driver.currentTime >= e.video.duration
    }

    function l(e) {
        var r = this;
        if (!r.hasAudio) {
            r.driver.currentTime = r.video.currentTime + e / 1e3;
            if (r.video.loop && c(r)) {
                r.driver.currentTime = 0
            }
        }
        f(r.video, r.driver.currentTime);
        if (r.video.ended) {
            r.video.pause(true);
            return false
        }
    }

    function p() {
        var e = this;
        var r = e[u];
        if (e.webkitDisplayingFullscreen) {
            e[a]();
            return
        }
        if (!e.paused) {
            return
        }
        if (!e.buffered.length) {
            e.load()
        }
        r.driver.play();
        r.updater.start();
        e.dispatchEvent(new Event("play"));
        e.dispatchEvent(new Event("playing"))
    }

    function m(e) {
        var r = this;
        var n = r[u];
        n.driver.pause();
        n.updater.stop();
        if (r.webkitDisplayingFullscreen) {
            r[o]()
        }
        if (r.paused && !e) {
            return
        }
        r.dispatchEvent(new Event("pause"));
        if (r.ended) {
            r[d] = true;
            r.dispatchEvent(new Event("ended"))
        }
    }

    function h(r, n) {
        var i = r[u] = {};
        i.hasAudio = n;
        i.video = r;
        i.updater = new e(l.bind(i));
        if (n) {
            i.driver = v(r)
        } else {
            i.driver = {
                muted: true,
                paused: true,
                pause: function t() {
                    i.driver.paused = true
                },
                play: function d() {
                    i.driver.paused = false;
                    if (c(i)) {
                        f(r, 0)
                    }
                },
                get ended() {
                    return c(i)
                }
            }
        }
        r.addEventListener("emptied", function() {
            if (i.driver.src && i.driver.src !== r.src) {
                f(r, 0);
                r.pause();
                i.driver.src = r.src
            }
        }, false);
        r.addEventListener("webkitbeginfullscreen", function() {
            if (!r.paused) {
                r.pause();
                r[a]()
            } else if (n && !i.driver.buffered.length) {
                i.driver.load()
            }
        });
        if (n) {
            r.addEventListener("webkitendfullscreen", function() {
                i.driver.currentTime = i.video.currentTime
            });
            r.addEventListener("seeking", function() {
                if (s.indexOf(i.video.currentTime * 100 | 0 / 100) < 0) {
                    i.driver.currentTime = i.video.currentTime
                }
            })
        }
    }

    function g(e) {
        var i = e[u];
        e[a] = e.play;
        e[o] = e.pause;
        e.play = p;
        e.pause = m;
        n(e, "paused", i.driver);
        n(e, "muted", i.driver, true);
        n(e, "ended", i.driver);
        n(e, "loop", i.driver, true);
        r(e, "seeking");
        r(e, "seeked");
        r(e, "timeupdate", d, false);
        r(e, "ended", d, false)
    }

    function y(e) {
        if ( $(e).hasClass('is-initialised') ) {
            return;
        }
        var r = arguments.length <= 1 || arguments[1] === undefined ? true : arguments[1];
        var n = arguments.length <= 2 || arguments[2] === undefined ? true : arguments[2];
        if (n && !t) {
            return
        }
        h(e, r);
        g(e);
        if (!r && e.autoplay) {
            e.play()
        }
        $(e).addClass('is-initialised');
    }
    return y
}(jQuery);
/*
 * jQuery appear plugin
 *
 * Copyright (c) 2012 Andrey Sidorov
 * licensed under MIT license.
 *
 * https://github.com/morr/jquery.appear/
 *
 * Version: 0.3.6
 */
(function($) {
  var selectors = [];

  var check_binded = false;
  var check_lock = false;
  var defaults = {
    interval: 250,
    force_process: false
  };
  var $window = $(window);

  var $prior_appeared = [];

  function appeared(selector) {
    return $(selector).filter(function() {
      return $(this).is(':appeared');
    });
  }

  function process() {
    check_lock = false;
    for (var index = 0, selectorsLength = selectors.length; index < selectorsLength; index++) {
      var $appeared = appeared(selectors[index]);

      $appeared.trigger('appear', [$appeared]);

      if ($prior_appeared[index]) {
        var $disappeared = $prior_appeared[index].not($appeared);
        $disappeared.trigger('disappear', [$disappeared]);
      }
      $prior_appeared[index] = $appeared;
    }
  }

  function add_selector(selector) {
    selectors.push(selector);
    $prior_appeared.push();
  }

  // "appeared" custom filter
  $.expr[':'].appeared = function(element) {
    var $element = $(element);
    if (!$element.is(':visible')) {
      return false;
    }

    var window_left = $window.scrollLeft();
    var window_top = $window.scrollTop();
    var offset = $element.offset();
    var left = offset.left;
    var top = offset.top;

    if (top + $element.height() >= window_top &&
        top - ($element.data('appear-top-offset') || 0) <= window_top + $window.height() &&
        left + $element.width() >= window_left &&
        left - ($element.data('appear-left-offset') || 0) <= window_left + $window.width()) {
      return true;
    } else {
      return false;
    }
  };

  $.fn.extend({
    // watching for element's appearance in browser viewport
    appear: function(options) {
      var opts = $.extend({}, defaults, options || {});
      var selector = this.selector || this;
      if (!check_binded) {
        var on_check = function() {
          if (check_lock) {
            return;
          }
          check_lock = true;

          setTimeout(process, opts.interval);
        };

        $(window).scroll(on_check).resize(on_check);
        check_binded = true;
      }

      if (opts.force_process) {
        setTimeout(process, opts.interval);
      }
      add_selector(selector);
      return $(selector);
    }
  });

  $.extend({
    // force elements's appearance check
    force_appear: function() {
      if (check_binded) {
        process();
        return true;
      }
      return false;
    }
  });
})(function() {
  if (typeof module !== 'undefined') {
    // Node
    return require('jquery');
  } else {
    return jQuery;
  }
}());
/*!
 * hoverIntent v1.8.1 // 2014.08.22 // jQuery v1.9.1+
 * http://briancherne.github.io/jquery-hoverIntent/
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2014 Brian Cherne
 */

/* hoverIntent is similar to jQuery's built-in "hover" method except that
 * instead of firing the handlerIn function immediately, hoverIntent checks
 * to see if the user's mouse has slowed down (beneath the sensitivity
 * threshold) before firing the event. The handlerOut function is only
 * called after a matching handlerIn.
 *
 * // basic usage ... just like .hover()
 * .hoverIntent( handlerIn, handlerOut )
 * .hoverIntent( handlerInOut )
 *
 * // basic usage ... with event delegation!
 * .hoverIntent( handlerIn, handlerOut, selector )
 * .hoverIntent( handlerInOut, selector )
 *
 * // using a basic configuration object
 * .hoverIntent( config )
 *
 * @param  handlerIn   function OR configuration object
 * @param  handlerOut  function OR selector for delegation OR undefined
 * @param  selector    selector OR undefined
 * @author Brian Cherne <brian(at)cherne(dot)net>
 */

(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (jQuery && !jQuery.fn.hoverIntent) {
        factory(jQuery);
    }
})(function($) {
    'use strict';

    // default configuration values
    var _cfg = {
        interval: 100,
        sensitivity: 6,
        timeout: 0
    };

    // counter used to generate an ID for each instance
    var INSTANCE_COUNT = 0;

    // current X and Y position of mouse, updated during mousemove tracking (shared across instances)
    var cX, cY;

    // saves the current pointer position coordinates based on the given mousemove event
    var track = function(ev) {
        cX = ev.pageX;
        cY = ev.pageY;
    };

    // compares current and previous mouse positions
    var compare = function(ev,$el,s,cfg) {
        // compare mouse positions to see if pointer has slowed enough to trigger `over` function
        if ( Math.sqrt( (s.pX-cX)*(s.pX-cX) + (s.pY-cY)*(s.pY-cY) ) < cfg.sensitivity ) {
            $el.off(s.event,track);
            delete s.timeoutId;
            // set hoverIntent state as active for this element (permits `out` handler to trigger)
            s.isActive = true;
            // overwrite old mouseenter event coordinates with most recent pointer position
            ev.pageX = cX; ev.pageY = cY;
            // clear coordinate data from state object
            delete s.pX; delete s.pY;
            return cfg.over.apply($el[0],[ev]);
        } else {
            // set previous coordinates for next comparison
            s.pX = cX; s.pY = cY;
            // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
            s.timeoutId = setTimeout( function(){compare(ev, $el, s, cfg);} , cfg.interval );
        }
    };

    // triggers given `out` function at configured `timeout` after a mouseleave and clears state
    var delay = function(ev,$el,s,out) {
        delete $el.data('hoverIntent')[s.id];
        return out.apply($el[0],[ev]);
    };

    $.fn.hoverIntent = function(handlerIn,handlerOut,selector) {
        // instance ID, used as a key to store and retrieve state information on an element
        var instanceId = INSTANCE_COUNT++;

        // extend the default configuration and parse parameters
        var cfg = $.extend({}, _cfg);
        if ( $.isPlainObject(handlerIn) ) {
            cfg = $.extend(cfg, handlerIn);
            if ( !$.isFunction(cfg.out) ) {
                cfg.out = cfg.over;
            }
        } else if ( $.isFunction(handlerOut) ) {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
        } else {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
        }

        // A private function for handling mouse 'hovering'
        var handleHover = function(e) {
            // cloned event to pass to handlers (copy required for event object to be passed in IE)
            var ev = $.extend({},e);

            // the current target of the mouse event, wrapped in a jQuery object
            var $el = $(this);

            // read hoverIntent data from element (or initialize if not present)
            var hoverIntentData = $el.data('hoverIntent');
            if (!hoverIntentData) { $el.data('hoverIntent', (hoverIntentData = {})); }

            // read per-instance state from element (or initialize if not present)
            var state = hoverIntentData[instanceId];
            if (!state) { hoverIntentData[instanceId] = state = { id: instanceId }; }

            // state properties:
            // id = instance ID, used to clean up data
            // timeoutId = timeout ID, reused for tracking mouse position and delaying "out" handler
            // isActive = plugin state, true after `over` is called just until `out` is called
            // pX, pY = previously-measured pointer coordinates, updated at each polling interval
            // event = string representing the namespaced event used for mouse tracking

            // clear any existing timeout
            if (state.timeoutId) { state.timeoutId = clearTimeout(state.timeoutId); }

            // namespaced event used to register and unregister mousemove tracking
            var mousemove = state.event = 'mousemove.hoverIntent.hoverIntent'+instanceId;

            // handle the event, based on its type
            if (e.type === 'mouseenter') {
                // do nothing if already active
                if (state.isActive) { return; }
                // set "previous" X and Y position based on initial entry point
                state.pX = ev.pageX; state.pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $el.off(mousemove,track).on(mousemove,track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                state.timeoutId = setTimeout( function(){compare(ev,$el,state,cfg);} , cfg.interval );
            } else { // "mouseleave"
                // do nothing if not already active
                if (!state.isActive) { return; }
                // unbind expensive mousemove event
                $el.off(mousemove,track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                state.timeoutId = setTimeout( function(){delay(ev,$el,state,cfg.out);} , cfg.timeout );
            }
        };

        // listen for mouseenter and mouseleave
        return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
    };
});
// Magnific Popup v1.1.0 by Dmitry Semenov
// http://bit.ly/magnific-popup#build=image+iframe+gallery+retina+imagezoom
// MIT LICENSE
(function(a){typeof define=="function"&&define.amd?define(["jquery"],a):typeof exports=="object"?a(require("jquery")):a(window.jQuery||window.Zepto)})(function(a){var b="Close",c="BeforeClose",d="AfterClose",e="BeforeAppend",f="MarkupParse",g="Open",h="Change",i="mfp",j="."+i,k="mfp-ready",l="mfp-removing",m="mfp-prevent-close",n,o=function(){},p=!!window.jQuery,q,r=a(window),s,t,u,v,w=function(a,b){n.ev.on(i+a+j,b)},x=function(b,c,d,e){var f=document.createElement("div");return f.className="mfp-"+b,d&&(f.innerHTML=d),e?c&&c.appendChild(f):(f=a(f),c&&f.appendTo(c)),f},y=function(b,c){n.ev.triggerHandler(i+b,c),n.st.callbacks&&(b=b.charAt(0).toLowerCase()+b.slice(1),n.st.callbacks[b]&&n.st.callbacks[b].apply(n,a.isArray(c)?c:[c]))},z=function(b){if(b!==v||!n.currTemplate.closeBtn)n.currTemplate.closeBtn=a(n.st.closeMarkup.replace("%title%",n.st.tClose)),v=b;return n.currTemplate.closeBtn},A=function(){a.magnificPopup.instance||(n=new o,n.init(),a.magnificPopup.instance=n)},B=function(){var a=document.createElement("p").style,b=["ms","O","Moz","Webkit"];if(a.transition!==undefined)return!0;while(b.length)if(b.pop()+"Transition"in a)return!0;return!1};o.prototype={constructor:o,init:function(){var b=navigator.appVersion;n.isLowIE=n.isIE8=document.all&&!document.addEventListener,n.isAndroid=/android/gi.test(b),n.isIOS=/iphone|ipad|ipod/gi.test(b),n.supportsTransition=B(),n.probablyMobile=n.isAndroid||n.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),s=a(document),n.popupsCache={}},open:function(b){var c;if(b.isObj===!1){n.items=b.items.toArray(),n.index=0;var d=b.items,e;for(c=0;c<d.length;c++){e=d[c],e.parsed&&(e=e.el[0]);if(e===b.el[0]){n.index=c;break}}}else n.items=a.isArray(b.items)?b.items:[b.items],n.index=b.index||0;if(n.isOpen){n.updateItemHTML();return}n.types=[],u="",b.mainEl&&b.mainEl.length?n.ev=b.mainEl.eq(0):n.ev=s,b.key?(n.popupsCache[b.key]||(n.popupsCache[b.key]={}),n.currTemplate=n.popupsCache[b.key]):n.currTemplate={},n.st=a.extend(!0,{},a.magnificPopup.defaults,b),n.fixedContentPos=n.st.fixedContentPos==="auto"?!n.probablyMobile:n.st.fixedContentPos,n.st.modal&&(n.st.closeOnContentClick=!1,n.st.closeOnBgClick=!1,n.st.showCloseBtn=!1,n.st.enableEscapeKey=!1),n.bgOverlay||(n.bgOverlay=x("bg").on("click"+j,function(){n.close()}),n.wrap=x("wrap").attr("tabindex",-1).on("click"+j,function(a){n._checkIfClose(a.target)&&n.close()}),n.container=x("container",n.wrap)),n.contentContainer=x("content"),n.st.preloader&&(n.preloader=x("preloader",n.container,n.st.tLoading));var h=a.magnificPopup.modules;for(c=0;c<h.length;c++){var i=h[c];i=i.charAt(0).toUpperCase()+i.slice(1),n["init"+i].call(n)}y("BeforeOpen"),n.st.showCloseBtn&&(n.st.closeBtnInside?(w(f,function(a,b,c,d){c.close_replaceWith=z(d.type)}),u+=" mfp-close-btn-in"):n.wrap.append(z())),n.st.alignTop&&(u+=" mfp-align-top"),n.fixedContentPos?n.wrap.css({overflow:n.st.overflowY,overflowX:"hidden",overflowY:n.st.overflowY}):n.wrap.css({top:r.scrollTop(),position:"absolute"}),(n.st.fixedBgPos===!1||n.st.fixedBgPos==="auto"&&!n.fixedContentPos)&&n.bgOverlay.css({height:s.height(),position:"absolute"}),n.st.enableEscapeKey&&s.on("keyup"+j,function(a){a.keyCode===27&&n.close()}),r.on("resize"+j,function(){n.updateSize()}),n.st.closeOnContentClick||(u+=" mfp-auto-cursor"),u&&n.wrap.addClass(u);var l=n.wH=r.height(),m={};if(n.fixedContentPos&&n._hasScrollBar(l)){var o=n._getScrollbarSize();o&&(m.marginRight=o)}n.fixedContentPos&&(n.isIE7?a("body, html").css("overflow","hidden"):m.overflow="hidden");var p=n.st.mainClass;return n.isIE7&&(p+=" mfp-ie7"),p&&n._addClassToMFP(p),n.updateItemHTML(),y("BuildControls"),a("html").css(m),n.bgOverlay.add(n.wrap).prependTo(n.st.prependTo||a(document.body)),n._lastFocusedEl=document.activeElement,setTimeout(function(){n.content?(n._addClassToMFP(k),n._setFocus()):n.bgOverlay.addClass(k),s.on("focusin"+j,n._onFocusIn)},16),n.isOpen=!0,n.updateSize(l),y(g),b},close:function(){if(!n.isOpen)return;y(c),n.isOpen=!1,n.st.removalDelay&&!n.isLowIE&&n.supportsTransition?(n._addClassToMFP(l),setTimeout(function(){n._close()},n.st.removalDelay)):n._close()},_close:function(){y(b);var c=l+" "+k+" ";n.bgOverlay.detach(),n.wrap.detach(),n.container.empty(),n.st.mainClass&&(c+=n.st.mainClass+" "),n._removeClassFromMFP(c);if(n.fixedContentPos){var e={marginRight:""};n.isIE7?a("body, html").css("overflow",""):e.overflow="",a("html").css(e)}s.off("keyup"+j+" focusin"+j),n.ev.off(j),n.wrap.attr("class","mfp-wrap").removeAttr("style"),n.bgOverlay.attr("class","mfp-bg"),n.container.attr("class","mfp-container"),n.st.showCloseBtn&&(!n.st.closeBtnInside||n.currTemplate[n.currItem.type]===!0)&&n.currTemplate.closeBtn&&n.currTemplate.closeBtn.detach(),n.st.autoFocusLast&&n._lastFocusedEl&&a(n._lastFocusedEl).focus(),n.currItem=null,n.content=null,n.currTemplate=null,n.prevHeight=0,y(d)},updateSize:function(a){if(n.isIOS){var b=document.documentElement.clientWidth/window.innerWidth,c=window.innerHeight*b;n.wrap.css("height",c),n.wH=c}else n.wH=a||r.height();n.fixedContentPos||n.wrap.css("height",n.wH),y("Resize")},updateItemHTML:function(){var b=n.items[n.index];n.contentContainer.detach(),n.content&&n.content.detach(),b.parsed||(b=n.parseEl(n.index));var c=b.type;y("BeforeChange",[n.currItem?n.currItem.type:"",c]),n.currItem=b;if(!n.currTemplate[c]){var d=n.st[c]?n.st[c].markup:!1;y("FirstMarkupParse",d),d?n.currTemplate[c]=a(d):n.currTemplate[c]=!0}t&&t!==b.type&&n.container.removeClass("mfp-"+t+"-holder");var e=n["get"+c.charAt(0).toUpperCase()+c.slice(1)](b,n.currTemplate[c]);n.appendContent(e,c),b.preloaded=!0,y(h,b),t=b.type,n.container.prepend(n.contentContainer),y("AfterChange")},appendContent:function(a,b){n.content=a,a?n.st.showCloseBtn&&n.st.closeBtnInside&&n.currTemplate[b]===!0?n.content.find(".mfp-close").length||n.content.append(z()):n.content=a:n.content="",y(e),n.container.addClass("mfp-"+b+"-holder"),n.contentContainer.append(n.content)},parseEl:function(b){var c=n.items[b],d;c.tagName?c={el:a(c)}:(d=c.type,c={data:c,src:c.src});if(c.el){var e=n.types;for(var f=0;f<e.length;f++)if(c.el.hasClass("mfp-"+e[f])){d=e[f];break}c.src=c.el.attr("data-mfp-src"),c.src||(c.src=c.el.attr("href"))}return c.type=d||n.st.type||"inline",c.index=b,c.parsed=!0,n.items[b]=c,y("ElementParse",c),n.items[b]},addGroup:function(a,b){var c=function(c){c.mfpEl=this,n._openClick(c,a,b)};b||(b={});var d="click.magnificPopup";b.mainEl=a,b.items?(b.isObj=!0,a.off(d).on(d,c)):(b.isObj=!1,b.delegate?a.off(d).on(d,b.delegate,c):(b.items=a,a.off(d).on(d,c)))},_openClick:function(b,c,d){var e=d.midClick!==undefined?d.midClick:a.magnificPopup.defaults.midClick;if(!e&&(b.which===2||b.ctrlKey||b.metaKey||b.altKey||b.shiftKey))return;var f=d.disableOn!==undefined?d.disableOn:a.magnificPopup.defaults.disableOn;if(f)if(a.isFunction(f)){if(!f.call(n))return!0}else if(r.width()<f)return!0;b.type&&(b.preventDefault(),n.isOpen&&b.stopPropagation()),d.el=a(b.mfpEl),d.delegate&&(d.items=c.find(d.delegate)),n.open(d)},updateStatus:function(a,b){if(n.preloader){q!==a&&n.container.removeClass("mfp-s-"+q),!b&&a==="loading"&&(b=n.st.tLoading);var c={status:a,text:b};y("UpdateStatus",c),a=c.status,b=c.text,n.preloader.html(b),n.preloader.find("a").on("click",function(a){a.stopImmediatePropagation()}),n.container.addClass("mfp-s-"+a),q=a}},_checkIfClose:function(b){if(a(b).hasClass(m))return;var c=n.st.closeOnContentClick,d=n.st.closeOnBgClick;if(c&&d)return!0;if(!n.content||a(b).hasClass("mfp-close")||n.preloader&&b===n.preloader[0])return!0;if(b!==n.content[0]&&!a.contains(n.content[0],b)){if(d&&a.contains(document,b))return!0}else if(c)return!0;return!1},_addClassToMFP:function(a){n.bgOverlay.addClass(a),n.wrap.addClass(a)},_removeClassFromMFP:function(a){this.bgOverlay.removeClass(a),n.wrap.removeClass(a)},_hasScrollBar:function(a){return(n.isIE7?s.height():document.body.scrollHeight)>(a||r.height())},_setFocus:function(){(n.st.focus?n.content.find(n.st.focus).eq(0):n.wrap).focus()},_onFocusIn:function(b){if(b.target!==n.wrap[0]&&!a.contains(n.wrap[0],b.target))return n._setFocus(),!1},_parseMarkup:function(b,c,d){var e;d.data&&(c=a.extend(d.data,c)),y(f,[b,c,d]),a.each(c,function(c,d){if(d===undefined||d===!1)return!0;e=c.split("_");if(e.length>1){var f=b.find(j+"-"+e[0]);if(f.length>0){var g=e[1];g==="replaceWith"?f[0]!==d[0]&&f.replaceWith(d):g==="img"?f.is("img")?f.attr("src",d):f.replaceWith(a("<img>").attr("src",d).attr("class",f.attr("class"))):f.attr(e[1],d)}}else b.find(j+"-"+c).html(d)})},_getScrollbarSize:function(){if(n.scrollbarSize===undefined){var a=document.createElement("div");a.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(a),n.scrollbarSize=a.offsetWidth-a.clientWidth,document.body.removeChild(a)}return n.scrollbarSize}},a.magnificPopup={instance:null,proto:o.prototype,modules:[],open:function(b,c){return A(),b?b=a.extend(!0,{},b):b={},b.isObj=!0,b.index=c||0,this.instance.open(b)},close:function(){return a.magnificPopup.instance&&a.magnificPopup.instance.close()},registerModule:function(b,c){c.options&&(a.magnificPopup.defaults[b]=c.options),a.extend(this.proto,c.proto),this.modules.push(b)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&#215;</button>',tClose:"Close (Esc)",tLoading:"Loading...",autoFocusLast:!0}},a.fn.magnificPopup=function(b){A();var c=a(this);if(typeof b=="string")if(b==="open"){var d,e=p?c.data("magnificPopup"):c[0].magnificPopup,f=parseInt(arguments[1],10)||0;e.items?d=e.items[f]:(d=c,e.delegate&&(d=d.find(e.delegate)),d=d.eq(f)),n._openClick({mfpEl:d},c,e)}else n.isOpen&&n[b].apply(n,Array.prototype.slice.call(arguments,1));else b=a.extend(!0,{},b),p?c.data("magnificPopup",b):c[0].magnificPopup=b,n.addGroup(c,b);return c};var C,D=function(b){if(b.data&&b.data.title!==undefined)return b.data.title;var c=n.st.image.titleSrc;if(c){if(a.isFunction(c))return c.call(n,b);if(b.el)return b.el.attr(c)||""}return""};a.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var c=n.st.image,d=".image";n.types.push("image"),w(g+d,function(){n.currItem.type==="image"&&c.cursor&&a(document.body).addClass(c.cursor)}),w(b+d,function(){c.cursor&&a(document.body).removeClass(c.cursor),r.off("resize"+j)}),w("Resize"+d,n.resizeImage),n.isLowIE&&w("AfterChange",n.resizeImage)},resizeImage:function(){var a=n.currItem;if(!a||!a.img)return;if(n.st.image.verticalFit){var b=0;n.isLowIE&&(b=parseInt(a.img.css("padding-top"),10)+parseInt(a.img.css("padding-bottom"),10)),a.img.css("max-height",n.wH-b)}},_onImageHasSize:function(a){a.img&&(a.hasSize=!0,C&&clearInterval(C),a.isCheckingImgSize=!1,y("ImageHasSize",a),a.imgHidden&&(n.content&&n.content.removeClass("mfp-loading"),a.imgHidden=!1))},findImageSize:function(a){var b=0,c=a.img[0],d=function(e){C&&clearInterval(C),C=setInterval(function(){if(c.naturalWidth>0){n._onImageHasSize(a);return}b>200&&clearInterval(C),b++,b===3?d(10):b===40?d(50):b===100&&d(500)},e)};d(1)},getImage:function(b,c){var d=0,e=function(){b&&(b.img[0].complete?(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("ready")),b.hasSize=!0,b.loaded=!0,y("ImageLoadComplete")):(d++,d<200?setTimeout(e,100):f()))},f=function(){b&&(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("error",g.tError.replace("%url%",b.src))),b.hasSize=!0,b.loaded=!0,b.loadError=!0)},g=n.st.image,h=c.find(".mfp-img");if(h.length){var i=document.createElement("img");i.className="mfp-img",b.el&&b.el.find("img").length&&(i.alt=b.el.find("img").attr("alt")),b.img=a(i).on("load.mfploader",e).on("error.mfploader",f),i.src=b.src,h.is("img")&&(b.img=b.img.clone()),i=b.img[0],i.naturalWidth>0?b.hasSize=!0:i.width||(b.hasSize=!1)}return n._parseMarkup(c,{title:D(b),img_replaceWith:b.img},b),n.resizeImage(),b.hasSize?(C&&clearInterval(C),b.loadError?(c.addClass("mfp-loading"),n.updateStatus("error",g.tError.replace("%url%",b.src))):(c.removeClass("mfp-loading"),n.updateStatus("ready")),c):(n.updateStatus("loading"),b.loading=!0,b.hasSize||(b.imgHidden=!0,c.addClass("mfp-loading"),n.findImageSize(b)),c)}}});var E,F=function(){return E===undefined&&(E=document.createElement("p").style.MozTransform!==undefined),E};a.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(a){return a.is("img")?a:a.find("img")}},proto:{initZoom:function(){var a=n.st.zoom,d=".zoom",e;if(!a.enabled||!n.supportsTransition)return;var f=a.duration,g=function(b){var c=b.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),d="all "+a.duration/1e3+"s "+a.easing,e={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},f="transition";return e["-webkit-"+f]=e["-moz-"+f]=e["-o-"+f]=e[f]=d,c.css(e),c},h=function(){n.content.css("visibility","visible")},i,j;w("BuildControls"+d,function(){if(n._allowZoom()){clearTimeout(i),n.content.css("visibility","hidden"),e=n._getItemToZoom();if(!e){h();return}j=g(e),j.css(n._getOffset()),n.wrap.append(j),i=setTimeout(function(){j.css(n._getOffset(!0)),i=setTimeout(function(){h(),setTimeout(function(){j.remove(),e=j=null,y("ZoomAnimationEnded")},16)},f)},16)}}),w(c+d,function(){if(n._allowZoom()){clearTimeout(i),n.st.removalDelay=f;if(!e){e=n._getItemToZoom();if(!e)return;j=g(e)}j.css(n._getOffset(!0)),n.wrap.append(j),n.content.css("visibility","hidden"),setTimeout(function(){j.css(n._getOffset())},16)}}),w(b+d,function(){n._allowZoom()&&(h(),j&&j.remove(),e=null)})},_allowZoom:function(){return n.currItem.type==="image"},_getItemToZoom:function(){return n.currItem.hasSize?n.currItem.img:!1},_getOffset:function(b){var c;b?c=n.currItem.img:c=n.st.zoom.opener(n.currItem.el||n.currItem);var d=c.offset(),e=parseInt(c.css("padding-top"),10),f=parseInt(c.css("padding-bottom"),10);d.top-=a(window).scrollTop()-e;var g={width:c.width(),height:(p?c.innerHeight():c[0].offsetHeight)-f-e};return F()?g["-moz-transform"]=g.transform="translate("+d.left+"px,"+d.top+"px)":(g.left=d.left,g.top=d.top),g}}});var G="iframe",H="//about:blank",I=function(a){if(n.currTemplate[G]){var b=n.currTemplate[G].find("iframe");b.length&&(a||(b[0].src=H),n.isIE8&&b.css("display",a?"block":"none"))}};a.magnificPopup.registerModule(G,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){n.types.push(G),w("BeforeChange",function(a,b,c){b!==c&&(b===G?I():c===G&&I(!0))}),w(b+"."+G,function(){I()})},getIframe:function(b,c){var d=b.src,e=n.st.iframe;a.each(e.patterns,function(){if(d.indexOf(this.index)>-1)return this.id&&(typeof this.id=="string"?d=d.substr(d.lastIndexOf(this.id)+this.id.length,d.length):d=this.id.call(this,d)),d=this.src.replace("%id%",d),!1});var f={};return e.srcAction&&(f[e.srcAction]=d),n._parseMarkup(c,f,b),n.updateStatus("ready"),c}}});var J=function(a){var b=n.items.length;return a>b-1?a-b:a<0?b+a:a},K=function(a,b,c){return a.replace(/%curr%/gi,b+1).replace(/%total%/gi,c)};a.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var c=n.st.gallery,d=".mfp-gallery";n.direction=!0;if(!c||!c.enabled)return!1;u+=" mfp-gallery",w(g+d,function(){c.navigateByImgClick&&n.wrap.on("click"+d,".mfp-img",function(){if(n.items.length>1)return n.next(),!1}),s.on("keydown"+d,function(a){a.keyCode===37?n.prev():a.keyCode===39&&n.next()})}),w("UpdateStatus"+d,function(a,b){b.text&&(b.text=K(b.text,n.currItem.index,n.items.length))}),w(f+d,function(a,b,d,e){var f=n.items.length;d.counter=f>1?K(c.tCounter,e.index,f):""}),w("BuildControls"+d,function(){if(n.items.length>1&&c.arrows&&!n.arrowLeft){var b=c.arrowMarkup,d=n.arrowLeft=a(b.replace(/%title%/gi,c.tPrev).replace(/%dir%/gi,"left")).addClass(m),e=n.arrowRight=a(b.replace(/%title%/gi,c.tNext).replace(/%dir%/gi,"right")).addClass(m);d.click(function(){n.prev()}),e.click(function(){n.next()}),n.container.append(d.add(e))}}),w(h+d,function(){n._preloadTimeout&&clearTimeout(n._preloadTimeout),n._preloadTimeout=setTimeout(function(){n.preloadNearbyImages(),n._preloadTimeout=null},16)}),w(b+d,function(){s.off(d),n.wrap.off("click"+d),n.arrowRight=n.arrowLeft=null})},next:function(){n.direction=!0,n.index=J(n.index+1),n.updateItemHTML()},prev:function(){n.direction=!1,n.index=J(n.index-1),n.updateItemHTML()},goTo:function(a){n.direction=a>=n.index,n.index=a,n.updateItemHTML()},preloadNearbyImages:function(){var a=n.st.gallery.preload,b=Math.min(a[0],n.items.length),c=Math.min(a[1],n.items.length),d;for(d=1;d<=(n.direction?c:b);d++)n._preloadItem(n.index+d);for(d=1;d<=(n.direction?b:c);d++)n._preloadItem(n.index-d)},_preloadItem:function(b){b=J(b);if(n.items[b].preloaded)return;var c=n.items[b];c.parsed||(c=n.parseEl(b)),y("LazyLoad",c),c.type==="image"&&(c.img=a('<img class="mfp-img" />').on("load.mfploader",function(){c.hasSize=!0}).on("error.mfploader",function(){c.hasSize=!0,c.loadError=!0,y("LazyLoadError",c)}).attr("src",c.src)),c.preloaded=!0}}});var L="retina";a.magnificPopup.registerModule(L,{options:{replaceSrc:function(a){return a.src.replace(/\.\w+$/,function(a){return"@2x"+a})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var a=n.st.retina,b=a.ratio;b=isNaN(b)?b():b,b>1&&(w("ImageHasSize."+L,function(a,c){c.img.css({"max-width":c.img[0].naturalWidth/b,width:"100%"})}),w("ElementParse."+L,function(c,d){d.src=a.replaceSrc(d,b)}))}}}}),A()});
/*! modernizr 3.3.1 (Custom Build) | MIT *
 * http://modernizr.com/download/?-touchevents-setclasses !*/
!function(e,n,t){function o(e,n){return typeof e===n}function s(){var e,n,t,s,a,i,r;for(var l in c)if(c.hasOwnProperty(l)){if(e=[],n=c[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(s=o(n.fn,"function")?n.fn():n.fn,a=0;a<e.length;a++)i=e[a],r=i.split("."),1===r.length?Modernizr[r[0]]=s:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=s),f.push((s?"":"no-")+r.join("-"))}}function a(e){var n=u.className,t=Modernizr._config.classPrefix||"";if(p&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),p?u.className.baseVal=n:u.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):p?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function r(){var e=n.body;return e||(e=i(p?"svg":"body"),e.fake=!0),e}function l(e,t,o,s){var a,l,f,c,d="modernizr",p=i("div"),h=r();if(parseInt(o,10))for(;o--;)f=i("div"),f.id=s?s[o]:d+(o+1),p.appendChild(f);return a=i("style"),a.type="text/css",a.id="s"+d,(h.fake?h:p).appendChild(a),h.appendChild(p),a.styleSheet?a.styleSheet.cssText=e:a.appendChild(n.createTextNode(e)),p.id=d,h.fake&&(h.style.background="",h.style.overflow="hidden",c=u.style.overflow,u.style.overflow="hidden",u.appendChild(h)),l=t(p,e),h.fake?(h.parentNode.removeChild(h),u.style.overflow=c,u.offsetHeight):p.parentNode.removeChild(p),!!l}var f=[],c=[],d={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){c.push({name:e,fn:n,options:t})},addAsyncTest:function(e){c.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=d,Modernizr=new Modernizr;var u=n.documentElement,p="svg"===u.nodeName.toLowerCase(),h=d._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];d._prefixes=h;var m=d.testStyles=l;Modernizr.addTest("touchevents",function(){var t;if("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch)t=!0;else{var o=["@media (",h.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");m(o,function(e){t=9===e.offsetTop})}return t}),s(),a(f),delete d.addTest,delete d.addAsyncTest;for(var v=0;v<Modernizr._q.length;v++)Modernizr._q[v]();e.Modernizr=Modernizr}(window,document);
/* --- ORGANIC TABS --- */

// --- MODIFIED
// https://github.com/CSS-Tricks/jQuery-Organic-Tabs
// https://css-tricks.com/license/
(function ($) {
	"use strict";
    $.organicTabs = function (el, options) {
        var base = this;
        base.$el = $(el);
        base.$nav = base.$el.find(".tabs__nav");
        base.init = function () {
            base.options = $.extend({}, $.organicTabs.defaultOptions, options);
            var $allListWrap = base.$el.find(".tabs__content"),
                curList = base.$el.find("a.current").attr("href").substring(1);
            $allListWrap.height(base.$el.find("#" + curList).height());

            base.$nav.find("li > a").one('click', function() {
                base.$el.find(".tabs__content").css('overflow', 'hidden');
            });

            base.$nav.find("li > a").click(function (event) {

                var curList = base.$el.find("a.current").attr("href").substring(1),
                    $newList = $(this),
                    listID = $newList.attr("href").substring(1);
                if ((listID != curList) && (base.$el.find(":animated").length == 0)) {
                    base.$el.find("#" + curList).css({
                        opacity: 0,
                        "z-index": 10,
                        "pointer-events": "none"
                    });
                    var newHeight = base.$el.find("#" + listID).height();
                    $allListWrap.css({
                        height: newHeight
                    });
                    setTimeout(function () {
                        base.$el.find("#" + curList);
                        base.$el.find("#" + listID).css({
                            opacity: 1,
                            "z-index": 100,
                            "pointer-events": "auto"
                        });
                        base.$el.find(".tabs__nav li a").removeClass("current");
                        $newList.addClass("current");
                    }, 250);
                }
                event.preventDefault();
            });
        };
        base.init();
    };
    $.organicTabs.defaultOptions = {
        speed: 300
    };
    $.fn.organicTabs = function (options) {
        return this.each(function () {
            (new $.organicTabs(this, options));
        });
    };

})(jQuery);
// Adapted from https://gist.github.com/paulirish/1579671 which derived from
// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik Möller.
// Fixes from Paul Irish, Tino Zijdel, Andrew Mao, Klemen Slavič, Darius Bacon

// MIT license

if (!Date.now)
    Date.now = function() { return new Date().getTime(); };

(function() {
    'use strict';

    var vendors = ['webkit', 'moz'];
    for (var i = 0; i < vendors.length && !window.requestAnimationFrame; ++i) {
        var vp = vendors[i];
        window.requestAnimationFrame = window[vp+'RequestAnimationFrame'];
        window.cancelAnimationFrame = (window[vp+'CancelAnimationFrame']
        || window[vp+'CancelRequestAnimationFrame']);
    }
    if (/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent) // iOS6 is buggy
        || !window.requestAnimationFrame || !window.cancelAnimationFrame) {
        var lastTime = 0;
        window.requestAnimationFrame = function(callback) {
            var now = Date.now();
            var nextTime = Math.max(lastTime + 16, now);
            return setTimeout(function() { callback(lastTime = nextTime); },
                nextTime - now);
        };
        window.cancelAnimationFrame = clearTimeout;
    }
}());
// /* ====== HELPER FUNCTIONS ====== */

//similar to PHP's empty function
function empty(data)
{
	if(typeof(data) == 'number' || typeof(data) == 'boolean')
	{
		return false;
	}
	if(typeof(data) == 'undefined' || data === null)
	{
		return true;
	}
	if(typeof(data.length) != 'undefined')
	{
		return data.length === 0;
	}
	var count = 0;
	for(var i in data)
	{
		// if(data.hasOwnProperty(i))
		//
		// This doesn't work in ie8/ie9 due the fact that hasOwnProperty works only on native objects.
		// http://stackoverflow.com/questions/8157700/object-has-no-hasownproperty-method-i-e-its-undefined-ie8
		//
		// for hosts objects we do this
		if(Object.prototype.hasOwnProperty.call(data,i))
		{
			count ++;
		}
	}
	return count === 0;
}

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
	var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
	separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
		return uri + separator + key + "=" + value;
	}
}
