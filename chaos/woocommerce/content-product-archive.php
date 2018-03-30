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

global $product, $woocommerce_loop, $road_opt, $road_shopclass, $road_productrows, $road_productsfound, $road_viewmode;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Extra post classes
$classes = array();

$count   = $product->get_rating_count();

$colwidth = 3;
if($woocommerce_loop['columns'] > 0){
	$colwidth = round(12/$woocommerce_loop['columns']);
}

if($road_shopclass=='shop-fullwidth') {
	if(isset($road_opt)){
		$woocommerce_loop['columns'] = $road_opt['product_per_row_fw'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-xs-12 col-sm-4 col-md-'.$colwidth ;
} else {
	if(isset($road_opt)){
		$woocommerce_loop['columns'] = $road_opt['product_per_row'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-xs-12 col-sm-'.$colwidth ;
}
?>

<div <?php post_class( $classes ); ?>>
	<div class="product-wrapper">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<?php if ( $product->is_on_sale() ) : ?>
			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale"><span class="sale-text">' . __( 'Sale', 'woocommerce' ) . '</span></span>', $post, $product ); ?>
		<?php endif; ?>
		<div class="list-col4 <?php if($road_viewmode=='list-view'){ echo ' col-xs-12 col-sm-4';} ?>">
			<div class="product-image">
				<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
					<?php 
					echo $product->get_image('shop_catalog', array('class'=>'primary_image'));
					
					if(isset($road_opt['second_image'])){
						if($road_opt['second_image']){
							$attachment_ids = $product->get_gallery_attachment_ids();
							if ( $attachment_ids ) {
								echo wp_get_attachment_image( $attachment_ids[0], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
							}
						}
					}
					?>
				</a>
				<div class="quickviewbtn">
					<a class="detail-link quickview" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Quick View', 'roadthemes');?></a>
				</div>
				<div class="actions">
					<div class="action-buttons">
						
						<div class="add-to-links">
							<?php if ( class_exists( 'YITH_WCWL' ) ) {
								echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]'));
							} ?>
							<?php if( class_exists( 'YITH_Woocompare' ) ) {
								echo do_shortcode('[yith_compare_button]');
							} ?>
						</div>
						<div class="add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.$product->id.'"]') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="list-col8 <?php if($road_viewmode=='list-view'){ echo ' col-xs-12 col-sm-8';} ?>">
			<div class="gridview">
				<div class="ratings"><?php echo $product->get_rating_html(); ?></div>
				<div class="price-box"><?php echo $product->get_price_html(); ?></div>
				<h2 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="listview">
				<h2 class="product-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="ratings"><?php echo $product->get_rating_html(); ?></div>
				<div class="price-box"><?php echo $product->get_price_html(); ?></div>
				<div class="product-desc"><?php the_excerpt(); ?></div>
				<div class="actions">
					<div class="action-buttons">
						<div class="add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.$product->id.'"]') ?>
						</div>
						<div class="add-to-links">
							<?php if ( class_exists( 'YITH_WCWL' ) ) {
								echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]'));
							} ?>
							<?php if( class_exists( 'YITH_Woocompare' ) ) {
								echo do_shortcode('[yith_compare_button]');
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>