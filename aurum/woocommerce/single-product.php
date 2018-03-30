<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php
		if(SHOP_SINGLE_SIDEBAR):

			$class = 'col-md-9 col-sm-8';

			if(get_data('shop_single_sidebar') == 'left')
				$class .= ' pull-right-md';

		?>
		<div class="row">
			<div class="<?php echo $class; ?>">
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>


		<?php if(SHOP_SINGLE_SIDEBAR): ?>
			</div>

			<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */

				# start: modified by Arlind Nushi
				do_action( 'woocommerce_sidebar' );
				# end: modified by Arlind Nushi
			?>
		</div>
		<?php endif; ?>


		<?php
		# start: modified by Arlind Nushi
		get_template_part('tpls/woocommerce-product-next-prev');
		# end: modified by Arlind Nushi
		?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>



<?php get_footer( 'shop' ); ?>