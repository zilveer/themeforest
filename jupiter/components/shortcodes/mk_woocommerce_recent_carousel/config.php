<?php
extract( shortcode_atts( array(
	'title' 		=> 'New Arrivals',
	'style' 		=> 'modern',
	'image_size'	=> 'woocommerce-recent-carousel',
	'per_page' 		=> -1,
	'category'		=> '',
	'author'		=> '',
	'posts'			=> '',
	'featured' 		=> 'false',
	'order'			=> 'DESC',
	'per_view' 		=> 3,
	'orderby'		=> 'date',
	'el_class' 		=> ''
), $atts ) );
Mk_Static_Files::addAssets('mk_woocommerce_recent_carousel');

if($style == 'modern') {
	Mk_Static_Files::addAssets('mk_swipe_slideshow');
}