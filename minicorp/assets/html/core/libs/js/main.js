/* *********************************************************************************************************************
 * Global variables
 */
var logo;
var nav;
var mainNav;
var WAIT_INTERVAL = 100;
var BREAKINGPOINT = 768;
var RESPONSIVE = true;
var isStickyNav = false;

if (typeof ishyoboy_fe_globals !== 'undefined') {
    if (typeof ishyoboy_fe_globals.IYB_RESPONSIVE !== 'undefined') {
        RESPONSIVE = ishyoboy_fe_globals.IYB_RESPONSIVE;
    }
    if (typeof ishyoboy_fe_globals.IYB_BREAKINGPOINT !== 'undefined') {
        BREAKINGPOINT = ishyoboy_fe_globals.IYB_BREAKINGPOINT;
    }
}

var skillz;



/* *********************************************************************************************************************
 * After resize function
 */
var waitForFinalEvent = (function () {
    var timers = {};
    return function (callback, ms, uniqueId) {
        if (!uniqueId) {
            uniqueId = "Don't call this twice without a uniqueId";
        }
        if (timers[uniqueId]) {
            clearTimeout (timers[uniqueId]);
        }
        timers[uniqueId] = setTimeout(callback, ms);
    };
})();



/* *********************************************************************************************************************
 * Main func
 */
jQuery(document).ready(function($) {

    /*
     * Global variables
     */
    mainNav = $('.part-header #main-nav').find('ul');

    skillz = jQuery('.list-skills');
    if ( skillz.length > 0 ) {
        skillz = skillz.find('div div');

        /*
         * List skills
         */
        $(window).scroll(function() {
            animateSkillBars()
        });
    }

    /*
     * Browser detection
     */
    /*
    var _browser = { die: false, die8: false, die9: false, ff: false, op: false, wk: false };

    if ( $.browser.msie ) {
        _browser.die = true;
        if ( $.browser.version == '8.0' ) _browser.die8 = true;
        if ( $.browser.version == '9.0' ) _browser.die9 = true;
    }
    if ( $.browser.mozilla ) _browser.ff = true;
    if ( $.browser.opera ) _browser.op = true;
    if ( $.browser.webkit ) _browser.wk = true;
    /**/



    /*
     * Google Maps
     */
    var $mapObject = jQuery('.google-map');
    if ($mapObject.length > 0){
        $mapObject.initGoogleMaps();
    }
    /**/

    /*
     * Portfolio hover
     */
    var
        portfolio_container = $('.hover-cont');

    if ( portfolio_container.length > 0 ) {

        portfolio_container.hover( function(){
            var overlay = $(this).find('.hover-overlay');
                overlay.css('opacity', 1).css('z-index', 12);
            },
            function(){
                var overlay = $(this).find('.hover-overlay');
                overlay.css('opacity', 0).css('z-index', 1);
            }
        );
    }


	/*
	 * Top navigation multiple dropdown
	 */
	var topNav = $('.top-nav ul');

	if ( topNav.length > 0 ) {
		topNav.multipleDropDown();

		topNav.tinyNav({
            active: 'current_page_item',
            header: ' '
        });
	}



    /*
     * MultipleDropDown main navigation
     */
    if ( mainNav.length > 0 ) {
        mainNav.multipleDropDown();

	    var origPos = $('.part-header .main-nav').offset();

        // Align left and break
        $(window).resize(function() {
            waitForFinalEvent(function(){
                var contW = $('#part-header').find('[class*="grid"]');
                var logo = contW.find('.logo');
                var tagline = contW.find('.tagline');
	            var nav = contW.find('nav');
                var stickyNav = $('.part-header');

	            /*
	             * if logo + tagline + menu doesn't fit OR if logo + tagline doesn't fit
	             */
                alignNavigation();


                /*
                 * If screen < 767
                 */
                var tiny = $('.part-header select.tinynav');
                var ticon = $('.part-header i.tinynav');

                if ( RESPONSIVE === true ){
                    if ( ( $(window).width() <= BREAKINGPOINT ) ) {
                        mainNav.css('display', 'none');

                        setTimeout(function() {
                            $('.part-header i.tinynav').css('display', 'block');

                            if ( !_search ) {
                                $('.part-header .tinynav').css('display', 'block');
                            }
                        }, 1);

                        nav.css({
                            'margin-left': '0',
                            'width': '100%',
                            'padding-bottom': '30px'
                        });

                        if ( stickyNav.length > 0 ) {
                            stickyNav.css({
                                'min-height': '0'
                            });
                        }

                    }
                    else {
                    // switch resp / main nav
                    $('.part-header .tinynav, .part-header i.tinynav, .part-header .addForm').css('display', 'none');
                    $('.part-header .main-nav > ul').css('display', 'block');

                    // break and float left navigation
                    nav.css({
                        'padding': '0',
                        'width': 'auto'
                    });

                    // change icon
                    ticon.removeClass('icon-align-justify');
                    ticon.addClass('icon-search-1');
                    _search = false;
                }
                }

            }, WAIT_INTERVAL, "MultipleDropDownResize");
        });
    }



    /*
     * TinyNav - Responsive navigation drop down
     */

    if ( mainNav.length > 0 ) {
        mainNav.tinyNav({
            active: 'current_page_item'
        });

        var tNav = $('.part-header .tinynav');

	    if ( $('.part-header .is-search').length > 0 ) {
		    // create search button
            tNav.parent().append('<i class="tinynav icon-search-1"></i><div class="addForm" id="addForm"></div>');

		    // change padding
	        $('.part-header select.tinynav').css({
		        'padding': '0 30px 0 0'
		    });
	    }

        // Add search dynamic
        if ( tNav.length > 0 ) {
            tNav.find('option[value="#search"]').remove();
        }

        // Click to search resp btn / menu btn                                             `
        var itnav = $('.part-header i.tinynav');
        var addForm = $('.part-header .addForm');
        _search = false;

        $('.part-header .main-nav a[href="#search"]+form').clone().appendTo(addForm);

        var sform = addForm;

        itnav.click(function() {
            if ( !_search ) {
                tNav.fadeOut(searchDel, function() {
                    sform.fadeIn(searchDel);
                });

                // change icon
                itnav.removeClass('icon-search-1');
                itnav.addClass('icon-align-justify');

                _search = true;
            }
            else {
                sform.fadeOut(searchDel, function() {
                    tNav.fadeIn(searchDel);
                });

                // change icon
                itnav.removeClass('icon-align-justify');
                itnav.addClass('icon-search-1');

                _search = false;
            }
        });
    }

    /*
     * Main nav search
     */
    var mnSearch = $('.part-header #main-nav').find('a[href="#search"]');

    if ( mnSearch.length > 0 ) {
        var searchForm = mnSearch.find('+form');
        var searchOpened = false;
        var searchDel = 100;

        mnSearch.click(function() {
            if ( !searchOpened ) {
                // hide all siblings
                var siblings = mnSearch.parent().siblings().not(mnSearch);

                if ( siblings.length > 0 ) {
                    // Siblings Exist
                    siblings.fadeTo(searchDel, 0.0001, function() {
                        $(this).css('visibility', 'hidden');

                        // show form
                        searchForm.css('visibility', 'visible');
                        searchForm.fadeTo(searchDel, 1);

                        // Focus on field after click
                        searchForm.find('input[type="text"]').focus();
                    });
                }
                else{
                    // No siblings, just search

                    // show form
                    searchForm.css('visibility', 'visible');
                    searchForm.fadeTo(searchDel, 1);

                    // Focus on field after click
                    searchForm.find('input[type="text"]').focus();
                }

                // add active class and switch search to cancel
                mnSearch.addClass('icon-cancel-2 active');
                mnSearch.removeClass('icon-search-1');

                searchOpened = true;
            }
            else {
                // hide form
                searchForm.fadeTo(searchDel, 0.0001, function() {
                    $(this).css('visibility', 'hidden');

                    // show all siblings
                    mnSearch.parent().siblings().css('visibility', 'visible');
                    mnSearch.parent().siblings().fadeTo(searchDel, 1);
                });

                mnSearch.addClass('icon-search-1');
                mnSearch.removeClass('icon-cancel-2 active');

                searchOpened = false;
            }

            return false;
        });
    }



	/*
	 * Sticky nav
	 */
	if ( mainNav.length > 0 && $('.part-header.sticky-on').length > 0 ) {
		var stickyNav = $('.part-header');

		$(window).scroll(function() {
            var stickyNavPosition = stickyNav.offset();
			if ( !stickyNav.isOnScreen() && ( stickyNavPosition.top <= $(window).scrollTop() ) ) {
                if ( !isStickyNav ){
	                stickyNav
		                .css({
			                'min-height': stickyNav.height()
		                })
		                .addClass('sticky-nav');

                    isStickyNav = true;

                    alignNavigation();

	                if ( $('.demo_store').length > 0 ) {
		                $('.sticky-nav .row').css({
			                'margin-top': $('.demo_store').height() + 14
		                })
	                }
                }
			}
			else {
                if ( isStickyNav ){
	                if ( ( stickyNav.find('.logo').width() + stickyNav.find('.tagline').width() + stickyNav.find('nav').width() ) < stickyNav.width() ) {
		                stickyNav.css({
			                'min-height': '0'
		                });

		                stickyNav.find('.main-nav ul li a').css({
			                '-webkit-transition-duration': '0',
			                '-moz-transition-duration': '0',
			                '-ms-transition-duration': '0',
			                '-o-transition-duration': '0',
			                'transition-duration': '0'
		                });
	                }

	                stickyNav.removeClass('sticky-nav');

                    isStickyNav = false;

                    alignNavigation();

	                if ( $('.demo_store').length > 0 ) {
		                stickyNav.find('.row').css({
			                'margin-top': 0
		                })
	                }
                }
			}
		});
	}



    /*
     * HTML5 placeholder
     */
    if( !isPlaceholder() ) {
        var placeholder = $('[placeholder]');

        placeholder.focus(function() {
            var input = $(this);

            if ( input.val() == input.attr('placeholder') ) {
                input.val('').removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);

            if ( input.val() == '' || input.val() == input.attr('placeholder') ) {
                input.addClass('placeholder').val( input.attr('placeholder') );
            }
        }).blur();

        placeholder.parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);

                if ( input.val() == input.attr('placeholder') ) {
                    input.val('');
                }
            });
        });
    }



    /*
     * Lined titles - remove line and change white-space if title is too long
     */
    var lined = $('[class*="lined"]');

    if ( lined.length > 0 ) {
        $(window).resize(function() {
            waitForFinalEvent(function(){
                lined.each(function() {
                    var self = $(this);

                    var textwidth = parseInt(self.textWidth());
                    var selfwidth = parseInt(self.parent().width());

                    if ( textwidth >= selfwidth ) {
                        self.css('white-space', 'normal').find('span').hide();
                    }
                    else {
                        self.css('white-space', 'nowrap').find('span').show();
                    }
                });
            }, WAIT_INTERVAL, "LinedTitlesResize");
        });
    }

    /*
     * Boxgroup - same height for boxes
     */
    var boxgroup = $('.boxgroup');

    if ( boxgroup.length > 0 ) {
        $(window).resize(function() {

            if ( RESPONSIVE === true ){
                // only if the layout is responsive

                waitForFinalEvent(function(){
                    if ( $(window).width() > BREAKINGPOINT ) {
                        boxgroup.each(function() {
                            var box = $(this).find('.box');

                            box.css('height', 'auto');
                            box.sameHeight();
                        });
                    }
                    else {
                        boxgroup.find('.box').each(function() {
                            $(this).css('height', 'auto');
                        });
                    }
                }, WAIT_INTERVAL, "BoxgroupResize");
            }
            else{
                waitForFinalEvent(function(){
                    boxgroup.each(function() {
                        var box = $(this).find('.box');

                        box.css('height', 'auto');
                        box.sameHeight();
                    });
                }, WAIT_INTERVAL, "BoxgroupResize");
            }
        });
    }



    /*
     * Slidable container
     */
    var slidable = $('.slidable');

    if ( slidable.length > 0 ) {
        slidable.each(function() {
	        $(this).find('[class*="slide"]').wrapAll('<div class="slidable-container" />');
        });

	    slidable.each(function() {
		    var me = $(this);
            var dataAttr = {
			    autoslide: me.attr('data-autoslide'),
			    interval: me.attr('data-interval'),
			    animation: me.attr('data-animation'),
			    navigation: me.attr('data-navigation')
	        };

            // Fix autoslide when only one slide available
            var slides = me.find('[class*="slide"]');
            if ( slides.length <= 1 ) {
                dataAttr.autoslide = 'no';
            }

		    var opts = {
			    selector: '.slidable-container > [class*="slide"]',
			    animation: 'slide',
			    directionNav: false,
			    slideshow: false,
			    smoothHeight: true,
			    video: true,
			    pauseOnHover: true,
                keyboard: false,
			    start: function() {
                    if ( dataAttr.autoslide == 'yes' ) {
                        $(window).scroll(function() {

                            if ( me.isOnScreen() ) {
                                me.flexslider('play');
                            }
                            else {
                                me.flexslider('pause');
                            }

                        });

                        if ( me.isOnScreen() ) {
                            me.flexslider('play');
                        }
                        else {
                            me.flexslider('pause');
                        }
                    }

                    fixVideoHeights();

                    $('.ish-slider .flex-control-nav').show();

                    me.resize();

				    // Hide images from the very beginning
				    $('.slidable img').css('visibility', 'visible');
			    }
		    };

		    // Only if autoslide is 'yes' set the interval -> default / custom
		    if ( dataAttr.autoslide == 'yes' ) {
			    opts.slideshow = true;

			    if ( dataAttr.interval != undefined ) {
				    opts.slideshowSpeed = dataAttr.interval * 1000;
			    }
			    else {
				    opts.slideshowSpeed = 4000;
			    }

		    }

		    // Change animation to fade
		    if ( dataAttr.animation == 'fade' ) {
			    opts.animation = 'fade';
			    me.addClass('anim-fade');
		    }

		    // Turn off navigation
		    if ( dataAttr.navigation == 'no' ) {
			    opts.controlNav = false;
		    }

		    me.imagesLoaded(function() {
			    me.show().flexslider(opts);
		    });
	    });
    }



	/*
     * Twitter widget
     */
    $('div[class^="tweets-"]').each( function(){
        var me = $(this);
        $(this).tweetMachine( (me.attr('data-username') ? me.attr('data-username') : 'ishyoboydotcom') , {
            limit: parseInt($(this).attr('class').substr(7), 10),
            endpoint: 'ishyoboy_get_tweets',
            backendScript:  php_array.admin_ajax,
            autoRefresh: false,
            tweetFormat: "<div class='tweet'><div class='text'></div><div class='tweet-details'><a href='' class='time'></a></div></div>"
        });
    });



    /*
     * Dribbble widget
     */
    var bbb = $('.dribbble-widget');

    if ( bbb.length > 0 ) {
        $.jribbble.getShotsByPlayerId( (bbb.attr('data-user-name') ? bbb.attr('data-user-name') : 'IshYoBoy') , function(playerShots) {
            var html = '';

            $.each(playerShots.shots, function(i, shot) {
                html += '<a href="' + shot.url + '">';
                html += '<img src="' + shot.image_teaser_url + '" ';
                html += 'alt="' + shot.title + '"></a>';
            });

            bbb.html(html);
        }, {
            page: 1,
            per_page: 9
        });
    }


	/*
	 * Back to top link
	 */
	var fixedTop = $('.fixed-top');

	fixedTop.hide();


    $(window).scroll(function() {
		if ( $(window).scrollTop() > 100 ) {
			fixedTop.fadeIn();
		}
		else {
			fixedTop.fadeOut();
		}
	});



	/*
	 * Smooth scroll
	 */
	$('.smooth-scroll').smoothScroll();



	/*
	 * Accordion
	 */
	var acc = $('.accordion, .toggle');

	if ( acc.length > 0 ) {
		// for each accordion on page
		acc.each(function() {
			var accDel = 250;
			var _this = $(this);
			var iconP = 'icon-right-dir-1';
			var iconM = 'icon-down-dir-1';

			// pointers all
			_this.find('.acc-title, .tgg-title').prepend('<i class="pointer ' + iconP + '" />');

			// pointer active
			_this.find('.active i.pointer').removeClass(iconP).addClass(iconM);

			// Hide all apart from 'active'
			_this.find('li').not('.active').children('div').hide();

			if ( _this.attr('class').indexOf("accordion") !== -1 ) {
				_this.find('.acc-title').click(function() {
					// close opened + remove 'active' class + change pointer to left
					_this.find('.active').children('div').stop().slideUp(accDel);
					_this.find('li').removeClass('active');
					_this.find('i.pointer').removeClass(iconM).addClass(iconP);

					// open clicked + add 'active' class + change pointer to down
					$(this).siblings('div').stop().slideDown(accDel);
					$(this).parent('li').addClass('active');
					$(this).find('i.pointer').removeClass(iconP).addClass(iconM);

                    $(window).resize();
				});
			}
			else if ( _this.attr('class').indexOf("toggle") !== -1 ) {
				_this.find('.tgg-title').each(function() {
					if ( $(this).parent().attr('class') == 'active' )
						var tggOpened = true;
					else
						var tggOpened = false;

					$(this).click(function() {
						if ( !tggOpened ) {
							// open clicked + add 'active' class + change pointer to down
							$(this).siblings('div').stop().slideDown(accDel);
							$(this).parent('li').addClass('active');
							$(this).find('i.pointer').removeClass(iconP).addClass(iconM);

							tggOpened = true;
						}
						else {
							// open clicked + add 'active' class + change pointer to down
							$(this).siblings('div').stop().slideUp(accDel);
							$(this).parent('li').removeClass('active');
							$(this).find('i.pointer').removeClass(iconM).addClass(iconP);

							tggOpened = false;
						}
                        $(window).resize();
					});
				});
			}
		});
	}



	/*
	 * Fancybox
	 */
    fancybox_init();



	/*
	 * Alerts - close button
	 */
	var alertsClose = $('.box.success.close, .box.warning.close, .box.info.close, .box.error.close');

	if ( alertsClose.length > 0 ) {
		alertsClose.prepend('<a href="#alert-close" class="icon-cancel-1"></a>');

		var alertsCloseBtn = alertsClose.find('a[href="#alert-close"]');

		alertsCloseBtn.click(function() {
			$(this).parent().fadeOut(500);

			return false;
		});
	}



    /*
     * Iframe video height fix
     */

    if ( jQuery('.post-video-content').length > 0 ) {
        jQuery(window).resize(function() {
            fixVideoHeights();
        });
    }

    /*
     * Iframe video height fix
     */

    if ( jQuery('embed').length > 0 ) {
        jQuery(window).resize(function() {
            var src = jQuery('embed');
            src.each(function() {
                var self = jQuery(this);
                var parent = self.parent();
                var ow = parent.width();

                var w = self.attr('width');
                var h = self.attr('height');
                var rat = ow / w;

                self.attr('width', ow);
                self.attr('height', parseInt(h * rat));
            });
        });
    }
    if ( jQuery('iframe').length > 0 ) {
        jQuery(window).resize(function() {
            var src = jQuery('iframe');
            src.each(function() {
                var self = jQuery(this);
                var parent = self.parent();
                var ow = parent.width();

                var attsrc = self.attr('src');

                if ( (attsrc) && (attsrc.indexOf('soundcloud.com') == -1) ){

                    var w = self.attr('width');
                    var h = self.attr('height');
                    var rat = ow / w;

                    self.css('width', '100%');

                    if ( ow > 0 ){
                        self.attr('width', ow);
                        self.attr('height', parseInt(h * rat));
                    }
                }
            });
        });
    }


	/*
	 * Isotope - Centered Masonry layout
	 */
	var masonry = $('.masonry');

	if ( masonry.length > 0 ) {

        masonry.each( function(){

            var massMain = $(this);
            var massCont = massMain.find('.mass_content');

            massCont.imagesLoaded(function(){
                if ( massMain.hasClass('portfolio-fluid') ) {

                    $(window).smartresize(function(){

                        massCont.isotope({
                            resizable: true,
                            animationEngine : 'jquery',
                            animationOptions: {
                                duration: 500,
                                easing: 'swing',
                                queue: false
                            },
                            layoutMode : 'masonry',
                            resizesContainer: true
                        });
                    }).smartresize();

                }
                else {

                    centeredMasonry();
                    massCont.isotope({
                        resizable: true,
                        animationEngine : 'jquery',
                        animationOptions: {
                            duration: 500,
                            easing: 'swing',
                            queue: false
                        },
                        layoutMode : 'masonry',
                        resizesContainer: true
                    });
                }

                // Filters activation
                var filterSelector = '.portfolio-filters';
                var filter = massMain.siblings(filterSelector);
                if ( filter.length > 0 ) {

                    // Set default filter if none set
                    if (!filter.find('.active a').length > 0){
                        filter.find('a').eq(0).parent().addClass('active');
                    }

                    var filter_lis = filter.find('li');

                    // Isotope filterable menu
                    filter.find('a').click(function(){

                        filter_lis.removeClass('active');
                        $(this).parent().addClass('active');
                        var selector = $(this).attr('data-filter');
                        massCont.isotope({ filter: selector });
                        return false;

                    });

                }
            });

        });

	}

    var nomasonry = $('.nomasonry.anim-filter');

    if ( nomasonry.length > 0 ) {
        // NO MASONRY

        var animFilt = nomasonry;

        animFilt.imagesLoaded(function(){
            if ( animFilt.length > 0 ) {

                animFilt.each( function(){

                    var container = $(this);

                    container.isotope({
                        resizable: true,
                        animationEngine : 'jquery',
                        animationOptions: {
                            duration: 500,
                            easing: 'swing',
                            queue: false
                        },
                        layoutMode : 'fitRows'
                    });

                    // Filters activation
                    var filterSelector = '.portfolio-filters';
                    var filter = container.siblings( filterSelector );
                    if ( filter.length > 0 ) {

                        // Set default filter if none set
                        if (!filter.find('.active a').length > 0){
                            filter.find('a').eq(0).parent().addClass('active');
                        }

                        // Isotope filterable menu

                        var filter_lis = filter.find('li');

                        filter.find('a').click(function(){

                            filter_lis.removeClass('active');
                            $(this).parent().addClass('active');
                            var selector = $(this).attr('data-filter');
                            container.isotope({ filter: selector });
                            return false;

                        });

                    }

                });
            }

        });

    }



	/*
	 * Tooltip
	 */
	var tooltip = $('[data-type="tooltip"]');

	if ( tooltip.length > 0 ) {
		tooltip.tooltipster({
			functionReady: function(origin) {
				var classList = origin.attr('class').split(/\s+/);
				var col;

				$.each( classList, function(index, item){
					if ( item.indexOf('tooltip-color') === 0 ) {
						col = item;
					}
				});

				$('.tooltipster-default').addClass( col );
			}
		});
	}



	/*
	 * Tabs
	 */
	var tabs = $('.tabs-navigation');

	if ( tabs.length > 0 ) {
		tabs.each(function() {
			var me = $(this);
			var sibl = me.attr('data-tabs');
			var tabsCont = $('.tabs-content[data-tabs="' + sibl + '"]');
			var who = me.find('li.active a').attr('href');
			var tabsDel = 300;

			// hide all content -> show only active one
			tabsCont.find('> div').hide();
			tabsCont.find('> div.' + who.replace('#', '') + '').show();

			me.find('a').click(function() {
				var clicked = $(this).attr('href');

				tabsCont.find('> div').hide();
				tabsCont.find('> div.' + clicked.replace('#', '') + '').fadeIn(tabsDel);

				me.find('li.active').removeClass('active');
				me.find('a[href="' + clicked + '"]').parent().addClass('active');

                $(window).resize();

				return false;
			});
		});
	}



	/*
	 * Expandable widgetized area
	 */
	var exp = $('.part-expandable');

	if ( exp.length > 0 ) {
		var expLink = $('#expandable');
        var allExpLinks = $('#expandable, a[href="#open-expandable"], .open-expandable, a[href="#open-close-expandable"]');
        var closeLink = $('a[href="#close-expandable"], .close-expandable');
		var expDel = 500;
		var scrollDel = 500;
		var expOpened = false;
		var openClass = 'icon-down-open-1';
		var closeClass = 'icon-up-open-1';

		if ( exp.hasClass('expand-off') ) {

            // Open buttons
			allExpLinks.click(function() {

				if ( !expOpened ) {

					// If not top
					if ( $(window).scrollTop() != 0 ) {

						// Scroll to top
						$(window).scrollTo(0, {
							duration: scrollDel,
							onAfter: function() {
								openExpandable();
							}
						});
					}
					else {
						openExpandable();
					}
				}
				else {
					if ( $(this).attr('id') == 'expandable' ) {
						closeExpandable();
					}
                    else if ( $(this).attr('href') == "#open-close-expandable" ) {
                        $(window).scrollTo(0, {
                            duration: scrollDel,
                            onAfter: function() {
                                closeExpandable();
                            }
                        });
                    }
					else {
						$(window).scrollTo(0, {
							duration: scrollDel
						});
					}
				}

				return false;
			});

            // Close button
            closeLink.click(function() {
                if ( expOpened ) {
                    closeExpandable();

                    $(window).scrollTo(0, {
                        duration: scrollDel
                    });
                }

                return false;
            });
		}
		else if ( exp.hasClass('expand-on') ) {
			//
		}

		function openExpandable() {
			exp.css({
				'position': 'relative',
				'top': '0'
			}).hide().slideDown(expDel);

			expLink.removeClass(openClass).addClass(closeClass);

			expOpened = true;
		}

		function closeExpandable() {
			exp.slideUp(expDel);

			expLink.removeClass(closeClass).addClass(openClass);

			expOpened = false;
		}
	}



	/*
	 * Table column highlight
	 */
	var highCol = $('.highlight-col');

	if ( highCol.length > 0 ) {
		//highCol.parents('table').each(function() {
		highCol.each(function() {
			var tbl = $(this).parents('table');
			var me = $(this);
			var idx = me.index() + 1;
			var classList = me.attr('class');

			tbl.find('th:nth-child(' + idx + '), td:nth-child(' + idx + ')').addClass(classList);
			tbl.find('tr:nth-child(even)').find('th:nth-child(' + idx + '), td:nth-child(' + idx + ')').addClass('even');
		});
	}



	/*
	 * EasyPieChart - charts
	 */
	var chart = $('.chart');

	if ( chart.length > 0 ) {
		chart.each(function() {
			var me = $(this);

			// attributes from html
			var dataAttr = {
				lineCap: me.attr('data-linecap'),
				lineWidth: me.attr('data-linewidth'),
				size: me.attr('data-size'),
				barColor: me.attr('data-barcolor'),
				trackColor: me.attr('data-trackcolor'),
				animate: me.attr('data-animate')
			};

			// options for easyPieChart
			var opts = {
				scaleColor: false,
				lineCap: 'square',
				lineWidth: 10,
				size: 150
			};

			if ( dataAttr.lineCap== 'round' ) {
				opts.lineCap = 'round';
			}
			if ( dataAttr.lineWidth != undefined ) {
				opts.lineWidth = dataAttr.lineWidth;
			}
			if ( dataAttr.size != undefined ) {
				opts.size = dataAttr.size;
			}
			if ( dataAttr.barColor != undefined ) {
				opts.barColor = dataAttr.barColor;
			}
			if ( dataAttr.trackColor != undefined ) {
				opts.trackColor = dataAttr.trackColor;
			}
			if ( dataAttr.animate != undefined ) {
				opts.animate = dataAttr.animate * 1000;
			}

			// do charts
			me.easyPieChart(opts);
		});
	}


    /*
     * Audio.js
     */
    if ( jQuery('.audio-audiojs').length > 0 ) {
        if ( typeof audiojs !== 'undefined'  ){
            audiojs.events.ready(function() {
                var as = audiojs.createAll();
            });
        }
    }

    /*
     * Parallax dynamic
     */
    var parallaxDyn = jQuery('.bgscroll');

    if ( parallaxDyn.length > 0 ) {
        parallaxDyn.each(function(){
            var $div = jQuery(this);
            var $dataScroll = jQuery(this).data('scroll');
            var $dataAmount = jQuery(this).data('amount');
            var $dur = jQuery(this).data('duration');
            var $eas = jQuery(this).data('easing');
            if(! $dataScroll  || $dataScroll == "" || $dataScroll === null){$dataScroll = '0.1'}
            if(! $dataAmount  || $dataAmount == "" || $dataAmount === null){$dataAmount = '50%'}
            if(! $dur  || $dur == "" || $dur === null){$dur = '1'}
            if(! $eas  || $eas == "" || $eas === null){$eas = 'linear'}

            bg = $div.css('background-image');
            if (bg) {
                var src = bg.replace(/(^url\()|(\)$|[\"\'])/g, ''),
                    $img = jQuery('<img>').attr('src', src).on('load', function() {

                        // do something, maybe:
                        $div.parallax($dataAmount, $dataScroll, true, $dur, $eas);
                    });
            }
        });
    }



    $(window).resize(function(){
        $(window).scroll();
    });

    $(window).resize();

});


/* *********************************************************************************************************************
 * Functions
 */

/*
 * Check if placeholder is supported
 */
function isPlaceholder() {
    var inp = document.createElement('input');
    return ('placeholder' in inp);
}

function fancybox_init() {
    if ( jQuery('.openfancybox-video').length > 0 ) {
        jQuery(".openfancybox-video").each(function(){
            var target = jQuery(jQuery(this).attr("href"));
            var src = target.find('iframe').attr("src");
            jQuery(this).fancybox({
                'type': "inline",
                'content': target,
                'transitionIn'	: 'none',
                'transitionOut'	: 'none',
                'onClosed': function(){
                    target.find('iframe').attr("src", src);
                }
            });
        });
    }

    if ( jQuery('.openfancybox-image').length > 0 ) {
        jQuery(".openfancybox-image").fancybox({
            'padding' : 10
        });
    }

    if ( jQuery('.openfancybox-audio').length > 0 ) {
        jQuery(".openfancybox-audio").fancybox({
            'padding' : 10
        });
    }
}

function animateSkillBars(){

    skillz.find('span:in-viewport').each(function() {
        var me = jQuery(this);
        if (!me.hasClass('done')){
            var skillzDel = 1000;
            me.addClass('done').animate({
                'width': me.attr('data-count') + '%',
                'opacity': '1'
            }, skillzDel);
        }
    });

}

function  initialize(){
    var $mapObject = jQuery('.google-map');
    // Google Maps module

    $mapObject.each( function(){

        me = jQuery(this);

        var styles = [
            {
                "stylers": [
                    { "invert_lightness" : !!(( 'yes' == me.attr('data-invert') )) },
                    { "hue": ( me.attr('data-color') ) ? rgb2hex( me.attr('data-color') ) : '' }
                ]

            },
            {
                "elementType": "geometry.fill",
                "stylers": [
                    { "weight": 2 }
                ]
            }
        ];

        var positions = new Array();

        var i = 1;
        while ( me.attr('data-latlng' + i) ){

            latlngStr = me.attr('data-latlng' + i).split( ",", 2 );
            positions[i - 1] = new google.maps.LatLng( parseFloat(latlngStr[0]) , parseFloat(latlngStr[1]) );
            i++
        }

        if ( !positions[0] ) {
            positions[0] = new google.maps.LatLng(0, 0);
        }

        var zoom = 15;

        if ( '' != me.attr('data-zoom') ){
            zoom = parseInt(me.attr('data-zoom'));
        }

        var $mapOptions;
        $mapOptions = {
            center: positions[0],
            zoom: zoom,
            disableDefaultUI: true,
            backgroundColor: me.css('background-color'),       //Color used for the background of the Map div. This color will be visible when tiles have not yet loaded as the user pans. This option can only be set when the map is initialized.
            styles: styles,
            overviewMapControl: false,
            scrollwheel: false,                   //If false, disables scrollwheel zooming on the map. The scrollwheel is enabled by default.
            mapTypeControl: true,
            streetViewControl: true,
            rotateControl: true,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var $map;
        $map = new google.maps.Map(document.getElementById( me.attr('id') ), $mapOptions);

        for (var j = 0; j < positions.length; j++){
            var marker = new google.maps.Marker({
                position: positions[j],
                map: $map,
                animation: google.maps.Animation.DROP
            });
        }

        /*
        google.maps.event.addDomListener(window, 'resize', function() {
            $map.setCenter(positions[0]);
        });
        */

        jQuery(window).resize( function(){
            google.maps.event.trigger($map, 'resize');
            $map.setCenter(positions[0]);
        });

    });

}

function rgb2hex(rgb){
    if (rgb.indexOf("#") == -1){
        rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);

        return "#" +
            ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
    }
    else{
        return rgb;
    }
}

function fixVideoHeights(){
    var src = jQuery('.post-video-content');
    var rec_post = jQuery('.recent_posts_post_content');

    src.each(function() {
        var me = jQuery(this);
        var iframe = me.find('iframe');
        var iframe_w = iframe.attr('width');
        var iframe_h = iframe.attr('height');

        var parent_w = me.width();

        if (iframe_h > 0 && 0 == parent_w) {

            var visible_parent_w = 0;
            var visible_parent = me.parents('.slidable').find('.recent_posts_post_content');
            if (visible_parent.length > 0 ){
                visible_parent_w = visible_parent.width();
            }

            parent_w = visible_parent_w;
        }

        var rat = parent_w / iframe_w;

        if ( parent_w > 0 && iframe_h > 0 ){
            iframe.attr('width', parent_w);
            iframe.attr('height', iframe_h * rat);
        }
    });
}

function alignNavigation(){
    var contW = jQuery('#part-header').find('[class*="grid"]');
    var logo = contW.find('.logo');
    var tagline = contW.find('.tagline');
    var nav = contW.find('nav');

    /*
     * if logo + tagline + menu doesn't fit
     */
	if ( ( logo.width() + tagline.width() + nav.width() ) > contW.width() ) {
		contW.addClass('resp-nav');
	}
	else {
	    contW.removeClass('resp-nav');
	}

	/*
     * if logo + tagline doesn't fit
     */
    if ( ( logo.width() + tagline.width() ) > contW.width() ) {
        contW.addClass('resp-nav-small');
    }
    else {
        contW.removeClass('resp-nav-small');
    }

	contW.find('.main-nav ul li a').css({
		'-webkit-transition-duration': '.25s',
		'-moz-transition-duration': '.25s',
		'-ms-transition-duration': '.25s',
		'-o-transition-duration': '.25s',
		'transition-duration': '.25s'
	});
}

function centeredMasonry() {
    if (jQuery.Isotope){
        jQuery.Isotope.prototype._getCenteredMasonryColumns = function() {

            this.width = this.element.width();

            var parentWidth = this.element.parent().width();

            var colW = this.options.masonry && this.options.masonry.columnWidth || // i.e. options.masonry && options.masonry.columnWidth

                this.$filteredAtoms.outerWidth(true) || // or use the size of the first item

                parentWidth; // if there's no items, use size of container

            var cols = Math.floor(parentWidth / colW);

            cols = Math.max(cols, 1);

            this.masonry.cols = cols; // i.e. this.masonry.cols = ....
            this.masonry.columnWidth = colW; // i.e. this.masonry.columnWidth = ...
        };

        jQuery.Isotope.prototype._masonryReset = function() {

            this.masonry = {}; // layout-specific props
            this._getCenteredMasonryColumns(); // FIXME shouldn't have to call this again

            var i = this.masonry.cols;

            this.masonry.colYs = [];
            while (i--) {
                this.masonry.colYs.push(0);
            }
        };

        jQuery.Isotope.prototype._masonryResizeChanged = function() {

            var prevColCount = this.masonry.cols;

            this._getCenteredMasonryColumns(); // get updated colCount
            return (this.masonry.cols !== prevColCount);
        };

        jQuery.Isotope.prototype._masonryGetContainerSize = function() {

            var unusedCols = 0,

                i = this.masonry.cols;
            while (--i) { // count unused columns
                if (this.masonry.colYs[i] !== 0) {
                    break;
                }
                unusedCols++;
            }

            return {
                height: Math.max.apply(Math, this.masonry.colYs),
                width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth // fit container to columns that have been used;
            };
        };
    }
}