jQuery(document).ready(function() {

    jQuery("body").fitVids();

    /* Mobile */
    if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) ||
        navigator.userAgent.match(/Windows Phone/i) ){
        var mobile_device = true;
    }else{
        var mobile_device = false;
    }

    if ( !mobile_device  ) {
        if( bd.sticky_sidebar ){
            jQuery('.theia_sticky').theiaStickySidebar({containerSelector: ".bd-main"});
        }
    }

    jQuery(".footer-widgets .widget-footer:nth-child(3n+1)").addClass("first");
    jQuery(".footer-widgets .widget-footer:nth-child(3n+3)").addClass("last");

    jQuery(".btn-nav-out").bind("click",function(){
        if(
            jQuery("#warp").hasClass("side-out")){
            jQuery("#warp").removeClass("side-out");
            jQuery(".btn-nav-out").removeClass("side-out");
        return false
    }else{
        jQuery("#warp").addClass("side-out");
        jQuery(".btn-nav-out").addClass("side-out");
    }
    });

    jQuery(".slide-out-info-btn").click(function(){
        jQuery('.slide-out-info').slideToggle('800', function() {
        });
    });

    /* Main */
    jQuery("article.post .social-shares-link, article.post .post-share-box").bind("hover",function(){if(jQuery(this).hasClass("active")){jQuery(this).removeClass("active");jQuery(".social-shares-link").removeClass("active");jQuery(".post-share-box").css({right:"-600px"});return false}else{jQuery(this).addClass("active");jQuery(".social-shares-link").addClass("active");jQuery(".post-share-box").css({right:"35px"});return false}});

    /* Prevent Default */
    jQuery(".prev, .nxt, .flex-next, .flex-prev, .btn-nav-out, .slide-out-info-btn, #filters a").click(function(event){
        event.preventDefault(event);
    });

    /* Lightbox */
    jQuery('.lightbox').lightbox();

    /* placeholder */
    jQuery('input, textarea').placeholder();

    /* Criteria Percent */
    setTimeout(function(){
        jQuery('.bd-criteria-percent .bd-criteria-percentage').each(function(){
            var me = jQuery(this);
            var perc = me.attr("data-percentage");
            var current_perc = 0;
            var progress = setInterval(function(){
                if (current_perc>=perc){ clearInterval(progress); }
                else { current_perc +=1; me.css('width', (current_perc)+'%'); }
                me.text((current_perc)+'%');
            }, 10);
        });
    },10);

    jQuery("#container-grid").css({
        "visibility": "visible"
    });



    /* Top Navigation Select */
    jQuery("<select />").appendTo("#top-navigation");jQuery("<option />",{selected:"selected",value:"",text:js_local_vars.dropdown_goto}).appendTo("#top-navigation select");jQuery("#top-navigation li").each(function(){var e=jQuery(this).parents("ul").length-1;var t="";if(e>0){t=" - "}if(e>1){t=" - - "}if(e>2){t=" - - -"}if(e>3){t=" - - - -"}var n=jQuery(this).children("a");jQuery("<option />",{value:n.attr("href"),text:t+n.text()}).appendTo("#top-navigation select")});jQuery("#top-navigation select").change(function(){window.location=jQuery(this).find("option:selected").val()});
	
	/* Navigation Select */
    jQuery("<select />").appendTo("#navigation");jQuery("<option />",{selected:"selected",value:"",text:js_local_vars.dropdown_goto}).appendTo("#navigation select");jQuery("#navigation li").each(function(){var e=jQuery(this).parents("ul").length-1;var t="";if(e>0){t=" - "}if(e>1){t=" - - "}if(e>2){t=" - - -"}if(e>3){t=" - - - -"}var n=jQuery(this).children("a");jQuery("<option />",{value:n.attr("href"),text:t+n.text()}).appendTo("#navigation select")});jQuery("#navigation select").change(function(){window.location=jQuery(this).find("option:selected").val()});
	
    /* Go top */
    jQuery(window).scroll(function(){
        if(jQuery(this).scrollTop() > 1){ jQuery('.gotop').css({bottom:"25px"}); }
        else{ jQuery('.gotop').css({bottom:"-100px"}); }
    });
    jQuery('.gotop').click(function(){ jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

    /* Tipsy */
    jQuery('.ttip').tipsy({fade: true, gravity: 's'});
    jQuery('.tooldown, .tooltip-s').tipsy({fade: true, gravity: 'n'});
    jQuery('.tooltip-nw').tipsy({fade: true, gravity: 'nw'});
    jQuery('.tooltip-ne').tipsy({fade: true, gravity: 'ne'});
    jQuery('.tooltip-w').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-e').tipsy({fade: true, gravity: 'e'});
    jQuery('.tooltip-sw').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-se').tipsy({fade: true, gravity: 'e'});

    /* tabs */
    jQuery(".tab_container").hide();
    jQuery("ul.tabs_nav li:first").addClass("active").show();
    jQuery(".tab_container:first").show();
    jQuery("ul.tabs_nav li").click(function() {
        jQuery("ul.tabs_nav li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".tab_container").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        jQuery(activeTab).fadeIn('fast');
        return false;
    });

    /* Shortcodes toggle */
    jQuery('div.toggle h4').click(function () {
        var text = jQuery(this).siblings('div.panel');
        if (text.is(':hidden')) {
            text.slideDown('200');
            jQuery(this).siblings('span').html('-');
        } else {
            text.slideUp('200');
            jQuery(this).siblings('span').html('+');
        }
    });

    /* Shortcodes tabs */
    initTabGroup();

    // Load Complete
    setTimeout(function() {
        loadComplete();
    }, 3000);


    var $images = jQuery('div.post-image img'),
        preloaded = 0,
        total = $images.length;
    $images.load(function() {
        if (++preloaded === total) {
            // Done!
        }
    });
});

/*
 * LOAD
 */
jQuery(window).bind("load", function() {
    loadComplete();

    jQuery(window).resize();
});

// Load Complete
function loadComplete() {
    jQuery('#loading').remove();
    jQuery('.folio-container, .blog-grid-layout').removeClass('loading');
}


/* Fixed */
jQuery(document).scroll(function(){
    var e=jQuery(this).scrollTop();

    if(e>=50){
        jQuery("#header-fix.fixed-on").addClass("header-fix")
    }
    else if(e<50){
        jQuery("#header-fix.fixed-on").removeClass("header-fix")
    }
});

/* initTabGroup */
/* Tabs Shortcodes */
function initTabGroup(e) {
    if(typeof e === 'undefined'){
        e = document;
    }
    if (jQuery('.tabgroup', jQuery(e)).length) {
        jQuery('.tabgroup', jQuery(e)).tabs().show();
    }
}