/**
 *
 * StartuplyWP JS functions
 *
 * @author Vivaco
 * @license Commercial License
 * @link http://startuplywp.com
 * @copyright 2015 Vivaco
 * @package Startuply
 * @version 2.0.0
 *
 */

 !function(t){if(!t.fn.style){var e=function(t){return t.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")},r=!!CSSStyleDeclaration.prototype.getPropertyValue;r||(CSSStyleDeclaration.prototype.getPropertyValue=function(t){return this.getAttribute(t)},CSSStyleDeclaration.prototype.setProperty=function(t,r,n){this.setAttribute(t,r);var n="undefined"!=typeof n?n:"";if(""!=n){var i=new RegExp(e(t)+"\\s*:\\s*"+e(r)+"(\\s*;)?","gmi");this.cssText=this.cssText.replace(i,t+": "+r+" !"+n+";")}},CSSStyleDeclaration.prototype.removeProperty=function(t){return this.removeAttribute(t)},CSSStyleDeclaration.prototype.getPropertyPriority=function(t){var r=new RegExp(e(t)+"\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?","gmi");return r.test(this.cssText)?"important":""}),t.fn.style=function(t,e,r){var n=this.get(0);if("undefined"==typeof n)return this;var i=this.get(0).style;return"undefined"!=typeof t?"undefined"!=typeof e?(r="undefined"!=typeof r?r:"",i.setProperty(t,e,r),this):i.getPropertyValue(t):i}}}(jQuery);

// Main theme functions start
var Startuply;
Startuply = {

    options: {
        log: false,
        animations: true,
    },
    //flexslider for testimonials and gallery
    flexsliderOptions: {
        manualControls: '.flex-manual .switch',
        nextText: "",
        prevText: "",
        startAt: 1,
        slideshow: false,
        direction: "horizontal",
        animation: "slide"
    },

    //check if site is laoded from mobile device
    mobileMenuView: false,
    homePage: false,

    log: function (msg) {
        if ( this.options.log ) console.log('%cStartupLy Log: ' + msg, 'color: #1ac6ff');
    },

    checkMobile: function () {
        if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $('.parallax-section').css({'background-attachment': 'scroll'});
            $.each($('.wpb_animate_when_almost_visible'), function () { $(this).removeClass('wpb_animate_when_almost_visible').attr('style', ''); });

            $('.animated').css('opacity', 1);

        } else {
            $elems = $('.parallax-section[id^="parallax-"]')
            $('.parallax-section[id^="parallax-"]').parallax("50%", 0.4);
        }
    },

    //get all options from the theme
    getThemeOptions: function () {
        var _this = this;

        _this.stickyMenu = ( typeof themeOptions != 'undefined' && themeOptions.stickyMenu ) ? themeOptions.stickyMenu : 'all_pages';
        _this.stickyMenuOffset = ( typeof themeOptions != 'undefined' && themeOptions.menuPosition ) ? + themeOptions.menuPosition : 600;

        _this.mobileMainMenuMod = ( typeof themeOptions != 'undefined' && themeOptions.mobileMainMenuMod ) ? + themeOptions.mobileMainMenuMod : false;
        _this.mobileMenuMod = ( typeof themeOptions != 'undefined' && themeOptions.mobileMenuMod ) ? + themeOptions.mobileMenuMod : false;
        _this.mobileMenu = false;

        _this.smoothScroll = ( typeof themeOptions != 'undefined' && themeOptions.smoothScroll ) ? + themeOptions.smoothScroll : 0;
        _this.smoothScrollSpeed = ( typeof themeOptions != 'undefined' && themeOptions.smoothScrollSpeed ) ? + themeOptions.smoothScrollSpeed : 800;
    },

    //set theme options on current page
    setPageOptions: function () {
        var _this = this;

        if ( $('body').is('.home') ) {
            _this.homePage = true
        }

        if ( _this.mobileMainMenuMod && _this.homePage || _this.mobileMenuMod && !_this.homePage ) {
            _this.mobileMenu = true;
            $('body').addClass('mobile-always');
        }
    },

    //check if "Always mobile menu" is set
    mobileMenuStatus: function () {
        var _this = this;

        if ( window.innerWidth <= 1024 || _this.mobileMenu ) {
            _this.mobileMenuView = true
        }else {
            _this.mobileMenuView = false
        }

        if ( _this.mobileMenuView ) {
            $('.navigation-header .navbar-collapse').css({
                'height': $(window).height(),
                'max-height': $(window).height()
            });
        }else {
            $('.navigation-header .navbar-collapse').css({
                'height': '',
                'max-height': ''
            });

            $('.dropdown').removeClass('opened');
            $('.dropdown-menu').css('display', '');
        }
    },

    //adjust row/column heights for "100%" height option
    fullColumnHeight: function () {
        $.each( $('.vc_row-fluid.window_height'), function () {
            if ( !$(this).is('.vsc_inner') ) {
                $(this).css('min-height', $(window).height());
            }
        });

        $.each( $('.wpb_column.full_height'), function () {
            if ( $(this).css('float') == 'none' ) {
                $(this).height('auto');

            } else {
                $(this).height('auto');
                $(this).outerHeight( $(this).closest('.row-element').height() );
            }
        });

        $.each( $('.vc_row-fluid.window_height.vsc_inner'), function () {
             $(this).css('min-height', $(this).closest('.wpb_column').height() );
        });

        $.each( $('.vc_row-fluid.centered-content'), function () {
            var rowHeight = $(this).outerHeight(),
                $container = $(this).find('>.container'),
                containerHeight = 0,
                padding = 0;

            if ( !$container.length ) {
                $container = $(this).find('.column_container').first();
            }

            containerHeight = $container.outerHeight();
            padding = (rowHeight - containerHeight) / 2;

            $(this).css({
                'padding-top': padding,
                'padding-bottom': padding
            });
        });
    },

    //custom, super-fast smooth scrolling
    smoothScrollInit: function () {
        var _this = this
        !function(){function e(){var e=!1;e&&c("keydown",r),v.keyboardSupport&&!e&&u("keydown",r)}function t(){if(document.body){var t=document.body,o=document.documentElement,n=window.innerHeight,r=t.scrollHeight;if(S=document.compatMode.indexOf("CSS")>=0?o:t,w=t,e(),x=!0,top!=self)y=!0;else if(r>n&&(t.offsetHeight<=n||o.offsetHeight<=n)){var a=!1,i=function(){a||o.scrollHeight==document.height||(a=!0,setTimeout(function(){o.style.height=document.height+"px",a=!1},500))};if(o.style.height="auto",setTimeout(i,10),S.offsetHeight<=n){var l=document.createElement("div");l.style.clear="both",t.appendChild(l)}}v.fixedBackground||b||(t.style.backgroundAttachment="scroll",o.style.backgroundAttachment="scroll")}}function o(e,t,o,n){if(n||(n=1e3),d(t,o),1!=v.accelerationMax){var r=+new Date,a=r-C;if(a<v.accelerationDelta){var i=(1+30/a)/2;i>1&&(i=Math.min(i,v.accelerationMax),t*=i,o*=i)}C=+new Date}if(M.push({x:t,y:o,lastX:0>t?.99:-.99,lastY:0>o?.99:-.99,start:+new Date}),!T){var l=e===document.body,u=function(){for(var r=+new Date,a=0,i=0,c=0;c<M.length;c++){var s=M[c],d=r-s.start,f=d>=v.animationTime,h=f?1:d/v.animationTime;v.pulseAlgorithm&&(h=p(h));var m=s.x*h-s.lastX>>0,w=s.y*h-s.lastY>>0;a+=m,i+=w,s.lastX+=m,s.lastY+=w,f&&(M.splice(c,1),c--)}l?window.scrollBy(a,i):(a&&(e.scrollLeft+=a),i&&(e.scrollTop+=i)),t||o||(M=[]),M.length?E(u,e,n/v.frameRate+1):T=!1};E(u,e,0),T=!0}}function n(e){x||t();var n=e.target,r=l(n);if(!r||e.defaultPrevented||s(w,"embed")||s(n,"embed")&&/\.pdf/i.test(n.src))return!0;var a=e.wheelDeltaX||0,i=e.wheelDeltaY||0;return a||i||(i=e.wheelDelta||0),!v.touchpadSupport&&f(i)?!0:(Math.abs(a)>1.2&&(a*=v.stepSize/120),Math.abs(i)>1.2&&(i*=v.stepSize/120),o(r,-a,-i),e.preventDefault(),void 0)}function r(e){var t=e.target,n=e.ctrlKey||e.altKey||e.metaKey||e.shiftKey&&e.keyCode!==H.spacebar;if(/input|textarea|select|embed/i.test(t.nodeName)||t.isContentEditable||e.defaultPrevented||n)return!0;if(s(t,"button")&&e.keyCode===H.spacebar)return!0;var r,a=0,i=0,u=l(w),c=u.clientHeight;switch(u==document.body&&(c=window.innerHeight),e.keyCode){case H.up:i=-v.arrowScroll;break;case H.down:i=v.arrowScroll;break;case H.spacebar:r=e.shiftKey?1:-1,i=-r*c*.9;break;case H.pageup:i=.9*-c;break;case H.pagedown:i=.9*c;break;case H.home:i=-u.scrollTop;break;case H.end:var d=u.scrollHeight-u.scrollTop-c;i=d>0?d+10:0;break;case H.left:a=-v.arrowScroll;break;case H.right:a=v.arrowScroll;break;default:return!0}o(u,a,i),e.preventDefault()}function a(e){w=e.target}function i(e,t){for(var o=e.length;o--;)z[N(e[o])]=t;return t}function l(e){var t=[],o=S.scrollHeight;do{var n=z[N(e)];if(n)return i(t,n);if(t.push(e),o===e.scrollHeight){if(!y||S.clientHeight+10<o)return i(t,document.body)}else if(e.clientHeight+10<e.scrollHeight&&(overflow=getComputedStyle(e,"").getPropertyValue("overflow-y"),"scroll"===overflow||"auto"===overflow))return i(t,e)}while(e=e.parentNode)}function u(e,t,o){window.addEventListener(e,t,o||!1)}function c(e,t,o){window.removeEventListener(e,t,o||!1)}function s(e,t){return(e.nodeName||"").toLowerCase()===t.toLowerCase()}function d(e,t){e=e>0?1:-1,t=t>0?1:-1,(k.x!==e||k.y!==t)&&(k.x=e,k.y=t,M=[],C=0)}function f(e){if(e){e=Math.abs(e),D.push(e),D.shift(),clearTimeout(A);var t=D[0]==D[1]&&D[1]==D[2],o=h(D[0],120)&&h(D[1],120)&&h(D[2],120);return!(t||o)}}function h(e,t){return Math.floor(e/t)==e/t}function m(e){var t,o,n;return e*=v.pulseScale,1>e?t=e-(1-Math.exp(-e)):(o=Math.exp(-1),e-=1,n=1-Math.exp(-e),t=o+n*(1-o)),t*v.pulseNormalize}function p(e){return e>=1?1:0>=e?0:(1==v.pulseNormalize&&(v.pulseNormalize/=m(1)),m(e))}var w,g={frameRate:150,animationTime:_this.smoothScrollSpeed,stepSize:120,pulseAlgorithm:!0,pulseScale:8,pulseNormalize:1,accelerationDelta:20,accelerationMax:1,keyboardSupport:!0,arrowScroll:50,touchpadSupport:!0,fixedBackground:!0,excluded:""},v=g,b=!1,y=!1,k={x:0,y:0},x=!1,S=document.documentElement,D=[120,120,120],H={left:37,up:38,right:39,down:40,spacebar:32,pageup:33,pagedown:34,end:35,home:36},v=g,M=[],T=!1,C=+new Date,z={};setInterval(function(){z={}},1e4);var A,N=function(){var e=0;return function(t){return t.uniqueID||(t.uniqueID=e++)}}(),E=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||function(e,t,o){window.setTimeout(e,o||1e3/60)}}(),K=/chrome/i.test(window.navigator.userAgent),L="onmousewheel"in document;L&&K&&(u("mousedown",a),u("mousewheel",n),u("load",t))}();
    },
    // check if site is laoded from mobile device
    checkMobile: function () {
        if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $(window).width() < this.options.mobileMenuMaxWidth ) {
            this.mobileDevice = true;

            this.log('Mobile device');
        }else {
            this.log('Desktop')
        }
    },
	
    initVideoBackground: function () {
        $('div[class*="ytp-player"]').each( function() {
            var $div = $(this),
                paddingTop = parseInt($div.css('padding-top')),
                paddingBottom = parseInt($div.css('padding-bottom')),
                token = $div.data('token'),
				results = $div.data('videoUrl').match("[\\?&]v=([^&#]*)"), vid,
                settingObj = window['vsc_vbg_' + token],
                $player,
                controlsTempalte;

            $div.css('height', $div.outerHeight());
            $div.children().not('.row-overlay').first().css({ 'padding-top': paddingTop, 'padding-bottom': paddingBottom });
            $div.style('padding-top', '0', 'important');
            $div.style('padding-bottom', '0', 'important');

            if ( !Startuply.checkMobile() ) {
                $player = $('.ytp-player-'+settingObj.id+'').mb_YTPlayer();

                if ( results && results.length > 1) {
                    vid = results[1];

                    $div.css({
                        'background-image': 'url("http://img.youtube.com/vi/'+vid+'/maxresdefault.jpg")',
                        'background-size': 'cover'
                    });
                }
                if ( $div.attr('data-controls') != 'none' ) {

                    controlsTempalte = '<div class="video-conrols"><i class="yt-play-btn-big"' + ( ( $div.attr('data-autoplay') == 'true' ) ? ' style="display: none"' : '' ) + '></i><div class="bottom"><div class="controls-container ' + $div.attr('data-controls') + '"><i class="yt-play-toggle' + ( ( $div.attr('data-autoplay') == 'false' ) ? ' active' : '' ) + '"></i><i class="yt-mute-toggle ' + ( ( $div.attr('data-mute') == 'true' ) ? ' active' : '' ) + '"></i><div class="yt-volume-slider"></div></div></div><div>'

                    $('.ytp-player-'+settingObj.id+'').append(controlsTempalte);

                    var $playBtn = $div.find('.yt-play-btn-big'),
                        $playToggle = $div.find('.yt-play-toggle'),
                        $muteToggle = $div.find('.yt-mute-toggle'),
                        $volumeSlider = $div.find('.yt-volume-slider');

                    $volumeSlider.slider({
                        range: 'min',
                        min: 0,
                        max: 100,
                        step: 5,
                        value: 50,
                        slide: function ( event, ui ) { $player.setYTPVolume(ui.value); }
                    });

                    $playBtn.on('click', function () {
                        $player.YTPPlay();
                    });

                    $playToggle.on('click', function () {
                        if ( $(this).is('.active') ) {
                            $player.YTPPlay();
                        }else {
                            $player.YTPPause();
                        }
                    });

                    $muteToggle.on('click', function () {
                        if ( $(this).is('.active') ) {
                            $muteToggle.removeClass('active');
                        }else {
                            $muteToggle.addClass('active');
                        }
                        $player.toggleVolume();
                    });

                    $player.on("YTPStart", function (e) {
                        $playBtn.fadeOut(300);
                        $playToggle.removeClass('active');
                    });

                    $player.on("YTPPause", function (e) {
                        $playBtn.fadeIn(200);
                        $playToggle.addClass('active');
                    });                    
					
					$player.on("YTPData", function (e) {
                        console.log(e);
                    });
                }

            } else {
                $('.ytp-player-'+settingObj.id+'').height(window.innerHeight).addClass('no-video-bg');
            }
        });
    },

    initEddCheckout: function() {
        var $wrap = $('#edd_checkout_wrap');

        if ( $wrap.length ) {
            var $cart = $('#edd_checkout_cart'),
                $payment = $('#edd_purchase_form > *').not('#edd_purchase_form_wrap'),
                $purchase = $('#edd_purchase_form_wrap'),
                steps, $steps, $step1, $step2, $step3,
                $navigation = $('<div class="edd-checkout-navigation">' +
                                    '' +
                                    '<ul class="edd-checkout-navigation-list"> ' +
                                        '<li class="edd-checkout-navigation-list-item"><span data-step="0" class="edd-checkout-navigation-list-item-link active">Review Order</span></li> ' +
                                        '<li class="edd-checkout-navigation-list-item"><span data-step="1" class="edd-checkout-navigation-list-item-link">Payment Method</span></li> ' +
                                        '<li class="edd-checkout-navigation-list-item"><span data-step="2" class="edd-checkout-navigation-list-item-link">Billing details</span></li>' +
                                    '</ul>' +
                                '</div>'),
                $navigationControls = $('<div class="edd-checkout-navigation-controls clearfix">' +
                                            '<a href="#" class="prev hidden btn btn-outline-color base_clr_bg base_clr_brd base_clr_txt">PREVIOUS</a> ' +
                                            '<a href="#" class="next btn btn-solid base_clr_bg">NEXT STEP</a>' +
                                        '</div>');

            if ( !$cart.length ) {
                return;
            }

            $wrap.prepend($navigation);
            $wrap.append($navigationControls);

            $cart.wrap('<div class="edd-checkout-step active"></div>');
            $payment.wrapAll('<div class="edd-checkout-step"></div>');
            $purchase.wrap('<div class="edd-checkout-step"></div>');
            $payment.find('.edd-gateway').after('<i class="pseudo-radio"></i>');
            $wrap.find('#edd-gateway-option-paypal .pseudo-radio').after('<span class="paypal-icon"></span>');

            $steps = $wrap.find('.edd-checkout-step');
            $step1 = $cart.parent();
            $step2 = $payment.parent();
            $step3 = $purchase.parent();

            $step1.prepend('<h3 class="edd-checkout-step-title">REVIEW YOUR ORDER</h3>');
            $step2.prepend('<h3 class="edd-checkout-step-title">PAYMENT METHOD</h3>');
            $step3.prepend('<h3 class="edd-checkout-step-title">BILLING DETAILS</h3>');

            steps = [ $step1, $step2, $step3 ];

            if ( !$purchase.length ) {
                steps = [ $step1, $step2 ];
                $navigation.find('.edd-checkout-navigation-list-item-link[data-step="1"]').parent().remove();
                $navigation.find('.edd-checkout-navigation-list-item-link[data-step="2"]').attr('data-step', '1');
                $step2.find('h3').text('BILLING DETAILS');
            }

            $navigation.on('click', '.edd-checkout-navigation-list-item-link', function() {
                var $this = $(this),
                    step = parseInt($this.attr('data-step'));

                if ( !$this.is('.active') ) {
                    $navigation.find('.edd-checkout-navigation-list-item-link').removeClass('active');
                    $this.addClass('active');
                    $steps.removeClass('active');
                    steps[step].addClass('active');
                    $navigationControls.find('.btn').removeClass('hidden');

                    if ( step === steps.length - 1 ) {
                        $navigationControls.find('.next').addClass('hidden');
                    }else if ( step === 0 ) {
                        $navigationControls.find('.prev').addClass('hidden');
                    }
                }
            });

            $navigationControls.on('click', '.btn', function(event) {
                event.preventDefault();

                var $activeLi = $navigation.find('.edd-checkout-navigation-list-item-link.active').parent(),
                    $nextLi = $activeLi.next(),
                    $prevLi = $activeLi.prev();

                if ( $(this).is('.next') && $nextLi.length ) {
                    $nextLi.find('.edd-checkout-navigation-list-item-link').trigger('click');
                }else if ( $(this).is('.prev') && $prevLi.length ) {
                    $prevLi.find('.edd-checkout-navigation-list-item-link').trigger('click');
                }
            });
        }
    },

    initEddProductPage: function () {
        if ( $('.edd-product-main-pics').length && $('.edd-product-thumbs').length && typeof $.fn.bxSlider == 'function' ) {
            $('.edd-product-main-pics').wrap('<div class="edd-slider-wrapper">');
            $('.edd-product-thumbs').wrap('<div class="edd-pager-wrapper">');

            var mainSlider, thumbSlider;

            if ( $('.edd-product-main-pics li').length && $('.edd-product-thumbs').length ) {
                mainSlider = $('.edd-product-main-pics').bxSlider({
                    prevText: '',
                    nextText: '',
                    pager: false,
                    adaptiveHeight: true
                });

                thumbSlider = $('.edd-product-thumbs').bxSlider({
                    prevText: '',
                    nextText: '',
                    pager: false,
                    maxSlides: 5,
                    slideWidth: 125,
                    slideMargin: 9,
                    moveSlides: 4
                });

                $('.edd-product-pic-slider .bx-controls-direction a').addClass('base_clr_bg');

                $('.edd-product-thumbs').on('click', '.product-pic', function () {
                    var $this = $(this),
                        imgId = $this.attr('data-img-id'),
                        $currentSlide = $('.edd-product-main-pics').find('[data-img-id=' + imgId + ']');

                    mainSlider.goToSlide($currentSlide.index() - 1);
                });
            } else {
                $('.edd-product-pic-slider').remove();
            }
        }

        if ( $('#sidebar .edd-add-to-cart').length ) {
            $('.edd-add-to-cart').removeClass('btn-sm').addClass('btn-lg');
        }

        if ( $('#sidebar .edd_go_to_checkout').length ) {
            $('.edd_go_to_checkout ').removeClass('btn-sm').addClass('btn-lg');
        }

        if ( $('#sidebar .edd_download_purchase_form .edd_price_options').length ) {
            $('.product-price').addClass('price-options');
        }
    },

    //progress bars
    progressBar: function () {
        if ( typeof $.fn.waypoint != 'undefined' ) {
            $('.vsc_progress_bar').each(function (index) {
                $(this).waypoint(function () {
                    var $this = $(this),
                        $bar = $this.find('.vsc_bar'),
                        val = $bar.data('percentage-value');

                    setTimeout(function () {
                        $bar.css({"width": val + '%'});
                    }, index * 10 );
                }, { offset:'95%' });
            });
        }else {
            $('.vsc_progress_bar').each(function () {
                var $bar = $(this).find('.vsc_bar')
                $bar.css('width', $bar.data('percentage-value') + '%');
            });
        }
    },

    //sticky menu initialization
    stickyMenuInit: function () {
        var _this = this,
            menuTrigger = false;
            menuTriggerOld = false;

        $(window).on('scroll', function () {
            var scrollTop = $(this).scrollTop();

            if ( scrollTop >= _this.stickyMenuOffset ) {
                menuTrigger = true;
            }else {
                menuTrigger = false;
            }

            if ( menuTrigger != menuTriggerOld ) {
                if ( menuTrigger ) {
                    _this.stickMenu();
                }else {
                    _this.unstickMenu();
                }

                menuTriggerOld = menuTrigger;
            }
        });
    },

    stickMenu: function () {
        $('.navigation-header').addClass('no-transition');
        $('.navigation-header').css('top', -($('.navigation-header').height() + 10));
        $('.navigation-header').addClass('fixmenu-clone');

        setTimeout(function () {
            $('.navigation-header').css('top', 0);
            $('.navigation-header').removeClass('no-transition');
        }, 30);

        if ( $('.navbar-collapse').not('.collapsed').length ) {
            $('.navbar-collapse').not('.collapsed').closest('.navigation-header').find('.navigation-toggle').trigger('click');
        }
    },

    unstickMenu: function () {
        $('.navigation-header').addClass('no-transition');
        $('.navigation-header').removeClass('fixmenu-clone');
        $('.navigation-header').css('top', '');

        setTimeout(function () {
            $('.navigation-header').removeClass('no-transition');
        }, 30);

        if ( $('.navbar-collapse').not('.collapsed').length ) {
            setTimeout(function() {
                $('.navbar-collapse').not('.collapsed').closest('.navigation-header').find('.navigation-toggle').trigger('click');
            }, 100);
        }
    },

    //testimonials slider init
    testimonialsSliderInit: function () {
        $('.testimonials-slider').flexslider(this.flexsliderOptions);
    },

    //prettyphoto lightbox init
    prettyPhotoInit: function () {
        $('.portfolio[data-pretty^=\'prettyPhoto[port_gal]\']').prettyPhoto();
    },

    //one page menu navigation
    onePageNavInit: function () {
        if ( typeof $.fn.waypoint != 'undefined' ) {
            var $menuLinks = $('header .navigation-bar a[href*="#"]').not('[href="#"]');

            $menuLinks.each(function (index) {
                var href = $(this).attr('href'),
                    anchorId = href.substring(href.indexOf('#'), href.length),
                    $block = $(anchorId);

                if ( $block.length ) {
                    $block.waypoint(function () {
                        var id = $(this).attr('id'),
                            $item = $('.navigation-bar a[href="#' + id + '"]');
                        $('.navigation-bar a[href*="#"]').not('[href="#"]').closest('.menu-item').removeClass('current');
                        $item.closest('.menu-item').addClass('current');

                        /* push anchor to browser URL
                        if ( history.pushState ) {
                            history.pushState(null, null, '#' + id);
                        }
                        */

                    }, { offset:'25%' });
                }
            });
            $('body').waypoint(function () {
                var id = 'home', $item = $('.navigation-bar a[href="#' + id + '"]');
                $('.navigation-bar a[href*="#"]').not('[href="#"]').closest('.menu-item').removeClass('current');
                if ( $item.length ) {
                    $item.closest('.menu-item').addClass('current');

                    /* push anchor to browser URL
                    if ( history.pushState ) {
                        history.pushState(null, null, '#' + id);
                    }
                    */
                }
            });
        }
    },

    //onload handler
    windowLoadHeandler: function (event) {
        var _this = this;

        if ( $('.navigation-bar a[href*="#"]').not('a[href="#"]').length ) {
            if ( window.location.hash.length && $('.navigation-bar a[href="' + window.location.hash + '"]').length ) {
                $('.navigation-bar a[href="' + window.location.hash + '"]').first().trigger('click');
            }

            _this.onePageNavInit();
        }

        if ( $('.testimonials-slider').length ) {
            _this.testimonialsSliderInit();
        }

        if ( $('#portfolio-wrapper').length ) {
            _this.prettyPhotoInit();
        }

        if ( _this.smoothScroll ) {
            _this.smoothScrollInit();
        }

        if ( $('.nav-tabs').length ) {
            $('.nav-tabs li:first-child a').trigger('click');
        }
    },

    //on resize handler
    windowResizeHandler: function (event) {
        var _this = this;

        _this.mobileMenuStatus();

        if ( $('.window_height').length || $('.full_height').length ) {
            _this.fullColumnHeight();
        }

        if ( $('.navbar-collapse').not('.collapsed').length ) {
            $('.navbar-collapse').not('.collapsed').closest('.navigation-header').find('.navigation-toggle').trigger('click');
        }
    },

    //on scroll handler
    windowScrollHandler: function (event) {
        var _this = this;

        if ( _this.mobileMenuView && $('.navbar-collapse').not('.collapsed').length ) {
            $('.navbar-collapse').not('.collapsed').closest('.navigation-header').find('.navigation-toggle').trigger('click');
        }

        if ($(window).scrollTop() > 500) {
            $('.back-to-top').fadeIn();
        }else {
            $('.back-to-top').fadeOut();
        }
    },

    //on navigation click handler
    navigationToggleHandler: function ($el) {
        var _this = this;

        if ( _this.mobileMenuView ) {
            var $btn = $el,
                $menu = $btn.closest('.navigation-header').find('.navbar-collapse');

            if ( $menu.hasClass('collapsing') ) {
                return false;

            }else {

                if ( $menu.hasClass('collapsed') ) {
                    $menu.addClass('collapsing');
                    $menu.removeClass('collapsed');
                    $btn.closest('.navigation-header').addClass(' collapsed');
                    $('#main-content').addClass('collapsed');

                } else {
                    $('.dropdown').removeClass('opened');
                    $('.dropdown-menu').css('display', '');
                    $menu.addClass('collapsing');
                    $menu.addClass('collapsed');
                    $btn.closest('.navigation-header').removeClass('collapsed');
                    $('#main-content').removeClass('collapsed');
                }

                setTimeout(function() { $menu.removeClass('collapsing'); }, 400)
            }
        }
    },

    //mobile menu scrolling fix
    bodyMouseMoveHandler: function (event) {
        var _this = this;

        if ( !_this.mobileMenuView ) {
            var elements = $(event.target).parents('.dropdown.opened').find('> .dropdown-menu').get();

            if ( $(event.target).hasClass('dropdown opened') ) {
                elements.push($(event.target).find('> .dropdown-menu').get(0));
            }

            $('body').find('.dropdown.opened > .dropdown-menu').not(elements).stop(true, true).slideUp(250);
            $('body').find('.dropdown-menu .dropdown.opened > .dropdown-menu').not(elements).stop(true, true).delay(100).fadeOut(200);
            $('body').find('.dropdown.opened > .dropdown-menu').not(elements).closest('.dropdown').removeClass('opened');
        }
    },

    //dropdown menu aninmations nad open/close
    dropdownMouseOverHandler: function ($el) {
        var _this = this;

        if ( !_this.mobileMenuView ) {
            $el.addClass('opened');
            if ( $el.closest('.dropdown-menu').length ) {
                $el.find('.dropdown-menu').first().stop(true, true).delay(100).fadeIn(250);
            }else {
                $el.find('.dropdown-menu').first().stop(true, true).delay(100).slideDown(250);
            }
        }
    },

    //dropdown click handler
    dropdownClickHandler: function ($el) {
        var _this = this;

        if ( _this.mobileMenuView ) {
            var $item = $el.closest('.dropdown')

            if ( $item.is('.opened') ) {
                $item.removeClass('opened');
                $item.find('.dropdown-menu').first().stop(true, true).slideUp(300);
            } else {
                $item.addClass('opened').siblings('.dropdown').removeClass('opened');
                $item.find('.dropdown-menu').first().stop(true, true).slideDown(300);
                $item.siblings('.dropdown').find('.dropdown-menu').stop(true, true).slideUp(300);
            }
        }
    },

    //small back-to-top link function
    backToTopHandler: function () {
        var _this = this;

        $('html, body').animate({
            scrollTop: 0,
            easing: 'swing'
        }, 750);
    },

    //custom smooth scrolling for all onpage anchors
    anchorClickHandler: function(anchorId) {
        var _this = this,
            offsetTop = $(anchorId).offset().top - $('.navigation-header').height(),
            $nav = $('.navigation-bar'),
            $elems = $nav.find('a[href="' + anchorId + '"]');

        $('body, html').animate({
            scrollTop: offsetTop
        }, 750, function () {
            if ( history.pushState ) {
                history.pushState(null, null, anchorId);
            }else {
                window.location.hash = anchorId;
            }

            $('.navigation-bar a[href*="#"]').not('[href="#"]').closest('.menu-item').removeClass('current');
            $elems.closest('.menu-item').addClass('current');
        });
    },

    //material design animations framework
    waveShowAnimation: function (event, $el) {
        var diag = Math.sqrt($el.outerWidth()*$el.outerWidth() + $el.outerHeight()*$el.outerHeight()),
            radiusIndex = Math.floor(diag/Math.sqrt(20)),
            color = $el.attr('data-color');

        $el.prepend('<div class="inside-wave base_clr_bg" style="top:' + event.offsetY + 'px; left:' + event.offsetX + 'px;"></div>');

        setTimeout( function() {
            if ( color !== '' ) {
                $el.find('.inside-wave').css('background', color);
            }

            $el.find('.inside-wave').css({
                'opacity': '1',
                '-webkit-transform': 'scale(' + radiusIndex + ')',
                '-moz-transform': 'scale(' + radiusIndex + ')',
                '-ms-transform': 'scale(' + radiusIndex + ')',
                '-o-transform': 'scale(' + radiusIndex + ')',
                'transform': 'scale(' + radiusIndex + ')'
            });
        }, 10);
    },

    //material design wave callback animation
    waveHideAnimation: function (event, $el) {
        var $waves = $el.find('.inside-wave');

        $waves.css('opacity', 0);

        setTimeout(function(){
            $waves.remove();
        }, 400);
    },

    setEventHandlers: function () {
        var _this = this;

        $(window).on('load', function (event) {
            _this.windowLoadHeandler(event);
        });

        $(window).on('resize', function (event) {
            _this.windowResizeHandler(event);
        });

        $(window).on('scroll', function (event) {
            _this.windowScrollHandler(event);
        });

        $('.navigation-toggle').on('click', function () {
            _this.navigationToggleHandler($(this));
        });

        $('.navbar-collapse').bind( 'mousewheel DOMMouseScroll', function (event) {
            if ( _this.mobileMenuView ) {
                var e0 = event.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;

                this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                event.preventDefault();
            }
        });

        $('body').on('mousemove', function(event) {
            _this.bodyMouseMoveHandler(event);
        });

        $('.dropdown').on('mouseover', function() {
            _this.dropdownMouseOverHandler($(this));
        });

        $('.dropdown > a').on('click', function(event) {
            event.preventDefault();

            _this.dropdownClickHandler($(this));
        });

        $('.back-to-top').on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            _this.backToTopHandler();
        });

        $('body').on( 'click', 'a[href*="#"]', function (event) {
            var href = $(this).attr('href'),
                anchorId = href.substring(href.indexOf('#'), href.length);

				if ( $(this).attr('data-toggle') == 'tab' || typeof $(this).attr('data-vc-accordion') !== 'undefined' || typeof $(this).attr('data-vc-tabs') !== 'undefined' ) return;


            if ( $(anchorId).length ) {
                _this.anchorClickHandler(anchorId);
                return false;
            }
        });

        $('body').on('mouseover', '.wave-mouseover', function (event) {
            _this.waveShowAnimation(event, $(this));
        });

        $('body').on('mouseout', '.wave-mouseover', function (event) {
            _this.waveHideAnimation(event, $(this));
        });

        $('body').on('mousedown', '.wave-click', function (event) {
            _this.waveShowAnimation(event, $(this));
        });

        $('body').on('mouseup mouseover', '.wave-click', function (event) {
            _this.waveHideAnimation(event, $(this));
        });

        _this.eddFix();
    },

    //show & hide login/forgot password form
    login_ShowHide: function () {
        var _this = this;

        $(window).on('load', function () {
            $('.forgot-link a').click(function() {

                $('#login-form').toggleClass('show hide');
                $('#forgot-form').toggleClass('show hide');

                return false;
            });
        });
    },

    //show page preloading
    showScreen: function () {
        var _this = this;

        $(window).on('load', function () {
            if ( $('.vsc_progress_bar').length ) {
                _this.progressBar();
            }
        });
    },

    hidePreloader: function () {
        var _this = this;

        $('#mask').delay(500).fadeOut(600);
		
        _this.showScreen();
    },

    eddFix: function () {
        if ( $('.edd-downloads-container').length ) {
            $("body").off(".eddAddToCart",".edd-add-to-cart");
            $("body").on("click.eddAddToCart",".edd-add-to-cart",function(a){a.preventDefault();var b=$(this),c=b.closest("form"),d=b.find(".edd-loading"),e=b.find(".edd-add-to-cart-label"),f=b.closest("div");d.width(),d.height(),b.attr("data-edd-loading",""),d.show(),e.hide();var c=b.parents("form").last(),i=b.data("download-id"),j=b.data("variable-price"),k=b.data("price-mode"),l=[],m=!0;if("yes"==j)if(c.find(".edd_price_option_"+i).is("input:hidden"))l[0]=$(".edd_price_option_"+i,c).val();else{if(!c.find(".edd_price_option_"+i+":checked",c).length)return b.removeAttr("data-edd-loading"),alert(edd_scripts.select_option),void 0;c.find(".edd_price_option_"+i+":checked",c).each(function(a){if(l[a]=$(this).val(),!0===m){var b=$(this).data("price");b&&b>0&&(m=!1)}})}else l[0]=i,b.data("price")&&b.data("price")>0&&(m=!1);if(m&&c.find(".edd_action_input").val("add_to_cart"),"straight_to_gateway"==c.find(".edd_action_input").val())return c.submit(),!0;var n=b.data("action"),o={action:n,download_id:i,price_ids:l,post_data:$(c).serialize()};return $.ajax({type:"POST",data:o,dataType:"json",url:edd_scripts.ajaxurl,xhrFields:{withCredentials:!0},success:function(a){if("1"==edd_scripts.redirect_to_checkout)window.location=edd_scripts.checkout_page;else{if($(".cart_item.empty").length?($(a.cart_item).insertBefore(".cart_item.edd_subtotal"),$(".cart_item.edd_checkout,.cart_item.edd_subtotal").show(),$(".cart_item.empty").remove()):$(a.cart_item).insertBefore(".cart_item.edd_subtotal"),$(".cart_item.edd_subtotal span").html(a.subtotal),$(".edd-cart-item-title",a.cart_item).length,$("span.edd-cart-quantity").each(function(){$(this).text(a.cart_quantity),$("body").trigger("edd_quantity_updated",[a.cart_quantity])}),"none"==$(".edd-cart-number-of-items").css("display")&&$(".edd-cart-number-of-items").show("slow"),("no"==j||"multi"!=k)&&($("a.edd-add-to-cart",f).toggle(),$(".edd_go_to_checkout",f).css("display","inline-block")),"multi"==k&&b.removeAttr("data-edd-loading"),$(".edd_download_purchase_form").length&&("no"==j||!c.find(".edd_price_option_"+i).is("input:hidden"))){var e=$('.edd_download_purchase_form *[data-download-id="'+i+'"]').parents("form");$("a.edd-add-to-cart",e).hide(),"multi"!=k&&e.find(".edd_download_quantity_wrapper").slideUp(),$(".edd_go_to_checkout",e).show().removeAttr("data-edd-loading")}"incart"!=a&&($(".edd-cart-added-alert",f).fadeIn(),setTimeout(function(){$(".edd-cart-added-alert",f).fadeOut()},3e3)),$("body").trigger("edd_cart_item_added",[a])}}}).fail(function(a){window.console&&window.console.log&&console.log(a)}).done(function(){}),!1});
        }
    },

    pageHeight: function () {
        var headerHeight = 0,
            footerHeight = 0;

        if ( $('header').length ) headerHeight = $('header').first().outerHeight();
        if ( $('footer').length ) footerHeight = $('footer').first().outerHeight();

        $('#main-content').css('min-height', window.innerHeight - headerHeight - footerHeight);
    },

    // init animations on page
    initAnimations: function () {
        var _this = this;

        if ( this.mobileDevice || !this.options.animations ) {
            $('.animated').css('opacity', 1);

        }else if ( typeof $.fn.appear == 'function' ) {
            // this.log( 'Init animations' );

            $('.animated').appear(function() {
                var $el = $(this),
                    animation = $el.data('animation'),
                    animationDelay = $el.data('delay') || 0,
                    animationDuration = $el.data('duration') || 1000;

                if ( _this.options.animations ) {
                    $el.css({
                        '-webkit-animation-delay': animationDelay + 'ms',
                        'animation-delay': animationDelay + 'ms',
                        '-webkit-animation-duration': animationDuration/1000 + 's',
                        'animation-duration': animationDuration/1000 + 's'
                    });

                    $el.addClass(animation);

                }else {
                    $el.removeClass('animated');
                }
            }, {accY: -150});

        }else {
            $('.animated').css('opacity', 1);

            // this.log( 'Can\'t find jQuery.appear function' );
            // this.log( 'Remove animations' );
        }
    },

    init: function () {
        var _this = this;

        _this.pageHeight();

        _this.checkMobile();

        _this.getThemeOptions();

        _this.setPageOptions();

        _this.mobileMenuStatus();

        if ( $('div[class*="ytp-player"]').length && !_this.mobileMenuView ) {
            $('div[class*="ytp-player"]').css('background-image', '');
        }

        if ( _this.stickyMenu == 'home' && _this.homePage || _this.stickyMenu == 'all_pages' ) {
            _this.stickyMenuInit();
        }

        if ( $('.window_height').length || $('.full_height').length ) {
            _this.fullColumnHeight();
        }

        _this.initVideoBackground();

        _this.initEddCheckout();

        _this.initEddProductPage();

        _this.setEventHandlers();

        _this.hidePreloader();

        _this.login_ShowHide();
    }
}

;(function($){

    $(document).on('ready', function () {
        Startuply.init();
    });

})( jQuery );
