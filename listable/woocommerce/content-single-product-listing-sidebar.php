<?php
/**
 * The template for displaying product content in the listing's sidebar
 *
 *
 * @author 		PixelGrade
 * @package 	Listable
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//lets get the product type so we can add a class to the widget
$product_type_class = "";
$product_details = wc_get_product( get_the_ID() );
if ( ! empty( $product_details ) && ! empty( $product_details->product_type ) ) {
	$product_type_class = "product-type_" . strtolower( $product_details->product_type );
}

?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" class="product woocommerce add_to_cart_inline <?php echo $product_type_class; ?>" id="product-<?php the_ID(); ?>">

	<div class="summary entry-summary">

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
		//do_action( 'woocommerce_single_product_summary' );

		//we start from the single product page but cherry-pick what we need
		wc_get_template( 'single-product/title.php' );
		wc_get_template( 'single-product/price.php' );
		wc_get_template( 'single-product/short-description.php' );
		woocommerce_template_single_add_to_cart(); ?>

	</div><!-- .summary -->
</div>