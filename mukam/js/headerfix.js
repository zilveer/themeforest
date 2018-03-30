// Fixed Header Fix
// ======================
jQuery(window).load(function() {
    if( jQuery('body').find('.shopheader').length<1 ) {
    jQuery('.mukam-waypoint').css('marginTop', jQuery('.mukam-header').outerHeight(true) );
}
});

// Fixed Header for Parallax Home Page
// ======================
// ======================
var browser_height = jQuery(window).height();
jQuery(window).load(function() {
     jQuery('.parallax-homepage').css({height:browser_height});
});