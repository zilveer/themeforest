<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar' ); } ?>

<div id="main" role="main">

	<?php $footer_parallax_effect = ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) )? true : false ; ?>

	<?php if ( $footer_parallax_effect ): ?>
	<div class="parallax-footer">
	<?php endif ?>

	<?php if ( ! get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/topmenu' ); ?>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

		<?php if ( get_mental_option( 'show_header' ) ): ?>

			<?php azl_get_template_part('blocks/header', '', array('title' => woocommerce_page_title(false))); ?>

		<?php else: ?>

			<div class="section">
				<section>
					<div class="container text-center">
						<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
					</div>
				</section>
			</div>

		<?php endif ?>

	<?php endif ?>

	<div class="section">
		<section>
			<div class="container">
				<div class="row">

					<div class="<?php echo get_mental_option( 'sidebar_show_on', '', 'archive' ) ? 'col-md-8' : 'col-md-12' ?>
						<?php echo ( get_mental_option( 'sidebar_show_on', '', 'archive' ) && get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-push-4' : '' ?>">
						<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
						?>

						<?php do_action( 'woocommerce_archive_description' ); ?>

						<?php if ( have_posts() ) : ?>

							<?php
								/**
								 * woocommerce_before_shop_loop hook
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

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
						?>

					</div>

					<?php if ( get_mental_option( 'sidebar_show_on', '', 'archive' ) ): ?>
						<div
							class="col-md-3 <?php echo ( get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-pull-8' : 'col-md-offset-1' ?>">
							<?php
							/**
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							do_action( 'woocommerce_sidebar' );
							?>
						</div>
					<?php endif ?>

				</div>

			</div> <!-- container -->
		</section>
	</div> <!-- section -->

<?php if ( $footer_parallax_effect ): ?>
	</div>
<?php endif ?>

	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer-woocommerce' ) ?>

</div> <!-- main -->

<?php get_footer( 'shop' ); ?>