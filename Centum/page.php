<?php
/**
 * The main template file.
 * @package WordPress
 */
get_header();


get_template_part( 'content', 'page' );

$layout = get_post_meta($post->ID, 'incr_sidebar_layout', true);
if($layout != 'full-width') {
	get_sidebar();	
}




get_footer();

?>