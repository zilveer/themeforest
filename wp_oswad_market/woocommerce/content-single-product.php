<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
	 
	$_wrapper_class = '';
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class( apply_filters('single_product_wrapper_class', $_wrapper_class ) ); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 * @hooked woocommerce_show_product_images - 20
		 * 
		 */
		 
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	
	<div class="summary entry-summary">

		<?php
		/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked wd_template_single_rating - 6
			 * @hooked wd_template_single_availability - 6
			 * @hooked wd_template_single_sku - 8
			 * @hooked woocommerce_template_single_excerpt - 16
			 * @hooked woocommerce_template_single_sharing - 17
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_price - 31
			 * @hooked get_product_categories - 40
			 * @hooked product_tags_template - 40
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->
	<!--wd_single_product_summary_end-->
						
	<?php
	/**
		* woocommerce_after_single_product_summary hook
		* @hooked woocommerce_output_product_data_tabs - 10
		* @hooked wd_upsell_display - 15
		* @hooked wd_output_related_products - 16
		* 
		*/
		
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php 
/**
	* woocommerce_after_single_product hook
	*/
do_action( 'woocommerce_after_single_product' ); 
?>