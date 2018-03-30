jQuery(document).ready(function($){
    // **********************************************************************//
    // ! Nano scroller
    // **********************************************************************//

    (function() {
        var scrollWidget = $('.shop-filters-area .sidebar-widget');
        scrollWidget.each(function() {
            var content = $(this).find('> ul, > div, > form');
            if(content.height() > 190) {
                $(this).addClass('nano-scroll-apply');
                content.addClass('widget-content');
                $(this).nanoScroller({ 
                    contentClass: 'widget-content',
                    preventPageScrolling: true 
                });
            }
        });
    })();

    // **********************************************************************//
    // ! Update cart fragments
    // **********************************************************************//
    var et_fragment_refresh = {
        url: myAjax.ajaxurl,
        type: 'POST',
        data: { action: 'et_refreshed_fragments' },
        success: function( data ) {
            if ( data && data.fragments ) {
                $.each( data.fragments, function( key, value ) {
                    $( "." + key ).replaceWith( value );
                });
            }
        }
    };
    $.ajax( et_fragment_refresh );


    // **********************************************************************// 
    // ! Fixed product page
    // **********************************************************************//
    $(function() {
        if($(window).width() < 992) return;
     
        $('.fixed-product-block').each(function() {
            var el = $(this),
                parent = el.parent(),
                heightOffsetEl = $('.product-images'),
                parentHeight = heightOffsetEl.outerHeight();

            if( parent.outerHeight() > parentHeight) return;

            $(window).resize(function() {
                parentHeight = heightOffsetEl.outerHeight();
                el.css('max-width', parent.width());
                parent.height(parentHeight);
            });

            $(window).resize();

            $(this).stick_in_parent();

        });
    });
    // **********************************************************************// 
    // ! One page hash navigation
    // **********************************************************************//

    (function() {
        // Click on menu item with hash
        var menu = $('.menu');
        menu.each(function() {
            var that = $(this);
            var links = $(this).find('a');
            if(!that.parent().hasClass('one-page-menu')) return;
            links.click(function(e){
                if($(this).attr('href').split('#')[0] == window.location.href.split('#')[0]) {
                    e.preventDefault();
                    var hash = $(this).attr('href').split('#')[1];
                    et_change_active_item(hash);
                    et_scroll_to_id(hash);
                }
            });
        });
        
        // if loaded page with hash
        var windowHash = window.location.hash.split('#')[1];
        
        if(window.location.hash.length > 1) {
            setTimeout(function(){
                et_scroll_to_id(windowHash);
            }, 600);
        }
        
        function et_scroll_to_id(id){
            
            var offset = 85;
            if ($('.fixed-header-area').parent().hasClass('page-wrapper')) {
                offset = 135;
            }

            var position = 0;
            if($('body').hasClass('full-page-on')) { 
                offset = 0;
            }
            if(id != 'top'){
                if($('#'+id).length < 1) {
                    return;
                }
                position = $('#'+id).offset().top - offset;
            }
            

            if($(window).width() < 992 && menu.parent().hasClass('one-page-menu') ) {
                $('.menu-icon').first().click()
            }
            
            $('html, body').stop().animate({
                scrollTop: position
            }, 1000, 'easeOutCubic', function() {
                et_change_active_item(id);
            });
        }
        
        function et_change_active_item(hash) {
            var itemId;
            var menu = $('.menu');
            if(!menu.parent().hasClass('one-page-menu')) return;
            
            menu.find('.current-menu-item').removeClass('current-menu-item');
            
            if(hash == 'top') {
                menu.each(function() {
                    $(this).find('li').first().addClass('current-menu-item');
                });
                return;
            }
            
            menu.find('li').each(function() {
                if($(this).find('>a').attr('href')) {
                    var thisHash = $(this).find('>a').attr('href').split('#')[1];
                    if(thisHash == hash) {
                        itemId = $(this).attr('id');
                    }
                }
            });
            
            $('.'+itemId).addClass('current-menu-item');
        }
        
        
        $(window).scroll(function() {
            if($(window).scrollTop() < 200) {
                et_change_active_item('top');
            }
        });
        
        // change active link on scroll
        $('.content > .wpb_row').waypoint(function() {
            var id = $(this).attr('id');
            et_change_active_item(id);
        }, { offset: 150 });

    })();


    // **********************************************************************// 
    // ! Fullpage js
    // **********************************************************************//

    (function() {
        if($('body').hasClass('full-page-on') && $(window).width() > 768) {
            $.scrollify({
                section : '.wpb_row[id]',
                before:function(i) {
                    $('.sections-nav').find('.active-nav').removeClass('active-nav');
                    $('.sections-nav li').eq(i).addClass('active-nav');
                }
            });

            var sections = $('.content > .wpb_row'),
                pointsHTML = '';

            for (var i = 0; i < sections.length; i++) {
                pointsHTML += '<li>' + i + '</li>';
            };

            $('body').append('<ul class="sections-nav">' + pointsHTML + '</ul>');

            $(document).on('click', '.sections-nav li', function() {
                $('.sections-nav').find('.active-nav').removeClass('active-nav');
                $(this).addClass('active-nav');
                $.scrollify.move( $(this).index() );
            });

        }
    })();
    
    
    // **********************************************************************// 
    // ! Disable right mouse click
    // **********************************************************************//
    
    $('body.disabled-right').mousedown(function(e){ 
        if( e.button == 2 ) { 
            //$("html, body").animate({scrollTop:0}, '1000', 'swing', function() { 
                $('body').addClass('shown-credentials');
            //});
            return false; 
        } 
        return true; 
    }); 
    
    $('.credentials-html .close-credentials').click(function() {
        $('body').removeClass('shown-credentials');
    });
    
    // **********************************************************************// 
    // ! 100% height
    // **********************************************************************//
    $('.full-height').etFullHeight();
    $('.st-pusher').etFullHeight();
    
    $(window).resize(function() {
        $('.copyright-bottom').css({
            'marginTop': -$('.copyright-bottom').height(),
            'marginBottom': 0
        }).prev().css({
            'paddingBottom': $('.copyright-bottom').height()+20
        });
    });
    
    
    $('.cta-block.style-fullwidth').etFullWidth();
    
    
    // **********************************************************************// 
    // ! Tooltip plugin
    // **********************************************************************//

    $('.title-toolip').tooltipster();

    // **********************************************************************// 
    // ! Header slider overlap
    // **********************************************************************//
    
    
    $(window).resize(function() {
        var headerWrapper = $('.header-wrapper');
        if(headerWrapper.hasClass('slider-overlap')) {
            var headerHeight = headerWrapper.height();
            var revSlider = $('.page-heading-slider .wpb_revslider_element').first();
            revSlider.css({
                'marginTop' : - headerHeight
            });
        }
    });

    // **********************************************************************// 
    // ! Lists CSS classes
    // **********************************************************************//
    $('ul li:last-child').addClass('lastItem');
    $('ul li:first-child').addClass('firstItem');
    
    // **********************************************************************//
    // ! Parallax Breadcrumbs
    // **********************************************************************//
    
    $(function() {

        if($(window).width() < 1200) return;

        var previousScroll = 0,
            deltaY = 0,
            breadcrumbs = $('.bc-type-7, .bc-type-8').find('.container'),
            opacity = 1,
            finalOpacity = 0.3,
            scale = 1,
            finalScale = 0.8,
            scrollTo = 300;


        $(window).scroll(function(){
            var currentScroll = $(this).scrollTop();

            if(currentScroll > 1 && currentScroll < scrollTo) {

                opacity = 1 - ( 1 - finalOpacity ) * ( currentScroll / scrollTo );
                scale   = 1 - ( 1 - finalScale )   * ( currentScroll / scrollTo );

                opacity = opacity.toFixed(3);
                scale   = scale.toFixed(3);

                breadcrumbsAnimation(breadcrumbs);
            } else if(currentScroll < 10) {
                opacity = 1;
                scale   = 1;

                breadcrumbsAnimation(breadcrumbs);
            }
        });


        var breadcrumbsAnimation = function(el) {
            if(deltaY >= 0 || $(window).scrollTop() < 1) deltaY = 0;
            el.css({
                'transform': 'scale(' + scale + ')',
                'opacity' : opacity
            });
        };
    });
    // **********************************************************************// 
    // ! 8theme Mega Search
    // **********************************************************************//
    
    $.fn.etMegaSearch = function ( options ) {
        var et_search = $(this);
        var form = et_search.find('form');
        var input = form.find('input[type="text"]');
        var resultArea = et_search.find('.et-search-result');
        var close = et_search.find('.et-close-results');
        
        input.keyup(function() {
        
            if($(this).val() == '' || $(this).val().length < 3) {
                et_search.removeClass('loading result-exist');
                return;
            }
            
            data = 's='+$(this).val() + '&products=' + et_search.data('products') + '&count=' + et_search.data('count') + '&images=' + et_search.data('images') + '&posts=' + et_search.data('posts') + '&portfolio=' + et_search.data('portfolio') + '&pages=' + et_search.data('pages') + '&testimonial=' + et_search.data('testimonial') + '&action=et_get_search_result';
            
            et_search.addClass('loading');
            resultArea.html('');
            
            $.ajax({
                url: myAjax.ajaxurl,
                method: 'GET',
                data: data,
                dataType: 'JSON',
                error: function(data) {
                    console.log('AJAX error');
                },
                success : function(data){
                    if(data.results) {
                        et_search.addClass('result-exist');
                    } else {
                        et_search.removeClass('result-exist');
                    }
                    resultArea.html(data.html);
                },
                complete : function() {
                    et_search.removeClass('loading');
                }
            });         
        });
        
        close.click(function() {
            et_search.removeClass('result-exist');
        });

        return this;
    }
    
    $('.et-mega-search').each(function(){
        $(this).etMegaSearch();
    });
    

    // **********************************************************************// 
    // ! Media Elements with JS
    // **********************************************************************//

    /*jQuery('video:not(.et-section-video, .tp-caption video)').mediaelementplayer({
        success: function(player, node) {
            jQuery('#' + node.id + '-mode').html('mode: ' + player.pluginType);
        }
    });*/


    // **********************************************************************// 
    // ! Windows Phone Responsive Fix
    // **********************************************************************//
        (function() {
            if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement("style");
                msViewportStyle.appendChild(
                    document.createTextNode("@-ms-viewport{width:auto!important}")
                );
                document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
            }
        })();


    // **********************************************************************// 
    // ! Promo popup
    // **********************************************************************//

    var et_popup_closed = $.cookie('etheme_popup_closed');
    $('.etheme-popup').magnificPopup({
        items: {
          src: '#etheme-popup',
          type: 'inline'
        },
        closeOnBgClick: true,
        removalDelay: 300, //delay removal by X to allow out-animation
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = 'my-mfp-slide-bottom';
            },
            beforeClose: function() {
            if($('#showagain:checked').val() == 'do-not-show')
                $.cookie('etheme_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
            },
        }
      // (optionally) other options
    });
    
    if(et_popup_closed != 'do-not-show' && $('.etheme-popup').length > 0 && $('body').hasClass('open-popup')) {
        $('.etheme-popup').magnificPopup('open');
    }

    // **********************************************************************// 
    // ! Search popup
    // **********************************************************************//
    $('.popup-with-form').magnificPopup({
        type: 'inline',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        closeOnBgClick: true,
        removalDelay: 300,
        focus: '#Modalsearch',
        mainClass: 'my-mfp-slide-bottom effect-delay2',
        callbacks: {
            beforeOpen: function() {
                 this.st.focus = '#Modalsearch';
            },
            open: function() {
                $('#s').focus();
            }
        }
    });
    // focus on search input for dropdown type
    $('.search-dropdown').on('mouseover', function() {
        $(this).find('input').focus();
    }).on('touchstart click', '.popup-with-form', function() {
        $('.search-dropdown').find('input').focus();
    });
    
    
    $('.popup-btn').magnificPopup({
        type:'inline',
        midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });

    // **********************************************************************// 
    // ! WordPress gallery
    // **********************************************************************//
    
    $('.et-gallery').each(function() {
        var gal = $(this);
        var time = 300;
        var preview = gal.find('.gallery-preview');
        gal.find('a').mouseover(function(){
            var newSrc = $(this).attr('href');
            var index = $(this).parent().attr('data-index');
            preview.attr('data-index',index);
            preview.stop().animate({
                'opacity' : 0
            }, time, function() {
                preview.find('img').attr('src', newSrc);
                preview.find('img').attr('srcset', newSrc);
                preview.stop().animate({
                    'opacity':1
                }, time);
            });
            
        });
        preview.click(function(){
            var index = $(this).attr('data-index');
            gal.find('dt[data-index="' + index + '"] a').click();
        });
    });

    // **********************************************************************// 
    // ! Images lightbox
    // **********************************************************************//
    $("a[rel^='lightboxGall']").magnificPopup({
        type:'image',
        gallery:{
            enabled:true
        }
    });
    

    $('.images-popups-gallery').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: "a[data-rel^='gallery']", // the selector for gallery item
            type: 'image',
            gallery: {
              enabled:true
            }
        });
    }); 

    $("a[rel='lightbox'], a[rel='pphoto']").magnificPopup({
        type:'image',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,                    
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = 'my-mfp-slide-bottom effect-delay2';
            }
        }
    });

    // **********************************************************************// 
    // ! Mobile loader
    // **********************************************************************//
    $('.mobile-loader > div').fadeOut(300);
    $('.mobile-loader').delay(300).fadeOut(800, function(){
        $('.mobile-loader').remove();
    });

    // **********************************************************************// 
    // ! Product images sections loading
    // **********************************************************************//
    
    $('.single-product-page .images').addClass('shown');


    // **********************************************************************// 
    // ! Animated Counters
    // **********************************************************************//

    function animateCounter(el) {
        var initVal = parseInt(el.text());
        var finalVal = el.data('value');
        if(finalVal <= initVal) return;
        var intervalTime = 1;
        var time = 200;
        var step = parseInt((finalVal - initVal)/time.toFixed());
        if(step < 1) {
            step = 1;
            time = finalVal - initVal;
        }
        var firstAdd = (finalVal - initVal)/step - time;
        var counter = parseInt((firstAdd*step).toFixed()) + initVal;
        var i = 0;
        var interval = setInterval(function(){
            i++;
            counter = counter + step;
            el.text(counter);
            if(i == time) {
                clearInterval(interval);
            }
        }, intervalTime);
    }

    // **********************************************************************// 
    // ! Full width section
    // **********************************************************************//

    function et_sections(){
        $('.full-width-section').each(function() {
            if($(this).parents('.et_section').length == 0) {
                $(this).css({'visibility': 'visible'}).wrap( "<div class='et_section'><div class='container'></div></div>" );
            }
        });
        $('.et_section').each(function(){
            $(this).css({
                'left': - ($(window).width() - $('.header > .container').width())/2,
                'width': $(window).width(),
                'visibility': 'visible'
            });
            var videoTag = $(this).find('.section-back-video video');
            videoTag.css({
                'width': $(window).width(),
                //'height': $(window).width() * videoTag.height() / videoTag.width() 
            });
        });
    }

    et_sections()

    $(window).resize(function(){
        et_sections();
    })
    
    
    // **********************************************************************// 
    // ! Hidden Top Panel
    // **********************************************************************//

    $(function(){
        var topPanel = $('.top-panel');
        var pageWrapper = $('.page-wrapper');
        var showPanel = $('.show-top-panel');
        var panelHeight = topPanel.outerHeight();
        showPanel.toggle(function(){
            $(this).addClass('show-panel');
            pageWrapper.attr('style','transform: translateY('+panelHeight+'px);-ms-transform: translateY('+panelHeight+'px);-webkit-transform: translateY('+panelHeight+'px);');
            topPanel.addClass('show-panel');
        },function(){
            pageWrapper.attr('style','')
            topPanel.removeClass('show-panel');
            $(this).removeClass('show-panel');
        });
    });

    // **********************************************************************// 
    // ! Remove some br and p
    // **********************************************************************//
    $('.toggle-element ~ br').remove();
    $('.toggle-element ~ p').remove();
    $('.block-with-ico h5').next('p').remove();
    $('.tab-content .row-fluid').next('p').remove();
    $('.tab-content .row-fluid').prev('p').remove();


    // **********************************************************************// 
    // ! Update Favicon
    // **********************************************************************//
    function et_update_favicon() {
        var itemsCount = $('.cart-summ').data('items-count');
        var enableBadge = $('.shopping-container').data('fav-badge');
        var favicon = new Favico({
            animation : 'popFade',
            fontStyle : 'normal',
        });
        
        if (enableBadge == 'enable') {
            favicon.badge(itemsCount);
        }
    }

    et_update_favicon();

    // **********************************************************************// 
    // ! Fade animations
    // **********************************************************************//

    setTimeout(function() {
        $('.fade-in').removeClass('fade-in');
    }, 500);
    
    // **********************************************************************// 
    // ! Products grid images slider
    // **********************************************************************//

    function contentProdImages() {
        $('.hover-effect-slider').each(function() {
            var slider = $(this);
            var index = 0;
            var autoSlide;
            var imageLink = slider.find('.product-content-image');
            var imagesList = imageLink.data('images');
            imagesList = imagesList.split(",");
            var arrowsHTML = '<div class="sm-arrow arrow-left">left</div><div class="sm-arrow arrow-right">right</div>';
            var counterHTML = '<div class="slider-counter"><span class="current-index">1</span>/<span class="slides-count">' + imagesList.length + '</span></div>';

            if(imagesList.length > 1) {
                slider.prepend(arrowsHTML);
                //slider.prepend(counterHTML);

                // Previous image on click on left arrow
                slider.find('.arrow-left').click(function(event) {
                    if(index > 0) {
                        index--; 
                    } else {
                        index = imagesList.length-1; // if the first item set it to last
                    }
                    imageLink.find('img').attr('src', imagesList[index]).attr('srcset', imagesList[index]); // change image src
                    slider.find('.current-index').text(index + 1); // update slider counter
                });

                // Next image on click on left arrow
                slider.find('.arrow-right').click(function(event) {
                    if(index < imagesList.length - 1) {
                        index++;
                    } else {
                        index = 0; // if the last image set it to first
                    }
                    imageLink.find('img').attr('src', imagesList[index]).attr('srcset', imagesList[index]);// change image src
                    slider.find('.current-index').text(index + 1);// update slider counter
                });


            }

        });
    }

    contentProdImages();

    // **********************************************************************// 
    // ! Wishlist
    // **********************************************************************//
    $('.yith-wcwl-add-button.show').each(function(){
        var wishListText = $(this).find('a').text();
        $(this).find('a').attr('data-hover',wishListText);
    });    

    // **********************************************************************// 
    // ! Main Navigation plugin
    // **********************************************************************//


    // Addlink with image for menu.
    var src = $( 'li .image-link .nav-item-tooltip' ).find('>div').first().attr('data-src');
    var newContent = '<img src="' + src + '" />';
    $( 'li .image-link a' ).html(newContent);

    $.fn.et_menu = function ( options ) {
        var methods = {
            init: function(el) {
                methods.el = el;
                
                $(window).resize(function() {
                    methods.setOffsets();
                    methods.sideMenu();
                });
                
                methods.setOffsets();
                
                el.find('a').has('.nav-item-tooltip').hover(function() {
                    var newContent = '';
                    var tooltip = $(this).find('.nav-item-tooltip');
                    var src = tooltip.find('>div').first().attr('data-src');
                    if(src.length > 10) {
                        newContent = '<img src="' + src + '" />';
                        tooltip.html(newContent);
                    }
                });
                
            },
            setOffsets: function() {
                
                methods.el.find('.menu-full-width > .nav-sublist-dropdown').each(function() {
                    var boxed = $('body').hasClass('boxed');
                    var extraBoxedOffset = 0;
                    if(boxed) {
                        extraBoxedOffset = $('.page-wrapper').offset().left;
                    }
                    var li = $(this).parent();
                    var liOffset = li.offset().left - extraBoxedOffset;
                    var liOffsetTop = li.offset().top;
                    var liWidth = $(this).parent().width();
                    var dropdowntMarginLeft = liWidth/2;
                    var dropdownWidth = $(this).outerWidth();
                    var dropdowntLeft = liOffset - dropdownWidth/2;
                    var dropdownBottom = liOffsetTop - $(window).scrollTop() + $(this).outerHeight();
                    
                    if(dropdowntLeft < 0) {
                        var left = liOffset - 10;
                        dropdowntMarginLeft = 0;
                    } else {
                        var left = dropdownWidth/2;
                        
                    }
                    
                    $(this).css({
                        'left': - left,
                        'marginLeft': dropdowntMarginLeft
                    });
                    
                    var dropdownRight = ($(window).width() - extraBoxedOffset*2) - (liOffset - left + dropdownWidth + dropdowntMarginLeft);
                    
                    if(dropdownRight < 0) {
                        $(this).css({
                            'left': 'auto',
                            'right': - ($(window).width() - liOffset - liWidth - 10) + extraBoxedOffset*2
                        });
                    }
                    
                    if(($('.header-wrapper').hasClass('header-type-vertical') || $('.header-wrapper').hasClass('header-type-vertical2')) && dropdownBottom > $(window).height()) {
                        $(this).css({
                            'top': 'auto',
                            'bottom': - ($(window).height() - (liOffsetTop - $(window).scrollTop() + li.outerHeight())) + 15
                        });
                    }
                    
                });  
            },
            sideMenu: function() {
                if($(window).height() < 800) {
                    $('.header-wrapper').addClass('header-scrolling');
                } else {
                    $('.header-wrapper').removeClass('header-scrolling');
                }
            }
        };

        var settings = $.extend({
            type: "default"
        }, options );
        
        methods.init(this);


        return this;
    }

    // First Type of column Menu
    $('.menu-main-container .menu').et_menu({
        type: "default"
    });
    

    


    function et_equalize_height(elements, removeHeight) {
        var heights = [];

        if(removeHeight) {
            elements.attr('style', '');
        }

        elements.each(function(){
            heights.push($(this).height());
        });

        var maxHeight = Math.max.apply( Math, heights );
        if($(window).width() > 767) {
            elements.height(maxHeight);
        }
    }

    $(window).resize(function(){
        //et_equalize_height($('.product-category'), true);
    });

    // **********************************************************************// 
    // ! "Top" button
    // **********************************************************************//

    var scroll_timer;
    var displayed = false;
    var $message = jQuery('.back-top');
    
    jQuery(window).scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () { 
        if(jQuery(window).scrollTop() <= 0) {
            displayed = false;
            $message.addClass('bounceOut').removeClass('bounceIn');
        }
        else if(displayed == false) {
            displayed = true;
            $message.stop(true, true).removeClass('bounceOut').addClass('bounceIn').click(function () { $message.addClass('bounceOut').removeClass('bounceIn'); });
        }
        }, 400);
    });
    
    jQuery('.back-top').click(function(e) {
            jQuery('html, body').animate({scrollTop:0}, 600);
            return false;
    });
    

    // **********************************************************************// 
    // ! Portfolio
    // **********************************************************************//

    $portfolio = $('.masonry');

    $portfolio.each(function() {
        var portfolioGrid = $(this);
        portfolioGrid.isotope({ 
            itemSelector: '.portfolio-item'
        });    
        $(window).smartresize(function(){
            portfolioGrid.isotope({ 
                itemSelector: '.portfolio-item'
            });
        });
        
        portfolioGrid.parent().find('.portfolio-filters a').click(function(){
            var selector = $(this).attr('data-filter');
            portfolioGrid.parent().find('.portfolio-filters a').removeClass('active');
            if(!$(this).hasClass('active')) {
                $(this).addClass('active');
            }
            portfolioGrid.isotope({ filter: selector });
            return false;
        });
    });
    

    setTimeout(function(){
        $('.portfolio').addClass('with-transition');
        $('.portfolio-item').addClass('with-transition');
        $(window).resize();
    },500);
    

    // **********************************************************************// 
    // ! Blog isotope
    // **********************************************************************// 
    
    $blog = $('.blog-masonry');

    $blog.isotope({ 
        itemSelector: '.post-grid'
    });    
    
    
    $(window).smartresize(function(){
        $blog.isotope({ 
            itemSelector: '.post-grid'
        });   
    });
    
    $('body').on('click', '.load-more-posts a', function(e){
        e.preventDefault();
            
        var url = $(this).attr('href');
        
        if($(this).length>0) {
            et_add_blog_posts(url);
            
            $loading = true;
        }
    });
    
    var $loading = false;
    
    $(window).scroll(function(){
        var $window = $(window);
        var $element = $('.load-more-posts');
        
        if($element.length>0) {
            var pos = $window.scrollTop();              
    
            windowHeight = $window.height();
            var top = $element.offset().top; 
            var height = $element.height();
            var viewportBottom = pos + windowHeight; 
    
            // Check if totally above or totally below viewport
            if (top + height < pos || top > viewportBottom) {
                return;
            }
                
            var url = $element.find('a').attr('href');
            
            if($element.find('a').length>0) {
                et_add_blog_posts(url);
                
                $loading = true;
            }
            
        }
            
    });
    
    function et_add_blog_posts(url){
        if($loading) return;
        $.ajax({
            url: url,
            method: 'GET',
            timeout: 10000,
            dataType: 'text',
            beforeSend: function() {
                $('.load-more-posts').addClass('loading');
            },
            success: function(data) {
                $('.blog-masonry').addClass('with-transition');
                $('.post-grid').addClass('with-transition');
                $('.blog-masonry').isotope( 'insert', $(data).find('.blog-masonry .post-grid') );
                $('.load-more-posts').html($(data).find('.load-more-posts').html());
                
                
            },
            error: function(data) {
                console.log('Error loading ajax content!');
                window.location.reload();
            },
            complete: function() {
                
                setTimeout(function(){
                    $(window).resize();
                },100);
                
                setTimeout(function(){
                    $loading = false;
                },500);
                
                $('.load-more-posts').removeClass('loading');
            }
        });
        
        return;
    }

    // **********************************************************************// 
    // ! Other elements isotope
    // **********************************************************************// 
    
    $container = $('.isotope-container');
    
    $isotope = $('.et_isotope');
    
    $isotope.each(function() {
        var isotope = $(this);
        isotope.isotope({ 
            itemSelector: '.et_isotope-item'
        });    
        
       $(window).smartresize(function(){
            isotope.isotope({ 
                itemSelector: '.et_isotope-item'
            });   
        });
        
        setTimeout(function(){
            isotope.addClass('with-transition');
            isotope.find('.et_isotope-item').addClass('with-transition');;
        },500);  
    });

    $container.each(function() {
        var container = $(this);
        var isotope = container.find('.et_isotope');
        container.find('.et_categories_filter a').data('isotope', isotope).click(function(e){
            e.preventDefault();
            var isotope = jQuery(this).data('isotope');
            jQuery(this).parent().parent().find('.active').removeClass('active');
            jQuery(this).addClass('active');
            isotope.isotope({filter: jQuery(this).attr('data-filter')});
        });    
    });
 

    // **********************************************************************// 
    // ! Fixed header
    // **********************************************************************// 
    
    $(window).scroll(function(){
        if (!$('body').hasClass('fixNav-enabled')) {return false; }
        var fixedHeader = $('.fixed-header-area');
        var scrollTop = $(this).scrollTop();
        var headerHeight = $('.header-wrapper').height() + 20;
        
        if(scrollTop > headerHeight){
            if(!fixedHeader.hasClass('fixed-already')) {
                fixedHeader.stop().addClass('fixed-already');
            }
        }else{
            if(fixedHeader.hasClass('fixed-already')) {
                fixedHeader.stop().removeClass('fixed-already');
            }
        }
    });
    // **********************************************************************// 
    // ! Icons Preview
    // **********************************************************************// 

    var modalDiv = $('#iconModal');
    
    $('.demo-icons .demo-icon').click(function(){

        var name = $(this).find('i').attr('class');

        
        modalDiv.find('i').each(function(){
            $(this).attr('class',name);
        });
        
        modalDiv.find('#myModalLabel').text(name);
        
        modalDiv.modal();
    });

    // **********************************************************************// 
    // ! Testimonials Gallery
    // **********************************************************************// 
    
    $(".testimonials-slider").each(function() {
        var navigation = ($(this).data('navigation') == 1);
        var autoplay = false;
        if($(this).data('interval') != '') {
            autoplay = $(this).data('interval');
        }
        $(this).owlCarousel({
            items:1, 
            lazyLoad : true,
            autoPlay: autoplay,
            navigation: navigation,
            navigationText:false,
            rewindNav: true,
            itemsCustom: [[0, 1], [479,1], [619,1], [768,1],  [1200, 1], [1600, 1]]
        });
    });


    // **********************************************************************// 
    // ! WooCommerce
    // **********************************************************************// 
    
    $('.woocommerce-review-link').click(function() {
        $('#tab_reviews').click();
    });
    
    $('.open-terms-link').click(function() {
        $.magnificPopup.open({
            items: { src: '#terms-popup' },
            type: 'inline',
            removalDelay: 500, //delay removal by X to allow out-animation
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = 'mfp-zoom-in-to-left-out';
                }
            }
        }, 0);
    });

    // **********************************************************************// 
    // ! Remove from cart with AJAX
    // **********************************************************************//

    $(document.body).on('click', '.cart-popup .delete-btn, .shopping-cart .product-remove a', function(e){
        e.preventDefault();
        var $this = $(this);
        var key = $this.data('key');

        $.ajax({
            method: "POST",
            url: woocommerce_params.ajax_url,
            data: {
                'action': 'et_remove_from_cart',
                'key' : key
            },
            error: function() {
                console.log('removing from cart AJAX error');
            },
            success: function(response) {
                $('#cartModal').replaceWith(response.fragments.cart_modal);
                $('.shopping-cart-widget').replaceWith(response.fragments.top_cart);
                et_update_favicon();
                $this.parent().parent().remove();
                $('.success').remove();
                $('table.cart').before('<p class="success">' + response.msg + '<span class="close-parent">close</span></p>');
            }
        });

    });
    


    // **********************************************************************// 
    // ! Products view switcher
    // **********************************************************************// 

    function listSwitcher() {
        var activeClass = 'switcher-active';
        var gridClass = 'products-grid';
        var listClass = 'products-list';
        jQuery('.switchToList').click(function(){
            if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid'){
                switchToList();
            }
        });
        jQuery('.switchToGrid').click(function(){
            if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list'){
                switchToGrid();
            }
        });
        
        function switchToList(){
            jQuery('.switchToList').addClass(activeClass);
            jQuery('.switchToGrid').removeClass(activeClass);
            jQuery('.main-products-loop .products-loop').fadeOut(300,function(){
                jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
                jQuery.cookie('products_page', 'list', { expires: 3, path: '/' });
            });
        }
        
        function switchToGrid(){
            jQuery('.switchToGrid').addClass(activeClass);
            jQuery('.switchToList').removeClass(activeClass);
            jQuery('.main-products-loop .products-loop').fadeOut(300,function(){
                jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
                jQuery.cookie('products_page', 'grid', { expires: 3, path: '/' });
            }); 
        }
    }

    function check_view_mod(){
        var activeClass = 'switcher-active';
        if(jQuery.cookie('products_page') == 'grid') {
            jQuery('.main-products-loop .products-loop').removeClass('products-list').addClass('products-grid');
            jQuery('.switchToGrid').addClass(activeClass);
        }else if(jQuery.cookie('products_page') == 'list') {
            jQuery('.main-products-loop .products-loop').removeClass('products-grid').addClass('products-list');
            jQuery('.switchToList').addClass(activeClass);
        }else{
            if(view_mode_default == 'list_grid' || view_mode_default == 'list') {
                jQuery('.switchToList').addClass(activeClass);
            }else{
                jQuery('.switchToGrid').addClass(activeClass);
            }
        }
    }

    listSwitcher();
    check_view_mod();

    // **********************************************************************// 
    // ! Step by step checkout
    // **********************************************************************// 

    var stepsNav = $('.checkout-steps-nav');
    var steps = $('.checkout-steps');
    var nextStepBtn = $('.continue-checkout');

    stepsNav.find('li a').click(function(e) {
        e.preventDefault();
        var link = $(this);
        var stepId = link.data('step');
        showStep(stepId);
    });

    nextStepBtn.click(function(e) {
        e.preventDefault();
        var nextId = $(this).data('next');

        showStep(nextId);
    });

    steps.find('.active').show();

    // checkout method 

    var radioBtns = $('input[name="method"]');

    radioBtns.change(function() {
        var checkedMethod = jQuery(this).val();

        checkMethod(checkedMethod);
    });

    checkMethod($('input[name="method"]:checked').val());

    function showStep(id) {
        var stepsNav = $('.checkout-steps-nav');

        $('.checkout-step').fadeOut(200);

        stepsNav.find('li a').removeClass('active filled');

        for(var i = id; i>0; i--) {
            $('#tostep' + i + ' a').addClass('filled');
        }

        $('#tostep' + id + ' a').addClass('active');

        setTimeout(function(){
            $('#step' + id).fadeIn(200);
        }, 200);
    }


    function checkMethod(val){
        if(val == 2) {
            $('#tostep2').css('display','inline-block');
            $('#createaccount').attr('checked', true);
            $('#step1 .continue-checkout').data('next',2);
        }else{
            $('#tostep2').hide();
            $('#createaccount').attr('checked', false);
            $('#step1 .continue-checkout').data('next',3);
        }
    }


    /* Ajax Filter */
    
    function ajaxProductLoad(url,blockId) {
        $.ajax({
            url: url,
            method: 'GET',
            timeout: 10000,
            dataType: 'text',
            success: function(data) {
                productLoaded(data,blockId);
                
            },
            error: function(data) {
                alert('Error loading ajax content!');
                window.location.reload();
            }
        });
    }
    
    function productLoaded(data,blockId) {
        //hide spinner
        $('.woocommerce-pagination').html($(data).find('.woocommerce-pagination').html());
        for(var i=0; i<blockId.length; i++) {
            jQuery(blockId[i]).html(jQuery(data).find(blockId[i]).html());
        }
        $('.content.span9').html($(data).find('.content.span9').html());
        $('.widget_layered_nav_filters').html($(data).find('.widget_layered_nav_filters').html());
        $('.content.span12').html($(data).find('.content.span12').html());
        //$('*').css({'cursor':'auto'});
        $('.product-grid').removeClass('loading').find('#floatingCirclesG').remove();
      
        $('select.orderby').change(function(){
            $(this).closest('form').submit();
        });

        //productHover();
        check_view_mod();
        listSwitcher();
        contentProdImages();
        
    }
    
    if(ajaxFilterEnabled == 'enabled') {
        $('.widget_layered_nav a, .woocommerce-pagination a').live('click', function(event) {
            var url = $(this).attr('href');
            if (url == '') {
                url = $(this).attr('value');
            }
            
            var blockId = [];

            jQuery('.widget_layered_nav').each(function(){
                blockId.push('#' + jQuery(this).attr('id'));
            });
            
            //$('*').css({'cursor':'progress'});
            $('.product-loop .product').addClass('loading').prepend('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
        
            ajaxProductLoad(url,blockId);
            event.stopPropagation();
            return false;
        });
    }
    

    // Ajax add to cart

    var modalWindow = jQuery('.etheme-simple-product').eModal();

    $('.etheme-simple-product, .ajax-enabled .variations_form .single_add_to_cart_button').live('click', function(e) {
        e.preventDefault();
        // AJAX add to cart request
        var $thisbutton = $(this);
        
        if ($thisbutton.is('.single_add_to_cart_button, .etheme-simple-product, .product_type_downloadable, .product_type_virtual') && ! $thisbutton.is('.wc-variation-selection-needed, .wc-variation-is-unavailable') ) {
        
            $('#top-cart').addClass('updating');
            
            var form = $('form.cart');
            
            formAction = form.attr('action');
            
            var variation = {};
            form.find('select').each(function() {
                var key = $(this).attr('name');
                var value = $(this).val();      
                variation[key] = value;
            });

            var data = {
                action:         'et_woocommerce_add_to_cart',
                product_id:     form.find('[name="add-to-cart"]').val(),
                quantity:       form.find('.qty').val(),
                variation_id:   form.find('[name="variation_id"]').val(),
                variation:      variation
            };

            et_add_to_cart(data, $thisbutton, true);
            
            return false;
        
        } else {
            return true;
        }
        
    });

    if ( !isIE() ) {
        [].slice.call( document.querySelectorAll( '.progress-button' ) ).forEach( function( bttn ) {
            if($('body').hasClass('woocommerce-wishlist')) return;
            new ProgressButton( bttn, {
                callback : function( instance ) {
                    var progress = 0,
                        interval = setInterval( function() {
                            progress = Math.min( progress + Math.random() * 0.01, 1 );
                            instance._setProgress( progress );

                            if( progress === 1 ) {
                                instance._stop(1);
                                clearInterval( interval );
                            }
                        }, 5 );
                }
            } );
        } );
    }

    function isIE () {
        if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
           return true;
        }
        return false;
    }

    // Ajax add to cart (on list page)
    $(document).on('click', '.etheme_add_to_cart_button', function() {
        
        // AJAX add to cart request
        var $thisbutton = $(this);


        if ($thisbutton.is('.product_type_simple, .product_type_downloadable, .product_type_virtual') && !$('body').hasClass('woocommerce-wishlist')) {

            if (!$thisbutton.attr('data-product_id')) return true;
                        
            var data = {
                action:         'et_woocommerce_add_to_cart',
                product_id:     $thisbutton.attr('data-product_id'),
                quantity:       1
            };

            et_add_to_cart(data, $thisbutton, false);

            return false;

        } else {
            return true;
        }
        
    });
    
    function et_add_to_cart(data, $thisbutton, showEmodal) {

    
        if(showEmodal) {
            modalWindow.eModal('showModal');
        }

        if ( isIE() ) {
            $thisbutton.addClass('adding-to-cart');
        }

        // Ajax action
        $.post( woocommerce_params.ajax_url, data, function( response ) {
            

            if(showEmodal) {
                   
                if($('.product-thumbnails img').length > 0) {
                    productImageSrc = $('.product-thumbnails img').first().attr('src');  
                } else {
                    productImageSrc = $('.product-images img, .images img').first().attr('src');  
                }

                
                productName = $('.meta-title span').first().text();  
    
                modalWindow.eModal('endLoading')
                     .eModal('setTitle',productName)
                     .eModal('addImage', productImageSrc)
                     .eModal('addText', successfullyAdded)
                     .eModal('addBtn',{
                            title: contBtn,
                            href: 'javascript:void(0);',
                            cssClass: 'btn filled',
                            hideOnClick: true
                        })
                     .eModal('addBtn',{
                            title: checkBtn,
                            href: checkoutUrl,
                            cssClass: 'btn filled active'
                        });  
            }   
                        
            if ( ! response )
                return false;

            var this_page = window.location.toString();

            this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );


            $thisbutton.parent().find('#floatingCirclesG').remove();
            
            fragments = response.fragments;
            cart_hash = response.cart_hash;

            if ( isIE() ) {
                $thisbutton.removeClass('adding-to-cart');
            }

            setTimeout(function() { 
                $thisbutton.parent().parent().removeClass('loading');
                $thisbutton.removeClass('added');
            }, 3000)
            
            // Cart widget load
            $('#cartModal').replaceWith(fragments.cart_modal);
            $('.cart_list').replaceWith( $(fragments.top_cart).find('.cart_list') );
            $('.shopping-container').replaceWith(fragments.top_cart);
            et_update_favicon();

            
            $('body').trigger('cart_widget_refreshed');
            
            // Unblock
            $( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

            // Cart page elements
            $( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

                $( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();

                $( 'body' ).trigger( 'cart_page_refreshed' );
            });

            $( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
                $( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
            });


            // Trigger event so themes can refresh other areas
            $('body').trigger( 'added_to_cart', [ fragments, cart_hash ] );
            return true;
        });
    }
    
    // **********************************************************************// 
    // ! AJAX Quick View
    // **********************************************************************//


    $(document.body).on('click', '.show-quickly, .show-quickly-btn', (function() {
        var $thisbutton = $(this);
        var $productCont = $(this).parent().parent().parent();
        var prodid = $thisbutton.data('prodid');
        var magnificPopup;
        $.ajax({
            url: woocommerce_params.ajax_url,
            method: 'POST',
            data: {
                'action': 'et_product_quick_view',
                'prodid': prodid
            },
            dataType: 'html',
            beforeSend: function() {
                $productCont.addClass('loading');
                $productCont.append('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
            },
            complete: function() {
                $productCont.find('#floatingCirclesG').remove();
                $productCont.removeClass('loading');
            },
            success: function(response){

                $.magnificPopup.open({
                    items: { src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">' + response + '</div></div>' },
                    type: 'inline',
                    removalDelay: 300, //delay removal by X to allow out-animation
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = 'my-mfp-slide-bottom';
                        }
                    }
                }, 0);

                $(function() {
                    $('.quick-view-popup .variations_form').wc_variation_form();
                    $('.quick-view-popup .variations_form .variations select').change();
                });
                $('.quick-view-popup .images').addClass('shown');
            },
            error: function() {
                $.magnificPopup.open({
                    items: {
                        src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">Error with AJAX request</div></div>'
                    },
                    type: 'inline',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = 'mfp-zoom-in-to-left-out';
                        }
                    }
                }, 0);
            }
        });

    }));


    // **********************************************************************// 
    // ! Product variations images
    // **********************************************************************// 
    
    $('form.variations_form').on( 'found_variation', function( event, variation ) {
        var $variation_form = $(this);
        var $product        = $(this).closest( '.product' );
        var $product_img    = $product.find( '.woocommerce-main-image img:eq(0)' );
        var $product_link   = $product.find( '.woocommerce-main-image' );
        var $lighbox_link   = $product.find( '.product-lightbox-btn' ).first();

        var o_src           = $product_img.attr('data-o_src');
        var o_title         = $product_img.attr('data-o_title');
        var o_href          = $product_link.attr('data-o_href');

        var variation_image = variation.image_src;
        var variation_link = variation.image_link;
        var variation_title = variation.image_title;

        $product_link.attr('href', variation_image);
                    
        if ($('.main-images').hasClass('zoom-enabled')) {
            if($(window).width() > 768 && variation_image.length > 5 && variation_link.length > 5){
                try {
                    $product_link.swinxyzoom('load', variation_image,  variation_link);
                } catch(e) {}
                
            }
            $product_link.attr('href', variation_link);
        } else{
            $product_link.attr('href', variation_link);
        }

        if(variation_image.length > 5) $('.product-thumbnails img').first().attr('src', variation_image);

        if(variation_link.length > 5) $lighbox_link.attr('href', variation_link);

        
        var owlMain = jQuery(".main-images").data('owlCarousel');
        if( typeof owlMain != 'undefined') {
            owlMain.goTo(0);
        }



    })              
    // Reset product image
    .on( 'reset_image', function( event ) {
    

        var $product        = $(this).closest( '.product' );
        var $product_img    = $product.find( '.woocommerce-main-image img:eq(0)' );
        var $product_link   = $product.find( '.woocommerce-main-image' );
        var $lighbox_link   = $product.find( '.product-lightbox-btn' ).first();
        

        var o_src           = $product_img.attr('data-o_src');
        var o_href          = $product_link.attr('data-o_href');
        
        $product_link.attr('href', o_href);

        if ($('.main-images').hasClass('zoom-enabled')) {
            if($(window).width() > 768 && typeof $product_img.attr('data-o_src') != 'undefined' && o_src.length > 5 && o_href.length > 5){
                try {
                    $product_link.swinxyzoom('load', o_src,  o_href);
                } catch(e) {}
            }

            $product_link.attr('href', o_href);
        } else{
            $product_link.attr('href', o_href);
        }
        
        if(o_href.length > 5) $lighbox_link.attr('href', o_href);
        
        if(typeof o_src != 'undefined' && o_src.length > 5) $('.product-thumbnails img').first().attr('src', o_src);

        var owlMain = jQuery(".main-images").data('owlCarousel');
        if( typeof owlMain != 'undefined') {
            owlMain.goTo(0);
        }
        
    } );

    $( '.variations_form .variations select' ).change();
    
    // **********************************************************************// 
    // ! Search form
    // **********************************************************************// 
    
    var searchBlock = $('.search.hide-input');
    var searchForm = searchBlock.find('#searchform');
    var searchBtn = searchForm.find('.button');
    var searchInput = searchForm.find('input[type="text"]');

    searchBtn.click(function(e) {
        e.preventDefault();
        searchInput.fadeIn(200).focus();
        $('body').addClass('search-input-shown');


        // Hide search input on click
        $(document).click(function(e) {
            var target = e.target;
            if (!$(target).is('.search.hide-input') && !$(target).parents().is('.search.hide-input')) {
                searchInput.fadeOut(200);
                $('body').removeClass('search-input-shown');
            }
        });

    });

    // **********************************************************************// 
    // ! Tabs
    // **********************************************************************// 

    var tabs = $('.tabs');
    $('.tabs > p > a').unwrap('p');
    
    var leftTabs = $('.left-bar, .right-bar');
    var newTitles;
    
    leftTabs.each(function(){
        var currTab = $(this);
        //currTab.find('> a.tab-title').each(function(){
            newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
        //});

        newTitles.first().addClass('opened');

        
        var tabNewTitles = $('<div class="left-titles"></div>').prependTo(currTab);
        tabNewTitles.html(newTitles);

        currTab.find('.tab-content').css({
            'minHeight' : tabNewTitles.height()
        });
    });
    
    
    tabs.each(function(){
        var currTab = $(this);
        
        var openNumber = parseInt(currTab.attr('data-active'));
        
        if(currTab.attr('data-active') == 'false') {
            
        } else if(!isNaN(openNumber)) {
            openNumber--;
            currTab.find('.tab-title:eq('+openNumber+')').addClass('opened').next().show();
        } else {
            currTab.find('.tab-title').first().addClass('opened').next().show();
        }
        

        currTab.find('.tab-title, .tab-title-left').click(function(e){
            
            e.preventDefault();
            
            var tabId = $(this).attr('id');
            var time = 250;
        
            if($(this).hasClass('opened')){
                if(currTab.hasClass('accordion') || ($(window).width() < 992 && !currTab.hasClass('products-tabs'))){
                    $(this).removeClass('opened');
                    $('#content_'+tabId).slideUp(time);
                }
            }else{
                currTab.find('.tab-title, .tab-title-left').each(function(){
                    var tabId = $(this).attr('id');
                    $(this).removeClass('opened');
                    if(currTab.hasClass('accordion') || ($(window).width() < 992 && !currTab.hasClass('products-tabs'))) {
                        $('#content_'+tabId).slideUp(time);
                    } else {
                        $('#content_'+tabId).hide();
                    }
                });


                if(currTab.hasClass('accordion') || ($(window).width() < 992 && !currTab.hasClass('products-tabs'))){
                    $('html, body').animate({
                        scrollTop: currTab.offset().top - 50
                    }, 800);
                    setTimeout(function(){
                        $('#content_'+tabId).addClass('tab-content').slideDown(time); // Fix it
                    },1);
                } else {
                    $('#content_'+tabId).show();
                }
                $(this).addClass('opened');
            }
        });
    });
    
    // **********************************************************************// 
    // ! Categories Accordion
    // **********************************************************************// 


    jQuery.fn.etAccordionMenu = function ( options ) {
        //var settings = $.extend({
        //    type: "default"
        //}, options );
    
        var $this = jQuery(this);
        
        var plusIcon = '+';
        var minusIcon = '&ndash;';
    
        var etCats = $('.product-categories');
        $this.addClass('with-accordion')
        var openerHTML = '<div class="open-this">'+plusIcon+'</div>';

        $this.find('li').has('.children, .nav-sublist-dropdown').has('li').addClass('parent-level0').prepend(openerHTML);

        if($this.find('.current-cat.parent-level0, .current-cat, .current-cat-parent').length > 0) {
            $this.find('.current-cat.parent-level0, .current-cat-parent').find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
        } else {
            $this.find('>li').first().find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
        }

        $this.find('.open-this').click(function() {
            if($(this).parent().hasClass('opened')) {
                $(this).html(plusIcon).parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
            }else {
                $(this).html(minusIcon).parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
            }
        });
    
        return this;
    } 
    
    if(catsAccordion) {
        $('.product-categories').etAccordionMenu();
    }
    
    // **********************************************************************// 
    // ! Toggle elements
    // **********************************************************************// 


    var etoggle = $('.toggle-block'),
        etoggleEl = etoggle.find('.toggle-element'),
        etoggleTitle = etoggleEl.find('.toggle-title'),
        plusIcon = '+',
        minusIcon = '&ndash;';
    

    etoggleTitle.click(function(e) {
        e.preventDefault();
        if($(this).hasClass('opened')) {
            $(this).removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
        }else {
            if($(this).parent().hasClass('noMultiple')){
                $(this).parent().find('.toggle-element').removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
            }
            $(this).addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').slideDown(200);
        }
    });


    // **********************************************************************// 
    // ! Mobile navigation
    // **********************************************************************// 

    var navList = $('.mobile-nav .menu');
    var etOpener = '<span class="open-child">(open)</span>';
    navList.addClass('et-mobile-menu');
    
    navList.find('li:has(ul)',this).each(function() {
        $(this).prepend(etOpener);
    });
    
    navList.find('.open-child').click(function(){
        if ($(this).parent().hasClass('over')) {
            $(this).parent().removeClass('over').find('> ul').slideUp(200);
        }else{
            $(this).parent().parent().find('> li.over').removeClass('over').find('> ul').slideUp(200);
            $(this).parent().addClass('over').find('> ul').slideDown(200);
        }
    });

    navList.on('click', 'li > a', function(e) {
        if($(this).attr('href') == '#') {
            e.preventDefault();
            $(this).parent().find('> .open-child').click();
        }
    });
    
    function mobilecheck() {
            var check = false;
            (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
    }

    var eventtype = mobilecheck() ? 'touchstart' : 'click';
    var container = document.getElementById( 'st-container' );
    var bodyClickFn = function(evt) {
        if( !hasParentClass( evt.target, 'st-menu' ) && !hasParentClass( evt.target, 'rev_slider_wrapper' ) ) {
            resetMenu();
            document.removeEventListener( eventtype, bodyClickFn );
        }
    }
    $('.menu-icon, #st-trigger-effects button').bind('click touchstart', function() {
        var effect = $(this).attr( 'data-effect' );
        
        if($('html').hasClass('st-menu-open')) {
            $('html').removeClass('st-menu-open');    
        } else {
            classie.add( container, effect );
            $('#st-container').addClass(effect);
            $('html').addClass('st-menu-open');    
            setTimeout(function() {
                document.addEventListener( eventtype, bodyClickFn );  
            }, 20); 
                
        }
        
    });

    $('.close-mobile-nav').click(function() {
        resetMenu();
        document.removeEventListener( eventtype, bodyClickFn );
    }); 
    
    function resetMenu() {
        $('html').removeClass('st-menu-open');
        $('#st-container').removeClass('mobile-menu-block hide-filters-block');
    }
    
    function hasParentClass( e, classname ) {
        if(e === document) return false;
        if( classie.has( e, classname ) ) {
            return true;
        }
        return e.parentNode && hasParentClass( e.parentNode, classname );
    }
    
    // *************
    // Nicescroll for hidden menu
    // *************
    
    //$(".st-menu-content")
    //.niceScroll({


   // });
    


    // **********************************************************************// 
    // ! Alerts
    // **********************************************************************// 

    function closeParentBtn(){
        var closeParentBtn = jQuery('.close-parent');

        closeParentBtn.click(function(e){
            closeParent(this);
        });

        function closeParent(el) {
            jQuery(el).parent().slideUp(100);
        }
    }

    closeParentBtn();

    // **********************************************************************// 
    // ! Contact Form ajax
    // **********************************************************************// 

    var eForm = $('#contact-form');
    var spinner = jQuery('.spinner');

    $('.required-field').focus(function(){
        $(this).removeClass('validation-failed');
    });

    eForm.find('#submit').click(function(e){
        e.preventDefault();
        $('#contactsMsgs').html('');
        spinner.show();
        var errmsg;
        errmsg = '';

        eForm.find('.required-field').each(function(){
            if($(this).val() == '') {       
                    $(this).addClass('validation-failed');
                }
        });

        if(errmsg){
            $('#contactsMsgs').html('<p class="error">' + errmsg + '</p>');
            spinner.hide();
        }else{
            
            url = eForm.attr('action');
            
            data = eForm.serialize();

            data += '&action=et_send_msg_action';
            $.ajax({
                url: myAjax.ajaxurl,
                method: 'GET',
                data: data,
                error: function(data) {
                    $('#contactsMsgs').html('<p class="error">Error while ajax request<span class="close-parent"></span></p>');
                    spinner.hide();
                },
                success : function(data){
                    if (data.status == 'success') {
                        $('#contactsMsgs').html('<p class="success">' + data.msg + '<span class="close-parent"></span></p>');
                        eForm.find("input[type=text], textarea").val("");
                    }else{
                        $('#contactsMsgs').html('<p class="error">' + data.msg + '<span class="close-parent"></span></p>');
                    }
                    spinner.hide();
                    closeParentBtn();
                }
            });
            
        }

    });

    // **********************************************************************// 
    // ! Custom Comment Form Validation
    // **********************************************************************// 
    var ethemeCommentForm = $('#commentform');

    ethemeCommentForm.find('#submit').click(function(e){
        $('#commentsMsgs').html('');

        ethemeCommentForm.find('.required-field').each(function(){
            if($(this).val() == '') { 
                $(this).addClass('validation-failed');
                e.preventDefault();
            }   
        });

    });
    // **********************************************************************// 
    // ! Load in view 
    // **********************************************************************// 
    
    var counters = $('.animated-counter');

    counters.each(function(){
        $(this).waypoint(function(){
            animateCounter($(this));
        }, { offset: '100%' });
    });

    var progressBars = $('.progress-bars');

    progressBars.waypoint(function() {
        i = 0;
        $(this).find('.progress-bar').each(function () {
            i++;
            
            var el = $(this);
            var width = $(this).data('width');
            setTimeout(function(){
                el.find('div').animate({
                    'width' : width + '%'
                },400);
                el.find('span').css({
                    'opacity' : 1
                });
            },i*300, "easeOutCirc");
        
        });
    }, { offset: '85%' });


    // helper hex to rgb
    function componentToHex(c) {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    function rgbToHex(r, g, b) {
        return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
    }

    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    // Halloween parallax
    $('#scene').parallax();

//
 $("#jquery_jplayer_1").jPlayer({
        ready: function () {
          $(this).jPlayer("setMedia", {
            title: "Bubble",
            mp3: "wp-content/themes/royal/images/assets/Halloween-March.mp3",
          }).jPlayer("play");
        },
        swfPath: "/js",
        supplied: "mp3"
      });

//
$('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

$('.prettySocial').prettySocial();

    var etTheme = {
        init: function() {
            this.fragmentsRefresh();
        },

        fragmentsRefresh: function() {
            // **********************************************************************//
            // ! Update cart fragments
            // **********************************************************************//
            $.ajax( {
                url: myAjax.ajaxurl,
                type: 'POST',
                data: { action: 'et_refreshed_fragments' },
                success: function( data ) {
                    if ( data && data.fragments ) {
                        $.each( data.fragments, function( key, value ) {
                            $( "." + key ).replaceWith( value );
                        });
                    }
                }
            } );
        },

    };
    
    $( document.body ).on( 'updated_wc_div', function() {
        etTheme.fragmentsRefresh();
    } );



    var loginTimeout = 0;

    $( ".login-link" ).hover(
      function() {
        clearTimeout(loginTimeout);
        $( '.login-popup' ).addClass( 'hover_login' );
      },
      function() {

        loginTimeout = setTimeout(function () {
            $( '.login-popup' ).removeClass( 'hover_login' );
        }, 1500);
        
      }
    );

}); // document ready

