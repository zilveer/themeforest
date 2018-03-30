<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */
if ( !defined( 'ABSPATH' ) ) {
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
if ( !$product || !$product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
$settings = crazyblog_opt();
if ( is_product_category() ) {
	$innerCol = (crazyblog_set( $settings, 'shop_cat_col' )) ? crazyblog_set( $settings, 'shop_cat_col' ) : 'col-md-3';
} else if ( is_product_tag() ) {
	$innerCol = (crazyblog_set( $settings, 'shop_tag_col' )) ? crazyblog_set( $settings, 'shop_tag_col' ) : 'col-md-3';
} else {
	$innerCol = (crazyblog_set( $settings, 'shop_page_col' )) ? crazyblog_set( $settings, 'shop_page_col' ) : 'col-md-3';
}
global $product;
$add_to_cart = '';
if ( $product->is_purchasable() && $product->is_in_stock() ) {
	if ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) == 'yes' ) {
		$add_to_cart = 'add_to_cart_button ajax_add_to_cart';
	} else {
		$add_to_cart = 'add_to_cart_button';
	}
}
?>

<div class="<?php echo esc_attr( $innerCol ) ?> filter1">
	<div class="product-post">
		<div class="product-img">
			<?php the_post_thumbnail( 'crazyblog_454x344' ) ?>
			<span>
				<?php
				echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="fa fa-shopping-cart"></i></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : '' )
	),
$product );
				?>
			</span>
		</div>
		<h5><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h5>
		<?php echo $product->get_price_html() ?>
	</div><!-- Product Post -->
</div>