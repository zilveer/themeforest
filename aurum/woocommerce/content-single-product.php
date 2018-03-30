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

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div class="row">
	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class("item-details-single"); ?>>

		<div class="col-lg-6 col-md-6 col-sm-6 shop-item">
		<?php
			/**
			 * woocommerce_before_single_product_summary hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">

			<div class="summary entry-summary item-info">

				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div><!-- .summary -->

		</div>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />

	</div><!-- #product-<?php the_ID(); ?> -->

	<?php
	# start: modified by Arlind Nushi
	global $has_gallery;

	if(get_data('shop_single_sidebar') != 'hide' || get_data('shop_related_products_per_page') > 0)
		$has_gallery = false;
	# end: modified by Arlind Nushi
	?>
	<div class="clear"></div>

	<div class="<?php echo $has_gallery ? 'col-sm-11 col-md-offset-1' : 'col-sm-12'; ?>">

		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>



<div class="row">
<?php
# start: modified by Arlind Nushi
if(get_data('shop_related_products_per_page') > 0):
	global $is_related_products;

	$is_related_products = true;

	woocommerce_upsell_display();
	woocommerce_output_related_products();

	$is_related_products = false;
endif;
# end: modified by Arlind Nushi
?>
</div>