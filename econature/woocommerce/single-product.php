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
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();


woocommerce_output_content_wrapper();

	while ( have_posts() ) : the_post();

		wc_get_template_part( 'content', 'single-product' );

	endwhile; // end of the loop.

woocommerce_output_content_wrapper_end();


do_action('woocommerce_sidebar');


get_footer();

