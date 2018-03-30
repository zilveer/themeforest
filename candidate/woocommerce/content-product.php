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

$num_comments1 = get_comments_number();
$num_rating1 = (int) $product->get_average_rating();
$price1 = $product->get_price();

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
$classes[] = 'col-lg-4 col-md-4 col-sm-6 mix';
?>

<div <?php post_class( $classes ); ?> data-dateorder="<?php  echo '1'; ?>" data-popularorder="<?php  echo $num_comments1; ?>" data-avgratingorder="<?php  echo $num_rating1; ?>" data-priceorder="<?php  echo $price1; ?>">

	<?php 
	$attachment_ids = $product->get_gallery_attachment_ids();
	 ?>
	 <?php 
	
	 
	 /**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	 
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
	do_action( 'woocommerce_before_shop_loop_item' ); 
	?>

	<!-- Shop Item -->
	<div class="shop-item animate-onscroll">

		<div class="shop-image">
			<a href="<?php the_permalink(); ?>">
			
				<?php if ( $product->is_on_sale() ) : ?>

					<?php echo '<div class="shop-ribbon-sale"></div>'; ?>

				<?php endif; ?>
				
				
				<?php if ( !$product->is_in_stock() ) : ?>

					<?php echo '<div class="shop-ribbon-stock"></div>'; ?>

				<?php endif; ?>
				
				
				<div class="shop-featured-image">
				
					<?php if( has_post_thumbnail() ) {
					echo get_the_post_thumbnail( $product->id, 'th-shop' ); 
					} else {
					echo woocommerce_placeholder_img( 'shop_thumbnail' );
					} ?>
					
				</div>
				<?php if ( $attachment_ids ) { 
				$image_attributes = wp_get_attachment_image_src( $attachment_ids[0], 'th-shop'  );			
				?>
				<div class="shop-hover">
					<img src="<?php echo $image_attributes[0]; ?>" alt="">
				</div>
				<?php } ?>
				
			</a>
		</div>
		
		<div class="shop-content">
			
			<?php 
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			 
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );  
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );  
			do_action( 'woocommerce_before_shop_loop_item_title' );
			
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			 
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );  
			do_action( 'woocommerce_shop_loop_item_title' );
			?>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			
			<?php 
			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			 
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			do_action( 'woocommerce_after_shop_loop_item_title' );
			 ?>
			 
			 
			<?php if ( $price_html = $product->get_price_html() ) { ?>
			<span class="price"><?php echo $price_html; ?></span>
			<?php } ?>
			
			<?php woocommerce_get_template( 'loop/rating.php' ); ?>
			
			
			<?php 
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			 
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
			
			<a href="<?php the_permalink(); ?>" class="button details-button button-arrow transparent"><?php echo __('Details','candidate');?></a>
			
			
			
		</div>
		
	</div>
	<!-- /Shop Item -->

	
	
	

</div >