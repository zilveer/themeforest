<?php

/*------------------------------------------------------------*
 * 	Loop for displaying only featured items
 *------------------------------------------------------------*/

// Get number of featured posts set in theme customization
$theme_settings = sleek_theme_settings();

$featured_cat = get_category( $theme_settings->posts['featured_category'] );
$featured_count = (int)$theme_settings->posts['featured_count'];

if($featured_count == 0){
	$featured_count = -1;
}

echo do_shortcode('[blog posts="' . $featured_count . '" style="' . $theme_settings->posts['featured_style'] . '" category="' . $featured_cat->slug . '" sort_by="date" sort_order="DESC" carousel_arrows="false" carousel_grid="3" interval="4000" slider_effect="slide_x" slider_control="arrows"]
');
