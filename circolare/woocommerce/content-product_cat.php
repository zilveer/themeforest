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

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
}

// Increase loop count
$woocommerce_loop['loop'] ++;
?>
<li <?php wc_product_cat_class(); ?>>
	
	<div class="product-item">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
	
	<div class="general-block-outer list-product-image product-thumb-alt">
	<div class="general-block">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
	
			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
			
		</a>
	</div>
	</div>

	<div class="title">
		<h3 class="title-container product-titles">
			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
			</a>
		</h3>
	</div>

		<div class="image mosaic-block bar">
		
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>

			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>
		</a>
	</div>
	
	<div class="info">
		
		<div class="float-right">
			<span class="button-small">
				<a href="<?php echo $cat_link; ?>" rel="nofollow"class="special button">
					<?php _e('View More...', 'circolare'); ?>
				</a>
			</span>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>
</li>
