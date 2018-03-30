<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( null === cs_get_customize_option( 'shop_sidebar' ) ) {
	$page_sidebar = 'none';
} else {
	$page_sidebar = cs_get_customize_option( 'shop_sidebar' );
}

if ( isset( $page_sidebar ) && ( 'left' === $page_sidebar ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}

get_header(); ?>


<section id="page-wrapper" class="blog-section">
	<div class="container">
		<div class="new-block">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<div class="row page-tagline">
					<div class="col-md-6 col-md-offset-3">
						<h2 class="title"><?php woocommerce_page_title(); ?></h2>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
				<?php if ( isset( $page_sidebar ) && ( $page_sidebar == 'none' ) ){ ?>
				<div class=" col-md-12 col-sm-12 col-xs-12">
					<?php } else { ?>
					<div class=" col-md-8 col-sm-8 col-xs-12 <?php echo esc_attr( $sidebar_class ); ?>">
						<?php } ?>
						<?php if ( have_posts() ) : ?>

							<?php
							/**
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>

							<?php woocommerce_product_loop_start(); ?>

							<?php woocommerce_product_subcategories(); ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
							crum_posts_navigation();
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array(
							'before' => woocommerce_product_loop_start( false ),
							'after'  => woocommerce_product_loop_end( false )
						) )
						) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

					</div>

					<?php if ( ! ( $page_sidebar == 'none' ) ) {
						/**
						 * woocommerce_sidebar hook.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
					} ?>
				</div><!--.row-->
			</div><!--new-block-->
		</div><!-- .container -->
</section><!-- #page-wrapper -->


<?php get_footer(); ?>
