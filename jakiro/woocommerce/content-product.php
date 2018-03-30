<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wp_enqueue_script('vendor-carouFredSel');
wp_enqueue_script( 'wc-add-to-cart-variation' );

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

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
?>
<li <?php post_class( $classes ); ?>>
	<div class="product-container">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<figure>
			<div class="product-wrap">
				<div class="product-images">
					<a href="<?php the_permalink(); ?>">
						<?php if ( !$product->is_in_stock() ) : ?>            
			            	<span class="out_of_stock"><?php esc_html_e( 'Out of stock', 'jakiro' ); ?></span>            
						<?php endif; ?>
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
					<?php 
						if(class_exists('DH_Woocommerce'))
						DH_Woocommerce::instance()->template_loop_quickview();
					?>
				</div>
			</div>
			<figcaption>
				<div class="shop-loop-product-info">
					<div class="info-title">
						<h3 class="product_title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
					</div>
					<div class="info-rating">
							<?php woocommerce_template_loop_rating(); ?>
						</div>
					<div class="info-meta">
						<div class="info-price">
							<?php woocommerce_template_loop_price(); ?>
						</div>
						<div class="info-availability">
						<?php
							// Availability
							$availability      = $product->get_availability();
							$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html__('Available : ','jakiro') .'<span>'. esc_html( $availability['availability'] ) . '</span></p>';
						
							echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
						?>
						</div>
						<div class="info-excerpt">
							<?php echo wp_trim_words($post->post_excerpt,30)?>
						</div>
						<div class="loop-add-to-cart">
							<?php woocommerce_template_loop_add_to_cart();?>
						</div>
					</div>
				</div>
			</figcaption>
		</figure>
	</div>
</li>