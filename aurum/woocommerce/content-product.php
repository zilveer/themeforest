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

global $product, $is_related_products, $products_columns;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// start: modified by Arlind Nushi
$item_colums = '';
$item_preview_type = get_data('shop_item_preview_type');

$shop_columns = SHOP_COLUMNS;

if($products_columns > 0) {
	$shop_columns = $products_columns;
}

if($is_related_products) {
	$shop_columns = 4;
}

$classes[] = 'shop-item';

switch($item_preview_type)
{
	case "fade":
		$classes[] = 'hover-effect-1';
		break;

	case "slide":
		$classes[] = 'hover-effect-1 image-slide';
		break;

	case "gallery":
		$classes[] = 'hover-effect-2 image-slide';
		break;
}

$xs_column = get_data( 'shop_products_mobile_two_per_row' ) == 'two' ? 'col-xs-6' : 'col-xs-12';

switch($shop_columns)
{
	case 6:
		$item_colums = "col-lg-2 col-md-2 col-sm-2 {$xs_column}";
		break;

	case 5:
		$item_colums = "col-lg-15 col-md-3 col-sm-6 {$xs_column}";
		break;

	case 4:
		$item_colums = "col-lg-3 col-md-3 col-sm-6 {$xs_column}";
		break;

	case 3:
		$item_colums = "col-lg-4 col-md-4 col-sm-6 {$xs_column}";
		break;

	case 2:
		$item_colums = "col-sm-6 {$xs_column}";
		break;

	case 1:
		$item_colums = "col-sm-12 {$xs_column}";
		break;
}

if($products_columns == -1) {
	$item_colums = '';
}
// end: modified by Arlind Nushi
?>

<?php // start: modified by Arlind ?>
<?php if ( $item_colums ) : ?>
<div class="item-column <?php echo $item_colums; ?>">
<?php endif; ?>
<?php // end: modified by Arlind ?>

	<div <?php post_class( $classes ); ?>>
		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	
		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
	
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
	
		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		// start: modified by Arlind Nushi
		#do_action( 'woocommerce_after_shop_loop_item' ); Moved to inc/laborator_woocommerce.php->aurum_shop_loop_item_title()
		// end: modified by Arlind Nushi
		?>
	</div>

<?php // start: modified by Arlind ?>
<?php if ( $item_colums ) : ?>
</div>
<?php endif; ?>
<?php // end: modified by Arlind ?>

<?php
// start: modified by Arlind
do_action( 'aurum_woocommerce_shop_loop_clear_row', $shop_columns, $item_colums );
// end: modified by Arlind