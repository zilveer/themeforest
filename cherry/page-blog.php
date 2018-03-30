<?php

/**
 * Template Name: Blog page
 */

get_header();

//Retrieve and verify sidebars 
$posts_sidebar = rwmb_meta('gg_primary-widget-area');
$sidebar_list = of_get_option('sidebar_list');
if ($sidebar_list) : $posts_sidebar_exists = in_array_r($posts_sidebar, $sidebar_list); else : $posts_sidebar_exists = false; endif;

st_before_content($columns='');
get_template_part( 'loop', 'blog' );
st_after_content();
get_sidebar();
get_footer();
?>