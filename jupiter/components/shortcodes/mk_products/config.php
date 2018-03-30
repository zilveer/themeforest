<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'layout' 						=> 'compact',
	'display' 						=> 'recent',
	'category' 						=> '',
	'image_size'					=> 'crop',
	'posts'							=> '',
	'orderby' 						=> 'date',
	'order' 						=> 'DESC',
	'columns' 						=> 2,
	'show_quickview' 				=> 'false',
	'show_category' 				=> 'false',
	'show_rating' 					=> 'false',
	'animation' 					=> '',
	'pagination'					=> 'true',
	'count'							=> 12,
	'el_class' 						=> '',

	'color_product_title' 			=> '',
	'color_product_category' 		=> '',
	'color_product_border' 			=> '',
	'color_product_price' 			=> '',
	'color_product_price_sale' 		=> '',
	'color_product_price_orginal' 	=> '',
	'color_product_rating' 			=> '',

), $atts ) );

Mk_Static_Files::addAssets('mk_swipe_slideshow');
Mk_Static_Files::addAssets('mk_image_slideshow');
Mk_Static_Files::addAssets('mk_products');
Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_message_box');