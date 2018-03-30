(function ($) {
    "use strict";

    var fn = {

        // Launch Functions
        Launch: function () {
            fn.StartMenu();
            fn.MenuSticky();
            fn.Carousel();
            fn.Apps();
            fn.SubMenuArrow();
        },

        // Menu DropDown
        StartMenu: function () {

            // main menu      
            jQuery('.main-menu li > ul').animate({'opacity': 0});

            jQuery('.main-menu li').hover(function () {
                var currentItem = jQuery(this).find('ul:first');
                currentItem.stop().css({display:'block'}).animate({'opacity': 1}, 150);
                var currentItemMega = jQuery(this).find('.td-mega-menu');
                currentItemMega.stop().css({display:'block'}).animate({'opacity': 1}, 150);
            },function() {
                var currentItem = jQuery(this).find('ul:first');
                currentItem.stop().animate({'opacity': 0}, 150, function() {
                    currentItem.css({display:'none'});
                });
                var currentItemMega = jQuery(this).find('.td-mega-menu');
                currentItemMega.stop().animate({'opacity': 0}, 150, function() {
                    currentItemMega.css({display:'none'});
                });
            });

            // top menu      
            jQuery('.top-menu li > ul').animate({'opacity': 0});

            jQuery('.top-menu li').hover(function () {
                var currentItem = jQuery(this).find('ul:first');
                currentItem.stop().css({display:'block'}).animate({'opacity': 1}, 150);
            },function() {
                var currentItem = jQuery(this).find('ul:first');
                currentItem.stop().animate({'opacity': 0}, 150, function() {
                    currentItem.css({display:'none'});
                });
            });

        },




        // Sticky Menu
        MenuSticky: function () {
            var menu = document.querySelector('#header'),
                origOffsetY = menu.offsetTop + 104;
            function scroll() {
                if ($(window).scrollTop() >= origOffsetY) {
                    $('#header').addClass('sticky-menu');
                    $('.wrapper').css("margin-top", "104px");
                } else {
                    $('#header').removeClass('sticky-menu');
                    $('.wrapper').css("margin-top", "0");
                }
            }
            document.onscroll = scroll;
        },



        // Owl Carousel
        Carousel: function () {

            jQuery.fn.exists = function(){return this.length>0;}

            if( jQuery("#carousel").exists() ) {

                var owl = $("#carousel");
                owl.owlCarousel({
                    itemsCustom : [
                        [1200, 4],
                        [970, 3],
                        [768, 2],
                        [360, 1]
                    ],
                    navigation : false
                });

                $(".next").click(function () {
                    owl.trigger('owl.next');
                });

                $(".prev").click(function () {
                    owl.trigger('owl.prev');
                });

            }

        },


        // Apps
        Apps: function () {

            // Responsive Video's
            $(".property").fitVids();
            $(".video-post").fitVids();
            $(".video-content").fitVids();

        },

        // SubMenuArrow
        SubMenuArrow: function () {

            jQuery('li.has-submenu > a').each(function(i, ojb) {
                jQuery(this).addClass('main-has-submenu');
            });

            jQuery('ul.sub-menu li.has-submenu > a').each(function(i, ojb) {
                if ( jQuery(this).hasClass('main-has-submenu') ) {
                    jQuery(this).removeClass('main-has-submenu').addClass('child-has-submenu');
                } else {
                    jQuery(this).addClass('child-has-submenu');
                }
            });



            jQuery('li.page_item_has_children > a').each(function(i, ojb) {
                jQuery(this).addClass('main-has-submenu');
            });

            jQuery('ul.children li.page_item_has_children > a').each(function(i, ojb) {
                if ( jQuery(this).hasClass('main-has-submenu') ) {
                    jQuery(this).removeClass('main-has-submenu').addClass('child-has-submenu');
                } else {
                    jQuery(this).addClass('child-has-submenu');
                }
            });

        }    

    };

    $(document).ready(function () {

        fn.Launch();

        // Go Top
        jQuery('.back-to-top').click(function () {
            jQuery('html, body').scrollTo(jQuery('#scroll-top-anchor'), 300);
        });

        jQuery("#page-title.event-page-title").each(function() {

            if(jQuery(window).height() > 460) {

                jQuery("#page-title.event-page-title .container .row .col-sm-4 .event-header-container").css("height", jQuery(window).height() - jQuery("#header").height());

            } else {

                jQuery("#page-title.event-page-title .container .row .col-sm-4 .event-header-container").css("height", 500);

            }

        });

        var isMobile = {
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
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        if( isMobile.any() ) {

        } else {
            var s = skrollr.init({
                smoothScroll: true,
                forceHeight: false
            });
        }

        jQuery('.sidebar-button').click(function(e) {
            if ( jQuery("body").hasClass('right_side_menu_opened') ) {
                jQuery("body").removeClass('right_side_menu_opened');
                jQuery(".side_menu").css("visibility", "hidden");
            } else {
                jQuery("body").addClass('right_side_menu_opened');
                jQuery(".side_menu").css("visibility", "visible");
            }
        });

        jQuery('.close_side_menu').click(function(e) {
            jQuery("body").removeClass('right_side_menu_opened');
            jQuery(".side_menu").css("visibility", "hidden");
        });

        var timer;     
        jQuery(window).scroll(function(e){
            if(jQuery("body").hasClass("right_side_menu_opened")){
                clearTimeout(timer);
                timer = setTimeout(checkStop,50);
            };
        });

        function checkStop(){
            jQuery("body").removeClass("right_side_menu_opened");
            jQuery(".side_menu_button_wrapper a.side_menu_button_link").removeClass("opened");
        }

        jQuery.fn.exists = function(){return this.length>0;}

        if( jQuery("#owl-demo").exists() ) {

            var owl = jQuery("#owl-demo");
     
            owl.owlCarousel({
                navigation : true,
                singleItem : true,
                transitionStyle : "goDown",
                navigationText: [
                    "<i class='fa fa-angle-left arrow-round'></i>",
                    "<i class='fa fa-angle-right arrow-round'></i>"
                ]
            });

        }

        // Expand/Colapse content
        jQuery('#upload-form-holder-main-settings .td-buttom').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this);
            var $collapse = $this.closest('.collapse-group').find('.collapse');
            $collapse.collapse('toggle');
        });

        jQuery('#upload-form-holder .td-buttom').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this);
            var $collapse = $this.closest('.collapse-group').find('.collapse');
            $collapse.collapse('toggle');
        });

        jQuery('.transaction-block-header .td-buttom').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this);
            var $collapse = $this.closest('.collapse-group').find('.collapse');
            $collapse.collapse('toggle');
        });

        // Tooltip
        jQuery('[data-rel]').each(function() {
          jQuery(this).attr('rel', jQuery(this).data('rel'));
        });
        
        var targets = jQuery( '[rel~=tooltip]' ),
            target  = false,
            tooltip = false,
            tip     = false,
            title   = false;
     
        targets.bind( 'mouseenter', function()
        {
            target  = jQuery( this );
            tip     = target.attr( 'title' );
            tooltip = jQuery( '<div id="tooltip"></div>' );
     
            if( !tip || tip == '' )
                return false;
     
            target.removeAttr( 'title' );
            tooltip.css( 'opacity', 0 )
                   .html( tip )
                   .appendTo( 'body' );
     
            var init_tooltip = function()
            {
                if( jQuery( window ).width() < tooltip.outerWidth() * 1.5 )
                    tooltip.css( 'max-width', jQuery( window ).width() / 2 );
                else
                    tooltip.css( 'max-width', 340 );
     
                var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                    pos_top  = target.offset().top - tooltip.outerHeight() - 20;
     
                if( pos_left < 0 )
                {
                    pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                    tooltip.addClass( 'left' );
                }
                else
                    tooltip.removeClass( 'left' );
     
                if( pos_left + tooltip.outerWidth() > jQuery( window ).width() )
                {
                    pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                    tooltip.addClass( 'right' );
                }
                else
                    tooltip.removeClass( 'right' );
     
                if( pos_top < 0 )
                {
                    var pos_top  = target.offset().top + target.outerHeight();
                    tooltip.addClass( 'top' );
                }
                else
                    tooltip.removeClass( 'top' );
     
                tooltip.css( { left: pos_left, top: pos_top } )
                       .animate( { top: '+=10', opacity: 1 }, 50 );
            };
     
            init_tooltip();
            jQuery( window ).resize( init_tooltip );
     
            var remove_tooltip = function()
            {
                tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
                {
                    jQuery( this ).remove();
                });
     
                target.attr( 'title', tip );
            };
     
            target.bind( 'mouseleave', remove_tooltip );
            tooltip.bind( 'click', remove_tooltip );
        });


        jQuery('a[rel="external"]').attr('target', '_blank');


        jQuery.fn.exists = function(){return this.length>0;}

        if( jQuery(".player").exists() ) {

            jQuery(".player").mb_YTPlayer();

        }

        jQuery("area[rel^='prettyPhoto']").prettyPhoto();

        jQuery("a[rel^='prettyPhoto']").prettyPhoto();
            
        jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
        jQuery(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

        jQuery('#tag-index-page').isotope({
            itemSelector: '.tag-group',
            layoutMode: 'masonry'
        });

        jQuery('#events-cat-block').isotope({
            itemSelector: '.cat-block-isotope',
            layoutMode: 'masonry'
        });

        jQuery('#listings-cat-block').isotope({
            itemSelector: '.cat-block-isotope',
            layoutMode: 'masonry'
        });

    });

    jQuery(window).bind('resize', function () {

        jQuery("#page-title.event-page-title").each(function() {

            if(jQuery(window).height() > 460) {

                jQuery("#page-title.event-page-title .container .row .col-sm-4 .event-header-container").css("height", jQuery(window).height() - jQuery("#header").height());

            } else {

                jQuery("#page-title.event-page-title .container .row .col-sm-4 .event-header-container").css("height", 500);

            }

        });

        if(jQuery(window).width() < 1189) {
            jQuery("#menu").addClass('no-transform');
        } else {
            jQuery("#menu").removeClass('no-transform');

        }

        jQuery("#resume-cover-image").each(function() {
        
            if(jQuery(window).height() > (jQuery("#resume-cover-image .bannerText").height()+200)) {
        
                jQuery(this).css("height", jQuery(window).height() - 94);
                var itemHeight = jQuery("#resume-cover-image .bannerText").height()/2;
                jQuery("#resume-cover-image .bannerText").css("top", ((jQuery(window).height() - 94)/2 - itemHeight)-0);

            } else {

                jQuery(this).css("height", jQuery("#resume-cover-image .bannerText").height() + 100);
                var itemHeight = jQuery("#resume-cover-image .bannerText").height()/2;
                jQuery("#resume-cover-image .bannerText").css("top", ((jQuery(this).height())/2 - itemHeight)-0);

            }
            
        });

        jQuery("#listings-big-slider").each(function() {

            if(jQuery(window).height() > (jQuery("#listings-big-slider .bannerText").height()+200)) {
        
                jQuery(this).css("height", jQuery(window).height() - 94);
                var itemHeight = jQuery("#listings-big-slider .bannerText").height()/2;
                jQuery("#listings-big-slider .bannerText").css("top", ((jQuery(window).height() - 94)/2 - itemHeight)-30);

            } else {

                jQuery(this).css("height", jQuery("#listings-big-slider .bannerText").height() + 100);
                var itemHeight = jQuery("#listings-big-slider .bannerText").height()/2;
                jQuery("#listings-big-slider .bannerText").css("top", ((jQuery(this).height())/2 - itemHeight)-30);

            }
            
        });

        jQuery('#tag-index-page').isotope({
            itemSelector: '.tag-group',
            layoutMode: 'masonry'
        });

    });

    jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\b8\b$/.test(value);
    }, "type the correct answer -_-");

    jQuery(window).load(function(){

        jQuery('#pageloader').fadeOut(1000);
        jQuery(".video-content").css("opacity", "1");

    });

})(jQuery);