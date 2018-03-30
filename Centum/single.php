<?php
/**
 * The template for displaying all single posts.
 *
 * @package Centum
 */

get_header();


get_template_part( 'content', 'single' );

$sidebar_side = get_post_meta($post->ID, 'incr_sidebar_layout', true);


get_sidebar();

get_footer();

?>