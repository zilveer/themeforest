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
 * @version 2.5.0
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
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
$oi_qoon_options = get_option('oi_qoon_options');
if ($_GET['per_page']!=''){$oi_qoon_options['oi_shop_per_page'] = $_GET['per_page'];}
if ($_GET['per_row']!=''){
	if ($_GET['per_row']=='3'){
		$oi_qoon_options['oi_shop_per_row'] = 'col-md-4 col-sm-4';
	};
	if ($_GET['per_row']=='4'){
		$oi_qoon_options['oi_shop_per_row'] = 'col-md-3 col-sm-3';
	};
	if ($_GET['per_row']=='2'){
		$oi_qoon_options['oi_shop_per_row'] = 'col-md-6 col-sm-6';
	}
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$oi_qoon_options['oi_shop_per_page'].';' ), 20 );



$classes[] = $oi_qoon_options['oi_shop_per_row'];

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
            <h4 class="oi_product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div class="clearfix">
            	<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
             </div>
             <div class="oi_add_to_cart_arcvhive">
             	<div class="add_to_cart_arcvhive_holder">
             		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                </div>
                <div class="details_arcvhive_holder">
             		<a href="<?php the_permalink(); ?>"><?php _e('Details','qoon-creative-wordpress-portfolio-theme'); ?></a>
                </div>
             </div>
             <div class="clearfix"></div>
        </div>
    </div>

</div>