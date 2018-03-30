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

$options = get_option('sf_flexform_options');
if (isset($options['enable_pb_product_pages'])) {
	$enable_pb_product_pages = $options['enable_pb_product_pages'];
} else {
	$enable_pb_product_pages = false;
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			 if ($enable_pb_product_pages) {
			 	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			 }
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->
	
	<?php if ($enable_pb_product_pages) { ?>
	
		<div id="product-display-area" class="clearfix">
			
			<?php the_content(); ?>
			
		</div>
		
		<?php
			add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
			function sb_woo_remove_reviews_tab($tabs) {
				unset($tabs['description']);
				return $tabs;
			}
		?>
		
	<?php } ?>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>