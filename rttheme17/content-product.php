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

 
global $product, $woocommerce_loop, $woo_layout_names, $woo_module_used_in_template , $woo_column_class_name, $height_fix; 


// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) 
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) 
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woo_column_class_name );

// Ensure visibilty
if ( ! $product->is_visible() ) 
	return; 
// Height Fix
if ( @$height_fix != "FALSE" )
	$height_fix = "height_fix";


// Increase loop count
$woocommerce_loop['loop']++; 
?> 

<?php if(is_woocommerce() || $woo_module_used_in_template=="TRUE"):?>
	<li style="position:relative;" class=" box <?php echo $height_fix;?> <?php echo $woo_column_class_name;?> box-shadow  margin-b20 <?php 
		if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) 
			echo 'last'; 
		elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) 
			echo 'first'; 
		?>">
	<?php else:?>
	<li style="position:relative;margin-bottom:20px;" class="box  box-shadow <?php echo $woo_layout_names[$woocommerce_loop['columns']];?> <?php 
		if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) 
			echo 'last'; 
		elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) 
			echo 'first'; 
		?>">
<?php endif;?>
 
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

		<div class="product_info">		
		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
		
		<?php
			/** 
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */	  
			do_action( 'woocommerce_after_shop_loop_item_title' ); 
		?>

	</a>

	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' ); 

	?>

</li>

 