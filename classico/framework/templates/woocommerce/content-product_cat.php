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

$class = '';

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

if ( empty( $woocommerce_loop['categories_columns'] ) )
	$woocommerce_loop['categories_columns'] = 3;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	
if( !empty($woocommerce_loop['display_type']) && $woocommerce_loop['display_type'] == 'slider' ) {
	$class = 'slide-item';
} else {
	$col_sm = 12 / $woocommerce_loop['categories_columns'];
	$class = 'col-xs-12 col-sm-' . $col_sm . ' category-grid columns-' . $woocommerce_loop['categories_columns'];
}

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="<?php echo $class; ?> product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	?>">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>
		<div class="categories-mask">
			<span><?php _e('Category', ET_DOMAIN); ?></span>
			<h4><?php echo $category->name; ?></h4>
			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>
			<span class="more"><?php _e('Read More', ET_DOMAIN); ?></span>
		</div>


	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>