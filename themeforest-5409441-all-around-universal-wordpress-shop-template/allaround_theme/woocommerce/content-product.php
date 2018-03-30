<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
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
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % 2 )
	$classes[] = 'last';
if ( ( 0 == $woocommerce_loop['loop'] % 3 ) or ( 0 == $woocommerce_loop['loop'] % 4 ) )
	$classes[] = 'right';
	
	$classes[] ='products2_column';
	$classes[] ='products';
?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			remove_action ( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			do_action( 'woocommerce_before_shop_loop_item_title' );
			
			$out = '';
			$excerpt = get_the_excerpt();
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'product-500');

			$image_wrapper = '<div class="image_wrapper">' . get_the_post_thumbnail($post->ID, 'blog-231', array('class' => 'col-1-4_img'));
			$image_wrapper .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" rel="prettyPhoto"><img src="' . get_template_directory_uri() . '/images/home/more.png" class="customColorBg" alt="" /></a></div><!-- image_more_info -->';
			$image_wrapper .= '<div class="image_read_more_wrapper"><div class="image_read_more"><a href="' . get_permalink() . '">' . __ ('Read More', 'allaround') . '</a></div></div><!-- image_read_more_wrapper --></div><!-- image_wrapper -->';
			
			$text_wrapper = '<div class="text_wrapper"><h3><a href="' . get_permalink() . '">'. get_the_title() .'</a></h3><span class="subtitle">' . get_the_term_list( get_the_ID(), 'product_cat', '', ' ', '' ) . '</span>';
			$text_wrapper .= '<span>' . string_limit_words( $excerpt, 96 ) . '</span><div class="clear"></div><!-- clear -->';
			
			if ( ( 0 == $woocommerce_loop['loop'] % 3 ) or ( 0 == $woocommerce_loop['loop'] % 4 ) ) {
				echo $text_wrapper;
				do_action( 'woocommerce_after_shop_loop_item_title' );
				do_action( 'woocommerce_after_shop_loop_item' );
				echo '</div><!-- text_wrapper -->';
				echo $image_wrapper;
			}
			else {
				echo $image_wrapper;
				echo $text_wrapper;
				do_action( 'woocommerce_after_shop_loop_item_title' );
				do_action( 'woocommerce_after_shop_loop_item' );
				echo '</div><!-- text_wrapper -->';
			}
			if ( $woocommerce_loop['loop'] == 4 ) $woocommerce_loop['loop'] = 0;
		?>
</div>