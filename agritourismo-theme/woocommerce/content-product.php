<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
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
	<div class="column3">
		<div class="product">

			<div class="product-header">
				<a href="<?php the_permalink();?>"><?php echo $product->get_image(array(300,0)); ?></a>
			</div>
			<div class="product-content">
				<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				<p><?php echo wordLimiter(get_the_excerpt(),20); ?></p>
				<div class="detail">
					<?php echo $product->get_price_html(); ?>
					<?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' && $product->get_rating_count() > "0") { ?>
						<span class="rating">
							<a href="<?php the_permalink();?>" class="ratingscount"><?php echo $product->get_rating_count();?> <?php _e("ratings", THEME_NAME);?></a>
							<?php echo $product->get_rating_html(); ?>
						</span>
					<?php } ?>
					<div class="clear-float"></div>
				</div>
			</div>
			<?php get_template_part("woocommerce/loop/add-to-cart");?>

		</div>
	</div>