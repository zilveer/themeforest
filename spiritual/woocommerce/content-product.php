<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$shop_product_column = (get_option('swm_woo_shop_p_column') <> '') ? esc_attr(get_option('swm_woo_shop_p_column')) : 4;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $shop_product_column );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

// Set loop column
$swm_woo_column = 'shop-column-' . $woocommerce_loop['columns'];
array_push($classes,$swm_woo_column);

?>
<li <?php post_class( $classes ); ?>>
	<div class="swm-featured-product-block">

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<h3 class="swm-product-title swm_text_color"><a href="<?php echo get_the_permalink(); ?>" class="swm-product-title-link"><?php the_title(); ?></a></h3>

		<div class="swm_woo_featuredimg">
			
			<a href="<?php the_permalink(); ?>" class="product-images">
				
				
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

			<div class="swm-product-details">				

				<div class="swm-product-price-cart">

					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>

					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				
				</div>
				<div class="clear"></div>

			</div>
	</div>

	

</li>