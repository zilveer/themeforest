(function ($) {
    
    $(document).ready(function() {  

// Do not delete above line
/****************************************************************/
/****************************************************************/

$(".fitVids").fitVids();

if(!jQuery('#mc_mv_EMAIL').val()) { 
    jQuery('#mc_mv_EMAIL').attr("placeholder", "Your Email Address");
} 

/***************************************************************
* Main Navigation *
****************************************************************/

function swm_main_navigation() {      

    /* mobile menu show hide ------------------------------------- */

     $('.top_nav').tinyNav({
        active: 'active',  // class name of active link
        header: 'Navigation'  // default display text for dropdown
    });

    $('#mobile_nav_button').click(function () {
        $('ul.mobi-menu').toggleClass("mobile_nav_active");
        
        var menu_icon = $('#mobile_nav_button i');

        if($(menu_icon).hasClass("fa-list-ul")) {        
            $(menu_icon).removeClass("fa-list-ul").addClass("fa-times");
        } else {
            $(menu_icon).removeClass("fa-times").addClass("fa-list-ul");        
        } 
    });

    $('.top_nav > li > a.sf-with-ul').after('<div class="mobile_nav_subarrow"><i class="fa fa-caret-square-o-down"></i></div>');

    $('.mobile_nav_subarrow').click(function () {
      $(this).parent().toggleClass("mobile_sub_menu");
    }); 
  
    /* search box show hide ------------------------------------- */

    $(".search_section").click(function (e) {
        $(".swm_search_box").fadeToggle("fast");
        e.stopImmediatePropagation();

        var search_icon = $('.search_section i');

        if($(search_icon).hasClass("fa-search")) {        
            $(search_icon).removeClass("fa-search").addClass("fa-times");
            $(this).removeClass("sbox_skin").addClass("sbox_dark");            
        } else {
            $(search_icon).removeClass("fa-times").addClass("fa-search");
            $(this).removeClass("sbox_dark").addClass("sbox_skin");      
        }

        $('.isotope-item').toggleClass('isotope-zindex');

    });

    $(".swm_search_box").click(function (e) {
        e.stopImmediatePropagation();
    });

    // logo section toggle responsive menu

    $('.logo_section_toggle').click(function () {
        $('.logo_section_menu').toggleClass("logo_nav_active");        

        var menu_icon = $('.logo_section_btn i');

        if($(menu_icon).hasClass("fa-chevron-down")) {        
            $(menu_icon).removeClass("fa-chevron-down").addClass("fa-chevron-up");
        } else {
            $(menu_icon).removeClass("fa-chevron-up").addClass("fa-chevron-down");        
        } 
    });

    $('.sticky-navigation').waypoint('sticky');

}

swm_main_navigation();

/***************************************************************
* Parallax Background *
****************************************************************/
function swm_parallax_on() {

    var dataParallax = $(".swm_section_prallax").attr("data-parallaxtest"), 
        dataParallaxHeader = $(".swm_headerImage").attr("data-parallaxtest");

    if (/Android|webOS|iPhone|iPad|iPod|pocket|psp|kindle|avantgo|blazer|midori|Tablet|Palm|maemo|plucker|phone|BlackBerry|symbian|IEMobile|mobile|ZuneWP7|Windows Phone|Opera Mini/i.test(navigator.userAgent)) {
                
        $(".swm_section_prallax").css('background-attachment','scroll');               
        $(".swm_headerImage").css('background-attachment','scroll');          

    } else {
        $(".swm_parallax_on").each(function(){
            var scrollSpeed  = $(this).attr("data-bg-scrollSpeed"); 
            $(this).parallax( '50%', scrollSpeed);
        });         

        if ( dataParallax == 'true' ) {                      
            $(".swm_section_prallax").css('background-attachment','fixed');
        }

        if ( dataParallaxHeader == 'true' ) {            
            $(".swm_headerImage").css('background-attachment','fixed');
        }  
    }
     
}

/***************************************************************
* Retina *
****************************************************************/

function swm_retinaRatioCookies() {
    var devicePixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
    if (!$.cookie("pixel_ratio")) {
        if (devicePixelRatio > 1 && navigator.cookieEnabled === true) {
            $.cookie("pixel_ratio", devicePixelRatio, {expires : 360});
            location.reload();
        }
    }
}

/***************************************************************
* Responsive Height *
****************************************************************/

function swm_responsive_height() {  
    $(window).resize(function(){
        $('.swm_headerImage').each(function(){
            var self = $(this),
                old_width = 1199,
                old_height = parseInt(self.attr("data-header-height") || 400),
                new_width = old_width,
                new_height = old_height,
                w_width = $(window).width();
            
            if( w_width <= 1199 ) { new_width = 1000; }
            if( w_width <= 979 ) { new_width = 749; }
            if( w_width <= 767 ) { new_width = 461; }
            if( w_width <= 480 ) { new_width = 301; }

            var ratio =  (new_width / old_width) * old_height;
            new_height = Math.round(ratio);

            $(this).css('max-height',new_height);
            $('.swm_header_content').css('height',new_height);
          
        });
    });
    $(window).trigger('resize');   
} 

/***************************************************************
    * Post Format Gallery *
****************************************************************/

function swm_pf_gallery() { 
    $('.pfi_gallery').imagesLoaded( function() {
        $('.pfi_gallery').flexslider({
            animation: 'fade',
            animationSpeed: 500,
            slideshow: false,
            smoothHeight: false,
            controlNav: true,
            directionNav: true,               
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>'                
        });
    });    
}

/***************************************************************
    * Portfolio Page *
****************************************************************/

function swm_portfolio_items() { 

    $(".swm_portfolio_sort").imagesLoaded( function() {
        $('.swm_portfolio_sort').isotope({
        itemSelector: '.swm_portfolio_isotope',
        masonry: {
            //custom addition
        }
        });
    });

    $('.filter_menu a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.swm_portfolio_sort').isotope({filter: selector});
        $('.filter_menu a.active').removeClass('active');
        $(this).addClass('active');
        return false;
    });

    if ($(window).width() < 768) {
        $('div .swm_horizontal_menu').addClass('h_responsive');
    }

    $(".pf_sort").imagesLoaded( function() {
        $('.pf_sort').isotope({
        itemSelector: '.pf_isotope',
        masonry: {
            //custom addition
        }
        });
    });
}

/***************************************************************
    * Cause Page *
****************************************************************/

function swm_cause_items() { 

    $(".swm_cause_sort").imagesLoaded( function() {
        $('.swm_cause_sort').isotope({
        itemSelector: '.swm_cause_isotope',
        masonry: {
            //custom addition
        }
        });
    });

    $('.filter_menu a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.swm_cause_sort').isotope({filter: selector});
        $('.filter_menu a.active').removeClass('active');
        $(this).addClass('active');
        return false;
    });

    
    $(".cause_sort").imagesLoaded( function() {
        $('.cause_sort').isotope({
        itemSelector: '.cause_isotope',
        masonry: {
            //custom addition
        }
        });
    });
}

/***************************************************************
    * Sermons Page *
****************************************************************/

function swm_sermons_items() { 

    $(".swm_sermons_sort").imagesLoaded( function() {
        $('.swm_sermons_sort').isotope({
        itemSelector: '.swm_sermons_isotope',
        masonry: {
            //custom addition
        }
        });
    });

    $('.filter_menu a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.swm_sermons_sort').isotope({filter: selector});
        $('.filter_menu a.active').removeClass('active');
        $(this).addClass('active');
        return false;
    });

    
    $(".sermons_sort").imagesLoaded( function() {
        $('.sermons_sort').isotope({
        itemSelector: '.sermons_isotope',
        masonry: {
            //custom addition
        }
        });
    });
}

/***************************************************************
    * Testimonials Page *
****************************************************************/
function swm_testimonials_items() { 
    $(".testimonials_sort").imagesLoaded( function() {
        $('.testimonials_sort').isotope({
        itemSelector: '.testimonials_isotope',
        masonry: {
            //custom addition
        }
        });
    });   

    $('.filter_menu a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.testimonials_sort').isotope({filter: selector});
        $('.filter_menu a.active').removeClass('active');
        $(this).addClass('active');
        return false;
    });     
}

/***************************************************************
* Auto Lightbox *
****************************************************************/

(function($)
{
    $.fn.swm_auto_lightbox = function(variables)
    {
        var defaults = {
            lightboxSelectors: 'a[data-rel^="prettyPhoto"],a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com/watch"] , a[href*="screenr.com"]'
        };

        var options = $.extend(defaults, variables),
            win             = $(window),
            windowWidth     = parseInt(win.width(),10) * 0.8, //lightbox width
            windowHeight    = (windowWidth/16)*9;  // lightbox height

        return this.each(function() {

            var elements = $(options.lightboxSelectors, this),
                lastParent = "",
                counter = 0;

            elements.each(function() {
                var el = $(this),
                    rel = el.data('rel'),
                    getParent = el.parents('.swm_container:eq(0)'),
                    imgGallery = 'img_gallery';

                if(getParent.get(0) != lastParent) {
                    lastParent = getParent.get(0);
                    counter ++;
                }

                if(rel !== "" && typeof rel !== 'undefined') {
                    el.attr('rel','lightbox['+rel+']');
                }

                if((el.attr('rel') === undefined || el.attr('rel') === '')) {
                    if(elements.length > 1) {
                        el.attr('rel','lightbox['+imgGallery+counter+']');
                    } else {
                        el.attr('rel','lightbox');
                    }
                }
            });           

            if($.fn.prettyPhoto) {
                elements.prettyPhoto({ social_tools:'',slideshow: 5000, deeplinking: false, overlay_gallery:false, default_width: windowWidth, default_height: windowHeight });
            }

        });
    };
})(jQuery);

/***************************************************************
* Go top scroll *
****************************************************************/

function swm_go_top_scroll() { 

    var pageScroll = false;
    var $element = $('#go_top_scroll');

    $element.click(function(e) {
        $('body,html').animate({ scrollTop: "0" }, 750, 'easeOutExpo' );
        e.preventDefault();
    });

    $(window).scroll(function() {
        pageScroll = true;
    });

    setInterval(function() {
        if( pageScroll ) {
            pageScroll = false;

            if( $(window).scrollTop() > 300 ) {
                $element.fadeIn('fast');
            } else {
                $element.fadeOut('fast');
            }
        }
    }, 250);    
}

/***************************************************************
* Mega Menu *
****************************************************************/

function swm_megamenu() { 

    var $et_top_menu = $( 'ul.top_nav' );

        $et_top_menu.find( 'li' ).hover( function() {
            if ( ! $(this).closest( 'li.mega-menu' ).length || $(this).hasClass( 'mega-menu' ) ) {
                $(this).addClass( 'swm_display_mega_menu' );
                $(this).removeClass( 'swm_menu_hover' ).addClass( 'swm_menu_hover' );
            }
        }, function() {
            var $this_el = $(this);

            $this_el.removeClass( 'swm_display_mega_menu' );

            setTimeout( function() {
                if ( ! $this_el.hasClass( 'swm_display_mega_menu' ) ) {
                    $this_el.removeClass( 'swm_menu_hover' );
                }
            }, 200 );
        } );

}

/***************************************************************
* Sermons Audio Video *
****************************************************************/

function swm_sermons_single() { 

    var swm_sermon_video = $('.swm_sermon_video'),
        swm_sermon_audio = $('.swm_sermon_audio'),
        video_on = swm_sermon_video.html().replace('autoplay=0', 'autoplay=1'),
        video_off = swm_sermon_video.html().replace('autoplay=1', 'autoplay=0'),
        mediaPlayer = new MediaElementPlayer('.sermonAudio');
        
    if ($('.sermonAudio').length) {         
        $(".sermonAudio").css('max-width', '100%');
        setTimeout(function() {            
            $(window).trigger('resize');
            swm_sermon_audio.hide();
            if (window.location.hash == '#getAudio') {
                swm_sermon_video.hide();
                swm_sermon_audio.show();
            }
        }, 400);             
    }

    $('.playSermonVideo').click(function(event) {
        event.preventDefault();           
        mediaPlayer.pause();
        swm_sermon_audio.hide();              
        swm_sermon_video.html(video_on).show();        
    });
    
    $('.playSermonAudio').click(function(event) {
        event.preventDefault();       
        swm_sermon_video.hide();        
        swm_sermon_video.html(video_off);       
        swm_sermon_audio.show();      
        mediaPlayer.play();       
        $(window).trigger('resize');
    });

    $(window).on("load", function() {
        if ( document.location.href.indexOf('#getVideo') > -1 && video_on ) {           
            swm_sermon_video.html(video_on).show();           
        }
    });   
}

/***************************************************************
* Load All Functions *
****************************************************************/

swm_retinaRatioCookies();
swm_parallax_on();
swm_responsive_height();
swm_pf_gallery();
swm_portfolio_items();
swm_cause_items();
swm_sermons_items();
swm_testimonials_items();
$('.swm_container').swm_auto_lightbox();
swm_go_top_scroll();
swm_megamenu();
swm_sermons_single();

/****************************************************************/
/****************************************************************/
}); })(jQuery);
// Do not delete above lines


// Window OnLoad Functions ##########################################################

(function ($) {

    var $window = $(window);

    $window.load(function(){  

       
        /***************************************************************
        * Blog Grid *
        ****************************************************************/

        function swm_BlogGridIsotope() {       
            $('.swm_blog_grid_sort').isotope({
                itemSelector: '.swm_blog_grid'
            });
        } 
        swm_BlogGridIsotope();        
        $window.resize(function () { swm_BlogGridIsotope(); });
        window.addEventListener("orientationchange", function() { swm_BlogGridIsotope(); });

    }); // End on window load
    
})(jQuery); // End jQuery(function($)