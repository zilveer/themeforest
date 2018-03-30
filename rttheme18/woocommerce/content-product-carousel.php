<?php
/**
 * The template for displaying product content within product carousels.
 *
 * modified version of content-product.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?> 

<div class="product product_item_holder item">

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
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</div> 
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>