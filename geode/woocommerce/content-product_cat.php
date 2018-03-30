<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 * @version     2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$classes[] = 'columns-'.$woocommerce_loop['columns'];
$classes[] = 'column';
$classes[] = apply_filters('geode_fx_onscroll','');

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] ='first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div role="listitem" <?php wc_product_cat_class( $classes, $category ); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<div>

		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="attachments-shop_catalog">

			<div>

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>

			</div>

		</a>

		<div class="woocommerce_after_shop_loop_item_title">

			<h3>
				<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
					<?php
						echo $category->name;

						if ( $category->count > 0 )
							echo apply_filters( 'woocommerce_subcategory_count_html', ' <small class="count">(' . $category->count . ')</small>', $category );
					?>
				</a>
			</h3>

			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>

			<?php
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>

		</div>
	</div>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>