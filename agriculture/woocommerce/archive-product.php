<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
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


$cmsms_layout = (is_shop() ? get_post_meta($cmsms_page_id, 'cmsms_layout', true) : $cmsms_option[CMSMS_SHORTNAME . '_archive_layout']);


if (!$cmsms_layout) {
    $cmsms_layout = 'r_sidebar';
}


get_header();


/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
woocommerce_output_content_wrapper();

	do_action( 'woocommerce_archive_description' );

	if (have_posts()) {
		
		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		echo '<div class="cmsms_wrap_result">';
			do_action('woocommerce_before_shop_loop');
		echo '</div>';
		
		woocommerce_product_loop_start();

			woocommerce_product_subcategories();

			while (have_posts()) : the_post();

				wc_get_template_part('content', 'product');

			endwhile; // end of the loop.

		woocommerce_product_loop_end();

		
		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action('woocommerce_after_shop_loop');
		

	} elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) {

		wc_get_template('loop/no-products-found.php');

	}


/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
woocommerce_output_content_wrapper_end();


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" class="fl" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();