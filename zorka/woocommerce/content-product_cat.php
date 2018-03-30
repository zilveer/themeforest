<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
	exit;
}
global $woocommerce_loop;
if (woocommerce_version_check('2.6','<')) {


// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}

// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}

// Increase loop count
	$woocommerce_loop['loop'] ++;
}

$classes = array('product-cat-item');
global $zorka_product_layout;
if (!isset($zorka_product_layout) || $zorka_product_layout == '') {
	switch($woocommerce_loop['columns']) {
		case 4:
			$classes[] = 'col-md-3 col-sm-4 col-xs-6';
			break;
		case 3 :
			$classes[] = 'col-md-4  col-sm-4 col-xs-6';
			break;
		case 2 :
			$classes[] = 'col-md-6  col-sm-6 col-xs-6';
			break;
	}
}

?>
<div <?php wc_product_cat_class($classes); ?>>
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

		<h3>
			<?php
				echo $category->name;
			?>
		</h3>

		<?php if ( $category->count > 0 )
			echo apply_filters( 'woocommerce_subcategory_count_html', '<span class="count">' . $category->count . ' ' . esc_html__('Items','zorka') . '</span>', $category );
		?>


		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>
