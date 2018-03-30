<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'sd-first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'sd-last';
}
	
if ( $woocommerce_loop['columns'] == 2 ) {
	
	$classes[] = 'col-md-6';

} elseif ( $woocommerce_loop['columns'] == 3 ) {
	
	$classes[] = 'col-md-4 col-sm-6 col-xs-12';
	
} elseif ( $woocommerce_loop['columns'] == 4 ) {
	
	$classes[] = 'col-md-3 col-sm-4 col-xs-12';
	
} elseif ( $woocommerce_loop['columns'] == 5 ) {
	
	$classes[] = 'col-md-5ths';
	
} elseif ( $woocommerce_loop['columns'] == 6 ) {
	
	$classes[] = 'col-md-2';
	
}

$classes[] = 'sd-loop-class';

?>
<div <?php post_class( $classes ); ?>>
	<div class="sd-product">

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="sd-thumb-add-cart">
			<div class="sd-shop-thumb-overlay sd-opacity-trans">
				<?php
					/**
					 * woocommerce_after_shop_loop_item hook
					 *
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' ); 
				?>
				
			</div>
			<span class="sd-loading-cart"><i class="fa fa-spinner fa-pulse"></i></span>
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</div>
		<!-- sd-thumb-add-cart -->
		<div class="sd-product-content clearfix">
			<h3><a href="<?php the_permalink(); ?>"  title="<?php echo esc_attr( sprintf( __( '%s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
			<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			
			
			<div class="sd-price">
				<?php echo woocommerce_template_loop_price(); ?>
			</div>
			
			
			<?php if ( $rating_html = $product->get_rating_html() ) : ?>
				<div class="sd-stars">
					<span class="sd-rating-text"><?php _e( 'RATING', 'sd-framework' ); ?></span>
					<?php echo $rating_html; ?>
				</div>
			<?php endif; ?>
		</div>
		<!-- sd-product-content -->
	</div>
	<!-- sd-product -->
</div>
<?php
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
		echo '<div class="clearfix visible-md-block visible-lg-block sd-separate-rows"></div>';
}
if ( $woocommerce_loop['columns'] == 3 ) {
	if ( 0 === $woocommerce_loop['loop'] % 2 ) {
			echo '<div class="clearfix visible-sm-block visible-xs-block sd-separate-rows"></div>';
	}
} elseif ( $woocommerce_loop['columns'] == 4 ) {
	if ( 0 === $woocommerce_loop['loop'] % 3 ) {
		echo '<div class="clearfix visible-sm-block sd-separate-rows"></div>';
	} 
	if ( 0 === $woocommerce_loop['loop'] % 2 ) {
		echo '<div class="clearfix visible-xs-block sd-separate-rows"></div>';		
	}
}
?>
