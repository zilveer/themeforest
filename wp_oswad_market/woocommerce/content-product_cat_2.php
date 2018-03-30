<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	
$classes = ' col-sm-8';
if( is_numeric($woocommerce_loop['columns']) && (int)$woocommerce_loop['columns'] > 0 )
	$classes = ' col-sm-'.(24/(int)$woocommerce_loop['columns']);

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li class="product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1)
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	echo $classes;
	?>">
	<div class="category-item">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="label-link"></a>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category-name">
			<h3>
				<?php
					echo $category->name;
				?>
			</h3>
		</a>
		<div class="category-description">
			<?php echo term_description($category->term_id, 'product_cat'); ?>
		</div>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category-thumbnail">
			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
		</a>

		<div class="min-price">
		<?php 
			_e('From ', 'wpdance');
			echo wd_get_min_price_product_category($category->term_id);
		?>
		</div>
	</div>
</li>