<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 * 
 * @cmsms_package 	Agriculture
 * @cmsms_version 	1.6
 */


global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


$average = $product->get_average_rating();
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
	 
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cmsms_product_left_column">
		<?php
			/**
			 * woocommerce_show_product_images hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
	</div>
	<div class="summary entry-summary cmsms_product_right_column">
		<?php
			woocommerce_template_single_title();
			
			echo '<div class="cmsms_wrap_price">';
				woocommerce_template_single_price();
				echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'cmsmasters' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'cmsmasters' ).'</span></div>' . 
			'</div>';
			
			woocommerce_template_single_excerpt();
			
			echo '<div class="cmsms_wrap_cart_form">';
				woocommerce_template_single_add_to_cart();
			echo '</div>';
			
			woocommerce_template_single_meta();
			woocommerce_template_single_sharing();
		?>
	</div><!-- .summary -->
	<div class="cl"></div>

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