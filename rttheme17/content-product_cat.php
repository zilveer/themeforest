<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop, $woo_layout_names;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) 
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) 
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li style="position:relative;margin-bottom:20px;" class="box height_fix sub_category box-shadow <?php echo $woo_layout_names[$woocommerce_loop['columns']];?> <?php 
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) 
		echo 'last'; 
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) 
		echo 'first'; 
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
		
	
				
		<?php
			/** 
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			$var = do_action( 'woocommerce_before_subcategory_title', $category ); 
		?>

		<div class="product_info">		
		<h5>
			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php echo $category->name; ?> 
			<?php if ( $category->count > 0 ) : ?>
				<mark class="count">(<?php echo $category->count; ?>)</mark>
			<?php endif; ?>
			</a>
		</h5>
 

		<?php
			/** 
			 * woocommerce_after_subcategory_title hook
			 */	  
			do_action( 'woocommerce_after_subcategory_title', $category ); 
		?>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
		</div>
			
</li>