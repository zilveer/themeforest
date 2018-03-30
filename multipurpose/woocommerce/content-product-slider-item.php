<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Extra post classes
$classes = array('col6', 'post');
?>
<article <?php post_class( $classes ); ?>>
	<div class="img">
		<a href="<?php the_permalink(); ?>">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>
	</div>

	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
	<?php if ( $price_html = $product->get_price_html() ) : ?>
		<span class="price"><strong><?php echo $price_html; ?></strong></span>
	<?php endif; ?>
</article>