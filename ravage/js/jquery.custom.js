jQuery.noConflict();
jQuery(document).ready(function($) { 

/*-----------------------------------------------------------------------------------*/
/*  Navigation
/*-----------------------------------------------------------------------------------*/

jQuery("nav ul, #icy-mobile-menu-wrapper ul").superfish({
    delay: 100,
    animation: {
        opacity: "show",
        height: "show"
    },
    speed: "fast",
    autoArrows: false,
    dropShadows: false
});

function icy_menu_trigger() {
    jQuery('.icy-menu-trigger').click(function(e) {        
            jQuery('#icy-mobile-menu-wrapper').stop().slideToggle(500);        
        e.preventDefault();
    });
}

function icy_mobilenav() {
	jQuery('#icy-mobile-menu-wrapper').css({'display': 'none'});    
    icy_menu_trigger();         
}
icy_mobilenav();

jQuery('.main-container').fitVids();

/*-----------------------------------------------------------------------------------*/
/*  Opacity changes
/*-----------------------------------------------------------------------------------*/

jQuery(".wp-post-image, .avatar").hover(function(){jQuery(this).animate({opacity:.7},200)},function(){jQuery(this).animate({opacity:1},200)})


});

