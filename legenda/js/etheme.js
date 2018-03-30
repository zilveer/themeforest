jQuery(document).ready(function($){


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
        focus: '#et_modal_search',
        mainClass: 'my-mfp-slide-bottom effect-delay2',
        callbacks: {
            beforeOpen: function() {
                 this.st.focus = '#et_modal_search';
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
    // ! Update cart fragments
    // **********************************************************************//
    var et_fragment_refresh = {
        url: myAjax.ajaxurl,
        type: 'POST',
        data: { action: 'et_refreshed_fragments' },
        success: function( data ) {
            if ( data && data.fragments ) {
                $('#cartModal').replaceWith(data.fragments.cart_modal);
                $('.shopping-cart-widget').replaceWith(data.fragments.top_cart);
                $('.cart-totals').replaceWith(data.fragments.cart_totals);  
            }
        }
    };
    $.ajax( et_fragment_refresh );

    $( document.body ).on( 'updated_wc_div', function() {
        $.ajax( et_fragment_refresh );
    } );

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

            data = 's='+$(this).val() + '&products=' + et_search.data('products') + '&count=' + et_search.data('count') + '&images=' + et_search.data('images') + '&posts=' + et_search.data('posts') + '&portfolio=' + et_search.data('portfolio') + '&pages=' + et_search.data('pages') + '&action=et_get_search_result';

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

    jQuery('video:not(.et-section-video)').mediaelementplayer({
        success: function(player, node) {
            jQuery('#' + node.id + '-mode').html('mode: ' + player.pluginType);
        }
    });

    // **********************************************************************//
    // ! Countdown
    // **********************************************************************//


    $.fn.countdown = function ( options ) {

        var settings = $.extend({
            type: "default"
        }, options );

        setInterval(function countdown_update() {
            var countdown = $('.et-timer');
            var eventDate = Date.parse(countdown.data('final')) / 1000;
            var currentDate = Math.floor($.now() / 1000);
            var days = countdown.find('.days');
            var hours = countdown.find('.hours');
            var minutes = countdown.find('.minutes');
            var seconds = countdown.find('.seconds');

            var remindSeconds = eventDate-currentDate;

            if(remindSeconds > 0) {
                var remindDays = Math.floor(remindSeconds / (60 * 60 * 24));
                remindSeconds -= remindDays * 60 * 60 * 24;
                var remindHours = Math.floor(remindSeconds / (60 * 60));
                remindSeconds -= remindHours * 60 * 60;
                var remindMinutes = Math.floor(remindSeconds / (60));
                remindSeconds -= remindMinutes * 60;

                if(remindDays < 10) remindDays = '0' + remindDays;
                if(remindHours < 10) remindHours = '0' + remindHours;
                if(remindMinutes < 10) remindMinutes = '0' + remindMinutes;
                if(remindSeconds < 10) remindSeconds = '0' + remindSeconds;

                if(days < 1 || remindDays == '00') {
                    days.parent().hide().next().hide();
                } else {
                    days.text(remindDays);
                }
                hours.text(remindHours);
                minutes.text(remindMinutes);
                seconds.text(remindSeconds);
            }

        }, 1000);

        return this;
    }

    $('.et-timer').countdown();


    // **********************************************************************//
    // ! Promo popup
    // **********************************************************************//

    var et_popup_closed = $.cookie('etheme_popup_closed');
    $('.etheme-popup').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#username',
        modal: true,
        closeOnBgClick: true
    });

    if(et_popup_closed != 'do-not-show') {
        $('.etheme-popup').click();
    }

    $(document).on('click', '.popup-modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
        if($('#showagain:checked').val() == 'do-not-show')
            $.cookie('etheme_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
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

    $("a[rel='lightbox']").magnificPopup({
        type:'image'
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
        var enableBadge = $('.shopping-cart-widget').data('fav-badge');
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
            var imagesList = imageLink.data('images-list');
            imagesList = imagesList.split(",");
            var arrowsHTML = '<div class="small-slider-arrow arrow-left">left</div><div class="small-slider-arrow arrow-right">right</div>';
            var counterHTML = '<div class="slider-counter"><span class="current-index">1</span>/<span class="slides-count">' + imagesList.length + '</span></div>';

            if(imagesList.length > 1) {
                slider.prepend(arrowsHTML);
                slider.prepend(counterHTML);

                // Previous image on click on left arrow
                slider.find('.arrow-left').click(function(event) {
                    if(index > 0) {
                        index--;
                    } else {
                        index = imagesList.length-1; // if the first item set it to last
                    }
                    imageLink.find('img').attr('src', imagesList[index]); // change image src
                    slider.find('.current-index').text(index + 1); // update slider counter
                });

                // Next image on click on left arrow
                slider.find('.arrow-right').click(function(event) {
                    if(index < imagesList.length - 1) {
                        index++;
                    } else {
                        index = 0; // if the last image set it to first
                    }
                    imageLink.find('img').attr('src', imagesList[index]);// change image src
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

    $.fn.et_menu = function ( options ) {
        var methods = {
            showChildren: function(el) {
                el.fadeIn(100).css({
                    display: 'list-item',
                    listStyle: 'none'
                }).find('li').css({listStyle: 'none'});
            },
            calculateColumns: function(el) {
                // calculate columns count
                var columnsCount = el.find('.container > ul > li.menu-item-has-children').length;
                var dropdownWidth = el.find('.container > ul > li').outerWidth();
                var padding = 20;
                if(columnsCount > 1) {
                    dropdownWidth = dropdownWidth*columnsCount + padding;
                    el.css({
                        'width':dropdownWidth
                    });
                }

                // calculate right offset of the  dropdown
                var headerWidth = $('.menu-wrapper').outerWidth();
                var headerLeft = $('.menu-wrapper').offset().left;
                var dropdownOffset = el.offset().left - headerLeft;
                var dropdownRight = headerWidth - (dropdownOffset + dropdownWidth);

                if(dropdownRight < 0) {
                    el.css({
                        'left':'auto',
                        'right':0
                    });
                }
            },
            openOnClick: function(el,e) {
                var timeOutTime = 0;
                var openedClass = "current";
                var header = $('.header-wrapper');
                var $this = el;


                if($this.parent().hasClass(openedClass)) {
                    e.preventDefault();
                    $this.parent().removeClass(openedClass);
                    $this.next().stop().slideUp(settings.animTime);
                    header.stop().animate({'paddingBottom': 0}, settings.animTime);
                } else {

                    if($this.parent().find('>div').length < 1) {
                        return;
                    }

                    e.preventDefault();

                    if($this.parent().parent().find('.' + openedClass).length > 0) {
                        timeOutTime = settings.animTime;
                        header.stop().animate({'paddingBottom': 0}, settings.animTime);
                    }

                    $this.parent().parent().find('.' + openedClass).removeClass(openedClass).find('>div').stop().slideUp(settings.animTime);

                    setTimeout(function(){
                        $this.parent().addClass(openedClass);
                        header.stop().animate({'paddingBottom': $this.next().height()+50},settings.animTime);
                        $this.next().stop().slideDown(settings.animTime);
                    },timeOutTime);
                }
            }
        };

        var settings = $.extend({
            type: "default", // can be columns, default, mega, combined
            animTime: 250,
            openByClick: true
        }, options );

        if(settings.type == 'mega') {
            this.find('>li>a').click(function(e) {
                methods.openOnClick($(this),e);
            });
            return this;
        }

        this.find('>li').hover(function (){
            if(!$(this).hasClass('open-by-click') || (!settings.openByClick && $(this).hasClass('open-by-click'))) {
                if(settings.openByClick) {
                    $('.open-by-click.current').find('>a').click();
                    $(this).find('>a').unbind('click');
                }
                var dropdown = $(this).find('> .nav-sublist-dropdown');
                methods.showChildren(dropdown);

                if(settings.type == 'columns') {
                    methods.calculateColumns(dropdown);
                }
            } else {
                $(this).find('>a').unbind('click');
                $(this).find('>a').bind('click', function(e) {
                    methods.openOnClick($(this),e);
                });
            }
        }, function () {
            if(!$(this).hasClass('open-by-click') || (!settings.openByClick && $(this).hasClass('open-by-click'))) {
                $(this).find('> .nav-sublist-dropdown').fadeOut(100).attr('style', '');
            }
        });

        return this;
    }

    // First Type of column Menu
    $('.main-nav .menu').et_menu({
        type: "default"
    });

    $('.fixed-header .menu').et_menu({
        openByClick: false
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
    var $message = jQuery('.back-to-top');

    jQuery(window).scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () {
        if(jQuery(window).scrollTop() <= 0)
        {
            displayed = false;
            $message.removeClass('btt-shown');
        }
        else if(displayed == false)
        {
            displayed = true;
            $message.stop(true, true).addClass('btt-shown').click(function () { $message.removeClass('btt-shown'); });
        }
        }, 400);
    });

    jQuery('.back-to-top').click(function(e) {
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

    var type = 'article';

    $blog.isotope({
        itemSelector: type
    });


    $('.copyright .logo-small').click(function(){
        var $newItems = $('');
        $blog.isotope( 'insert', $newItems );
    });



    $(window).smartresize(function(){
        $blog.isotope({
            itemSelector: type
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
                $(type).addClass('with-transition');
                $('.blog-masonry').isotope( 'insert', $(data).find('.blog-masonry ' + type) );
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
            isotope.find('.et_isotope-item').addClass('with-transition');
            $(window).resize();
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
    // ! WooCommerce
    // **********************************************************************//

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
            jQuery('.product-loop').fadeOut(300,function(){
                jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
                jQuery.cookie('products_page', 'list', { expires: 3, path: '/' });
            });
        }

        function switchToGrid(){
            jQuery('.switchToGrid').addClass(activeClass);
            jQuery('.switchToList').removeClass(activeClass);
            jQuery('.product-loop').fadeOut(300,function(){
                jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
                jQuery.cookie('products_page', 'grid', { expires: 3, path: '/' });
            });
        }
    }



    function check_view_mod(){
        var activeClass = 'switcher-active';
        if(jQuery.cookie('products_page') == 'grid' && $('body').hasClass('post-type-archive-product')) {
            jQuery('.product-loop').removeClass('products-list').addClass('products-grid');
            jQuery('.switchToGrid').addClass(activeClass);
        }else if(jQuery.cookie('products_page') == 'list' && $('body').hasClass('post-type-archive-product')) {
            jQuery('.product-loop').removeClass('products-grid').addClass('products-list');
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
    // ! Checkout login form
    // **********************************************************************//

    $('a.showlogin').click(function(){
        $('form.et_login').slideToggle();
        return false;
    });

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

    if(steps.length > 0) {
        checkMethod($('input[name="method"]:checked').val());
    }

    function showStep(id) {
        var stepsNav = $('.checkout-steps-nav');

        $('.checkout-step').fadeOut(200);

        stepsNav.find('li a').removeClass('active filled');

        for(var i = id; i>0; i--) {
            $('#tostep' + i + ' a').addClass('filled');
        }

        $('#tostep' + id + ' a').addClass('active');

        jQuery('html, body').animate({
            scrollTop: $('.checkout-steps-nav').offset().top - 100
        }, 800);

        setTimeout(function(){
            $('#step' + id).fadeIn(200);
        }, 200);
    }


    function checkMethod(val){
        if(val == 2) {
            $('#tostep2').css('display','inline-block');
            $('#createaccount').attr('checked', true);
            if($('#step2').length > 0) {
                $('#step1 .continue-checkout').data('next',2);
            } else {
                $('#step1 .continue-checkout').data('next',3);
            }

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

        $('html, body').animate({scrollTop: $('.product-loop').offset().top-100}, 500);

        //productHover();
        check_view_mod();
        listSwitcher();
        contentProdImages();

    }

    // Reviews for woocommerce tabs.

    $('.woocommerce-review-link').click(function() {
        $('#tab_reviews').click();
    });

    if (!$('body').hasClass('post-type-archive-tribe_events')) {
    
        if(ajaxFilterEnabled == 1 && !$('body').hasClass('single-product')) {
            $('.widget_layered_nav a, .woocommerce-pagination a').live('click', function(event) {
                var url = $(this).attr('href');
                if (url == '') {
                    url = $(this).attr('value');
                }

                history.pushState({}, '', url);
                
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

            var popstatePageloadFix = {
                popped : ('state' in window.history && window.history.state !== null),
                initialUrl : location.href,
                initialPop : false,
                init : function() {
                    this.initialPop = !this.popped && location.href == this.initialUrl;
                    this.popped = true;
                    return this.initialPop;
                }
            };

            $(window).on("popstate", function (event) {
                
                // Ignore initial popstate that some browsers fire on page load
                if ( popstatePageloadFix.init() ) return;
                
                location.assign(location.href);

            });
            
        }
    }else{
        return;
    }


    // Ajax add to cart

    var modalWindow = jQuery('.etheme-simple-product').eModal();

    $('.etheme-simple-product').live('click', function(e) {
        e.preventDefault();
        // AJAX add to cart request
        var $thisbutton = $(this);

        if ($thisbutton.is('.etheme-simple-product, .product_type_downloadable, .product_type_virtual')) {


            $('#top-cart').addClass('updating');

            formAction = $('form.cart').attr('action');

            var data = $('form.cart').serializeArray();

            modalWindow.eModal('showModal');

            // Trigger event
            //$('body').trigger('adding_to_cart');

            // Ajax action
            $.ajax({
                url: formAction,
                data: data,
                method: 'POST',
                timeout: 10000,
                dataType: 'text',
                error: function(data) {
                    modalWindow.eModal('endLoading')
                         .eModal('addError', 'Error with ajax')
                         .eModal('addBtn',{
                                title: contBtn,
                                href: 'javascript:void(0);',
                                cssClass: 'button small hidewindow',
                                hideOnClick: true
                            });
                },
                success : function(data,statusText,xhr ) {
                    jQuery('.shopping-cart-widget').html(jQuery(data).find('.shopping-cart-widget').html());
                    jQuery('.cart-totals').html(jQuery(data).find('.cart-totals').html());
                    jQuery('#shopping-cart-modal').html(jQuery(data).find('#shopping-cart-modal').html());

                    et_update_favicon();
                    if($('.thumbnails img').length > 0) {
                        productImageSrc = $('.thumbnails img').first().attr('src');
                    } else if($('.main-image-slider img').length > 0) {
                        productImageSrc = $('.main-image-slider img').first().attr('src');
                    } else {
                        productImageSrc = $('.images img').first().attr('src');
                    }

                    productName = $('.product_title, .product-name, .product-name-hiden').first().text();

                    modalWindow.eModal('endLoading')
                         .eModal('setTitle',productName)
                         .eModal('addImage', productImageSrc)
                         .eModal('addText', successfullyAdded)
                         .eModal('addBtn',{
                                title: contBtn,
                                href: 'javascript:void(0);',
                                cssClass: 'button small hidewindow',
                                hideOnClick: true
                            })
                         .eModal('addBtn',{
                                title: checkBtn,
                                href: checkoutUrl,
                                cssClass: 'button filled active small arrow-right'
                            });
                }
            });

            return false;

        } else {
            return true;
        }

    });

    // Ajax add to cart (on list page)
    $('.etheme_add_to_cart_button').live('click', function() {

        if($('body').hasClass('woocommerce-wishlist')) return;

        // AJAX add to cart request
        var $thisbutton = $(this);

        if ($thisbutton.is('.product_type_simple, .product_type_downloadable, .product_type_virtual')) {

            if (!$thisbutton.attr('data-product_id')) return true;

            $thisbutton.removeClass('added');
            $thisbutton.parent().parent().addClass('loading');
            $thisbutton.after('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');

            var data = {
                action:         'et_woocommerce_add_to_cart',
                product_id:     $thisbutton.attr('data-product_id'),
                quantity:       1
            };

            // Trigger event
            //$('body').trigger( 'adding_to_cart', [ $thisbutton, data ] );


            // Ajax action
            $.post( wc_add_to_cart_params.ajax_url, data, function( response ) {

                if ( ! response )
                    return;

                var this_page = window.location.toString();

                this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                // Redirect to cart option
                if ( wc_add_to_cart_params.cart_redirect_after_add == 'yes' ) {

                    window.location = wc_add_to_cart_params.cart_url;
                    return;

                } else {

                    $thisbutton.parent().find('#floatingCirclesG').remove();

                    fragments = response.fragments;
                    cart_hash = response.cart_hash;

                    // Changes button classes
                    $thisbutton.addClass('added').parent().prepend('<div class="added-text"><div>' + successfullyAdded + '</div></div>');

                    setTimeout(function() {
                        $thisbutton.parent().parent().removeClass('loading');
                        $thisbutton.removeClass('added');
                        $('.added-text').fadeOut(300);
                    }, 3000)

                    // Cart widget load

                    et_update_favicon();
                    $('#cartModal').replaceWith(fragments.cart_modal);
                    $('.shopping-cart-widget').replaceWith(fragments.top_cart);
                    $('.cart-totals').replaceWith(fragments.cart_totals);


                    $('body').trigger('cart_widget_refreshed');

                    // Trigger event so themes can refresh other areas
                    $('body').trigger( 'added_to_cart', [ fragments, cart_hash ] );
                }
            });

            return false;

        } else {
            return true;
        }

    });

    // **********************************************************************//
    // ! AJAX Quick View
    // **********************************************************************//


    $(document.body).on('click', '.show-quickly, .show-quickly-btn', (function() {
        var $thisbutton = $(this);
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
                $thisbutton.parent().parent().addClass('loading');
                $thisbutton.after('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
            },
            complete: function() {
                $thisbutton.parent().find('#floatingCirclesG').remove();
                $thisbutton.parent().parent().removeClass('loading');
            },
            success: function(response){

                $.magnificPopup.open({
                    items: { src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">' + response + '</div></div>' },
                    type: 'inline',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = 'mfp-zoom-in-to-left-out';
                        }
                    }
                }, 0);

                $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

                $(function() {
                    $('.variations_form').wc_variation_form();
                    $('.variations_form .variations select').change();
                    et_bind_variations_form();
                });
                $('.images').addClass('shown');
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

        if(!currTab.hasClass('closed-tabs')) {
            currTab.find('.tab-title').first().addClass('opened').next().show();
        }

        currTab.find('.tab-title, .tab-title-left').click(function(e){

            e.preventDefault();

            var tabId = $(this).attr('id');

            if($(this).hasClass('opened')){
                if(currTab.hasClass('accordion') || $(window).width() < 767){
                    $(this).removeClass('opened');
                    $('#content_'+tabId).hide();
                }
            }else{
                currTab.find('.tab-title, .tab-title-left').each(function(){
                    var tabId = $(this).attr('id');
                    $(this).removeClass('opened');
                    $('#content_'+tabId).hide();
                });


                if(currTab.hasClass('accordion') || $(window).width() < 767){
                    $('#content_'+tabId).removeClass('tab-content').show();
                    setTimeout(function(){
                        $('#content_'+tabId).addClass('tab-content').show(); // Fix it
                    },1);
                } else {
                    $('#content_'+tabId).show();
                }
                $(this).addClass('opened');
            }
        });
    });



    /*
    * Variations images changes
    * to make it work properly comment in woocommerce/assets/js/frontend/add-to-cart-variation.js
    * this.unbind( 'check_variations update_variation_values found_variation' );
    */

    function et_bind_variations_form() {
        $('form.variations_form').on( 'found_variation', function( event, variation ) {
            var $variation_form = $(this);
            var $product        = $(this).closest( '.product' );
            var $product_img    = $product.find( 'a#main-zoom-image img:eq(0)' );
            var $product_link   = $product.find( 'a#main-zoom-image' );

            $product_link.attr('data-o_href',$product_link.attr('href'));

            var o_src           = $product_img.attr('data-o_src');
            var o_title         = $product_img.attr('data-o_title');
            var o_href          = $product_link.attr('data-o_href');

            var variation_image = variation.image_src;
            var variation_link = variation.image_link;
            var variation_title = variation.image_title;

            $('.woocommerce-main-image').attr('href', variation_image);

            if ($('.main-image-slider').hasClass('zoom-enabled')) {
                if($(window).width() > 768 && variation_image.length > 5 && variation_link.length > 5){
                    $('a#main-zoom-image').swinxyzoom('load', variation_image,  variation_link);
                }

                $('a#main-zoom-image').attr('href', variation_link);

                //$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
            } else{

                $('a#main-zoom-image').attr('href', variation_link);

                //$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
            }

        })
        // Reset product image
        .on( 'reset_image', function( event ) {


            var $product        = $(this).closest( '.product' );
            var $product_img    = $product.find( 'a#main-zoom-image img:eq(0)' );
            var $product_link   = $product.find( 'a#main-zoom-image' );

            var o_src           = $product_img.attr('data-o_src');
            var o_href          = $product_link.attr('data-o_href');

            $('.woocommerce-main-image').attr('href', o_href);

            if ($('.main-image-slider').hasClass('zoom-enabled')) {
                if(typeof o_src != 'undefined' && typeof o_href != 'undefined') {
                    if($(window).width() > 768 && o_src.length > 5 && o_href.length > 5){
                        $('a#main-zoom-image').swinxyzoom('load', o_src,  o_href);
                    }

                    $('a#main-zoom-image').attr('href', o_href);
                }

                //$('.product-thumbnails-slider li:eq(0) img').attr('src', o_src);
            } else{
                $('a#main-zoom-image').attr('href', o_href);

                //$('.product-thumbnails-slider li:eq(0) img').attr('src', o_src);
            }


        } );

        $( '.variations_form .variations select' ).change();
    }

    et_bind_variations_form();


    // **********************************************************************//
    // ! Categories Accordion
    // **********************************************************************//

    var plusIcon = '+';
    var minusIcon = '&ndash;';
    if(catsAccordion) {
        var etCats = $('.product-categories');
        var openerHTML = '<div class="open-this">'+plusIcon+'</div>';

        etCats.find('>li').has('.children').has('li').addClass('parent-level0').prepend(openerHTML);

        if($('.current-cat.parent-level0, .current-cat, .current-cat-parent').length > 0) {
            $('.current-cat.parent-level0, .current-cat-parent').find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
        } else {
            etCats.find('>li').first().find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
        }

        etCats.find('.open-this').click(function() {
            if($(this).parent().hasClass('opened')) {
                $(this).html(plusIcon).parent().removeClass('opened').find('ul.children').slideUp(200);
            }else {
                $(this).html(minusIcon).parent().addClass('opened').find('ul.children').slideDown(200);
            }
        });
    }

    // **********************************************************************//
    // ! Toggle elements
    // **********************************************************************//


    var etoggle = $('.toggle-block');
    var etoggleEl = etoggle.find('.toggle-element');


    //etoggleEl.first().addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').show();

    etoggleEl.find('.toggle-title').click(function(e) {
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

    var navList = $('.mobile-nav div > ul');
    var etOpener = '<span class="open-child">(open)</span>';
    navList.addClass('et-mobile-menu');

    navList.find('li:has(ul)',this).each(function() {
        $(this).prepend(etOpener);
    })

    navList.find('.open-child').click(function(){
        if ($(this).parent().hasClass('over')) {
            $(this).parent().removeClass('over').find('>ul').slideUp(200);
        }else{
            $(this).parent().parent().find('>li.over').removeClass('over').find('>ul').slideUp(200);
            $(this).parent().addClass('over').find('>ul').slideDown(200);
        }
    });

    $('.menu-icon, .close-mobile-nav').click(function(event) {
        if(!$('body').hasClass('mobile-nav-shown')) {
            $('body').addClass('mobile-nav-shown', function() {
                // Hide search input on click
                setTimeout(function(){
                    $(document).one("click",function(e) {
                        var target = e.target;
                        if (!$(target).is('.mobile-nav') && !$(target).parents().is('.mobile-nav')) {

                                    $('body').removeClass('mobile-nav-shown');
                        }
                    });
                }, 111);
            });



        } else{
            $('body').removeClass('mobile-nav-shown');
        }
    });

    // **********************************************************************//
    // ! Side Block
    // **********************************************************************//

    $('.side-area-icon, .close-side-area').click(function(event) {
        if(!$('body').hasClass('shown-side-area')) {
            $('body').addClass('shown-side-area', function() {
                // Hide search input on click
                setTimeout(function(){
                    $(document).one("click",function(e) {
                        var target = e.target;
                        if (!$(target).is('.side-area') && !$(target).parents().is('.side-area')) {
                            $('body').removeClass('shown-side-area');
                        }
                    });
                }, 111);
            });
        } else{
            $('body').removeClass('shown-side-area');
        }
    });


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

    $('.parallax .banner-bg').each(function(){
        $(this).parallax('50%',0.05);
    });


    if($(window).width() > 767) {
        $('.parallax-section').each(function(){
            var speed = 0.1;
            if($(this).data('parallax-speed') != '') {
                speed = $(this).data('parallax-speed');
            }
            $(this).parallax('50%', speed);
        });
    }


}); // document ready


/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function( $ ){
    var $window = $(window);
    var windowHeight = $window.height();

    $window.resize(function () {
        windowHeight = $window.height();
    });

    $.fn.parallax = function(xpos, speedFactor, outerHeight) {
        var $this = $(this);
        var getHeight;
        var firstTop;
        var paddingTop = 0;


        //get the starting position of each element to have parallax applied to it
        $this.each(function(){
            firstTop = $this.offset().top;
        });

        if (outerHeight) {
            getHeight = function(jqo) {
                return jqo.outerHeight(true);
            };
        } else {
            getHeight = function(jqo) {
                return jqo.height();
            };
        }

        // setup defaults if arguments aren't specified
        if (arguments.length < 1 || xpos === null) xpos = "50%";
        if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
        if (arguments.length < 3 || outerHeight === null) outerHeight = true;

        // function to be called whenever the window is scrolled or resized
        function update(){
            var pos = $window.scrollTop();

            $this.each(function(){
                var $element = $(this);
                var top = $element.offset().top;
                var height = getHeight($element);
                var viewportBottom = pos + windowHeight;

                // Check if totally above or totally below viewport
                if (top + height < pos || top > viewportBottom) {
                    return;
                }


                //$this.css('backgroundPosition', xpos + " " + Math.round((top - viewportBottom) * speedFactor) + "px");
                $this.style('background-position', xpos + " " + Math.round((top - viewportBottom) * speedFactor) + "px", 'important');
            });
        }

        $window.bind('scroll', update).resize(update);
        update();
    };
});

(function($) {
  if ($.fn.style) {
    return;
  }

  // Escape regex chars with \
  var escape = function(text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
  };

  // For those who need them (< IE 9), add support for CSS functions
  var isStyleFuncSupported = !!CSSStyleDeclaration.prototype.getPropertyValue;
  if (!isStyleFuncSupported) {
    CSSStyleDeclaration.prototype.getPropertyValue = function(a) {
      return this.getAttribute(a);
    };
    CSSStyleDeclaration.prototype.setProperty = function(styleName, value, priority) {
      this.setAttribute(styleName, value);
      var priority = typeof priority != 'undefined' ? priority : '';
      if (priority != '') {
        // Add priority manually
        var rule = new RegExp(escape(styleName) + '\\s*:\\s*' + escape(value) +
            '(\\s*;)?', 'gmi');
        this.cssText =
            this.cssText.replace(rule, styleName + ': ' + value + ' !' + priority + ';');
      }
    };
    CSSStyleDeclaration.prototype.removeProperty = function(a) {
      return this.removeAttribute(a);
    };
    CSSStyleDeclaration.prototype.getPropertyPriority = function(styleName) {
      var rule = new RegExp(escape(styleName) + '\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?',
          'gmi');
      return rule.test(this.cssText) ? 'important' : '';
    }
  }

  // The style function
  $.fn.style = function(styleName, value, priority) {
    // DOM node
    var node = this.get(0);
    // Ensure we have a DOM node
    if (typeof node == 'undefined') {
      return;
    }
    // CSSStyleDeclaration
    var style = this.get(0).style;
    // Getter/Setter
    if (typeof styleName != 'undefined') {
      if (typeof value != 'undefined') {
        // Set style property
        priority = typeof priority != 'undefined' ? priority : '';
        style.setProperty(styleName, value, priority);
      } else {
        // Get style property
        return style.getPropertyValue(styleName);
      }
    } else {
      // Get CSSStyleDeclaration
      return style;
    }
  };

// Quantity buttons
    $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

    $( document ).on( 'click', '.plus, .minus', function() {

        // Get values
        var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger( 'change' );

    });

})(jQuery);