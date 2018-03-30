<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid.
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count.
$woocommerce_loop['loop']++;

$_3clicks_class = array(
	'g1-collection__item',
	'product-category',
	'product',
);

if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$_3clicks_class[] = 'first';
}

if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$_3clicks_class[] = 'last';
}

?>
<li class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $_3clicks_class ) ); ?>">
	<article <?php wc_product_cat_class( '', $category ); ?>>
		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<?php
		/**
		 * woocommerce_before_subcategory_title hook
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<h3 class="g1-h4">
			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
				<?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
				?>
			</a>
		</h3>

		<?php
		/**
		 * woocommerce_after_subcategory_title hook
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );
		?>

		<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
	</article>
</li>
