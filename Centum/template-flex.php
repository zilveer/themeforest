<?php
/**
 * Template Name: Page with Flex Slider
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */

get_header();

$slides = ot_get_option( 'mainslider', array() );
if ( !empty( $slides )) {
	get_template_part('slider'); 
}
get_template_part( 'content', 'page' ); 

$sidebar_side = get_post_meta($post->ID, 'incr_sidebar_layout', true);

if($sidebar_side != "left-sidebar") {
	get_sidebar();
}

get_footer(); 

?>