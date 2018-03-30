/*-------------------------------------------------------------- 
Fire up functions on $(document).ready()
--------------------------------------------------------------*/
jQuery(document).ready(function () {
	truethemes_SuperFish();
	truethemes_MobileMenu();
	jQuery("#menu-main-nav li:has(ul)").addClass("parent");
	jQuery(".ubermenu-nav li:has(ul)").addClass("tt-uber-parent");
	truethemes_Sliders();
	jQuery('.slider-content-video,.video_wrapper').fitVids();
	truethemes_Gallery();
    truethemes_masonry_blog();
	truethemes_KeyboardTab();
	jQuery('div.mc_signup_submit input#mc_signup_submit').removeClass('button');
    jQuery('.checkout-button.button.alt.wc-forward').find('br').remove();

    //parallax
    jQuery('.tt-parallax-text').fadeIn(1000); //delete this to remove fading content

    var $window = jQuery(window);
    jQuery('section[data-type="background"]').each(function () {
        var $bgobj = jQuery(this);

        jQuery(window).scroll(function () {
            var yPos = -($window.scrollTop() / $bgobj.data('speed'));
            var coords = '50% ' + yPos + 'px';
            $bgobj.css({
                backgroundPosition: coords
            });
        });
    });
});
/*-------------------------------------------------------------- 
Fire up functions on $(window).load()
--------------------------------------------------------------*/
jQuery(window).load(function () {
	truethemes_Fadeimages();
	truethemes_MobileSubs();
	truethemes_LightboxHover();
	jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
        hook:'data-gal', // do not change, sky will fall
        theme: 'light_square', // options: light_rounded / dark_rounded / pp_default / dark_square / facebook 
    });
	truethemes_ScrollTop();
	truethemes_Tabs();
	if (jQuery(window).width() > 1024) { //only load sticky on non-mobile devices
		truethemes_StickySidebar();
	}
	truethemes_flexslider_for_gallery_post_format();
});
/*---------------------------------------------------------------------------*/
/*
/* Note to developers:
/* Easily uncompress any functions using: http://jsbeautifier.org/
/*
/*---------------------------------------------------------------------------*/
/*-------------------------------------------------------------- 
Superfish - Dropdown Menus
--------------------------------------------------------------*/
function truethemes_SuperFish(){
//only activate top-toolbar if child <ul> is present
jQuery(".top-block ul:has(ul)").addClass("sf-menu");
jQuery('ul.sf-menu').superfish({
    delay: 100,
    animation: {
        opacity: 'show',
        height: 'show'
    },
    speed: 'fast',
    disableHI: true,
    autoArrows: false,
    dropShadows: false
})
}
// 2/3/4th level menu  offscreen fix
// thanks to sakib000: https://forum.jquery.com/topic/suprtfish-menu-text-off-screen       
var wapoMainWindowWidth = jQuery(window).width();
jQuery('#menu-main-nav.sf-menu ul li').mouseover(function(){  
    // checks if third level menu exist        
    var subMenuExist = jQuery(this).find('.sub-menu').length;           
    if( subMenuExist > 0){
        var subMenuWidth = jQuery(this).find('.sub-menu').width();
        var subMenuOffset = jQuery(this).find('.sub-menu').parent().offset().left + subMenuWidth;

        // if sub menu is off screen, give new position
        if((subMenuOffset + subMenuWidth) > wapoMainWindowWidth){                 
            var newSubMenuPosition = subMenuWidth + 14;
            jQuery(this).find('.sub-menu').css({
                left: -newSubMenuPosition
            });
        }
    }
 });
/*-------------------------------------------------------------- 
Sliders + Testimonials
--------------------------------------------------------------*/
function truethemes_Sliders(){
//data pulled in from Site Options using wp_localize()
var tt_slider_directionNav;
var tt_slider_pause_hover;
var tt_slider_randomize;
var tt_testimonial_directionNav;
var tt_testimonial_pause_hover;
var tt_testimonial_randomize;
if(php_data.karma_jquery_directionNav == 'true'){tt_slider_directionNav = true;}else{tt_slider_directionNav = false;}
if(php_data.karma_jquery_pause_hover  == 'true'){tt_slider_pause_hover  = true;}else{tt_slider_pause_hover  = false;}
if(php_data.karma_jquery_randomize    == 'true'){tt_slider_randomize    = true;}else{tt_slider_randomize    = false;}
if(php_data.testimonial_directionNav  == 'true'){tt_testimonial_directionNav = true;}else{tt_testimonial_directionNav = false;}
if(php_data.testimonial_pause_hover   == 'true'){tt_testimonial_pause_hover  = true;}else{tt_testimonial_pause_hover  = false;}
if(php_data.testimonial_randomize     == 'true'){tt_testimonial_randomize    = true;}else{tt_testimonial_randomize    = false;}
//karma jquery sliders
jQuery('.jquery1-slider-wrap, .jquery2-slider-bg, .jquery3-slider-wrap').flexslider({
	slideshowSpeed: php_data.karma_jquery_slideshowSpeed,
	pauseOnHover:   tt_slider_pause_hover,
	randomize:      tt_slider_randomize,
	directionNav:   tt_slider_directionNav,
	animation:      php_data.karma_jquery_animation_effect,
	animationSpeed: php_data.karma_jquery_animationSpeed,
	smoothHeight: true
});
//testimonial shortcode
jQuery('.testimonials').flexslider({
	slideshowSpeed: php_data.testimonial_slideshowSpeed,
	pauseOnHover:   tt_testimonial_pause_hover,
	randomize:      tt_testimonial_randomize,
	directionNav:   tt_testimonial_directionNav,
	animation:      php_data.testimonial_animation_effect,
	animationSpeed: php_data.testimonial_animationSpeed,
	controlsContainer: ".testimonials",
	smoothHeight: true
});

jQuery('.true-testimonial-1-flexslider').flexslider({
    slideshowSpeed: php_data.testimonial_slideshowSpeed,
    animation: "slide",
    namespace: "true-",
    start: function(slider) {
        slider.removeClass('loading');
    }
});

jQuery('.true-testimonial-2-flexslider').flexslider({
    slideshowSpeed: php_data.testimonial_slideshowSpeed,
    animation: "slide",
    controlNav: "thumbnails",
    namespace: "true-",
    start: function(slider) {
        slider.removeClass('loading');
    }
});



}
/*-------------------------------------------------------------- 
Tabs
--------------------------------------------------------------*/
function truethemes_Tabs(){
//Added since 3.0.2 dev 4. 
//tabs init code, added with browser url sniff to get tab id to allow activating tab via link
//example url http://localhost:8888/karma-experimental/shortcodes/tabs-accordion/?tab=2
var tab_id = window.location.search.split('?tab=');
if (tab_id) {
    var tab_index = tab_id[1] - 1;
    jQuery('.tabs-area').tabs({
        show: { effect: "fadeIn" },
        hide: { effect: "fadeOut" },
        active: tab_index
    })
} else {
    jQuery('.tabs-area').tabs({
        show: { effect: "fadeIn" },
        hide: { effect: "fadeOut" },
        active: 0
    })
}
}
/*-------------------------------------------------------------- 
Accessible Keyboard Tabbing
--------------------------------------------------------------*/
function truethemes_KeyboardTab() {
jQuery(function(){
    var lastKey = new Date(),
        lastClick = new Date();
    jQuery(document).on( "focusin", function(e){
        jQuery(".non-keyboard-outline").removeClass("non-keyboard-outline");
        var wasByKeyboard = lastClick < lastKey
        if( wasByKeyboard ) {
            jQuery( e.target ).addClass( "non-keyboard-outline");
        }     
    }); 
    jQuery(document).on( "click", function(){
        lastClick = new Date();
    });
    jQuery(document).on( "keydown", function() {
        lastKey = new Date();
    });
});
}
/*-------------------------------------------------------------- 
Image Fade-in
--------------------------------------------------------------*/
function truethemes_Fadeimages() {
    jQuery('[class^="attachment"]').each(function (index) {
        var t = jQuery('[class^="attachment"]').length;
        // When retina.js swaps the images, the new image, being
        // larger, overflows the frame. To fix this, take the
        // size of the zoomlayer, and apply it to the new image.
        // We do it regardless of whether the image has been swapped
        // by retina.js since it would be a waste to detect whether
        // the iamge has been swapped.
        var z = jQuery(this).prev('.lightbox-zoom');
        jQuery(this).css({
            'width': z.css('width'),
            'height': z.css('height')
        });
        if (t > 0) {
            jQuery(this).delay(160 * index).fadeIn(400)
        }
    })
}
/*-------------------------------------------------------------- 
Lightbox hover
--------------------------------------------------------------*/
function truethemes_LightboxHover() {
    jQuery('.lightbox-img').hover(function() {
        jQuery(this).children().first().children().first().stop(true);
        jQuery(this).children().first().children().first().fadeTo('normal', .90)
    }, function() {
        jQuery(this).children().first().children().first().stop(true);
        jQuery(this).children().first().children().first().fadeTo('normal', 0)
    })
}
/*-------------------------------------------------------------- 
Scroll to Top
--------------------------------------------------------------*/
function truethemes_ScrollTop() {
    jQuery('a.link-top').click(function() {
        if (!jQuery.browser.opera) {
            jQuery('body').animate({
                scrollTop: 0
            }, {
                queue: false,
                duration: 1200
            })
        }
        jQuery('html').animate({
            scrollTop: 0
        }, {
            queue: false,
            duration: 1200
        });
        return false
    })
}
jQuery(document).ready(function($){
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
        //duration of the top scrolling animation
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.karma-scroll-top');
    //hide or show the "back to top" link
    $(window).scroll(function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
    });
    //smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
            }, scroll_top_duration
        );
    });

});
/*-------------------------------------------------------------- 
Sticky Sidebar
--------------------------------------------------------------*/
function truethemes_StickySidebar() {

// Since 4.4 - site option to activate sticky
if(php_data.sticky_sidebar == 'true'){

/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);

//make em' stick
//jQuery("#sidebar").stick_in_parent({ offset_top: 15, spacer: false }); //sidebar - use this version for (iframe) widgets in left sidebar
jQuery("#sidebar").stick_in_parent({ offset_top: 15 }); //sidebar
jQuery("#sub_nav").stick_in_parent({ offset_top: 10 }); //sub navigation

} else {
// else user has disabled sticky in site-options...do nothing
}

} // END truethemes_StickySidebar()
/*-------------------------------------------------------------- 
Mobile Menu
--------------------------------------------------------------*/
function truethemes_MobileMenu(){
//@since 4.0.2  check for ubermenu mobile-menu settings and adjust code accordingly
//php_data pulled in from Site Options using wp_localize()
if(php_data.ubermenu_active == 'true'){
    var mobileMenuClone = jQuery(".ubermenu-nav").clone().attr("id", "tt-mobile-menu-list");
} else {
    var mobileMenuClone = jQuery("#menu-main-nav").clone().attr("id", "tt-mobile-menu-list");
}   
function truethemes_MobileMenu(){var windowWidth=jQuery(window).width();if(windowWidth<=767)if(!jQuery("#tt-mobile-menu-button").length){jQuery('<a id="tt-mobile-menu-button" href="#tt-mobile-menu-list"><span>'+php_data.mobile_menu_text+"</span></a>").prependTo("#header");mobileMenuClone.insertAfter("#tt-mobile-menu-button").wrap('<div id="tt-mobile-menu-wrap" />');tt_menu_listener()}else jQuery("#tt-mobile-menu-button").css("display",
"block");else{jQuery("#tt-mobile-menu-button").css("display","none");mobileMenuClone.css("display","none")}}truethemes_MobileMenu();function tt_menu_listener(){jQuery("#tt-mobile-menu-button").click(function(e){if(jQuery("body").hasClass("ie8")){var mobileMenu=jQuery("#tt-mobile-menu-list");if(mobileMenu.css("display")==="block")mobileMenu.css({"display":"none"});else{var mobileMenu=jQuery("#tt-mobile-menu-list");mobileMenu.css({"display":"block","height":"auto","z-index":999,"position":"absolute"})}}else jQuery("#tt-mobile-menu-list").stop().slideToggle(500);
e.preventDefault()});jQuery("#tt-mobile-menu-list").find("> .menu-item").each(function(){var $this=jQuery(this),opener=$this.find("> a"),slide=$this.find("> .sub-menu")})}jQuery(window).resize(function(){truethemes_MobileMenu()});jQuery(window).load(function(){jQuery("#tt-mobile-menu-list").hide()});jQuery(document).ready(function(){jQuery("#tt-mobile-menu-list").hide()})

// Buzu adds this Aug 1st 2015
// Function modified to serve the mega menu as well. Nov 1st 2015 (Buzu)
if (jQuery('body').hasClass('karma-no-mobile-submenu')) {
    // get all mobile menu items with sub menus
    var subs,
        sub_parents,
        mega_menus = mobileMenuClone.find('.karma_mega_div'),
        target;

    // before doing anything, check if we have a mega menu, if so strip the mega
    // menu stuff out
    if (mega_menus.length) {
        mega_menus.each(function () {
            var $this = jQuery(this);
                sub = $this.children('.sub-menu'),
                paren = $this.parent('li');

                paren.append(sub);
                $this.remove();
        });
    }

    subs = mobileMenuClone.find('li > ul'),
    sub_parents = subs.parent('li');

    subs.hide();

    mobileMenuClone.find('.karma_mega_div').css('display', 'block');

    sub_parents.append('<i class="fa fa-chevron-down"></i>');
    mobileMenuClone.on('click', '.fa-chevron-down', function () {
        var $this = jQuery(this);

        // small optimization.
        // save the target on the trigger to avoid searching for it everytime
        // user clicks to show/hide sub-menu
        if (!$this.data('target')) {
            target = $this.parent().children('.sub-menu');

            $this.data('target', target);
        }

        $this.data('target').slideToggle();
        $this.toggleClass('sub-menu-trigger--open')
    });
} else {
    // open the main nav submenues that have been hid by superfish
    mobileMenuClone.find('.sub-menu').css('display', 'block');
    mobileMenuClone.find('.karma_mega_div').css('display', 'block');
}
// Buzu ends here Aug 1st 2015
};
/*-------------------------------------------------------------- 
Mobile Menu - Left/Right Nav
--------------------------------------------------------------*/
function truethemes_MobileSubs() {
    // Buzu modified this function to make it work properly. Changes made can be
    // identified by their comments starting with B: (May 27 2016)
    //
    // B: Save the new elements so that they can be used later.
    var select = jQuery("<select />").appendTo("#sub_nav, body.karma-mobile-horz-dropdown #horizontal_nav");
    jQuery("<option />", {
        "selected": "selected",
        "value": "",
        "text": php_data.mobile_sub_menu_text
    }).appendTo("#sub_nav select, body.karma-mobile-horz-dropdown #horizontal_nav select");
    jQuery("#sub_nav a, body.karma-mobile-horz-dropdown #horizontal_nav a").each(function() {
        var el = jQuery(this);
        var new_el = jQuery("<option />", {
            "value": el.attr("href"),
            "text": el.text()
        }).appendTo("#sub_nav select, body.karma-mobile-horz-dropdown #horizontal_nav select")

        // B: If the original element has a filter data, add it to the clone too
        if (el.data('filter')) {
            new_el.data('filter', el.data('filter'));
        }
    });
    jQuery("#sub_nav select, body.karma-mobile-horz-dropdown #horizontal_nav select").change(function() {
        window.location = jQuery(this).find("option:selected").val()
    })
    // B: Do the actual sorting when the dropdown is changed, but only if the
    // selected children has a filter data value
    select.on('change', function (e) {
        jQuery(this).children('option').each(function() {
            if (this.selected && jQuery(this).data('filter')) {
                jQuery('#tt-gallery-iso-wrap').isotope({
                    filter: jQuery(this).data('filter')
                });
            }
        });
    });
};
/*-------------------------------------------------------------- 
Gallery Filtering
--------------------------------------------------------------*/
function truethemes_Gallery() {
    jQuery('#tt-gallery-iso-wrap').isotope({
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
    jQuery('#tt-gallery-iso-wrap').isotope({
        layoutMode: 'fitRows'
    });
    jQuery('#tt-gallery-nav a').click(function () {
        var selector = jQuery(this).attr('data-filter');
        jQuery('#tt-gallery-iso-wrap').isotope({
            filter: selector
        });
        return false
    });
    jQuery('#tt-gallery-nav li > a').click(function () {
        jQuery('#tt-gallery-nav li').removeClass();
        jQuery(this).parent().addClass('active')
    })
}
/*-------------------------------------------------------------- 
Masonry Blog
--------------------------------------------------------------*/
function truethemes_masonry_blog() {
    // masonry blog
jQuery('#tt-blog-container').isotope({
  animationOptions: {
   duration: 1150,
   easing: 'linear',
   queue: false
   }
});
// also run isotope on resize for 'fluid appearance'
jQuery(window).resize(function() {
  jQuery('#tt-blog-container').isotope({
    animationOptions: {
     duration: 1150,
     easing: 'linear',
     queue: false
     }
  });
});

}
/*-------------------------------------------------------------- 
Flexslider for gallery post format
--------------------------------------------------------------*/
function truethemes_flexslider_for_gallery_post_format(){
  jQuery('.karma-blog-slider').flexslider({
  animation: "slide",
  start: function(slider) {
    slider.removeClass('loading');
}
});
jQuery(".karma-blog-slider .flex-prev").addClass('fa fa-chevron-left').text('');
jQuery(".karma-blog-slider .flex-next").addClass('fa fa-chevron-right').text('');
}
/*-------------------------------------------------------------- 
Sticky Menu
--------------------------------------------------------------*/
function handleSWAppear() {
    truethemes_undoStickyMenu();
    jQuery('#menu-main-nav').one('scrollWatch.disappear', handleSWDisappear);
}
function handleSWDisappear() {
    var subs = jQuery(this).find('.drop'),
        open_sub = false;

    subs.each(function () {
        // Open submenus have opacity of 1
        if (jQuery(this).css('opacity') > 0) {
            open_sub = true;
        }
    });
    // Do the sticky menu only if there is no open submenu. In small screens
    // users may scroll down to see the entire submenu. If so, then a submenu
    // will be open, but the menu may not be in the viewport anymore. We don't
    // want to do the sticky menu in those cases.
    if (!open_sub) {
        truethemes_doStickyMenu();
        jQuery('#menu-main-nav').one('scrollWatch.appear', handleSWAppear);
    } else {
        // register the handler again, in case the menu closes down. When the
        // user scroll downs again, the menu will show up.
        jQuery('#menu-main-nav').one('scrollWatch.disappear', handleSWDisappear);
    }
}

function handleSWDisappear_2() {
    var old_top;

    function eventHandler_2() {
        var new_top = jQuery(window).scrollTop();

        if (old_top) {
            if (new_top > old_top || new_top == 0) {
                truethemes_undoStickyMenu();
                jQuery(window).off('scroll', eventHandler_2);
                jQuery(window).on('scroll', eventHandler);
            }
        }

        old_top = new_top;
    }

    function eventHandler() {
        var new_top = jQuery(window).scrollTop();

        if (old_top) {
            if (new_top < old_top) {
                truethemes_doStickyMenu();
                jQuery(window).off('scroll', eventHandler);
                jQuery(window).on('scroll', eventHandler_2);
            }
        }

        old_top = new_top;
    }

    jQuery(window).on('scroll', eventHandler);
}

function truethemes_StickyMenu(menu_type) {
    if (menu_type == 1) {
        jQuery('#menu-main-nav').one('scrollWatch.disappear', handleSWDisappear).scrollWatch();
    } else if (menu_type == 2) {
        jQuery('#menu-main-nav').one('scrollWatch.disappear', handleSWDisappear_2).scrollWatch();
    }
}

function truethemes_doStickyMenu() {
    var $ = jQuery;
    var container = $('<div id="B_sticky_menu"></div>'),
        tool_bar_clone = $('#header .top-block').clone(true);
        header_clone = $('#header .header-holder').clone(true);

    container.append(tool_bar_clone).append(header_clone);
    container.css({
        position: 'fixed',
        left: 0,
        top: -100,
        width: '100%',
        zIndex: 100,
        opacity: 0,
        boxShadow: '0 0 4px #000',
    });
    container.find('.header-area').css({
        maxWidth: 980,
        padding: '16px 0px',
        margin: 'auto'
    });
    container.find('.logo').css({
        'float': 'left',
    });
    container.find('.header-area').children().each(function() {
        !($(this).hasClass('logo') || $(this).is('nav')) && $(this).remove();
    });
    $('body').append(container);
    /*
	* modification to original codes to prevent error when .top-aside which is top toolbar is deactivated.
	* @since 4.0.5 dev 11 mod by denzel
	*/
    if(jQuery('.top-block').length == 0){    
 		   container.animate({
 		       top: $('#wpadminbar').length === 0 ? 0 : $('#header').offset().top,
 		       opacity: 1
 		   }, 700);
	    }else{
		    container.animate({
		        top: $('#wpadminbar').length === 0 ? 0 : $('#header .top-block').offset().top,
		        opacity: 1
		    }, 700);       
    }//endif
}
function truethemes_undoStickyMenu() {
    jQuery('#B_sticky_menu').animate({
        top: -300,
        opacity: 0
    }, {
        duration: 400,
        queue: false,
        complete: function() {
            jQuery(this).remove();
            if (jQuery('#B_sticky_menu').length) {
                truethemes_undoStickyMenu();
            }
        }
    });
}