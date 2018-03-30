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
if (0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
    $classes[] = ' first ';
if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
    $classes[] = ' last ';





if(get_option('sense_column_products') && get_option('sense_column_products') != '') {
$classes[] = get_option('sense_column_products');

	if(get_option('sense_column_products_mobile') && get_option('sense_column_products_mobile') != '') {
	$classes[] = get_option('sense_column_products_mobile');
	}


} else {
$classes[] = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';	
}

?>


<li <?php post_class( $classes ); ?>>

	<?php 
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	
	do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="product-image">
			<?php //do_action('woocommerce_before_shop_loop_item_title'); 
			if ( $product->is_on_sale() ) : 

					echo '<span class="onsale" style="margin-left: 0;" >'. __("Sale",'homeshop') .'</span>'; 

			endif; 
			
			if ( !$product->is_in_stock() ) : 

					echo '<span class="onsale labels_stock" style="margin-left: 0;" >'. __("Stock",'homeshop') .'</span>'; 

			endif; ?>
			
			
			<?php if ( $product->is_featured() ) : ?>

				<?php echo apply_filters( 'woocommerce_featured_flash', '<span class="onsale onfeatured">' . __( 'Hot', 'homeshop' ) . '</span>', $post, $product ); ?>

			<?php endif; ?>	 
			
			
			
			<?php
			//if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'show') {
			echo '<a href="' . esc_url(get_permalink()) . '" class="img-product-hover">';
			//}
			
			if( has_post_thumbnail() ) {
			echo get_the_post_thumbnail( $product->id, 'th-shop' ); 
			} else {
			echo woocommerce_placeholder_img( 'shop_thumbnail' );
			}
			?>
			<?php 
			//if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'show') {
			echo '</a>';
			//} 
			?>
			
			<?php if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') { ?>
								
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-hover">
				<i class="icons icon-eye-1"></i> <?php _e('Quick View', 'homeshop'); ?>
			</a>
			
			<?php } ?>
			
	</div>
	
	<div class="product-info">

		<h3><a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php 
		echo product_max_charlength_text(get_the_title($product->id), (int) get_option('sense_num_product_title')); 
		?>
		</a></h3>
		
		<?php 
			/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		
		do_action( 'woocommerce_shop_loop_item_title' );
		
		
		?>
		
		
		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<span class="price"><?php echo $price_html; ?></span>
		<?php endif; ?>
		<?php woocommerce_get_template( 'loop/rating.php' ); ?>
	
	
	<div class="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->post_excerpt ) ?>
	   <?php // woocommerce_template_single_excerpt(); ?>
    </div>
	
	</div>
	
	
	
	
	
	<div class="product-actions">
	<?php
	
	woocommerce_template_loop_add_to_cart();
	
	if( class_exists( 'YITH_WCWL_Shortcode' ) ) {
	echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
	
	?>
	
	
		<?php if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button() != '' ) { ?>
		<span class="add-to-compare">
			<span class="action-wrapper">
				<i class="icons icon-docs"></i>
				<span class="action-name"><?php if ( function_exists('woo_add_compare_button' ) ) echo woo_add_compare_button(); ?></span>
			</span>
		</span>
		<?php } ?>	
		
		
	</div>
	
	
	
	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	
	do_action( 'woocommerce_after_shop_loop_item' );
	?>

</li>