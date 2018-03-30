<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 * 
 * @cmsms_package 	Agriculture
 * @cmsms_version 	1.6
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


$cmsms_option = cmsms_get_global_options();


if (is_shop()) {
	$cmsms_page_id = wc_get_page_id('shop');
} else {
	$cmsms_page_id = get_the_ID();
}


$cmsms_layout = get_post_meta($cmsms_page_id, 'cmsms_layout', true);


if (!$cmsms_layout) { 
    $cmsms_layout = 'r_sidebar'; 
}

$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;
	case 'twentyfifteen' :
		echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
		break;
	default :
		if ($cmsms_layout == 'r_sidebar') {
			echo '<section id="content" class="cmsms_woo" role="main">' . "\n\t";
		} elseif ($cmsms_layout == 'l_sidebar') {
			echo '<section id="content" class="fr cmsms_woo" role="main">' . "\n\t";
		} else {
			echo '<section id="middle_content" class="cmsms_woo" role="main">' . "\n\t";
		}
		break;
}