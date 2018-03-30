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

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() )
	return;

// Extra post classes
$classes = array();
$classes[] = 'has-animation';

// calculate the data delay
$start 			= 100; // ms
$step 			= 200; // ms
$current_column = 1;
if ( !empty( $woocommerce_loop['loop'] ) ){
	
	$current_column = intval( $woocommerce_loop['loop'] ) + 1;
}
$shop_columns = 1;
if ( !empty( $woocommerce_loop['columns'] ) ){
	
	$shop_columns 	= intval( $woocommerce_loop['columns'] );
}
else {
	
	$shop_columns 	= apply_filters( 'loop_shop_columns', 4 );
}	
if( $current_column > $shop_columns ){
	
	$current_column = ($current_column - 1) % $shop_columns;
}
$data_delay = $start + $current_column * $step;
 
?>
<li <?php post_class( $classes ); ?> data-animation="fade-in-from-bottom" data-delay="<?php echo $data_delay; ?>">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
	?>

	<h4 class="product_title"><?php the_title(); ?></h4>

	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>


	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' ); 

	?>

</li>
