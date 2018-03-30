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

<?php do_action( 'woocommerce_before_single_product' ); ?>
<article  itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

	<div class="summary entry-summary">
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 15
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 10
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
	</div>
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</article>
<?php do_action( 'woocommerce_after_single_product' ); ?>