<?php 

define('SUBPAT_NOTICE', '0'); 
define('SUBPAT_LIVE_MODE', '0');

/**
 * Ebor Framework
 * Queue Up Framework
 * @since version 1.0
 * @author TommusRhodus
 */
require_once ( "ebor_framework/init.php" );

/**
 * Please use a child theme if you need to modify any aspect of the theme, if you need to, you can add code
 * below here if you need to add extra functionality.
 * Be warned! Any code added here will be overwritten on theme update!
 * Add & modify code at your own risk & always use a child theme instead for this!
 */ 

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action('woocommerce_before_single_product', 'woocommerce_get_sidebar', 20);
add_action('woocommerce_before_shop_loop', 'woocommerce_get_sidebar', 40);

function ebor_clear_loop(){
	echo '<div class="clear"></div><div class="break-30"></div>';
}
add_action('woocommerce_before_shop_loop', 'ebor_clear_loop', 35);

function woocommerce_template_loop_product_thumbnail(){
	global $post;
	$details = get_option('shop_catalog_image_size');
	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	$resized_image = aq_resize($url[0], $details['width'], $details['height'], $details['crop']);
	echo '<a href="' . get_permalink() . '"><img src="' . $resized_image . '" alt="' . get_the_title() . '" width="'.$details['width'].'" height="'.$details['height'].'" /></a>';
}

function ebor_woocommerce_load_scripts() {
	wp_deregister_script( 'prettyPhoto' );
	wp_deregister_script( 'prettyPhoto-init' );
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
}
add_action('wp_enqueue_scripts', 'ebor_woocommerce_load_scripts', 100);

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );