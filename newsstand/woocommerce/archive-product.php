<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div class="container shop-page">
		<div class="row">
			<div class="col-md-9">
				<div class="shop-items">

					<div class="s-title">
						<div class="left-side">
							<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
								<h1 class="s-title"><?php woocommerce_page_title(); ?></h1>
							<?php endif; ?>

							<?php if ( have_posts() ) : ?>

								<?php woocommerce_result_count(); ?>

							<?php endif; ?>
						</div>

						<?php if ( have_posts() ) : ?>

							<div class="right-side">
								<?php woocommerce_catalog_ordering(); ?>
							</div>

						<?php endif; ?>
					</div><!-- end of s-title-->

					<div class="s-items">

						<?php if ( have_posts() ) : ?>

							<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
								/**
								 * woocommerce_after_shop_loop hook
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

					</div>

				</div>
			</div>

			<div class="col-md-3">
				<div class="shop-sidebar">

					<?php if (is_active_sidebar('sidebar-2')): ?>
					    <?php dynamic_sidebar( 'sidebar-2' ); ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>

<?php get_footer( 'shop' ); ?>