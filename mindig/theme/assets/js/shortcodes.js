jQuery(document).ready( function($){
    "use strict";

    var $body = $('body'),
        content_width   = $('.content').width(),
        container_width = $('.container').width();


    /*************************
     * FEATURES TAB
     *************************/

    $.fn.yiw_features_tab = function( options ) {
        var config = {
            'tabNav' : 'ul.features-tab-labels',
            'tabDivs': 'div.features-tab-wrapper'
        };

        if( options ) $.extend( config, options );

        this.each( function () {
            var tabNav  = $( config.tabNav, this );
            var tabDivs = $( config.tabDivs, this );
            var labelNumber = tabNav.children( 'li' ).length;

            tabDivs.children( 'div' ).hide();

            var currentDiv = tabDivs.children( 'div' ).eq( tabNav.children( 'li.current-feature' ).index() );
            currentDiv.show();

            $( 'li', tabNav ).hover( function() {
                if( !$( this ).hasClass( 'current-feature' ) ) {
                    var currentDiv = tabDivs.children( 'div' ).eq( $( this ).index() );
                    tabNav.children( 'li' ).removeClass( 'current-feature' );

                    $( this ).addClass( 'current-feature' );

                    tabDivs.children( 'div' ).hide().removeClass( 'current-feature' );   console.log('hover');
                    currentDiv.fadeIn( 'slow', function() {
                        $(document).trigger('feature_tab_opened');
                    });
                }
            });

        });
    };

    $( '.features-tab-container' ).yiw_features_tab();

    /*************************
     * TABS
     *************************/

    $.fn.yiw_tabs = function(options) {
        // valori di default
        var config = {
            'tabNav': 'ul.tabs',
            'tabDivs': '.containers',
            'currentClass': 'current'
        };

        if (options) $.extend(config, options);

        this.each(function() {
            var tabNav = $(config.tabNav, this);
            var tabDivs = $(config.tabDivs, this);
            var activeTab;
            var maxHeight = 0;

            tabDivs.children('div').hide();

            if ( $('li.'+config.currentClass+' a', tabNav).length > 0 )
                activeTab = '#' + $('li.'+config.currentClass+' a', tabNav).data('tab');
            else
                activeTab = '#' + $('li:first-child a', tabNav).data('tab');

            $(activeTab).show().addClass('showing').trigger('yit_tabopened' , [ $(activeTab) ]);

            $('li:first-child a', tabNav).parents('li').addClass(config.currentClass);

            $('a', tabNav).click(function(){
                if ( ! $(this).parents('li').hasClass('current') ) {

                    var id = '#' + $(this).data('tab');
                    var thisLink = $(this);

                    $('li.'+config.currentClass, tabNav).removeClass(config.currentClass);
                    $(this).parents('li').addClass(config.currentClass);

                    $('.showing', tabDivs).fadeOut(200, function(){
                        $(this).removeClass('showing').trigger('yit_tabclosed');
                        $(id).fadeIn(200).addClass('showing').trigger('yit_tabopened' , [ $(id) ]);
                    });
                }

                return false;
            });


        });
    };

    $('.tabs-container').yiw_tabs({
        tabNav  : 'ul.tabs',
        tabDivs : '.border-box'
    });

    /*************************
     * IMAGE STYLED
     *************************/

    $(window).on('load', function () {
        if ($.fn.prettyPhoto) {
            $(".image-styled .img_frame a[rel^='prettyPhoto']").prettyPhoto({
                social_tools: ''
            });


        }
    });



    /*************************
     * PORTFOLIO SECTION
     *************************/

    if ( $.fn.owlCarousel && $.fn.imagesLoaded ) {
        $('.portfolio-slider').each(function(){
            var t = $(this),
                slides = t.find('.portfolios'),
                owl = null;

            t.imagesLoaded(function(){
                owl = slides.owlCarousel({
                    items : 5,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [991, 3],
                    itemsTablet: [767, 2],
                    itemsMobile: [481, 1],
                    addClassActive: true,
                    rtl: yit.isRtl == true
                });
            });

            t.on( 'click', '.prev-portfolio', function(e){
                e.preventDefault();
                owl.trigger('owl.prev');
            });

            t.on( 'click', '.next-portfolio', function(e){
                e.preventDefault();
                owl.trigger('owl.next');
            });


            _onresize( function(){
                var active_items  = t.find('.owl-item.active').length,
                    slides_number = t.find('.owl-item').length;

                if( slides_number == active_items ) {
                    t.find('.prev-portfolio, .next-portfolio').hide();
                }else{
                    t.find('.prev-portfolio, .next-portfolio').show();
                }
            } );
        });
    }

    /*************************
     * FIX WIDTH (sections, google maps, ecc...)
     *************************/

    var fixWidth = function(){
        var wrapperWidth = ( $body.hasClass('boxed-layout') ) ? $('#wrapper').outerWidth() : $(window).width();

        $('.portfolio-slider, .section-background, .google-map-frame.full-width .inner').css({
            width:  wrapperWidth
        });
    };

    _onresize( fixWidth );
    fixWidth();

    /*************************
     * SWIPER SLIDER PRODUCTS
     *************************/

    $('.swiper-products').each( function(){
        var slider = $(this),
            container = $(this).closest('.swiper_container'),
            slideOpacity = slider.find('.swiper-slide-image .opacity'),
            window_width = $(window).width(),

            items = slider.data('items'),
            overflow = slider.data('overflow'),
            autoplay = slider.data('autoplay'),

            swiper = container.swiper({
                //Your options here:

                mode:'horizontal',
                autoplay: autoplay,
                loop: true,
                loopAdditionalSlides: 2,
                slidesPerView : items,
                calculateHeight : true,
                grabCursor: true,
                autoResize: true //Sinc to Browser Resize/Resolution -> Important for Responsive
            });

        //Check Browser Resolution for All Browser
        if ( window_width > 767 ) {
            slider.parent().css('overflow', overflow);
        }

        if ( window_width > 480 &&  window_width < 768 && items != 2 ) {
            swiper.params.slidesPerView = 2;
            swiper.reInit();
        } else if( window_width <= 480 && items != 1 ) {
            swiper.params.slidesPerView = 1;
            swiper.reInit();
        }

        //Add background opacity -> IE8 Fix
        $('<div class="opacity left" />').appendTo( container ).css('opacity', 0.7);
        $('<div class="opacity right" />').appendTo( container ).css('opacity', 0.7);

        //Change slider options on Browser Resize
        _onresize( function(){
            if ( window_width > 767 ) {
                swiper.params.slidesPerView = items;
                container.css('overflow', overflow);
            }
            else if(  window_width > 480 && window_width < 768 ) {
                if( items != 2 ) {
                    swiper.params.slidesPerView = 2;
                }
                container.css('overflow', 'hidden');
            }
            else {
                if( items != 1 ){
                    swiper.params.slidesPerView = 1;
                }
                container.css('overflow', 'hidden');
            }
        } );
    });

    /*************************
     * SECTION BACKGROUND
     *************************/

    $('.section-background').each( function(){
        var section = $(this),
            section_background_fix_height = function(){
                var current_height = section.data('height');
                if ( current_height == 0 ){
                    var row = section.parents('.wpb_row'),
                        parent_height = row.next().height();

                    row.next().css('margin-bottom','25px');
                    section.css('height', parent_height+60);
                }
            };

        $( window ).on( 'load', section_background_fix_height );
        _onresize( section_background_fix_height );
    });

    /*************************
     * FAQ
     *************************/

    $('#faqs-container').yit_faq();

});