<?php
if(defined('SU_PLUGIN_FILE')):

function remove_layout_shortcodes( $shortcodes ) {
	// Add new shortcode
	unset($shortcodes['row'],$shortcodes['column']);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'remove_layout_shortcodes' );


/* LOAD CUSTOM SHORTCODES -muratkaracam */

$shortcodes_dir = get_template_directory().'/inc/shortcodes/';

$shortcodes = array( 'row', 'column', 'button', 'blog_list_block', 'blog_list_vertical', 'infobox', 'infobox_knob', 'infobox_photo','message_box', 'page_header', 'portfolio_block','portfolio_listing','portfolio_listing_2','progress','slider-concept-one','team','testimonial_ticker','text','text_balloon','twitter');

foreach($shortcodes as $shortcode){
	require_once $shortcodes_dir.$shortcode.".php";
}

endif; //check plugin