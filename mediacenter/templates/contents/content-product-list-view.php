<?php
/**
 * The template for displaying product content within list view loops.
 *
 * @author  Transvelo
 * @package MediaCenter/Templates/Contents/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div <?php post_class(); ?>>
	<div class="product-list-view-inner">

		<div class="product-list-view-header">
			<?php
				/**
				 * @hooked mc_loop_product_thumbnail - 10
				 */
				do_action( 'mc_before_loop_list_view_body' );
			?>
		</div>
		
		<a href="<?php the_permalink(); ?>" class="product-list-view-body">
			<?php
				/**
				 * @hooked mc_output_list_view_body_wrapper - 10
				 * @hooked mc_shop_loop_item_title - 20
				 * @hooked mc_loop_product_excerpt - 30
				 * @hooked mc_loop_action_buttons - 40
				 * @hooked mc_output_list_view_body_wrapper_end - 50
				 */
				do_action( 'mc_loop_list_view_body' );
			?>
		</a>
		
		<?php 
			/**
			 * @hooked mc_output_list_view_footer_start - 10
			 * @hooked woocommerce_template_loop_price - 20
			 * @hooked mc_loop_stock_availability - 30
			 * @hooked woocommerce_template_loop_add_to_cart - 40
			 * @hooked mc_output_list_view_footer_end - 50
			 *
			 */
			do_action( 'mc_after_loop_list_view_body' );
		?>

	</div><!-- /.product-list-view-inner -->
</div>