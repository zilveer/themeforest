<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
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


get_header();

	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	woocommerce_output_content_wrapper();
	

	while (have_posts()) : the_post();

		wc_get_template_part('content', 'single-product');

	endwhile; // end of the loop. 


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

