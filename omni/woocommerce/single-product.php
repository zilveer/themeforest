<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( null === cs_get_customize_option( 'single_shop_sidebar' ) ) {
	$page_sidebar = 'none';
} else {
	$page_sidebar = cs_get_customize_option( 'single_shop_sidebar' );
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

			<div class="row">
				<?php if ( isset( $page_sidebar ) && ( $page_sidebar == 'none' ) ){ ?>
				<div class=" col-md-12 col-sm-12 col-xs-12">
					<?php } else { ?>
					<div class=" col-md-8 col-sm-8 col-xs-12 <?php echo esc_attr( $sidebar_class ); ?>">
						<?php } ?>

						<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
						?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

						<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
						?>
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
