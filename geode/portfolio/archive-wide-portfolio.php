<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

	<?php get_template_part( 'title', '' ); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">


				<?php if ( have_posts() ) : ?>

					<div class="row">
						<div class="row-inside">

							<div class="sc-filter-wrap">

								<?php echo geode_portfolio_filter(); ?>

								<div class="sc-grid cf" <?php do_action('geode_loop_product_data'); ?>>

								<?php while ( have_posts() ) : the_post();

									get_template_part( 'portfolio/content', get_post_format() );

								endwhile; ?>

								</div><!-- .sc-grid -->

								<?php geode_pagenavi(); ?>

							</div><!-- .sc-filter-wrap -->
						</div><!-- .row-inside -->
					</div><!-- .row -->


			<?php else :
						
				get_template_part( 'content', 'none' );

			endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>