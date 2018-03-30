<?php

/**
 * Template Name: Portfolio page
 */

get_header();
//Retrieve and verify sidebars 
$portfolio_sidebar = rwmb_meta('gg_portfolio-widget-area');
$sidebar_list = of_get_option('sidebar_list');
if ($sidebar_list) : $portfolio_sidebar_exists = in_array_r($portfolio_sidebar, $sidebar_list); else : $portfolio_sidebar_exists = false; endif;


if (rwmb_meta('gg_portfolio_page_style') == 'sidebar') {
st_before_content($columns='');
} else { st_before_content($columns='sixteen'); }

if (rwmb_meta('gg_portfolio_page_style') == 'classic') {
	get_template_part( 'loop', 'portfolio' );
} elseif (rwmb_meta('gg_portfolio_page_style') == 'sidebar') {
	get_template_part( 'loop', 'portfolio-sidebar' );
} elseif (rwmb_meta('gg_portfolio_page_style') == 'filterable') {
	get_template_part( 'loop', 'portfolio-filterable' );
} else {
	get_template_part( 'loop', 'portfolio' );
}
st_after_content();

if (rwmb_meta('gg_portfolio_page_style') == 'sidebar') {
	get_sidebar('portfolio');
}
get_footer();
?>