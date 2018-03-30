(function( $ ) {
   "use strict";
	
	var MAJESTY = MAJESTY || {};
	MAJESTY.initialize = {
        init: function(){
            MAJESTY.initialize.responsiveClasses();
            MAJESTY.initialize.dataResponsiveHeights();
        },

        responsiveClasses: function(){
            var jRes = jRespond([
                {
                    label: 'smallest',
                    enter: 0,
                    exit: 479
                },{
                    label: 'handheld',
                    enter: 480,
                    exit: 767
                },{
                    label: 'tablet',
                    enter: 768,
                    exit: 991
                },{
                    label: 'laptop',
                    enter: 992,
                    exit: 1199
                },{
                    label: 'desktop',
                    enter: 1200,
                    exit: 10000
                }
            ]);
            jRes.addFunc([
                {
                    breakpoint: 'desktop',
                    enter: function() { $body.addClass('device-lg'); },
                    exit: function() { $body.removeClass('device-lg'); }
                },{
                    breakpoint: 'laptop',
                    enter: function() { $body.addClass('device-md'); },
                    exit: function() { $body.removeClass('device-md'); }
                },{
                    breakpoint: 'tablet',
                    enter: function() { $body.addClass('device-sm'); },
                    exit: function() { $body.removeClass('device-sm'); }
                },{
                    breakpoint: 'handheld',
                    enter: function() { $body.addClass('device-xs'); },
                    exit: function() { $body.removeClass('device-xs'); }
                },{
                    breakpoint: 'smallest',
                    enter: function() { $body.addClass('device-xxs'); },
                    exit: function() { $body.removeClass('device-xxs'); }
                }
            ]);
        },


        dataResponsiveHeights: function(){
            var $dataHeightXxs = $('[data-height-xxs]'),
                $dataHeightXs = $('[data-height-xs]'),
                $dataHeightSm = $('[data-height-sm]'),
                $dataHeightMd = $('[data-height-md]'),
                $dataHeightLg = $('[data-height-lg]');

            if( $dataHeightXxs.length > 0 ) {
                $dataHeightXxs.each( function(){
                    var element = $(this),
                        elementHeight = element.attr('data-height-xxs');

                    if( $body.hasClass('device-xxs') ) {
                        if( elementHeight != '' ) { element.css( 'height', elementHeight ); }
                    }
                });
            }

            if( $dataHeightXs.length > 0 ) {
                $dataHeightXs.each( function(){
                    var element = $(this),
                        elementHeight = element.attr('data-height-xs');

                    if( $body.hasClass('device-xs') ) {
                        if( elementHeight != '' ) { element.css( 'height', elementHeight ); }
                    }
                });
            }

            if( $dataHeightSm.length > 0 ) {
                $dataHeightSm.each( function(){
                    var element = $(this),
                        elementHeight = element.attr('data-height-sm');

                    if( $body.hasClass('device-sm') ) {
                        if( elementHeight != '' ) { element.css( 'height', elementHeight ); }
                    }
                });
            }

            if( $dataHeightMd.length > 0 ) {
                $dataHeightMd.each( function(){
                    var element = $(this),
                        elementHeight = element.attr('data-height-md');

                    if( $body.hasClass('device-md') ) {
                        if( elementHeight != '' ) { element.css( 'height', elementHeight ); }
                    }
                });
            }

            if( $dataHeightLg.length > 0 ) {
                $dataHeightLg.each( function(){
                    var element = $(this),
                        elementHeight = element.attr('data-height-lg');

                    if( $body.hasClass('device-lg') ) {
                        if( elementHeight != '' ) { element.css( 'height', elementHeight ); }
                    }
                });
            }
        }
    };
	
	MAJESTY.header = {

        init: function(){
            MAJESTY.header.superfish();
            MAJESTY.header.menufunctions();
            MAJESTY.header.fullWidthMenu();
            MAJESTY.header.overlayMenu();
            MAJESTY.header.topcart();
            MAJESTY.header.splitmenu();
            MAJESTY.header.removeStickyness();
        },

        superfish: function(){

            if ( $().superfish ) {
                if( $body.hasClass('device-lg') || $body.hasClass('device-md') ) {
                    $('#main-menu ul ul, #main-menu ul .mega-menu-content').css('display', 'block');
                    MAJESTY.header.menuInvert();
                }

                $('body:not(.side-header) #main-menu > ul, body:not(.side-header) #main-menu > div > ul,.top-links > ul').superfish({
                    popUpSelector: 'ul,.mega-menu-content,.top-link-section',
                    delay: 250,
                    speed: 350,
                    animation: {opacity:'show'},
                    animationOut:  {opacity:'hide'},
                    cssArrows: false
                });

                $('body.side-header #main-menu > ul').superfish({
                    popUpSelector: 'ul',
                    delay: 250,
                    speed: 350,
                    animation: {opacity:'show',height:'show'},
                    animationOut:  {opacity:'hide',height:'hide'},
                    cssArrows: false
                });
            }
        },

        menuInvert: function() {
            $('#main-menu ul ul, .center-header #main-menu ul ul').each( function( index, element ){
				if( $('body').hasClass('rtl') ) {
					var $menuChildElement = $(element);
					var windowWidth = $window.width();
					var menuChildOffset = $menuChildElement.offset();
					var menuChildWidth = $menuChildElement.width();
					var menuChildLeft = $window.width() - menuChildOffset.left - menuChildWidth;
					if( $('#header').hasClass('header-center') || $('#header').hasClass('center-header') ) {
						if(windowWidth - 179 - (menuChildWidth + menuChildLeft) < 0) {
							$menuChildElement.addClass('menu-pos-invert');
						}
					}				
					if(windowWidth - (menuChildWidth + menuChildLeft) < 0) {
						if( ! $menuChildElement.hasClass('menu-pos-invert') ) {
							$menuChildElement.addClass('menu-pos-invert');
						}
						
					}
				} else {
					var $menuChildElement = $(element);
					var windowWidth = $window.width();
					var menuChildOffset = $menuChildElement.offset();
					var menuChildWidth = $menuChildElement.width();
					var menuChildLeft = menuChildOffset.left;
					if( $('#header').hasClass('header-center') || $('#header').hasClass('center-header') ) {
						if( windowWidth - 179 - (menuChildWidth + menuChildLeft) < 0 ) {
							$menuChildElement.addClass('menu-pos-invert');
						}
					}
					
					if(windowWidth - (menuChildWidth + menuChildLeft) < 0) {
						if( ! $menuChildElement.hasClass('menu-pos-invert') ) {
							$menuChildElement.addClass('menu-pos-invert');
						}
						
					}
				}
            });

        },

        menufunctions: function(){

            $( '#main-menu ul li:has(ul)' ).addClass('sub-menu');
            $( '.top-links ul li:has(ul) > a' ).append( ' <i class="icon-angle-down"></i>' );
            $( '.top-links > ul' ).addClass( 'clearfix' );

            if( MAJESTY.isMobile.Android() ) {
                $( '#main-menu ul li.sub-menu' ).children('a').on('touchstart', function(e){
                    if( !$(this).parent('li.sub-menu').hasClass('sfHover') ) {
                        e.preventDefault();
                    }
                });
            }

            if( MAJESTY.isMobile.Windows() ) {
                $('#main-menu > ul, #main-menu > div > ul,.top-links > ul').superfish('destroy').addClass('windows-mobile-menu');

                $( '#main-menu ul li:has(ul)' ).append('<a href="#" class="wn-submenu-trigger"><i class="icon-angle-down"></i></a>');

                $( '#main-menu ul li.sub-menu' ).children('a.wn-submenu-trigger').click( function(e){
                    $(this).parent().toggleClass('open');
                    $(this).parent().find('> ul, > .mega-menu-content').stop(true,true).toggle();
                    return false;
                });
            }
        },

        fullWidthMenu: function(){
            if( $body.hasClass('stretched') ) {
                if( $header.find('.container-fullwidth').length > 0 ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 120 }); }
                if( $header.hasClass('full-header') ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 60 }); }
            } else {
                if( $header.find('.container-fullwidth').length > 0 ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 120 }); }
                if( $header.hasClass('full-header') ) { $('.mega-menu .mega-menu-content').css({ 'width': $wrapper.width() - 80 }); }
            }
        },

        overlayMenu: function(){
            if( $body.hasClass('overlay-menu') ) {
                var overlayMenuItem = $('#main-menu').children('ul').children('li'),
                    overlayMenuItemHeight = overlayMenuItem.outerHeight(),
                    overlayMenuItemTHeight = overlayMenuItem.length * overlayMenuItemHeight,
                    firstItemOffset = ( $window.height() - overlayMenuItemTHeight ) / 2;

                $('#main-menu').children('ul').children('li:first-child').css({ 'margin-top': firstItemOffset+'px' });
            }
        },

        removeStickyness: function(){

            if( $body.hasClass('device-md') || $body.hasClass('device-lg')) {
               // sticky header
                  $("#header").sticky({ topSpacing: 0,
                        //responsiveWidth: true,
                        getWidthFrom:"body",
                        wrapperClassName: 'sticky-header'
                    });
					//
            }
            if ( $body.hasClass('device-xs') || $body.hasClass('device-xxs') || $body.hasClass('device-sm') ) {
                $("#header").unstick();
                $(".sticky-onepage").sticky({ topSpacing: 0,
                        responsiveWidth: true,
                        getWidthFrom:"body",
                        wrapperClassName: 'sticky-header'
                     });
            }
        },

        topcart: function(){
            $("#shop_cart-trigger").click(function(e){
                $pagemenu.toggleClass('pagemenu-active', false);
                $topCart.toggleClass('shop_cart-open');
                e.stopPropagation();
                e.preventDefault();
            });
        },

        splitmenu: function(){
            if( ( $body.hasClass('device-lg') || $body.hasClass('device-md') ) && $header.hasClass('split-menu') ) {
                var element = $('#logo'),
                    logoWidth = defaultLogo.find('img').outerWidth(),
                    logoPosition = logoWidth/2,
                    menuPadding = logoPosition + 30;
                element.css({ 'margin-left': -logoPosition+'px' });
                $('#main-menu').find('.menu-left').css({ 'padding-right': menuPadding+'px' });
                $('#main-menu').find('.menu-right').css({ 'padding-left': menuPadding+'px' });
            }
        }
    };
	
	MAJESTY.widget = {

        init: function(){

            MAJESTY.widget.animations();
            MAJESTY.widget.Swiper();
            MAJESTY.widget.extras();
            MAJESTY.widget.forResizeAndLoad();
            MAJESTY.widget.html5Video();
            MAJESTY.widget.vimeoBgVideo();
            MAJESTY.widget.youtubeBgVideo();
            MAJESTY.widget.carouselImage();

        },
		Swiper:function(){
				if( $(".swiper-slider").length > 0 ){
					$(".swiper-slider").each( function(){
						var element = $(this),
							direction 	= element.parent('.swiper_wrapper').attr('data-direction'),
							effect 		= element.parent('.swiper_wrapper').attr('data-effect'),
							loop 		= element.parent('.swiper_wrapper').attr('data-loop'),
							speed 		= element.parent('.swiper_wrapper').attr('data-autoplay'),
							arrows  	= element.parent('.swiper_wrapper').attr('data-arrows'),
							bullet  	= element.parent('.swiper_wrapper').attr('data-bullet');
						
						var nextButton = null;
						var prevButton = null;
						var pagination = null;
						if( !direction ) { direction = 'horizontal'; }
						if( !effect ) { effect = 'slide'; }
						if( loop == 'false' ) { loop = false; } else { loop = true; }
						if( !speed ) { speed = 300; }
						if( arrows == 'true' ) {
							nextButton = '.swiper-button-next';
							prevButton = '.swiper-button-prev';
						}
						if( bullet == 'true' ) {
							pagination = '.swiper-pagination';
						}
						//console.log(direction);
						var swiperSlider = new Swiper(element,{
							pagination: pagination,
							paginationClickable: true,
							direction: direction,
							slidesPerView: 1,
							loop: loop,
							autoplay:5000,
							speed: speed,
							effect: effect,
							nextButton: nextButton,
							prevButton: prevButton,
							grabCursor: true
						});
						swiperSlider.on('onInit', function () {
							MAJESTY.widget.forResizeAndLoad();
						});
						
					});
				}
		},
        parallax: function(){
               if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
					if( $parallaxEl.length > 0 ){
						$parallaxEl.each(function(){
							var imgparallax = $(this).attr('data-parallax-image');
							if (typeof imgparallax !== typeof undefined && imgparallax !== false) {
								$(this).css("background-image", "url("+ imgparallax+ ")");
								if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
									$(this).css("background", "url("+ imgparallax+ ")");
								} 
							}
						});
						skrollr.init({
							forceHeight: false
						});
					}
                } else {
                $parallaxEl.addClass('mobile-parallax');
				if( $parallaxEl.length > 0 ){
					$parallaxEl.each(function(){
						var imgparallax = $(this).attr('data-parallax-image');
						if (typeof imgparallax !== typeof undefined && imgparallax !== false) {
							$(this).css("background-image", "url("+ imgparallax+ ")");
							if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
								$(this).css("background", "url("+ imgparallax+ ")");
							} 
						}
					});
				}
                
            }
        },
        animations: function(){   
            if( MAJESTY.isMobile.any() ) {
			$('.animated').addClass('visible');
			}
			else {
				$('.animated').appear(function() {
					var elem = $(this);
					var animation = elem.data('animation');
					if ( !elem.hasClass('visible') ) {
						var animationDelay = elem.data('animation-delay');
						if ( animationDelay ) {
							setTimeout(function(){
								elem.addClass( animation + " visible" );
							}, animationDelay);
						} else {
							elem.addClass( animation + " visible" );
						}
					}
				});
			}

        },

        html5Video: function(){
            var videoEl = $('.video-wrap:has(video)');
            if( videoEl.length > 0 ) {
                videoEl.each(function(){
                    var element = $(this),
                        elementVideo = element.find('video'),
                        outerContainerWidth = element.outerWidth(),
                        outerContainerHeight = element.outerHeight(),
                        innerVideoWidth = elementVideo.outerWidth(),
                        innerVideoHeight = elementVideo.outerHeight();

                    if( innerVideoHeight < outerContainerHeight ) {
                        var videoAspectRatio = innerVideoWidth/innerVideoHeight,
                            newVideoWidth = outerContainerHeight * videoAspectRatio,
                            innerVideoPosition = (newVideoWidth - outerContainerWidth) / 2;
                        elementVideo.css({ 'width': newVideoWidth+'px', 'height': outerContainerHeight+'px', 'left': -innerVideoPosition+'px' });
                    } else {
                        var innerVideoPosition = (innerVideoHeight - outerContainerHeight) / 2;
                        elementVideo.css({ 'width': innerVideoWidth+'px', 'height': innerVideoHeight+'px', 'top': -innerVideoPosition+'px' });
                    }

                    if( MAJESTY.isMobile.any() ) {
                        var placeholderImg = elementVideo.attr('poster');

                        if( placeholderImg != '' ) {
							if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
								element.append('<div class="video-placeholder" style="background: url('+ placeholderImg +');"></div>')
							} else {
								element.append('<div class="video-placeholder" style="background-image: url('+ placeholderImg +');"></div>');
							}
                            
                        }
                    }
                });
            }
        },

        vimeoBgVideo:function(){
			if( $("#vimeo").length > 0 ){
				$("#vimeo").each( function(){
					var element = $(this),
					video 		= element.attr('data-video'),
					volume 		= parseInt(element.attr('data-volume')),
					loop 		= element.attr('data-loop'),
					autoplay 	= element.attr('data-autoplay'),
					poster  	= element.attr('data-poster');
					if( !volume ) { volume = 1; }
					if( loop == 'false' ) { loop = false; } else { loop = true; }
					if( autoplay == 'false' ) { autoplay = false; } else { autoplay = true; }
					if( typeof poster === 'undefined' || poster != '' ) {
						element.addClass('poster-img');
						if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
							element.css("background", "url("+ poster+ ")");
						} else {
							element.css("background-image", "url("+ poster+ ")");
						}
					}
					if( !MAJESTY.isMobile.any() ){
						element.okvideo({ source: video,
							volume: volume,
							loop: loop,
							autoplay: autoplay,
							hd:true,
							adproof: true,
							annotations: false
						});
					} else {
						element.addClass('poster-img');
					}
					
				
				});
			}
        },
        carouselImage:function(){
			if( $('.menu-thumb-slide').length > 0 ) {
				$('.menu-thumb-slide').each( function(){
					var singImg  = $(this).find('.single-img-slider');
					var thumbImg = $(this).find('.thumb-img-slider');
					
					var pagination = thumbImg.attr('data-pagination');
					var items = thumbImg.attr('data-items');
					var itemsdesktop = thumbImg.attr('data-itemsdesktop');
					if( pagination == 'false' ) { pagination = false; } else { pagination = true; }
					if( $.isNumeric( items ) ) { if( items > 0  ) { items = parseInt( items ); } else { items = 5; } } else { items = 5; }
					if( $.isNumeric( itemsdesktop ) ) { if( itemsdesktop > 0  ) { itemsdesktop = parseInt( itemsdesktop ); } else { itemsdesktop = 4; } } else { itemsdesktop = 4; }
					var direction = 'ltr';
					var navtext = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"];
					if( $('body').hasClass('rtl') ) {
						direction = 'rtl';
						navtext = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"]
					}
					singImg.owlCarousel({
						direction: direction,
						singleItem : true,
						slideSpeed : 1000,
						navigation: false,
						pagination:false,
						afterAction : syncPosition,
						responsiveRefreshRate : 200,
						navigationText:navtext,
					});
					thumbImg.owlCarousel({
						direction: direction,
						items : items,
						itemsDesktop      : [1199,itemsdesktop],
						itemsDesktopSmall     : [979,4],
						itemsTablet       : [768,3],
						itemsMobile       : [479,2],
						pagination:pagination,
						responsiveRefreshRate : 100,
						afterInit : function(el){
						  el.find(".owl-item").eq(0).addClass("current");
						}
					});
					
					function syncPosition(el){
						var current = this.currentItem;
						var id = this.$elem.context.id;
						var imgthumb = $('#'+id).closest(".menu-thumb-slide").find('.thumb-img-slider');
						imgthumb.find(".owl-item").removeClass("current").eq(current).addClass("current");
						if(imgthumb.data("owlCarousel") !== undefined){
							center(current)
						}
					}
                 
					thumbImg.on("click", ".owl-item", function(e){
						e.preventDefault();
						var number = $(this).data("owlItem");
						singImg.trigger("owl.goTo",number);
					});
                 
					function center(number){
						var thumbImgvisible = thumbImg.data("owlCarousel").owl.visibleItems;
						var num = number;
						var found = false;
						for(var i in thumbImgvisible){
						  if(num === thumbImgvisible[i]){
							var found = true;
						  }
						}

						if(found===false){
							if(num>thumbImgvisible[thumbImgvisible.length-1]){
								thumbImg.trigger("owl.goTo", num - thumbImgvisible.length+2)
							} else {
								if( num - 1 === -1 ){
									num = 0;
								}
								thumbImg.trigger("owl.goTo", num);
							}
						} else if( num === thumbImgvisible[thumbImgvisible.length-1] ){
							thumbImg.trigger("owl.goTo", thumbImgvisible[1]);
						} else if(num === thumbImgvisible[0]){
							thumbImg.trigger("owl.goTo", num-1);
						}

					}
				});
			}
        },
        youtubeBgVideo: function(){

            if( $youTubeBg.length > 0 ){
                $youTubeBg.each( function(){
                    var element = $(this),
                        ytbgVideo = element.attr('data-video'),
                        ytbgMute = element.attr('data-mute'),
                        ytbgRatio = element.attr('data-ratio'),
                        ytbgQuality = element.attr('data-quality'),
                        ytbgOpacity = element.attr('data-opacity'),
                        ytbgContainer = element.attr('data-container'),
                        ytbgOptimize = element.attr('data-optimize'),
                        ytbgLoop = element.attr('data-loop'),
                        ytbgVolume = element.attr('data-volume'),
                        ytbgStart = parseInt( element.attr('data-start') ),
                        ytbgStop = parseInt( element.attr('data-stop') ),
                        ytbgAutoPlay = element.attr('data-autoplay'),
                        ytbgFullScreen = element.attr('data-fullscreen'),
						ytbgshowControls = element.attr('data-showcontrols'),
						ytbgPoster  = element.attr('data-poster');
						
                    if( ytbgMute == 'false' ) { ytbgMute = false; } else { ytbgMute = true; }
                    if( !ytbgRatio ) { ytbgRatio = '16/9'; }
                    if( !ytbgQuality ) { ytbgQuality = 'hd720'; }
                    if( !ytbgOpacity ) { ytbgOpacity = 1; }
                    if( !ytbgContainer ) { ytbgContainer = 'self'; }
                    if( ytbgOptimize == 'false' ) { ytbgOptimize = false; } else { ytbgOptimize = true; }
                    if( ytbgLoop == 'false' ) { ytbgLoop = false; } else { ytbgLoop = true; }
                    if( !ytbgVolume ) { ytbgVolume = 1; }
                    if( !ytbgStart ) { ytbgStart = 0; }
                    if( !ytbgStop ) { ytbgStop = 0; }
                    if( ytbgAutoPlay == 'false' ) { ytbgAutoPlay = false; } else { ytbgAutoPlay = true; }
                    if( ytbgFullScreen == 'true' ) { ytbgFullScreen = true; } else { ytbgFullScreen = false; }
					if( ytbgshowControls == 'true' ) { ytbgshowControls = true; } else { ytbgshowControls = false; }
					
					if( typeof ytbgPoster === 'undefined' || ytbgPoster != '' ) {
						if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
							element.css("background", "url("+ ytbgPoster+ ")");
						} else {
							element.css("background-image", "url("+ ytbgPoster+ ")");
						}	
					}
					
					if( MAJESTY.isMobile.any() ){
                        $(element).addClass('video-mobile');
                    } else {
						element.mb_YTPlayer({
							videoURL: ytbgVideo,
							mute: ytbgMute,
							ratio: ytbgRatio,
							quality: ytbgQuality,
							opacity: ytbgOpacity,
							containment: ytbgContainer,
							optimizeDisplay: ytbgOptimize,
							loop: ytbgLoop,
							vol: ytbgVolume,
							startAt: ytbgStart,
							stopAt: ytbgStop,
							autoplay: ytbgAutoPlay,
							realfullscreen: ytbgFullScreen,
							showYTLogo: false,
							showControls: ytbgshowControls
						});
					}
                });
            }
        },

        extras: function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('#main-menu-trigger,#overlay-menu-close').click(function() {
                $( '#main-menu > ul, #main-menu > div > ul' ).toggleClass("show");
                return false;
            });
            if( MAJESTY.isMobile.any() ){
                $body.addClass('device-touch');
                   
            }
           
        },

        // for resize and load function 
		forResizeAndLoad: function (){
				
		   // Decect Viewport Screen
			var vH = $(window).height();
			$('#page-slider, #home-header, #slider, .fullheight, .slider-parallax').css('height',vH);
			// Centering Text for Home Header
			var parent_height = $('.slider-content').parent().height();
			var image_height = $('.slider-content').height();
			var top_margin = (parent_height - image_height)/2; 
			$('.slider-content').css( 'padding-top' , top_margin);
			
			// used for visual composer full height to center content
			var row_height = $('.vc-col-fullheight').closest('.vc-row-full-height').height();
			var image_row_height = $('.vc-col-fullheight').height();
			var top_margin_row = (row_height - image_row_height)/2; 
			$('.vc-col-fullheight').css( 'padding-top' , top_margin_row);
		}
    };
	
	MAJESTY.isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (MAJESTY.isMobile.Android() || MAJESTY.isMobile.BlackBerry() || MAJESTY.isMobile.iOS() || MAJESTY.isMobile.Opera() || MAJESTY.isMobile.Windows());
        }
    };

    MAJESTY.documentOnResize = {
        init: function(){
            var t = setTimeout( function(){
                MAJESTY.header.fullWidthMenu();
                MAJESTY.header.overlayMenu();
                MAJESTY.initialize.dataResponsiveHeights();
                MAJESTY.widget.forResizeAndLoad();
                MAJESTY.widget.parallax();
            }, 0 );

        }
    };
	MAJESTY.documentOnReady = {
        init: function(){
            MAJESTY.initialize.init();
            MAJESTY.header.init();
            MAJESTY.widget.init();
            MAJESTY.header.removeStickyness();
            MAJESTY.widget.forResizeAndLoad();
        },

    };
    MAJESTY.documentOnLoad = {
        init: function(){
          MAJESTY.widget.parallax();            
        }

    };
	var $window = $(window),
        $body = $('body'),
        $wrapper = $('#wrapper'),
        $header = $('#header'),
        $headerWrap = $('#header-wrap'),
        oldHeaderClasses = $header.attr('class'),
        oldHeaderWrapClasses = $headerWrap.attr('class'),
        stickyMenuClasses = $header.attr('data-sticky-class'),
        defaultLogo = $('#logo').find('.standard-logo'),
        $topCart = $('#shop_cart'),
        $parallaxEl = $('.bcg'),
        $youTubeBg = $('.yt-bg-player');

    $(document).ready(MAJESTY.documentOnReady.init);
    $window.load( MAJESTY.documentOnLoad.init );
    $window.on( 'resize', MAJESTY.documentOnResize.init );
	
	function convert_string_to_boolean( value ) {
		if( value == 'true') {
			return true
		} else {
			return false
		}
		
	}
	
	
	
	/* Loader */
	$(window).load(function() {
		$(".loader-item").delay(800).fadeOut();
		$("#loader, #loader2, #loader3").delay(1300).fadeOut("slow");
	});
	
	$(window).load(function(){
		if( $('.theme-menu-filter-container').length > 0 ) {
			/* 
			 * jQuery Used For filters In Woocommerce
			 */
			$('.theme-menu-filter-container').each(function() {
				var isOriginLeft = true;
				if( $('body').hasClass('rtl') ) {
					isOriginLeft = false;
				}
				var $container = $(this).find('.theme-menu-items');
				$container.isotope({ isOriginLeft:isOriginLeft,transitionDuration: '0.65s',
					itemSelector : '.single-menu-item',
					gutter: 13
				});

				$(this).find('.menu-fillter a').click(function(){
					$(this).closest('.theme-menu-filter-container').find('.menu-fillter li').removeClass('activeFilter');
					$(this).parent('li').addClass('activeFilter');
					var selector = $(this).attr('data-filter');
					$container.isotope({ filter: selector });
					return false;
				});
		
				$(window).resize(function() {
					$container.isotope('layout');
				});
			});
		}
		if( $('.theme-menu-filters').length > 0 ) {
			/* 
			 * jQuery Used For filters In Woocommerce
			 */
			$('.theme-menu-filters').each(function() {
				var isOriginLeft = true;
				if( $('body').hasClass('rtl') ) {
					isOriginLeft = false;
				}
				var $container = $(this).find('ul.products');
				$container.isotope({ isOriginLeft:isOriginLeft,transitionDuration: '0.65s',
					itemSelector : '.menu-item, .menu-item-list',
					gutter: 13
				});

				$(this).find('.menu-fillter a').click(function(){
					$(this).closest('.theme-menu-filters').find('.menu-fillter li').removeClass('activeFilter');
					$(this).parent('li').addClass('activeFilter');
					var selector = $(this).attr('data-filter');
					$container.isotope({ filter: selector });
					return false;
				});
		
				$(window).resize(function() {
					$container.isotope('layout');
				});
			});
		}
		if( $('.masonry-items').length > 0 ) {
			$('.masonry-items').each(function() {
				var isOriginLeft = true;
				if( $('body').hasClass('rtl') ) {
					isOriginLeft = false;
				}
				var $container = $(this).find('ul.products');
				$container.isotope({ isOriginLeft:isOriginLeft,transitionDuration: '0.65s',
					itemSelector : '.menu-item',
					gutter: 13
				});
				$(window).resize(function() {
					$container.isotope('layout');
				});
			});
		}
		
		if( $('.masonary_blog .masonry-content').length > 0 ) {
			$('.masonary_blog .masonry-content').each(function() {
				var $container = $(this);
				var isOriginLeft = true;
				if( $('body').hasClass('rtl') ) {
					isOriginLeft = false;
				}
				$container.isotope({ isOriginLeft:isOriginLeft,transitionDuration: '0.65s',
					itemSelector : '.menu-item',
					gutter: 13
				});
				$(window).resize(function() {
					$container.isotope('layout');
				});
			});
		}
		
	});
	
	
	$(function() {
		//$(document).ready(MAJESTY.documentOnReady.init);
		if( $('.top-menu-scroll').length > 0 ) {
			$('.top-menu-scroll').singlePageNav({
				offset: $('#header').outerHeight(),
				threshold: 120,
				speed: 600,
				currentClass: 'current',
				easing: 'linear',
				filter: ':not(.external a)',
				beforeStart: function() {
					$('ul.top-menu-scroll').toggleClass('show');
				},
				onComplete: function() {
				}
			});
		}
		$(".go-down, .scroll-down").click(function(event){ // When a link with the .scroll class is clicked
			event.preventDefault(); // Prevent the default action from occurring
			$('html,body').animate({scrollTop:$(this.hash).offset().top }, 1000); // Animate the scroll to this link's href value
		});
		
		// Used in Visual Composer inline Scroll menu
		if( $('.theme-menu-scroll').length > 0 ) {
			$('.theme-menu-scroll').each( function(){
				
				$(this).singlePageNav({
					offset: 0,
					threshold: 120,
					speed: 600,
					currentClass: 'current',
					easing: 'swing',
					filter: ':not(.external a)',
				});
			});
		}
		
		// Menu Vertical
		if( $('#vertical-header').length > 0 ) {
			var menuLeft = document.getElementById( 'vertical-menu' ),
				showLeft = document.getElementById( 'menu-button' ),
				body = document.body;
			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
			};
		}
		
		// scroll to top
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
			$('#scroll_up').fadeIn();
			} else {
			$('#scroll_up').fadeOut();
			}
		});

		$('#scroll_up').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 500);
			return false;
		});
		
		//Detecting viewpot dimension
		var vH = $(window).height();
		var vW = $(window).width();

		//Adjusting Intro Components Spacing based on detected screen resolution
		$('.fullheight').css('height',vH);
		$('.halfheight').css('height',vH/2);
		$('.fullwidth').css('width',vW);
		$('.halfwidth').css('width',vW/2);
		MAJESTY.widget.forResizeAndLoad();
		
		// shopcart
		jQuery.fn.clickoutside = function(callback) {
			var outside = 1, self = $(this);
			self.cb = callback;
			this.click(function() {
				outside = 0; 
			});
			$(document).click(function() {
				outside && self.cb();
				outside = 1;
			});
			return $(this);
		};
		
		$("#shop_tigger").click(function(e) {
			$('#shop_cart').toggleClass("shop_cart_open"),e.stopPropagation(), e.preventDefault();
		});
		
		var q = function() { 
			$('#shop_cart').removeClass("shop_cart_open");
		};
		$('#shop_cart').clickoutside(q);
		
		/* Popover bs active */
		$('[data-toggle="popover"]').popover()


		/* menu carousel */
		if( $('.menu_carousel').length > 0 ) {
			var  navigation = $('.menu_carousel').attr('data-navigation');
			var items = parseInt( $('.menu_carousel').attr('data-items') );
            var itemsdesktop = parseInt( $('.menu_carousel').attr('data-itemsdesktop') );
            var itemsdesktopsmall = parseInt( $('.menu_carousel').attr('data-itemsdesktopsmall') );
			if( navigation == 'false' ) { navigation = false; } else { navigation = true; }
			if( $.isNumeric( items ) ) { if( items > 0  ) { items = parseInt( items ); } else { items = 5; } } else { items = 6; }
			if( $.isNumeric( itemsdesktop ) ) { if( itemsdesktop > 0  ) { itemsdesktop = parseInt( itemsdesktop ); } else { itemsdesktop = 4; } } else { itemsdesktop = 3; }
			if( $.isNumeric( itemsdesktopsmall ) ) { if( itemsdesktopsmall > 0  ) { itemsdesktopsmall = parseInt( itemsdesktopsmall ); } else { itemsdesktopsmall = 3; } } else { itemsdesktopsmall = 3; }
			
			var navtext = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"];
			if( navigation == false ) {
				navtext = false;
			}
			var direction = 'ltr';
			if( $('body').hasClass('rtl') ) {
				direction = 'rtl';
				navtext = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];
			}
			$('.menu_carousel').owlCarousel({
				direction: direction,
				autoPlay: 3000,
				stopOnHover:true,
				navigation : navigation, // Show next and prev buttons
				pagination:false,
				items : items,
				itemsDesktop : [1199,itemsdesktop],
				itemsDesktopSmall : [979,itemsdesktopsmall],
				navigationText:navtext,
			});
		}
		
		
		/* Our team  */
		if( $('#our_team_carousel').length > 0 ) {
			var direction = 'ltr';
			if( $('body').hasClass('rtl') ) {
				direction = 'rtl';
			}
			$("#our_team_carousel").owlCarousel({
				direction: direction,
				autoPlay: true,
				stopOnHover:true,
				navigation : false, // Show next and prev buttons
				pagination:true,
				items : 3,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [979,2],
				itemsTablet: [768,2],
				itemsTabletSmall: [550,1] // imortant
			});
		}
		// used in woo category slider
		if( $('.woo-owl-carousel').length > 0 ) {
			$('.woo-owl-carousel').each( function(){
				var direction = 'ltr';
				if( $('body').hasClass('rtl') ) {
					direction = 'rtl';
				}
				$(this).owlCarousel({
					direction: direction,
					autoPlay: true,
					stopOnHover:true,
					navigation : false, // Show next and prev buttons
					pagination:true,
					items : 3,
					itemsDesktop : [1199,3],
					itemsDesktopSmall : [979,2],
					itemsTablet: [600,1]
				});
			});
		}
		
		if( $('.theme-owl-carousel').length > 0 ||  $('.theme-owl-slider').length > 0 ) {
			$('.theme-owl-carousel, .theme-owl-slider').each( function(){
                    var element = $(this),
						type = element.attr('data-slider-type'),
                        autoplay = element.attr('data-autoplay'),
                        stoponhover = element.attr('data-stoponhover'),
                        slidespeed = element.attr('data-slidespeed'),
                        lazyload = element.attr('data-lazyload'),
                        navigation = element.attr('data-navigation'),
                        pagination = element.attr('data-pagination'),
                        paginationspeed = element.attr('data-paginationspeed'),
                        items = element.attr('data-items'),
                        itemsdesktop = element.attr('data-itemsdesktop'),
                        itemsdesktopsmall = parseInt( element.attr('data-itemsdesktopsmall') ),
                        itemstablet = parseInt( element.attr('data-itemstablet') ),
						itemstabletsmall = parseInt( element.attr('data-itemstabletsmall') ),
                        itemsmobile = element.attr('data-itemsmobile');
						
                    if( autoplay == 'false' ) { 
						autoplay = false; 
					} else if( autoplay == 'true' ) { 
						autoplay = true;
					} else if( $.isNumeric( autoplay ) ) {
						if( autoplay > 0  ) {
							autoplay = parseInt( autoplay );
						} else {
							autoplay = true;
						}
					} else {
						autoplay = true;
					}
					if( stoponhover == 'false' ) { stoponhover = false; } else { stoponhover = true; }
					if( $.isNumeric( slidespeed ) ) { if( slidespeed > 0  ) { slidespeed = parseInt( slidespeed ); } else { slidespeed = 200; } } else { slidespeed = 200; }
					if( lazyload == 'false' ) { lazyload = false; } else { lazyload = true; }
					if( navigation == 'false' ) { navigation = false; } else { navigation = true; }
					if( pagination == 'false' ) { pagination = false; } else { pagination = true; }
					if( $.isNumeric( paginationspeed ) ) { 
						if( paginationspeed > 0  ) {
							paginationspeed = parseInt( paginationspeed );
						} else {
							paginationspeed = 800;
						}
					} else { 
						paginationspeed = 800;
					}
					if( $.isNumeric( items ) ) { if( items > 0  ) { items = parseInt( items ); } else { items = 5; } } else { items = 5; }
					if( $.isNumeric( itemsdesktop ) ) { if( itemsdesktop > 0  ) { itemsdesktop = parseInt( itemsdesktop ); } else { itemsdesktop = 4; } } else { itemsdesktop = 4; }
					if( $.isNumeric( itemsdesktopsmall ) ) { if( itemsdesktopsmall > 0  ) { itemsdesktopsmall = parseInt( itemsdesktopsmall ); } else { itemsdesktopsmall = 3; } } else { itemsdesktopsmall = 3; }
					if( $.isNumeric( itemstablet ) ) { if( itemstablet > 0  ) { itemstablet = parseInt( itemstablet ); } else { itemstablet = 2; } } else { itemstablet = 2; }
					if( $.isNumeric( itemstabletsmall ) ) { if( itemstabletsmall > 0  ) { itemstabletsmall = parseInt( itemstabletsmall ); } else { itemstabletsmall = itemstablet; } } else { itemstabletsmall = itemstablet; }
					
					if( $.isNumeric( itemsmobile ) ) { if( itemsmobile > 0  ) { itemsmobile = parseInt( itemsmobile ); } else { itemsmobile = 1; } } else { itemsmobile = 1; }
					
					var navtext = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"];
					if( navigation == false ) {
						navtext = false;
					}
					var singleitem = false;
					if( type == 'slider' ) {
						singleitem = true;
					}
					var direction = 'ltr';
					if( $('body').hasClass('rtl') ) {
						direction = 'rtl';
						navtext = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];
					}
					element.owlCarousel({
						direction: direction,
						autoPlay: autoplay,
						stopOnHover:stoponhover,
						slideSpeed:slidespeed,
						lazyLoad:lazyload,
						navigation : navigation, // Show next and prev buttons
						pagination:pagination,
						paginationSpeed:paginationspeed,
						items : items,
						itemsDesktop : [1199,itemsdesktop],
						itemsDesktopSmall : [768,itemsdesktopsmall],
						itemsTablet: [600,itemstablet],
						itemsTabletSmall : [979,itemsdesktopsmall],
						
						itemsMobile: [479,itemsmobile],
						singleItem: singleitem,
						navigationText:navtext,
					});
                });
		}
		
		/* Text transform */
		if( $('#text-transform').length > 0 ) {
			var direction = 'ltr';
			if( $('body').hasClass('rtl') ) {
				direction = 'rtl';
			}
			$('#text-transform').each( function(){
				$(this).owlCarousel({
					direction: direction,
					autoPlay: 4000,
					navigation: false,
					slideSpeed: 700,
					pagination: false,
					singleItem: true
				});
			});
		}
		
		
		if( $('.theme-menu-tabs-sliders').length > 0 ) {
			$(this).find('div.list-group a').each(function() {
				$(this).click(function(e) {
					e.preventDefault();
					$(this).siblings('a.active').removeClass("active");
					$(this).addClass("active");
					var index = $(this).index();
					$(this).closest('.our-menu-tab-container').find("div.our-menu-tabs>div.tab-content").removeClass("active");
					$(this).closest('.our-menu-tab-container').find("div.our-menu-tabs>div.tab-content").eq(index).addClass("active");
				});
			});
			
			$(this).find('.our-menu-slider').each(function() {
				var direction = 'ltr';
				if( $('body').hasClass('rtl') ) {
					direction = 'rtl';
				}
				$(this).owlCarousel({
					direction: direction,
					navigation : false,
					slideSpeed : 300,
					lazyLoad : true,
					paginationSpeed : 400,
					singleItem:true
				});
			});
		}
		
		if( $('.blog-slider').length > 0 ) {
			var direction = 'ltr';
			var navtext = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"];
			if( $('body').hasClass('rtl') ) {
				direction = 'rtl';
				navtext = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"]
			}
			$(".blog-slider").owlCarousel({
				direction: direction,
				navigation : true, // Show next and prev buttons
				slideSpeed : 300,
				autoPlay: true,
				paginationSpeed : 400,
				pagination:false,
				navigationText:navtext,
				singleItem:true
			});
		}
		
		
		
		/* Modernizer for overlay mobile */
		if (Modernizr.touch) {
			// show the close overlay button
			$(".close-overlay").removeClass("hidden");
			// handle the adding of hover class when clicked
			$(".overlay_item").click(function(e){
				if (!$(this).hasClass("hover")) {
				$(this).addClass("hover");
				}
			});
			// handle the closing of the overlay
			$(".close-overlay").click(function(e){
				e.preventDefault();
				e.stopPropagation();
				if ($(this).closest(".overlay_item").hasClass("hover")) {
					$(this).closest(".overlay_item").removeClass("hover");
				}
			});
		} else {
			// handle the mouseenter functionality
			$(".overlay_item").mouseenter(function(){
				$(this).addClass("hover");
			})
			// handle the mouseleave functionality
			.mouseleave(function(){
				$(this).removeClass("hover");
			});
		}
		
		/*  Ticker */
		$('#fade, .text-rotator').list_ticker({
			speed:4000,
			effect:'fade'
		});

		/* Tooltip active */
		$('[data-toggle="tooltip"]').tooltip();

		/* Carousel active */
		$('.carousel').carousel({interval: 7000});
		$('.theme-tabs .nav-tabs a').click(function (e) {
			e.preventDefault() 
			$(this).tab('show');
		});
		
		if( $('a[rel^="lightbox"]').length > 0 ) {
			$("a[rel^='lightbox']").prettyPhoto({
				show_title: false,
				hook: 'data-rel',
				social_tools: false,
				theme: 'pp_ignited',
				horizontal_padding: 20,
				opacity: 0.95,
				deeplinking: false
			});
		}
		if( $('.thumb-with-lightbox').length > 0 ) {
			$('.thumb-with-lightbox').each(function() {
				var displaytitle = $(this).attr('data-display-title');
				if( displaytitle == 'false' ) { displaytitle = false; } else { displaytitle = true; }
				$(this).prettyPhoto({
					show_title: displaytitle,
					hook: 'data-rel',
					social_tools: false,
					theme: 'pp_ignited',
					horizontal_padding: 20,
					opacity: 0.95,
					deeplinking: false
				});
			});
		}
		/* Flickr */
		if( $('.flickr').length > 0 ) {
			$('.flickr').each( function(){
				var nums = parseInt( $(this).attr('data-numbers') );
				var id = $(this).attr('data-flickrid');
				$(this).find('.flickrbox').jflickrfeed({
					limit: nums,
					qstrings: {
					id: id
				},
					itemTemplate: '<li><a data-rel="prettyPhoto" href="{{image_b}}" ><img src="{{image_s}}" alt="{{title}}" /></a></li>'
				}, function() {
						$(".flickrbox a").prettyPhoto({
							show_title: false,
							hook: 'data-rel',
							social_tools: false,
							theme: 'pp_ignited',
							horizontal_padding: 20,
							opacity: 0.95,
							deeplinking: false
						});
				});
			});
		}
		
		/* == 
			Post Share 
		==*/
		if($('.post-share').length > 0 ){
			$('.post-share a').on('click',function(){ 
				window.open( $(this).attr('href') , "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
				return false; 
				});

			$('.post-share').animate({opacity:1});
		}
		
		if( $('.interactive-bg .bg').length > 0 ) {
			var strength 		= $(this).parent('.interactive-bg').attr('data-strength');
			var scale 			= $(this).parent('.interactive-bg').attr('data-scale');
			var animationspeed 	= $(this).parent('.interactive-bg').attr('data-animationspeed');
			
			if( !strength ) { strength = 25; }
			if( !scale ) { scale = 1.05; }
			if( !animationspeed ) { animationspeed = '100ms'; }
			console.log(strength);
			console.log(parseInt(scale));
			console.log(animationspeed,2);
			$(".bg").interactive_bg({
			   strength: parseInt(strength),
			   scale: parseFloat(scale,2),
			   animationSpeed: animationspeed,
			 });
			$(window).resize(function() {
				$(".wrapper-bg > .ibg-bg").css({
					width: $(window).outerWidth(),
					height: $(window).outerHeight()
				})
			});
		}
		
		/* Skipper Slider */
		if( $('.theme-skipper-slider').length > 0 ) {
			$('.theme-skipper-slider').each(function() {
				var transition 		= $(this).parent('.skipper-slider').attr('data-transition');
				var speed    		= $(this).parent('.skipper-slider').attr('data-speed');
				var arrows    		= convert_string_to_boolean ($(this).parent('.skipper-slider').attr('data-arrows') );
				var navtype    		= $(this).parent('.skipper-slider').attr('data-navtype');
				var autoplay    	= convert_string_to_boolean( $(this).parent('.skipper-slider').attr('data-autoplay') );
				var duration    	= $(this).parent('.skipper-slider').attr('data-duration');
				var hideprev    	= convert_string_to_boolean( $(this).parent('.skipper-slider').attr('data-hideprev') );
				//console.log(navType);
				$(this).skippr({
					transition: transition,
					speed: parseInt(speed),
					easing: 'easeOutQuart',
					arrows: arrows,
					navType: navtype,
					autoPlay: autoplay,
					autoPlayDuration: parseInt(duration),
					hidePrevious: hideprev,
				});
			});	
		}
		
		if( $('.bbgndgallery-images').length > 0 ) {
			    //BG SLIDESHOW WITH ZOOM EFFECT
			var transition 		= $('.bbgndgallery-images').attr('data-transition');
			var timer    		= $('.bbgndgallery-images').attr('data-timer');
			var efftimer    	= $('.bbgndgallery-images').attr('data-efftimer');
			var containment     = 'body';
			if ($("body").hasClass("boxed")) {
				containment = '#top-page-slider'
			}
			var images = [];
			$('.bbgndgallery-images').find("li img").each(function () {
				images.push($(this).attr('src'));
			});
			$.mbBgndGallery.buildGallery({
                containment:containment,
				timer:parseInt(timer),
				effTimer:parseInt(efftimer),
                controls:false, 
                grayScale:false,
                shuffle:false,
                preserveWidth:false,
                preserveTop: true,
                effect:transition,
                images:images,
                onStart:function(){MAJESTY.widget.forResizeAndLoad()},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });
		}
		
		/* Majest Wordpress Version Custom Css*/
		$('ul.page-numbers li').has('a.prev').addClass('previous');
		$('ul.page-numbers li').has('a.next').addClass('next');
		//cart.php
		$('.shop_table .product-remove a').html('<i class="fa fa-times"></i>');
		
		// Replace x-remove from first child to last child
		var removexcontent = $('.shop_table tr th.product-remove');
		$('.shop_table tr th.product-remove').remove();
		$('.shop_table thead tr').append(removexcontent);
		$.each($(".shop_table tr.cart_item"), function() { 
			var removex = $(this).find('.product-remove');
			$(this).find('.product-remove').remove();
			$(this).append(removex);
        });
		
		// Cart wrap select
		$('.cart_totals select.shipping_method, .cart_totals select.country_to_state, select.em-ticket-select, .em-search-category select, .em-search-country select, table.variations td select, .sidebar select, #footer select, .rtb-booking-form select, #rtb-time').wrap('<div class="select_wrap"></div>');
		if( $("a[data-rel^='prettyPhoto']").length > 0 ) {
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
				hook: 'data-rel',
				social_tools: false,
				theme: 'pp_woocommerce',
				horizontal_padding: 20,
				opacity: 0.8,
				deeplinking: false
			});
		}
		
		/* RESERVATION */
		if ( $(".rtb-booking-form").length > 0 ){
			$('.rtb-booking-form button').wrap('<div class="text-center col-md-12"></div>');
			$( ".rtb-text" ).each(function() {
				if( $(this).find('.rtb-error').length != 0 ) {
					$(this).addClass('rtb-error-icon');
				}
			});
		}
		
		if ($("#datetimepicker").length > 0){
			var currentTime = new Date();
			$('#datetimepicker').datetimepicker({timepicker:false,format:'m/d/Y', minDate:0, scrollMonth:false, yearStart:currentTime.getFullYear(), yearEnd:currentTime.getFullYear() + 1 });
		}
		
		// CountDown
		if ($(".theme-count-dow").length > 0 ){
			$( ".theme-count-dow" ).each(function() {
				var idelement 		= $(this).attr('id');
				var year 			= parseInt($(this).attr('data-year'));
				var month    		= parseInt($(this).attr('data-month'));
				var days    		= parseInt($(this).attr('data-days'));
				var dayslabel 		= $(this).attr('data-days-label');
				var hourslabel    	= $(this).attr('data-hours-label');
				var minuteslabel    = $(this).attr('data-minutes-label');
				var secondslabel    = $(this).attr('data-seconds-label');
				var rtl    			= $(this).attr('data-rtl');
				var expiretext		= $(this).closest('.wrap-count-down').find('.expiretext').html();
				if( rtl == 'false' ) { rtl = false; } else { rtl = true; }
				
				var austDay = new Date();
				austDay = new Date(year, month-1, days);
				$("#"+idelement).countdown({until: austDay, labels: ['Yr', 'Mo', 'Wk', dayslabel, hourslabel, minuteslabel, secondslabel], expiryText: expiretext, alwaysExpire: true, isRTL: rtl});
			});
		}
		
		
		//plugin bootstrap minus and plus
		//http://jsfiddle.net/laelitenetwork/puJ6G/
		$('.btn-number').click(function(e){
			e.preventDefault();
			
			var fieldName = $(this).attr('data-field');
			var type      = $(this).attr('data-type');
			//var input = $("input[name='"+fieldName+"']");
			var input = $(this).closest('.plus-minus').find('.input-number');
			var currentVal = parseInt(input.val());
			if (!isNaN(currentVal)) {
				if(type == 'minus') {
					
					if(currentVal > input.attr('min')) {
						input.val(currentVal - 1).change();
					} 
					if(parseInt(input.val()) == input.attr('min')) {
						$(this).attr('disabled', true);
					}

				} else if(type == 'plus') {
					var max = input.attr('max');
					if( typeof max === 'undefined' ) {
						max = 9999;
					}
					console.log(max);
					if( currentVal < max ) {
						input.val(currentVal + 1).change();
					}
					if( parseInt(input.val()) == max ) {
						$(this).attr('disabled', true);
					}

				}
			} else {
				input.val(0);
			}
		});
		$('.input-number').focusin(function(){
		   $(this).data('oldValue', $(this).val());
		});
		$('.input-number').change(function() {
			
			var minValue =  parseInt($(this).attr('min'));
			var maxValue = $(this).attr('max');
			if( typeof maxValue === 'undefined' ) {
				maxValue = 9999;
			} else {
				maxValue = parseInt(maxValue);
			}
			var valueCurrent = parseInt($(this).val());		
			var name = $(this).attr('name');
			if(valueCurrent >= minValue) {
				$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
			} else {
				$(this).val($(this).data('oldValue'));
			}
			if(valueCurrent <= maxValue) {
				$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
			} else {
				$(this).val($(this).data('oldValue'));
			}
			
			
		});
		$(".input-number").keydown(function (e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
				 // Allow: Ctrl+A
				(e.keyCode == 65 && e.ctrlKey === true) || 
				 // Allow: home, end, left, right
				(e.keyCode >= 35 && e.keyCode <= 39)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});	
		
		MAJESTY.widget.forResizeAndLoad();
		
		// add to version 1.2.1
		$('.top-small-header .down-button').bind('click', function () {
		  if ($(this).hasClass('current')) {
			$(this).removeClass('current');
			$('.top-small-header .down-button > i').removeClass('fa fa-chevron-circle-up');
			$('.top-small-header .down-button > i').addClass('fa fa-chevron-circle-down');
			$(this).parent().parent().find('.top-small-header .container').slideUp('slow', function(){ $(this).closest('.top-small-header').removeClass('opened'); });
			  
			  return false;
		  } else {
			$(this).addClass('current').closest('.top-small-header').addClass('opened');
			$('.top-small-header .down-button > i').removeClass('fa fa-chevron-circle-down');
			$('.top-small-header .down-button > i').addClass('fa fa-chevron-circle-up');
			$(this).parent().parent().find('.top-small-header .container').slideDown('slow');
			  
			  return false;
		  }
		});
		$(window).bind('resize', function () { 
			if ($(this).width() > 768) {
				$('.top-small-header .down-button').removeClass('current');
				$('.top-small-header .container').removeAttr('style');
				$('.top-small-header .down-button > i').removeClass('fa fa-chevron-circle-up');
				$('.top-small-header .down-button > i').addClass('fa fa-chevron-circle-down');
				$('.top-small-header').removeClass('opened');
			}
		});
	});
	
	if ($(".custom-google-map").length > 0 ){
			$( ".custom-google-map" ).each(function() {
				var zoom = $(this).attr('data-map-zoom');
				var maptitle = $(this).attr('data-map-title');
				var mapimage = $(this).attr('data-map-image');
				var latlang1 = $(this).attr('data-map-latlang');
				var LatLng = latlang1.split(',');
				var mapid = $(this).attr('id');
				var mapstyles = $(this).attr('data-map-style');
				if( !mapstyles ) { mapstyles = 'light'; }
				
				
				var desc  = '';
				if ( $(this).parent().find('.custom-google-map-desc').length > 0){
					desc  = $(this).parent().find('.custom-google-map-desc').html();
				}
				google.maps.event.addDomListener(window, 'load', init);
				//custom-map
				function init() {
					if( mapstyles == 'dark' ) {
						var mapOptions = {
							zoom: parseInt(zoom),
							scrollwheel: false,
							center: new google.maps.LatLng(LatLng[0], LatLng[1]), // Your Address Here
							styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
						};
					} else {
						var mapOptions = {
							zoom: parseInt(zoom),
							scrollwheel: false,
							center: new google.maps.LatLng(LatLng[0], LatLng[1]), // Your Address Here
							styles: [{stylers:[{hue:'#000000'},{saturation:-100}]},{featureType:'water',elementType:'geometry',stylers:[{lightness:50},{visibility:'simplified'}]},{featureType:'road',elementType:'labels',stylers:[{visibility:'off'}]}]
						};
					}
					var mapElement = document.getElementById(mapid);
					var map = new google.maps.Map(mapElement, mapOptions);
					var image = mapimage;
					var myLatLng = new google.maps.LatLng(LatLng[0], LatLng[1]);
					var mapMarker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						icon: image,
						title:  maptitle
				
					});
					if(  desc != 'undefined' && desc != '') {
						var contentString =  '<div id="content"><div id="bodyContent">' + desc + '</div></div>';
						var infowindow = new google.maps.InfoWindow({ content: contentString });
						google.maps.event.addListener(mapMarker, 'click', function() {
							infowindow.open(map, mapMarker);
						}); 
					}
				}
				google.maps.event.addDomListener(window, 'load', init);
			});
		}
	
	/*
	 * Text Rotator
	 */ 
	$.fn.list_ticker = function(options){
		var defaults = {
			speed:4000,
			effect:'slide'
		};
		var options = $.extend(defaults, options);
		return this.each(function(){
			var obj = $(this);
			var list = obj.children();
			list.not(':first').hide();
			setInterval(function(){
				list = obj.children();
				list.not(':first').hide();
				var first_li = list.eq(0)
				var second_li = list.eq(1)
				if(options.effect == 'slide'){
					first_li.slideUp();
					second_li.slideDown(function(){
						first_li.remove().appendTo(obj);
					});
				} else if(options.effect == 'fade'){
					first_li.fadeOut(function(){
						second_li.fadeIn();
						first_li.remove().appendTo(obj);
					});
				}
			}, options.speed)
		});
	};
	
	/*!
	 * classie - class helper functions
	 * from bonzo https://github.com/ded/bonzo
	 * 
	 * classie.has( elem, 'my-class' ) -> true/false
	 * classie.add( elem, 'my-new-class' )
	 * classie.remove( elem, 'my-unwanted-class' )
	 * classie.toggle( elem, 'my-class' )
	 */

	/*jshint browser: true, strict: true, undef: true */
	( function( window ) {

		'use strict';

		// class helper functions from bonzo https://github.com/ded/bonzo

		function classReg( className ) {
		  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
		}

		// classList support for class management
		// altho to be fair, the api sucks because it won't accept multiple classes at once
		var hasClass, addClass, removeClass;

		if ( 'classList' in document.documentElement ) {
		  hasClass = function( elem, c ) {
			return elem.classList.contains( c );
		  };
		  addClass = function( elem, c ) {
			elem.classList.add( c );
		  };
		  removeClass = function( elem, c ) {
			elem.classList.remove( c );
		  };
		}
		else {
		  hasClass = function( elem, c ) {
			return classReg( c ).test( elem.className );
		  };
		  addClass = function( elem, c ) {
			if ( !hasClass( elem, c ) ) {
			  elem.className = elem.className + ' ' + c;
			}
		  };
		  removeClass = function( elem, c ) {
			elem.className = elem.className.replace( classReg( c ), ' ' );
		  };
		}

		function toggleClass( elem, c ) {
		  var fn = hasClass( elem, c ) ? removeClass : addClass;
		  fn( elem, c );
		}

		window.classie = {
		  // full names
		  hasClass: hasClass,
		  addClass: addClass,
		  removeClass: removeClass,
		  toggleClass: toggleClass,
		  // short names
		  has: hasClass,
		  add: addClass,
		  remove: removeClass,
		  toggle: toggleClass
		};

	})( window );
})(jQuery);