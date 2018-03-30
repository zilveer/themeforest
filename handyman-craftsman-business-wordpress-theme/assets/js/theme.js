/**
 * Main JS file
 *
 * Contents
 *
 *  1 - Screen height matching
 *  1.1 - Set color scheme
 *  2 - Container padding for header fixed
 *  3 - Iframe blink fix
 *  4 - Mobile navigation
 *  5 - Anchor scrolling
 *  6 - Offsite sidebar Toggles
 *  7 - Sticky header
 *  8 - Sticky Main navigation
 *  9 - Sticky Phone for mobile devices
 * 10 - Animations
 * 11 - FitVids resposive video embeds
 * 12 - Forms
 * 13 - Popup dialog
 * 14 - Pretty photo
 * 15 - Helper functions
 */

// Defined here to have global scope
var TL_GLOBAL = {};

/* -------------------------------------------------------------------------------------------- */
/* ------------------------------- Swiper Height Matching Functions ------------------------- */
/* -------------------------------------------------------------------------------------------- */

/**
 * This should have global scope and is used by parent theme. With that said it must sit HERE!
 * @param s
 */
function layers_swiper_resize( s ){

    var height = 0;
    var slide_height = 0;

    s.slides.each(function( key, slide ){

        var slide_height = jQuery(slide).find( '.container' ).outerHeight();
        if ( jQuery(slide).find( '.content' ).outerHeight() ) slide_height += jQuery(slide).find( '.content' ).outerHeight();
        if ( jQuery(slide).find( '.content' ).height() ) slide_height -= jQuery(slide).find( '.content' ).height();

        if( height < slide_height ){
            height = slide_height;
        }
    });

    s.container.css({height: height+'px'});
}


jQuery(function ($) {
    "use strict";

    /* Global vars */
    var is_mobile_device = $("html").hasClass('mobile');
    var is_small_screen;

    if (tl_check_small_screen()) {
        is_small_screen = true;
    }

    if(is_mobile_device){
        if(is_small_screen){
            // Screen is too small for filters.... create carousel!
            $("html").addClass('small-touch-device');
            $("html").removeClass('touch-device');
        }else{
            $("html").addClass('touch-device')
            $("html").removeClass('small-touch-device')
        }
    }

    $(window).on('load resize', function () {
        is_small_screen = tl_check_small_screen();

        if(is_mobile_device){
            if(is_small_screen){
                // Screen is too small for filters.... create carousel!
                $("html").addClass('small-touch-device');
                $("html").removeClass('touch-device');
            }else{
                $("html").addClass('touch-device')
                $("html").removeClass('small-touch-device')
            }
        }
    });


    TL_GLOBAL.tl_trigger_complete_iframe = function () {
        $(".mfp-iframe").addClass("loaded-content");
        $(".mfp-preloader").css("display", "none");
    }

    /* -------------------------------------------------------------------------------------------- */
    /* --------------------------------------- Screen Height Matching ----------------------------- */
    /* -------------------------------------------------------------------------------------------- */

    $(window).resize(function () {
         tl_layers_match_to_screen_height();
    });

    tl_layers_match_to_screen_height();

    function tl_layers_match_to_screen_height() {

        var h = $(window).height();

        if($("html").hasClass("phone")){
                $('.full-screen').css('min-height', h);
                $('.full-screen').find('.swiper-slide .overlay').css('min-height', h);
        }else{
          $('.full-screen').css('height', h);
          $('.full-screen').find('.swiper-slide .overlay').css('height', h);
       }
    }


    /* -------------------------------------------------------------------------------------------- */
    /* ------------------------------- Container padding for header fixed ------------------------- */
    /* -------------------------------------------------------------------------------------------- */

    $(window).on('resize', function () {
        tl_layers_apply_overlay_header_styles();
    });


    $("body").on("tl_page_loaded", function(){
        tl_layers_apply_overlay_header_styles();
    });



    /**
     * Pad the entire site to compensate for overlay header
     */
    function tl_layers_apply_overlay_header_styles() {

        // Get header.
        var $header = jQuery( '.header-site' );

        // Get content wrapper.
        var $content_wrapper = jQuery( '#wrapper-content' );

        if( $header.hasClass( 'header-overlay' ) ) {

            // Get first element.
            var $first_element = $content_wrapper.children().eq(0);


            if( $first_element.hasClass( 'slide' ) ) {

                // First item/widget in the page content is Slider!

                // Reset previous incase this is being re-aplied due to window resize.
                $first_element.find('.swiper-slide > .content' ).css('padding-top', '' );

                var padding_top = $first_element.find('.swiper-slide > .content' ).eq(0).css('padding-top').replace('px', '');
                //padding_top = ( '' != padding_top ) ? parseInt( padding_top ) : 0 ;
                var phone_height = tl_check_small_screen()? 72 : 0;

                padding_top = $header.height() + phone_height;

                // First element is Slider Widget.
                $first_element.find('.swiper-slide > .content').css({ 'paddingTop': padding_top });

                jQuery('body').addClass( 'header-overlay-no-push' );
            }
            else if( $first_element.hasClass('title-container') ) {

                // Reset previous incase this is being re-aplied due to window resize.
                $first_element.css( 'padding-top', '' );

                var padding_top = $first_element.css('padding-top').replace('px', '');
                padding_top = ( '' != padding_top ) ? parseInt( padding_top ) : 0 ;

                var phone_gap = 0
                if($('.header-contact.phone-for-mobile').length && $('.header-contact.phone-for-mobile').css('display') != 'none'){
                    phone_gap = $header.find('.header-contact.phone-for-mobile').outerHeight();
                    $('.header-contact.phone-for-mobile').addClass('white-text');
                }
                // First element is Title (eg WooCommerce).
                $first_element.css({ 'paddingTop': $header.outerHeight() + padding_top + phone_gap });
                jQuery('body').addClass( 'header-overlay-no-push' );
            }
            else{

                // Reset previous incase this is being re-aplied due to window resize.
                $content_wrapper.css('padding-top', '' );

                var padding_top = $content_wrapper.css('padding-top').replace('px', '');
                padding_top = ( '' != padding_top ) ? parseInt( padding_top ) : 0 ;

                // Pad the site to compensate for overlay header.
                $content_wrapper.css( 'paddingTop', $header.outerHeight() + padding_top );
            }
        }
    }


    /**
     * 6 - Layers Custom Easing
     *
     * Extend jQuery easing with custom Layers easing function for UI animations - eg slideUp, slideDown
     */

    jQuery.extend( jQuery.easing, { layersEaseInOut: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t + b;
        return -c/2 * ((--t)*(t-2) - 1) + b;
    }});


    /* -------------------------------------------------------------------------------------------- */
    /* -------------------------------------- Iframe blink fix ------------------------------------ */
    /* -------------------------------------------------------------------------------------------- */
    tl_iframe_blink_fix();


    /* -------------------------------------------------------------------------------------------- */
    /* ------------------------------------- Mobile navigation ------------------------------------ */
    /* -------------------------------------------------------------------------------------------- */

    /* Collapse mobile navigation after click */
    $(".nav-mobile ul.menu > li a[href^='#']").on("click", function (e) {
        $(this).parents(".wrapper.open[class*='off-canvas']").find(".close-canvas").click();
    });


    /* --------------------------------------------------------------------------------------------- */
    /* -------------------------------------------- SCROLL ----------------------------------------- */
    /* --------------------------------------------------------------------------------------------- */

    $(document).on("click", 'a[href^="#"]', function (e) {

        e.preventDefault();

        var $this = $(this);
        var $hash = $this.attr("href");

        /**
         * Bugfix. Layers wp generates "#layers-widget-WIDGET_NAME" id at front BUT
         * in administration panel it is "#widget-layers-widget-WIDGET_NAME"
         */
        if($($hash).length == 0){
            $hash = $hash.replace("#widget-", "#");
        }

        if ($($hash).length > 0) {
            $(window).scrollTo($hash, 1500, {easing: 'easeOutExpo',offset:-100});
        } else {
            if (!$("body").hasClass("home")) {
                window.location.href = TL_CONF.baseurl + "/" + $hash;
            }
        }
    });



    /* ---------------------------------------------------------------------------------------------- */
    /* -------------------------------------- Offsite sidebar Toggles ------------------------------- */
    /* ---------------------------------------------------------------------------------------------- */

    $(document).on('click', '[data-toggle^="#"]', function (e) {
        e.preventDefault();
        var $that = $(this);
        var $target = $that.data('toggle');
        $($target).toggleClass($that.data('toggle-class'));

    });


    /* ---------------------------------------------------------------------------------------------- */
    /* ------------------------------------------ Sticky Header ------------------------------------- */
    /* ---------------------------------------------------------------------------------------------- */

    // Set site header element
    var $header_sticky = $("section.header-sticky");

    /**
     *  Handle scroll passing the go-sticky position.
     *
     *  Minimize Header
     */
    $("body").waypoint({
        offset: $header_sticky.outerHeight() * (-1), // Height of header with logo
        handler: function (direction) {
            if ('down' == direction) {
                //if (!is_small_screen) { // We need this check because "Sticky-kit v1.1.1" breaks staff for small devices
                    $header_sticky.stick_in_parent({parent: 'body'});
               // }
                // Clear previous timeout to avoid duplicates.
                clearTimeout($header_sticky.data('timeout'));
                // Show header miliseconds later so we can css animate in.
                $header_sticky.data('timeout', setTimeout(function () {
                    $header_sticky.addClass('is_stuck_show');
                }, '10'));
            }

        }
    });
    // Handle scroll arriving at page top.
    $("body").waypoint({
        offset: -127,
        handler: function (direction) {
            if ('up' == direction) {
                // Clear previous timeout to avoid late events.
                clearTimeout($header_sticky.data('timeout'));

                // Detach the header
                $header_sticky.removeClass('is_stuck_show');
                $header_sticky.trigger("sticky_kit:detach");

                if($header_sticky.length > 0){ // minimized header height

                    var $phone_gap = is_mobile_device ? $header_sticky.find('.header-contact.phone-for-mobile').outerHeight() : 0;

                    $(".title-container").css("padding-top", $header_sticky.height()+ $phone_gap);

                    var $content_wrapper = jQuery( '#wrapper-content' );
                    // Get first element.
                    var $first_element = $content_wrapper.children().eq(0);

                    if( $first_element.hasClass( 'slide' ) ) {
                        $first_element.find('.swiper-slide > .content').css({ 'paddingTop': $header_sticky.height() + $phone_gap });
                    }
                }
            }
        }
    });


    /* ------------------------------------------------------------------------------------------------ */
    /* ------------------------------------- Navigation ----------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------ */

    if(TL_CONF.is_popup == 0){
        // Initialize FlexNav
        var $main_nav_sticky = tl_get_main_navigation();

        $main_nav_sticky.find(".flexnav").flexNav({
            "hoverIntent": true,
            'animationSpeed':100,
            'hoverIntentTimeout':100
        });

        $(".header-site .flexnav").flexNav({
            "hoverIntent": true,
            'animationSpeed':100,
            'hoverIntentTimeout':100
        });
    }


    function tl_get_main_navigation(){
        /**
         * Main navigation can be wrapper in two containers
         */
        var $navs = $(".wrapper-content div.widget_nav_menu");
        return $navs.filter(function(){
            return ($(this).parents(".sidebar").length == 0);
        });

        return $navs;
    }


    $("body").on("tl_page_loaded", function(){
        tl_sticky_navigation_calc();
    });



    function tl_sticky_navigation_calc(){

        /**
         * Content Wrapper
         */
        var $content = $("#wrapper-content");

        /**
         *  First element in content wrapper
         */
        var $first_element = $content.children().eq(0);

        /*
        * Reference to the slider in page content
        */
        var $main_nav_sticky = tl_get_main_navigation();

        // Add active class if menu item clicked
        $main_nav_sticky.find(".menu-item > a").on("click", function(e){
            // Remove marked menu item if any
            $(".menu-item > a").parent().removeClass("active");
            $(".menu-item > a[href='" + $(this).attr("href") + "']").parent().addClass("active")
        });

        /*
        * Point where main navigation become sticky and smaller
        * */
        var menu_transform_point = 0;

        if( $first_element.hasClass( 'slide' ) ) { // Slider
            menu_transform_point = -($first_element.height());
        }else if( $first_element.hasClass('title-container') ) { // static page with static header
            menu_transform_point = -($first_element.outerHeight()+127);
        }else if($first_element.hasClass("widget_nav_menu")){
            // Navigaion is first widget
            menu_transform_point = -275;
        }

        if($header_sticky.length > 0){ // minimized header height
            menu_transform_point += 72;//$header_sticky.height();
        }

        menu_transform_point = menu_transform_point - ($(".header-site:not(.header-overlay)").height() - $main_nav_sticky.height());

        /*
         *   Handle main navigation if any.
         *   When main navigation riches page's top border stick to it.
         */
        $("body").waypoint({
            offset: menu_transform_point,
            handler: function (direction) {

                setTimeout( function(){

                    if ('down' == direction) {
                        if (!is_small_screen) { // We need this check because "Sticky-kit v1.1.1" breaks staff for small devices
                            var admin_bar_h = 0;
                            if($("body").hasClass('has-admin-bar')){
                                admin_bar_h = 32;
                            }
                            // Sticky header height + admin bar
                            $main_nav_sticky.stick_in_parent({parent: 'body', 'offset_top': $header_sticky.height() + admin_bar_h});
                        }
                        // Clear previous timeout to avoid duplicates.
                        clearTimeout($main_nav_sticky.data('timeout'));
                        // Show header miliseconds later so we can css animate in.
                        $main_nav_sticky.data('timeout', setTimeout(function () {
                            $main_nav_sticky.addClass('is_stuck_show');
                        }, '10'));
                    }else if('up' == direction){ // // Handle scroll arriving at page top.
                        // Clear previous timeout to avoid late events.
                        clearTimeout($main_nav_sticky.data('timeout'));
                        // Detach the header
                        $main_nav_sticky.removeClass('is_stuck_show');

                        if($("html").hasClass("ie9") || $("html").hasClass("ie8")){
                            $main_nav_sticky.trigger("sticky_kit:detach");
                        }else{
                            if (!is_small_screen) {
                                $main_nav_sticky.trigger("sticky_kit:detach");
                            }
                        }
                    }
                }, 100 );
            }
        });
    } //tl_sticky_navigation_calc



    /* -------------------------------------------------------------------------------------------- */
    /* ----------------------------- Sticky Phone number for mobile device ------------------------ */
    /* -------------------------------------------------------------------------------------------- */


    /**
     * Phone number related to mobile devices
     */
    var $phone_sticky = $(".phone-for-mobile");
    $("body").waypoint({
        offset: -50,
        handler: function (direction) {
            if ('down' == direction) {
                if(is_small_screen){ // less then 769
                    $phone_sticky.removeClass("zoomIn").css("display", "none");
                }else{
                    $phone_sticky.removeClass("zoomIn").addClass("animated zoomOut");
                    setTimeout(function () {
                        $phone_sticky.css("opacity", 0);
                        $phone_sticky.css("left", "-9999px");
                    }, 200);
                }
            }
        }
    });
    // Handle scroll arriving at page top.
    $("body").waypoint({
        offset: -1,
        handler: function (direction) {
            if ('up' == direction) {
                if (is_small_screen) {
                    $phone_sticky.css("opacity", 1);
                    $phone_sticky.css("left", 0);
                    $phone_sticky.removeClass('zoomOut').css("display", "block");
                }
            }
        }
    });


    /* --------------------------------------------------------------------------------------- */
    /* ---------------------------------------- ANIMATIONS ----------------------------------- */
    /* --------------------------------------------------------------------------------------- */

    // Set animations before removing  loading animation
    $("body").on("pre_tl_page_loaded", function (e) {

        if(!$("html").hasClass("ie8") && !$("html").hasClass("ie9") && !$("html").hasClass("phone")){

            var headings = $(".section-title .heading").not(".swiper-wrapper .section-title .heading");

            // Main headings animations
            tl_elements_animations_init(headings);
            tl_elements_animations(headings, 'zoomIn', '0.2s');

            var containers = $(".widget.row > .container");

            tl_elements_animations_init(containers);
            tl_elements_animations(containers, 'fadeIn', '0.1s');

            if((!$("body").hasClass("home")) || ($("body").hasClass("home")&&$("body").hasClass("blog"))){
                //Inner pages
                // Sidebar
                tl_elements_animations_init($(".sidebar aside"));
                tl_elements_animations($(".sidebar aside"), 'zoomIn', '0.2s');

                // Main content
                if($(".content-main .row > .column > *").length > 0){
                    tl_elements_animations_init($(".content-main .row > .column > *"));
                    tl_elements_animations($(".content-main .row > .column > *"), 'zoomIn', '0.2s');
                }else{
                    tl_elements_animations_init($(".content-main > .column > *"));
                    tl_elements_animations($(".content-main > .column > *"), 'zoomIn', '0.2s');
                }
            }else{
                // Blogtips
                tl_elements_animations_init($(".blogtips .post-list > article"));
                tl_elements_animations($(".blogtips .post-list > article"), 'zoomIn', '0.2s');
            }
        }
    });


    /* ----------------------------------------------------------------------------- */
    /* ----------------------- FitVids resposive video embeds. --------------------- */
    /* ----------------------------------------------------------------------------- */
    $(".media-image, .thumbnail-media, .thumbnail, .widget.slide .image-container").fitVids();


    /* ----------------------------------------------------------------------------- */
    /* ----------------------------------- FORMS ----------------------------------- */
    /* ----------------------------------------------------------------------------- */

    // Small tweek for form7 plugin. Add class to a field wrapper if field is required
    $('.wpcf7-form-control-wrap > :input[aria-required="true"]').parent().addClass('required');



    // Submit contact forms
    $("a.submit.button").on("click", function(e){
        e.preventDefault();
        $(this).parent().find("input[type='submit']").trigger("click");
    });


    /* Some HTML forms ex. forms in third party widgets has submit button that can nOT be
     *  stylized in proper way. So we hide them and add our button :D
     *
     *  Jetpack subscription button replacement
     */

    // Submit contact forms
    $(window).on("load", function(e){
        var jetpack_btn = $("input[name='jetpack_subscriptions_widget']");
            jetpack_btn.hide();

        var a = $("<a/>",{}).html(jetpack_btn.val());
        a.addClass("button");
        a.attr("href", "")

        a.append('<i class="icon-ti-angle-double-right"></i>');

        a.on("click", function(e){
            e.preventDefault();
            jetpack_btn.trigger("click");
        });
        jetpack_btn.before(a);
    });



    /* ----------------------------------------------------------------------------- */
    /* -------------------------------- POPUP WINDOW ------------------------------- */
    /* ----------------------------------------------------------------------------- */

    $("body").on("tl_portfolio_swiper_complete", function(){
        tl_do_magnific_popup($(".tl-portfolio-widget .ajax-popup-link[data-id]"));
    });

    // Close button
    $("body").on("click", "a.imfp-close", function(e){
        e.preventDefault();
        $.magnificPopup.close();
    });

    // Loading content to a popup
    var post_id = null;
    $("body").on("click", ".ajax-popup-link[data-id]", function(e){
        e.preventDefault();
    });



    /**
     * @returns {string}
     */
    function tl_generateHeight(){
        if($("html").hasClass("iphone")){
            return "height:" + tl_calculateIframeHeight() + "px;";
        }else{
            return "height:" + tl_calculateIframeHeight() + "px;";
        }
    }



    /**
     * Popup Window
     *
     * @param $links
     */
    function tl_do_magnific_popup($links){

        if($links.length == 0) return;

        var section_title = '';
        if(!is_mobile_device){
           section_title = ' animated slideInRight ';
        }

        var tl_window_height = tl_generateHeight();
        var popup_footer ='';

        if(!TL_CONF.contact.popup_hide_footer)
        {
            popup_footer ='<footer><div class="header-contact"><ul>';

            if(!TL_CONF.contact.popup_hide_btn){
                popup_footer = popup_footer +  '<li><a href="' + TL_CONF.contact.btn_link + '" class="button request-handyman close-popup-with-action">'+ TL_CONF.contact.btn_label +'</a></li>' +
                                               '<li class="text"> ' + TL_CONF.contact.or + ' </li>';
            }

            popup_footer = popup_footer + '<li class="text-slogan">' + TL_CONF.contact.txt1 + '</li>' +
                                            '<li><i class="fa fa-phone"></i></li>' +
                                            '<li class="phonedigits">' + TL_CONF.contact.fphone + '</li>' +
                                            '</ul></div>' +
                                            '</footer>';
        }


        var $popup_markup = '<section class="popup-content-wrapper white-popup mfp-with-anim">' +
                                '<div class="popup-header"><a class="imfp-close icon-ti-close"></a></div>' +
                                    '<article class="popup-inner-content">' +
                                        '<header class="section-title ' + section_title + ' "><h3 class="heading"></h3></header>' +
                                            '<div class="tl_service story"><iframe style="' + tl_window_height + '" class="mfp-iframe"></iframe></div>' +
                                    '</article>' +
                                    popup_footer +
                            '</section>'

        $links.magnificPopup({
            removalDelay: 300,
            fixedContentPos:true,
            type: 'iframe',
            mainClass: 'mfp-zoom-in',
            tLoading : '',
            callbacks: {
                beforeOpen: function () {
                    if(this.st.el.attr('data-effect')){
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
                markupParse: function(template, values, item) {
                    // optionally apply your own logic - modify "template" element based on data in "values"
                    $(template).find("h3").html($(item.el).data('title'));
                }
            },
            iframe: {
                markup: $popup_markup,
                patterns: {
                    ajax: {
                        index: TL_CONF.baseurl, // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                        id: null, // String that splits URL in a two parts, second part should be %id%
                        src: '%id%?tl_popup=1' // URL that will be set as a source for iframe.
                    }
                }
            }
        });
    }

    // -- Apply popup to all links except portfolio links in case of mobile phones
    tl_do_magnific_popup($('.ajax-popup-link[data-id]').filter(function(index){
         return (!is_small_screen || $(this).parents(".tl-portfolio-widget").length == 0)
    }));



    // -- Button inside popup window
    $(document).on("click", ".button.request-handyman", function (e) {
     $("a.imfp-close").trigger("click");
    });



      /* ---------------------------------------------------------------------------- */
    /* ----------------------------- Placeholder ---------------------------------- */
    /* ---------------------------------------------------------------------------- */

    $('input[placeholder]').floatlabel({
            labelStartTop: "20px",
            labelEndTop: "0px",
            paddingOffset: "0px"
    });



    /* ---------------------------------------------------------------------------- */
    /* ---------------------------- Pretty Photo ---------------------------------- */
    /* ---------------------------------------------------------------------------- */

    if (!(is_mobile_device) && $.fn.prettyPhoto) {
        $("a[class^='pretty-photo']").prettyPhoto({
            changepicturecallback: function () {
                // Removes social icons
                $('.twitter').empty();
                $('.facebook').empty();
            }
        });
    }


    /* ----------------------------------------------------------------------------- */
    /* -------------------------------- SOCIAL SHARER ------------------------------ */
    /* ----------------------------------------------------------------------------- */

    $(".social-share a").on("click", function(e){
        e.preventDefault();
        var $that = $(this);
        var type = $that.data('type');
        var href = $that.attr('href');

        window.open(href, 'Sharer', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });


    /* ------------------------------------------------------------------------------ */
    /* ----------------------------- COMMENT FORM SUBMIT ---------------------------- */
    /* ------------------------------------------------------------------------------ */

    $(".send-comment-fake").on("click", function(e){
        e.preventDefault();
        $(".form-submit > .submit").trigger("click");
    });


    /* ------------------------------------------------------------------------------ */
    /* -------------------------- GOOGLE MAP ---------------------------------------- */
    /* ------------------------------------------------------------------------------ */

    $("body").on("setInfobox", function(){
        tl_setInfoBox();
    });

    function tl_setInfoBox(){

        var infobox = '<div><h4 style="font-family: \'Roboto Slab\';text-align: center; padding: 35px 0 15px 0; font-size:2.4rem;">' + TL_CONF.contact.find_us + '</h4><div style="position:relative; text-align:center; background-color: #f5f5f5; padding: 20px 0px 50px 0;">'+
        '<span style="top:0; left:50%; margin-left:-10px; position: absolute; width: 20px; height: 20px; border-top:10px solid #fff;border-left:10px solid transparent;border-right:10px solid transparent;"></span>' +
        '<strong style="font-size: 1.8rem; font-family: Lato; line-height: 36px; ">' + TL_CONF.contact.company + '</strong>'+
        '<p style="font-size: 1.8rem; font-family: Lato; line-height: 36px;color:#888;font-weight: 300;">' + TL_CONF.contact.address + '</p>'+
        '<p style="font-size: 1.8rem; font-family: Lato; line-height: 36px;color:#222527;"><b>T: </b>&nbsp;&nbsp;' + TL_CONF.contact.phone + '</p>'+
        '<p style="font-size: 1.8rem; font-family: Lato; line-height: 36px;color:#222527;"><b>E: </b>&nbsp;&nbsp;' + TL_CONF.contact.email + '</p>'+
        '</div></div>';

        //<img style="position:absolute; bottom:-40px; left:50%;margin-left:-23px;" src="' + TL_CONF.themeurl + '/assets/images/google-marker.png">

        var myOptions = {
            content: infobox
            ,disableAutoPan: false
            ,maxWidth: "360px"
            ,pixelOffset: new google.maps.Size(-180, -375)
            ,zIndex: -1
            ,boxStyle: {
                background: "#fff",
                width: "360px"
            }
            ,closeBoxMargin: "0"
            ,closeBoxURL: ""
            ,infoBoxClearance: new google.maps.Size(0, 10)
            ,isHidden: false
            ,pane: "mapPane"
            ,enableEventPropagation: false
        };

        var ib = new InfoBox(myOptions);
        /**
         * $map && $marker defined in maps.js
         */
        ib.open($tl_map, $tl_marker);
    }


    /* --------------------------------------------------------------------------------- */
    /* ---------------------------------  S W I P E R -------------------------------- */
    /* --------------------------------------------------------------------------------- */

    /**
     * If slider contains only one slide swiper plugin is not applied. Force Swiper in order to calculate
     * swiper's content positions correctly. Only for mobile phones.
     */

     function forceSwiper(){
        if(is_mobile_device){
            var $sliders = $("section.slider-layout-full-screen[id^='layers-widget-slide-']");
            $sliders.each(function(){
                if($(this).find(".swiper-wrapper .swiper-slide").length == 1){
                    $(this).Swiper({mode:"horizontal"});
                    $(this).init();
                }
            });
        }
     }
     forceSwiper();




    /* --------------------------------------------------------------------------------- */
    /* ---------------------------------  H E L P E R S -------------------------------- */
    /* --------------------------------------------------------------------------------- */

    // Animation init
    function tl_elements_animations_init(items, trigger) {
        items.each(function () {
            var osElement = $(this);
            var osTrigger = ( trigger ) ? trigger : osElement;
            osTrigger.addClass('anim-init');
        });
    }


    // -- Animate
    function tl_elements_animations(items, anim_class, anim_delay, trigger) {
        items.each(function () {
            var osElement = $(this),
                osAnimationClass = osElement.attr('data-tl-anim'),
                osAnimationDelay = osElement.attr('data-tl-anim-delay');

            if (anim_class) {
                osAnimationClass = anim_class;
            }
            if (anim_delay) {
                osAnimationDelay = anim_delay;
            }
            osElement.css({
                '-webkit-animation-delay': osAnimationDelay,
                '-moz-animation-delay': osAnimationDelay,
                'animation-delay': osAnimationDelay
            });

            var osTrigger = ( trigger ) ? trigger : osElement;
            osTrigger.waypoint(function (direction) {
                if(direction === 'down' && !osElement.hasClass('animated')){
                    osElement.addClass('animated').addClass(osAnimationClass);

                    setTimeout(function(){
                        osElement.removeClass("anim-init");
                        osElement.removeClass(osAnimationClass);
                    }, 1200);
                }
            },{
                triggerOnce: true,
                offset: "95%"
            });
        });
    }


// -- Screen
    function tl_check_small_screen() {
        return (tl_getViewPortWidth() < 769) ? true : false;
    }
    function tl_getOrientation() {
        return Math.abs(window.orientation) - 90 == 0 ? "landscape" : "portrait";
    }
    function tl_getMobileWidth() {
        return tl_getOrientation() == "landscape" ? screen.availHeight : screen.availWidth;
    }
    function tl_getMobileHeight() {
        return tl_getOrientation() == "landscape" ? screen.availWidth : screen.availHeight;
    }
    function tl_getViewPortWidth() {
        return window.innerWidth;
    }


    /**
     * Thx to Chris Coyier
     * @see https://css-tricks.com/prevent-white-flash-iframe/
     */
    function tl_iframe_blink_fix() {
        /*
         1. Inject CSS which makes iframe invisible
         */
        var div = document.createElement('div'),
            ref = document.getElementsByTagName('base')[0] ||
                document.getElementsByTagName('script')[0];

        div.innerHTML = '&shy;<style> iframe { visibility: hidden; } </style>';
        ref.parentNode.insertBefore(div, ref);

        // Remove garbage ofter iframe loads
        window.onload = function () {
            div.parentNode.removeChild(div);
        }
    }


    function tl_calculateIframeHeight(){

        var screenH;
        var iframe  = $('.popup-inner-content iframe');

        var popup_footer_height = 140;
        var popup_header_height = 137;
        var padding = 12;

        var frame_space = popup_footer_height + popup_header_height + padding;

        if($("html").hasClass("mobile")){

            var orientation =  Math.abs(window.orientation) - 90 == 0 ? "landscape" : "portrait";
            if(orientation == 'landscape'){
                screenH = screen.availWidth
            }else{
                screenH = screen.availHeight
            }
            screenH = screenH - 60;// Adress bar
        }else{
            screenH = $(window).height();
        }

        if($("html").hasClass("phone")) {

            screenH = screenH - frame_space;
            iframe.animate({height: screenH}, 300, "swing");
            return Math.ceil(screenH);
        }else if($("html").hasClass("ipad")){
            screenH = screenH - frame_space -40;
            iframe.animate({height: screenH}, 300, "swing");
            return Math.ceil(screenH);
        }else{
            return Math.ceil(screenH*0.75) - 175;
        }
    }
}(jQuery));