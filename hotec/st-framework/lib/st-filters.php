<?php 

// remove auto p for shortcode

remove_filter('the_content','do_shortcode');
add_filter('the_content','do_shortcode',0);

// Do shortcodes for widget
add_filter('widget_text', 'do_shortcode');

function st_no_html($html){
    return htmlspecialchars($html);
}
// add
add_filter('st_gallery_caption','st_no_html',10,1);

function st_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'st_excerpt_length', 99 );





function st_excerpt_more( $more ='') {
	return __('...','smooththemes');
}
add_filter('excerpt_more', 'st_excerpt_more');







