<?php
# 
# rt-theme
# loop item for woocommerce products
#
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $rt_item_width, $rt_sidebar_location, $rt_display_descriptions, $rt_display_price, $rt_display_titles, $product, $woocommerce_loop, $products, $woo_product_layout, $page_product_count, $first_row, $last_row; 
?>

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
		<div>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div> 
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>