<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

<?php get_template_part( 'title', '' ); ?>
<div class="site-content cf site-main double-side-template">
	<?php geode_sidebar('left'); ?>

	<div id="primary" class="alignleft" data-delay="0">
		<div id="content" role="main">

			<div class="sc-filter-wrap">
				<?php echo geode_portfolio_filter(); ?>

					<?php if ( have_posts() ) : ?>

						<div class="sc-grid cf" <?php do_action('geode_loop_product_data'); ?>>

						<?php while ( have_posts() ) : the_post();

							get_template_part( 'portfolio/content', get_post_format() );

						endwhile; ?>

						</div><!-- .sc-grid -->

						<?php geode_pagenavi(); ?>

				<?php else :
				
					get_template_part( 'content', 'none' );

					endif; ?>

			</div><!-- .sc-filter-wrap -->
			
		</div><!-- #content -->
	</div><!-- #primary -->

	<?php geode_sidebar('right'); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>