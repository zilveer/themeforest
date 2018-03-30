<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
function getGridSize() {
    return (window.innerWidth <= 480) ? 2 :
           (window.innerWidth < 900) ? 4 : 4;
}

jQuery(window).load(function() {
	var post_carousel_column = jQuery('#post_carousel_column').val();
	var post_carousel_column_width = 190;
	var flexslider;
    
    if(jQuery.browser.msie) {
        jQuery('.post_carousel').flexslider({
		      animation: "slide",
		      animationLoop: true,
		      itemWidth: post_carousel_column_width,
		      itemMargin: 0,
		      minItems: getGridSize(),
		      maxItems: getGridSize(),
		      slideshow: false,
		      controlNav: false,
		      directionNav: false,
		      slideshow: true,
		      slideshowSpeed: 5000,
		      move: 1
	    }); 
    } else {
        jQuery('.post_carousel').flexslider({
		      animation: "slide",
		      animationLoop: true,
		      itemWidth: post_carousel_column_width,
		      itemMargin: 0,
		      minItems: getGridSize(),
		      maxItems: getGridSize(),
		      slideshow: false,
		      controlNav: false,
		      directionNav: false,
		      slideshow: true,
		      slideshowSpeed: 5000,
		      move: 1
	    });  
    }
    
    jQuery('.client_content').tipsy({fade: true, gravity: 'n'});
});