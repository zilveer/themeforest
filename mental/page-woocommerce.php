<?php
/*
Template Name: WooCommerce Template
Author: Vedmant <vedmant@gmail.com>
*/
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>
<?php get_header(); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar' ); } ?>

<div id="main" role="main">

	<?php $footer_parallax_effect = ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) )? true : false ; ?>

	<?php if ( $footer_parallax_effect ): ?>
	<div class="parallax-footer">
	<?php endif ?>

	<?php if ( ! get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/topmenu' ); ?>

	<?php if ( get_mental_option( 'show_header' ) ): ?>

		<?php azl_get_template_part('blocks/header', '', array('title' => get_the_title())); ?>

	<?php endif ?>

	<?php if ( have_posts() ): while( have_posts() ) : the_post(); ?>

		<div class="section section-page single-post">
			<section>
				<div class="container <?php echo get_mental_option( 'sidebar_show' ) ? '' : 'container-800' ?>">
					<div class="row sw-description">
						<div class="<?php echo get_mental_option( 'sidebar_show' ) ? 'col-md-8' : 'col-md-12' ?>
							<?php echo ( get_mental_option( 'sidebar_show' ) && get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-push-4' : '' ?>">

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<div class="sp-content">
									<?php the_content(); ?>
								</div>

								<?php the_mental_pagination(); ?>

								<?php wp_link_pages(); ?>

							</article>

							<?php edit_post_link(); ?>

						</div>

						<?php if ( get_mental_option( 'sidebar_show' ) ): ?>
							<div
								class="col-md-3 <?php echo ( get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-pull-8' : 'col-md-offset-1' ?>">
								<?php get_template_part( 'woocommerce/global/sidebar' ); ?>
							</div>
						<?php endif ?>

					</div>

					<!-- container -->
			</section>
		</div> <!-- section -->

		<?php if ( get_mental_option( 'comments_show' ) ): ?>

			<div class="section st-bg-grey-lighter">
				<section>
					<div class="container container-800">

						<?php comments_template(); ?>

					</div>
					<!-- container -->
				</section>
			</div> <!-- section -->

		<?php endif; ?>

	<?php endwhile;
	else: ?>

		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'mental' ); ?></h2>
		</article>

	<?php endif; ?>

<?php if ( $footer_parallax_effect ): ?>
	</div>
<?php endif ?>

	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer-woocommerce' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>
