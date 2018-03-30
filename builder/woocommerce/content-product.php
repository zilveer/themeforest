<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $oi_options;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

$classes[] = $oi_options['oi_shop_per_row'];
?>
<div <?php post_class( $classes ); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>" class="product-images">
		<?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>
        <?php if ($attachment_ids[0] !=''){?>
        <div class="oi_first_image">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
        </div>
        <div class="oi_second_image">
			<?php echo wp_get_attachment_image($attachment_ids[0], 'shop_catalog');?>
        </div>
        <?php }else{?>
        <div class="oi_first_image oi_single_image">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
        </div>
        <?php };?>
     </a>
       
    <div class="oi_product-details">
        <div class="oi_product-details-container">
            <h5 class="oi_product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <div class="clearfix">
            	<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
             </div>
             <div class="oi_add_to_cart_arcvhive">
             	<div class="add_to_cart_arcvhive_holder">
             		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                </div>
                <div class="details_arcvhive_holder">
             		<a href="<?php the_permalink(); ?>"><?php _e('<i class="fa  fa-plus-square-o"></i> Details','orangeidea'); ?></a>
                </div>
             </div>
             <div class="clearfix"></div>
        </div>
    </div>

</div>
